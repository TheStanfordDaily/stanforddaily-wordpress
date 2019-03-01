<?php namespace wp;

class AdmiralAdBlockAnalytics
{

    /**
     * Suffix to append to the user-agent when proxying requests
     * @var string
     */
    public static $UASuffix = "ADMIRALWP/1.7.0";

    /**
     * Default duration (1 day) (24 * 60 * 60) to store the embed for before requesting another script
     * @var int
     */
    const DEFAULT_EMBED_EXPIRATION = 86400;

    /**
     * Option keys for admiral plugin settings and other configuration data
     */
    const PROPERTY_OPTION_ID_KEY = "admiral_property_id";
    const PROPERTY_PROMISE_OPTION_ID_KEY = "admiral_property_promise_id";
    const PROPERTY_PROMISE_PROPERTY_OPTION_ID_KEY = "admiral_property_promise_property_id";
    const EMBED_OPTION_KEY = "admiral_embed";
    const EMBED_EXPIRATION_OPTION_KEY = "admiral_embed_expiration";
    const APPEND_PHP_OPTION_KEY = "admiral_append_php";
    const HIDE_NOTICE_OPTION_KEY = "admiral_hide_notice";

    /**
     * Admiral PropertyID you get when signing up for Admiral
     * @var string
     */
    private static $propertyID = "";

    /**
     * Admiral PropertyPromiseID you get when signing up for Admiral
     * @var string
     */
    private static $propertyPromiseID = "";

    /**
     * Admiral Embed script you get when signing up for Admiral
     * @var string
     */
    private static $embed = "";

    /**
     * Endpoint to partner API
     */
    private static $partnerApiEndpoint = "//partner.api.getadmiral.com/";


    /**
     * List of headers to copy over when proxying the script
     * @var array
     */
    public static $headersToCopy = array("Vary",
                                         "Content-Encoding",
                                         "Expires",
                                         "Last-Modified",
                                         "Content-Type",
                                         "X-Hostname",
                                         "Date",
                                         "Cache-Control",
                                         );

    private static function setPropertyID($propertyID)
    {
        if (empty($propertyID)) {
            throw new Exception("PropertyID cannot be empty");
        }
        self::$propertyID = $propertyID;
    }

    public static function getPropertyID()
    {
        if(empty(self::$propertyID)){
            self::$propertyID = get_option(self::PROPERTY_OPTION_ID_KEY, "");
        }
        return self::$propertyID;
    }

    private static function setPropertyPromiseID($propertyPromiseID)
    {
        if (empty($propertyPromiseID)) {
            throw new Exception("propertyPromiseID cannot be empty");
        }
        self::$propertyPromiseID = $propertyPromiseID;
    }

    public static function getPropertyPromiseID()
    {
        if(empty(self::$propertyPromiseID)){
            self::$propertyPromiseID = get_option(self::PROPERTY_PROMISE_OPTION_ID_KEY, "");
        }
        return self::$propertyPromiseID;
    }

    public static function isPropertyOrphanProperty($propertyID){
        $promiseProperty = get_option(self::PROPERTY_PROMISE_PROPERTY_OPTION_ID_KEY, "");
        return $propertyID === $promiseProperty;
    }

    private static function setEmbed($embed)
    {
        if (empty($embed)) {
            throw new Exception("Embed cannot be empty");
        }
        self::$embed = $embed;
        update_option(self::EMBED_OPTION_KEY, $embed);
        update_option(self::EMBED_EXPIRATION_OPTION_KEY, time() * self::DEFAULT_EMBED_EXPIRATION);
    }

    /**
     * Retrieves the embed from the DB. If it doesn't exist or
     * has expired, retrieves an embed from kikis and returns it
     */
    public static function getEmbed()
    {
        if(empty(self::$embed)){
            self::$embed = get_option(self::EMBED_OPTION_KEY, "");
            $embedTimeout = get_option(self::EMBED_EXPIRATION_OPTION_KEY, 0);

            // If the no embed was stored in the DB, or the current embed is timed out
            // we should request a new embed script
            $isExpired = $embedTimeout < time();
            $isEmpty = empty(self::$embed) && !empty(self::getPropertyID());
            if($isExpired || $isEmpty){
                $script = self::requestEmbedScript();
                if(!empty($script)){
                    self::setEmbed($script);
                }
            }
        }
        return self::$embed;
    }

