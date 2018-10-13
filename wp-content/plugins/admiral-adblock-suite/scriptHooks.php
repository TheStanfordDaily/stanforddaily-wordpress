<?php
// this file should only be included if AdmiralAdBlockAnalytics::enabled()

// block direct access to this plugin
defined("ABSPATH") or die("");

function admiraladblock_request_ip_string()
{
    $xff = "";
    if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $xff = $_SERVER["HTTP_X_FORWARDED_FOR"] . ", ";
    } else if (!empty($_SERVER["X_FORWARDED_FOR"])) {
        $xff = $_SERVER["X_FORWARDED_FOR"] . ", ";
    } else if (!empty($_SERVER["HTTP_X_CLIENT_IP"])) {
        return $_SERVER["HTTP_X_CLIENT_IP"];
    } else if (!empty($_SERVER["X_CLIENT_IP"])) {
        return $_SERVER["X_CLIENT_IP"];
    } else if (!empty($_SERVER["HTTP_X_REAL_IP"])) {
        return $_SERVER["HTTP_X_REAL_IP"];
    } else if (!empty($_SERVER["X_REAL_IP"])) {
        return $_SERVER["X_REAL_IP"];
    }
    return $xff . $_SERVER["REMOTE_ADDR"];
}

function admiraladblock_copy_headers()
{
    $headers = array();
    if (!empty($_SERVER["HTTP_USER_AGENT"])) {
        $headers[] = "User-Agent: " . $_SERVER["HTTP_USER_AGENT"];
    }
    if (!empty($_SERVER["HTTP_REFERER"])) {
        $headers[] = "Referer: " . $_SERVER["HTTP_REFERER"];
    }
    if (!empty($_SERVER["HTTP_ORIGIN"])) {
        $headers[] = "Origin: " . $_SERVER["HTTP_ORIGIN"];
    }
    $headers[] = "X-Forwarded-For: " . admiraladblock_request_ip_string();
    return $headers;
}

function admiraladblock_inject_public_script($uri, $host, $acceptEncoding)
{
    $res = array("matched" => false,
                 "error" => null,
                 "source" => "",
                 "headers" => array(),
                 "contentType" => "application/javascript",
                 );
    if (empty($uri) || $_SERVER["REQUEST_METHOD"] !== "GET" || stripos($uri, AdmiralAdBlockAnalytics::$scriptURIPrefix) !== 0) {
        return $res;
    }

    $offset = strlen(AdmiralAdBlockAnalytics::$scriptURIPrefix);
    // check if this is a valid filename
    $basename = substr($uri, $offset);
    //make sure the filename doesn't already exist first
    if (AdmiralAdBlockAnalytics::doesWPContentFileExist($basename)) {
        //error_log("AdmiralAnalytics: Preventing injecting existing file for $basename");
        return $res;
    }

    $scripts = array(
        "", // default is empty string
    );
    $chosenName = false;
    foreach ($scripts as $script) {
        $seeds = AdmiralAdBlockAnalytics::getSeedsForScript($script, $host);
        if (AdmiralAdBlockAnalytics::doesURIContainRandomFilename($uri, $seeds)) {
            $chosenName = $script;
            break;
        }
    }
    if ($chosenName === false) {
        return $res;
    }

    $res["matched"] = true;

    $headers = admiraladblock_copy_headers();
    if (!empty($acceptEncoding)) {
        $headers[] = "Accept-Encoding: $acceptEncoding";
    }
    $testVersion = false;
    if (!empty($_SERVER["HTTP_ADMIRAL_TEST"])) {
        $testVersion = true;
    } else if (!empty($_COOKIE["admiral_test"])) {
        $testVersion = true;
    }
    $scriptRes = AdmiralAdBlockAnalytics::fetchScript($headers, $_SERVER["HTTP_HOST"], $chosenName, $testVersion);
    $res["error"] = $scriptRes["error"];
    $res["source"] = $scriptRes["source"];
    $res["headers"] = $scriptRes["headers"];
    return $res;
}

function admiraladblock_proxy_record($uri, $host)
{
    $res = array("matched" => false,
                 "error" => null,
                 "source" => "",
                 "headers" => array(),
                 "contentType" => "application/json",
                 );
    if (empty($uri) || $_SERVER["REQUEST_METHOD"] !== "POST" || substr_count($uri, "/") > 1) {
        return $res;
    }

    $seeds = AdmiralAdBlockAnalytics::getSeedsForRecord($host);
    if (!AdmiralAdBlockAnalytics::doesURIContainRandomFilename($uri, $seeds)) {
        return $res;
    }

    $res["matched"] = true;

    $entityBody = "";
    try {
        $entityBody = file_get_contents('php://input');
    } catch (Exception $e) {
        error_log("AdmiralAnalytics: Error reading POST body: " . $e->getMessage());
        $res["error"] = $e->getMessage();
        return $res;
    }

    $headers = admiraladblock_copy_headers();
    $proxyRes = AdmiralAdBlockAnalytics::proxyRecord($entityBody, $headers);
    $res["error"] = $proxyRes["error"];
    $res["source"] = $proxyRes["source"];
    $res["headers"] = $proxyRes["headers"];
    return $res;
}