    public static function hideNotice()
    {
        update_option(self::HIDE_NOTICE_OPTION_KEY, 1);
    }

    public static function shouldShowNotice()
    {
        $hideNotice = get_option(self::HIDE_NOTICE_OPTION_KEY, 0);
        return empty($hideNotice);
    }

    private static $clientID = "";

    private static $clientSecret = "";

    public static function setClientIDSecret($clientID, $clientSecret)
    {
        self::$clientID = $clientID;
        self::$clientSecret = $clientSecret;
    }

    private static $pluginCode = "";

    private static $pluginVersion = "";

    private static $pluginName = "";

    /**
     * Retrieves the property ID and returns true or false respectively if it is set or not
     * Also allows for setting up the plugin code/version
     */
    public static function initialize($pluginCode, $pluginVersion, $pluginName)
    {
        self::$pluginCode = $pluginCode;
        self::$pluginVersion = $pluginVersion;
        self::$pluginName = $pluginName;
        self::$UASuffix = self::$UASuffix . " " . $pluginCode . "/" . $pluginVersion;
        add_action('admin_post_activate_admiral_adblocks_analytics_' . $pluginCode, function(){
            // Call redirect before all so that the user isn't sent to a blank page in case of handled error.
            $referer = wp_get_referer();
            if(!empty($referer)){
                wp_redirect($referer);
            } else {
                wp_redirect('index.php');
            }
            if(array_key_exists("accept", $_POST)){
                AdmiralAdBlockAnalytics::createNewProperty("");
            }
            AdmiralAdBlockAnalytics::hideNotice();
        });

        add_action('admin_post_claim_property_' . self::$pluginCode, self::$pluginCode . '\AdmiralAdBlockAnalytics::claimPropertyAction');

        // Show a claim property error with the query parameter is apparent
        if (!empty($_GET['claim_property_error'])) {
            add_action( 'admin_notices', self::$pluginCode . '\admiralClaimPropertyError' );
        }
        $propertyID = self::getPropertyID();
        if (empty($propertyID)) {
            return false;
        }
        return true;
    }


    public static function claimPropertyAction() {
        // Get a property claim token, and if there is an error, redirect to the same location to display the error
        $token = self::getPropertyClaimToken();
        if(empty($token)){
            $referer = wp_get_referer();
            if (empty($referer)) {
                $referer = 'index.php';
            }
            $query = parse_url($referer, PHP_URL_QUERY);
            // Returns a string if the URL has parameters or NULL if not
            if (!empty($query)) {
                $referer .= '&claim_property_error=1';
            } else {
                $referer .= '?claim_property_error=1';
            }
            wp_redirect($referer);
            return;
        }
        // If the token is received though, redirect to signup with the intent to claim-property
        wp_redirect('https://getadmiral.com/a/signup?i=claim-property&t=' . $token . '&d=' . get_site_url() . '&p=' . self::getPropertyID() . '&aid=' . self::$clientID);
    }

    /**
     * Retrieves the embed, and echos out the embed script in a script tag.
     */
    public static function printEmbedScripts()
    {
        $embed = self::getEmbed();
        if(!empty($embed)){
            echo $embed;
        }
    }