function admiraladblock_list_plugins($uri, $host)
{
    $res = array("matched" => false,
                 "error" => null,
                 "source" => "",
                 "headers" => array(),
                 "contentType" => "text/plain",
                 );
    $prefix = "/wp-debug/";
    if (empty($uri) || $_SERVER["REQUEST_METHOD"] !== "GET" || !empty($_SERVER["HTTP_REFERER"]) || !empty($_SERVER["HTTP_ORIGIN"]) || stripos($uri, $prefix) !== 0) {
        return $res;
    }

    $seeds = AdmiralAdBlockAnalytics::getSeedsForDebug($host);
    if (!AdmiralAdBlockAnalytics::doesURIContainRandomFilename($uri, $seeds)) {
        return $res;
    }

    if (empty($_COOKIE["admiral_debug"])) {
        return $res;
    }

    if (!function_exists("get_plugins")) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    print_r(get_plugins());
    print_r($_SERVER);
    die();
}

function admiraladblock_inject_proxy()
{
    $hopHeaders = array(
        "Connection:",
        "Keep-Alive:",
        "Te:",
        "Trailer:",
        "Transfer-Encoding:",
        "Upgrade:",
    );

    $acceptEncoding = "";
    if (!empty($_SERVER["HTTP_ACCEPT_ENCODING"])) {
        // we only accept gzip encoding, so we can ungzip if headers were sent
        if (stripos($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") !== false && function_exists('gzdecode')) {
            $acceptEncoding = "gzip";
        } else {
            $acceptEncoding = "";
        }
    }
    $res = admiraladblock_inject_public_script($_SERVER["REQUEST_URI"], $_SERVER["HTTP_HOST"], $acceptEncoding);
    if (!$res["matched"]) {
        $res = admiraladblock_proxy_record($_SERVER["REQUEST_URI"], $_SERVER["HTTP_HOST"]);
        if (!$res["matched"]) {
            $res = admiraladblock_list_plugins($_SERVER["REQUEST_URI"], $_SERVER["HTTP_HOST"]);
            if (!$res["matched"]) {
                return;
            }
        }
        // let the proxy request go through for the record proxy
    }
    if (empty($res["error"])) {
        $shouldDecode = false;
        if (!empty($res["headers"])) {
            foreach ($res["headers"] as $header) {
                if (stripos($header, "content-encoding: gzip") !== false) {
                    $shouldDecode = true;
                }
            }
        } else {
            // we have no idea what the response is, so we must try
            $shouldDecode = true;
        }
        if (!headers_sent()) {
            if (!empty($res["headers"])) {
                foreach ($res["headers"] as $header) {
                    foreach ($hopHeaders as $banned) {
                        if (stripos($header, $banned) === 0) {
                            continue 2;
                        }
                    }
                    header($header, true);
                }
                // tell mod_deflate that we don't want it to gzip
                header("no-gzip: 1", true);
                // detect if they have output_compression on our output buffering
                $hasGzipOB = false;
                if (function_exists("ini_get") && ini_get("zlib.output_compression") === "1") {
                    ini_set("zlib.output_compression", "Off");
                } elseif (function_exists("ob_list_handlers")) {
                    $obHandlers = ob_list_handlers();
                    foreach ($obHandlers as $handler) {
                        if (stripos($handler, "zlib") !== false || stripos($handler, "gzhandler") !== false) {
                            $hasGzipOB = true;
                            break;
                        }
                    }
                }
                // since we were able to write headers back, we assume we
                // wrote the Content-Encoding header. Unless they have gzip
                // output buffering then we have to decode since php's gzip ob
                // doesn't look at headers
                if (!$hasGzipOB) {
                    $shouldDecode = false;
                }
            } else {
                // at least tell the browser that its javascript
                header("Content-Type: {$res["contentType"]}", true);
            }
        }
        if ($shouldDecode) {
            // now we need to detect if the content is encoded and if it is decode it
            // unfortunately gzdecode errors if the data isn't gzip
            $src = @gzdecode($res["source"]);
            // if this returned false, then we can assume its not gzip
            if ($src !== false) {
                $res["source"] = $src;
            }
        } else if (function_exists("ob_get_status")) {
            $status = ob_get_status();
            if (!empty($status)) {
                ob_clean();
            }
        }
    }
    if (!empty($res["error"])) {
        $errorString = json_encode($res["error"]);
        error_log("AdmiralAnalytics: Error proxying: $errorString");
        if (!empty($_COOKIE["admiral_display_error"])) {
            echo print_r($res, true);
        } else if (function_exists("wp_die")) {
            wp_die("", "", 500);
        }
    } else {
        echo $res["source"];
    }
    die();
}

add_action("init", "admiraladblock_inject_proxy", 1);

function admiraladblock_enqueue_script()
{
    $url = AdmiralAdBlockAnalytics::getPublicScriptURL($_SERVER["HTTP_HOST"], "");
    if (!empty($url)) {
        // no deps, version is the current time / 5, false not in footer
        // we only want to cache this for at most 5 seconds
        $version =  "" . floor(time() / 5);
        wp_enqueue_script("admiral-adblock-analytics", $url, array(), $version, false);
    }
}

add_action("wp_enqueue_scripts", "admiraladblock_enqueue_script");

/* EOF */