    private static function httpCall($url, $headers = array(), $postBody = "")
    {
        $res = array("source" => "",
                     "error" => null,
                     "headers" => array(),
                     );
        $urlWithScheme = "https:" . $url;
        $ua = self::$UASuffix;
        $foundUA = false;
        foreach ($headers as $key => $header) {
            if (stripos($header, "user-agent") !== false) {
                $parts = explode(":", $header, 2);
                $ua = (isset($parts[1]) ? trim($parts[1]) . " " : "") . $ua;
                $headers[$key] = "User-Agent: $ua";
                $foundUA = true;
            }
        }
        if (!$foundUA) {
            $headers[] = "User-Agent: $ua";
        }
        if (function_exists("curl_init")) {
            if (!empty($postBody) && !defined("CURLOPT_SAFE_UPLOAD") && stripos($postBody, "@") === 0) {
                $res["error"] = array("code" => -99999999,
                                      "str" => "Unallowed postBody starting with @",
                                      "type" => "self",
                                      );
                return $res;
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlWithScheme);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // we cannot use FOLLOWLOCATION is open_basedir is set
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
            // try to prevent caching
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
            $verbose = null;
            if (function_exists("stream_get_contents")) {
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                $verbose = fopen("php://temp", "w+");
                curl_setopt($ch, CURLOPT_STDERR, $verbose);
            }
            if (!empty($headers)) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            }
            if (!empty($postBody)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody);
                if (defined("CURLOPT_SAFE_UPLOAD")) {
                    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, 1);
                }
            }
            curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . "/caroots.crt");

            $src = curl_exec($ch);
            if ($src === false) {
                $err = curl_errno($ch);
                $str = "";
                if (function_exists("curl_strerror")) {
                    $str = curl_strerror($err);
                }
                $verboseLog = "";

                if (!empty($verbose) && function_exists("rewind")) {
                    rewind($verbose);
                    $verboseLog = stream_get_contents($verbose);
                }
                $res["error"] = array("code" => $err,
                                      "str" => $str,
                                      "type" => "curl",
                                      "debug" => $verboseLog,
                                      );
            } else {
                $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                if (function_exists("mb_substr")) {
                    $header = mb_substr($src, 0, $headerSize);
                } else {
                    $header = substr($src, 0, $headerSize);
                }
                $recvHeaders = explode("\r\n", $header);
                foreach ($recvHeaders as $h) {
                    foreach (self::$headersToCopy as $hc) {
                        if (stripos($h, $hc) === 0) {
                            $res["headers"][] = $h;
                            break;
                        }
                    }
                }

                //todo: look for "Location" header

                if (function_exists("mb_substr")) {
                    $res["source"] = mb_substr($src, $headerSize);
                } else {
                    $res["source"] = substr($src, $headerSize);
                }
            }
            curl_close($ch);

        } elseif (function_exists("wp_remote_retrieve_body") && function_exists("wp_safe_remote_get") && function_exists("wp_safe_remote_post")) {
            $args = array(
                "headers" => $headers,
                "user-agent" => $ua,
            );
            if (!empty($postBody)) {
                $args["body"] = $postBody;
                $resp = wp_safe_remote_post($urlWithScheme, $args);
            } else {
                $resp = wp_safe_remote_get($urlWithScheme, $args);
            }
            if (function_exists('is_wp_error') && is_wp_error($resp)) {
                $res["error"] = array("code" => $resp->get_error_code(),
                                      "str" => $resp->get_error_message(),
                                      "type" => "wp",
                                      );
            } else {
                $body = wp_remote_retrieve_body($resp);
                if (empty($body)) {
                    $res["error"] = array("code" => 0,
                                          "str" => "Unknown error but empty body",
                                          "type" => "wp",
                                          );
                } else {
                    $res["source"] = $body;
                    $headers = wp_remote_retrieve_headers($resp);
                    foreach ($headers as $key => $val) {
                        $src["headers"][] = "$key: $val";
                    }
                }
            }
        }
        return $res;
    }

    public static function registerSettings($optionGroup)
    {
        register_setting($optionGroup, self::PROPERTY_OPTION_ID_KEY);
        register_setting($optionGroup, self::EMBED_OPTION_KEY);
        register_setting($optionGroup, self::APPEND_PHP_OPTION_KEY);
    }

    public static function getPropertyIDInput()
    {
        $currentPropertyID = self::getPropertyID();
        $pidValue = $currentPropertyID;
        if (function_exists('htmlspecialchars')) {
            $pidValue = htmlspecialchars($pidValue);
        } else {
            $pidValue = str_replace('"', '&quot;', $pidValue);
        }
        return '<table class="form-table"><tbody><tr>
        <th>Property ID</th>
        <td>
        <input type="text" name="' . self::PROPERTY_OPTION_ID_KEY . '" value="' . $pidValue . '" />
        <p class="description">The property ID is a unique identifier for your site. If you already have an account at getadmiral.com enter the property ID found on the property settings page here. If you don’t, no worries! We’ve automatically created a property for you. <button form="cta-form" type="submit" style="background: none;border: 0;padding: 0;cursor: pointer;text-decoration: underline;color: #0073aa;">Create an account</button> to claim it!</p>
        </td></tr></tbody></table>
        <input type="hidden" name="' . self::EMBED_OPTION_KEY . '" value="" />';

    }

    public static function getCTA()
    {
        $pluginName = "This plugin";
        if (!empty(self::$pluginName)) {
            $pluginName = self::$pluginName;
        }
        return '<div class="sub-cta" style="max-width:800px;padding: 40px;border-radius: 6px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);background: linear-gradient(125deg,transparent 60%,rgba(41,98,255,.8)),#0c2c5b;color: #fff; overflow:auto;">
            <h3 style="font-size: 20px;margin-bottom: 10px;margin-top:0;color: #fff;">' . $pluginName . ' is now integrated with Admiral.</h3>
            <p style="color:white;">Admiral is the industry’s leading adblock revenue recovery specialists, serving over 12,000 customers worldwide. We build products that empower publishers to grow visitor relationships, protect copyrighted content, and recover advertising revenue.</p>
            <form id="cta-form" action="admin-post.php" method="POST">
                <input type="hidden" name="action" value="claim_property_' . self::$pluginCode .  '" />
                <button type="submit" style="background-color: #f44336;position: relative;display: block;height: 40px;padding: 0 16px;float: left;font-size: 14px;line-height:40px;border: 0;outline: 0;border-radius: 3px;cursor: pointer;overflow: hidden;box-sizing: border-box;transition: .25s; color:white;">Get Your Free Admiral Analytics</button>
            </form>
        </div>';
    }

    private static function getCTA_INTERNAL()
    {
        return '<div class="sub-cta" style="max-width:800px;padding: 40px;border-radius: 6px;box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);background: linear-gradient(125deg,transparent 60%,rgba(41,98,255,.8)),#0c2c5b;color: #fff; overflow:auto;">
            <h3 style="font-size: 20px;margin-bottom: 10px;margin-top:0;color: #fff;">Free Adblock Analytics with Admiral.</h3>
            <p style="color:white;">Admiral is the industry’s leading adblock revenue recovery specialists, serving over 12,000 customers worldwide. We build products that empower publishers to grow visitor relationships, protect copyrighted content, and recover advertising revenue.</p>
            <form id="cta-form" action="admin-post.php" method="POST">
                <input type="hidden" name="action" value="claim_property_' . self::$pluginCode .  '" />
                <button type="submit" style="background-color: #f44336;position: relative;display: block;height: 40px;padding: 0 16px;float: left;font-size: 14px;line-height:40px;border: 0;outline: 0;border-radius: 3px;cursor: pointer;overflow: hidden;box-sizing: border-box;transition: .25s; color:white;">View Analytics</button>
            </form>
        </div>';
    }

    public static function renderOptions()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        echo '<div class="wrap" style="margin-top: 30px;">
            <div class="logo-container">
                <img src="//cdn.getadmiral.com/logo-horz.svg" height="40" />
            </div>
            <p>The Admiral Wordpress Plugin allows you to easily measure how much revenue you are losing to adblock.</p>
            ' . self::getCTA_INTERNAL() . '
            <form method="post" action="options.php">';
        settings_fields('admiral_property_settings');
        do_settings_sections('admiral_property_settings');
        echo self::getPropertyIDInput();
        submit_button();
        echo '</form>
        </div>';
    }

    private static function getSecretPromiseCall()
    {
        $postData = array(
            "method" => "Partner.CreateSecretPromise",
            "jsonrpc" => "2.0",
            "params" => array(
                "clientID" => self::$clientID,
                "clientSecret" => self::$clientSecret
            )
        );
        $res = self::httpCall(self::$partnerApiEndpoint, array(), json_encode($postData));
        if(empty($res["source"])){
            return "";
        }
        $body = json_decode($res["source"]);
        if(empty($body->result)){
            return "";
        }
        return $body->result->secretPromise;
    }

    private static function createPropertyCall($secretPromise, $domain)
    {
        $postData = array(
            "method" => "Partner.NewOrphanProperty",
            "jsonrpc" => "2.0",
            "params" => array(
                "clientID" => self::$clientID,
                "clientSecretPromise" => $secretPromise,
                "domain" => $domain,
                "withEmbed" => true
            )
        );
        $res = self::httpCall(self::$partnerApiEndpoint, array(), json_encode($postData));
        if(empty($res["source"])){
            return "";
        }
        $body = json_decode($res["source"]);
        if(empty($body->result)){
            return "";
        }
        return $body->result;
    }

    /**
     * Function to create new anonymous property
     */
    public static function createNewProperty($domain)
    {
        $secretPromise = self::getSecretPromiseCall();
        if(empty($domain)){
            $domain = get_site_url();
        }
        if(!empty($secretPromise)){
            $property = self::createPropertyCall($secretPromise, $domain);
            if(!empty($property)){
                self::setPropertyID($property->propertyID);
                self::setPropertyPromiseID($property->propertyPromiseID);
                update_option(self::PROPERTY_OPTION_ID_KEY, self::getPropertyID());
                update_option(self::PROPERTY_PROMISE_OPTION_ID_KEY, self::getPropertyPromiseID());
                update_option(self::PROPERTY_PROMISE_PROPERTY_OPTION_ID_KEY, self::getPropertyID());
                // Get embed will handle any potential fetching of embed code at this point
                self::setEmbed($property->embed);
                return true;
            } else {
                return false;
            }
        }
    }

    // Make a request to the delivery service to get a script for this property
    private static function getPropertyClaimToken()
    {
        $secretPromise = self::getSecretPromiseCall();
        $postData = array(
            "method" => "Partner.GetClaimPropertyToken",
            "jsonrpc" => "2.0",
            "params" => array(
                "clientID" => self::$clientID,
                "clientSecretPromise" => $secretPromise,
                "propertyID" => self::getPropertyID(),
                "propertyPromiseID" => self::getPropertyPromiseID()
            )
        );
        $res = self::httpCall(self::$partnerApiEndpoint, array(), json_encode($postData));
        if(empty($res["source"])){
            return "";
        }
        $body = json_decode($res["source"]);
        if(empty($body->result)){
            return "";
        }
        if(empty($body->result->claimPropertyToken)){
            return "";
        }
        return $body->result->claimPropertyToken;
    }

    // Make a request to the delivery service to get a script for this property
    private static function requestEmbedScript()
    {
        $propertyID = self::getPropertyID();
        if(!self::isPropertyOrphanProperty($propertyID)){
            $res = self::httpCall("//delivery.api.getadmiral.com/script/" . $propertyID . "/bootstrap", array());
            return '<script>' . $res["source"] . '</script>';
        }
        $secretPromise = self::getSecretPromiseCall();
        $postData = array(
            "method" => "Partner.GetEmbedCode",
            "jsonrpc" => "2.0",
            "params" => array(
                "clientID" => self::$clientID,
                "clientSecretPromise" => $secretPromise,
                "propertyID" => $propertyID,
                "propertyPromiseID" => self::getPropertyPromiseID()
            )
        );
        $res = self::httpCall(self::$partnerApiEndpoint, array(), json_encode($postData));
        if(empty($res["source"])){
            return "";
        }
        $body = json_decode($res["source"]);
        if(empty($body->result)){
            return "";
        }
        if(empty($body->result->embed)){
            return "";
        }
        return $body->result->embed;
    }

    /**
     * Function to add an alert to the top of the admin dashboard
     * to let a user know they need to initialize admiral.
     */
    public static function alertAdminToActivate()
    {
        add_action('admin_head-index.php', function(){
            $html = <<<HTML
            <div class="update-nag notice">
                <img src="//cdn.getadmiral.com/logo-horz.svg" height="30" />
                <div>
                    <p>Block Adblock now comes with advanced adblock analytics from Admiral. Click accept to start collecting data and discover how much revenue you're losing to adblockers. <a href="https://getadmiral.com/faq#claim-property">Click here</a> to learn more.</p>
                    <form action="admin-post.php" method="POST">
                        <input type="hidden" name="action" value="activate_admiral_adblocks_analytics_%s" />
                        <button class="button button-primary" name="accept" type="submit">Accept</button>
                        <button class="button" name="decline" type="submit">Decline</button>
                    </form>
                </div>
            </div>
HTML;
            echo sprintf($html, self::$pluginCode);
        });

    }
}


function admiralClaimPropertyError () {
    ?>
    <div class="error notice">
        <p>Failed to redirect you to claim your property. Please contact us at <a href="https://getadmiral.com/contact">https://getadmiral.com/contact</a>.</p>
    </div>
    <?php
}

/* EOF */
