<?php

function clean_snippet($snippet) {
    // from wp_trim_excerpt()
    $snippet = str_replace( ']]>', ']]&gt;', $snippet );

    return trim( $snippet );
}

function check_to_see_if_more_tag_is_set($post) {
    $extended_content = get_extended( $post->post_content );
    $more_is_being_used = $extended_content['extended'] ? true : false;

    return $more_is_being_used || strpos($post->post_content, "<span id=\"more-" . $post->ID . "\"></span>") !== false;
}

function split_post($post) {

    $length_type = 'words'; // words or characters
    $finish = 'sentence'; // exact, word, or sentence
    //   $content = wpautop($post->post_content);
    $content = $post->post_content;
    $p_tag = strpos( $content, '</p>' ); // find the string position of the first instance of '</p>', else false
    $length = 40; // use this if $p_tag is false

    $extended_content = get_extended( $content );
    $more_is_being_used = $extended_content['extended'] ? true : false;

    $unfiltered_content = trim($content);

  // If "read more" is on, set the snippet to the first extended content chunk; if not, we cut it ourselves
    if ( $more_is_being_used) {
        $snippet = $extended_content['main'];
        $remainder = $extended_content['extended'];
    } elseif (strpos($content, "<span id=\"more-" . $post->ID . "\"></span>") !== false ) {
        $pos = strpos($content, "<span id=\"more-" . $post->ID . "\"></span>");
        $snippet = substr($content, 0, $pos);
        $remainder = substr($content, $pos, strlen($content));
    } else {
        // if the p tag is found, set snippet to be the first paragraph, else fallback to the old way of doing excerpts (40 words, ends on a sentence)
        $snippet = !!$p_tag ? get_first_paragraph($content, $p_tag) : text_excerpt( $content, $length, $length_type, $finish );
        $len = strlen($snippet);
        $remainder = substr( $content, $len);
    }

  // $remainder = reverse_balance_tags($remainder);
    $whole_content = $snippet . '<div id="pico-break"></div>' . $remainder;
    return ['snippet' => htmLawed($snippet), 'remainder' => htmLawed($remainder), 'content' => htmLawed($whole_content)];
}

function get_first_paragraph($text, $position_of_closing_p_tag) {
	return substr($text, 0, $position_of_closing_p_tag) . '</p>';
}

function text_excerpt( $text, $length, $length_type, $finish ) {
    $tokens = array();
    $result = '';
    $w = 0;

    // Divide the string into tokens; HTML tags, or words, followed by any whitespace
    // (<[^>]+>|[^<>\s]+\s*)
    preg_match_all( '/(<[^>]+>|[^<>\s]+)\s*/u', $text, $tokens );
    // parse each token
    foreach ( $tokens[0] as $t ) {
        if ( $w >= $length && 'sentence' != $finish ) { // Limit reached
            break;
        }
        // Token is not a tag
        if ( $t[0] != '<' ) {
            // Limit reached, continue until ? . or ! occur at the end
            if ( $w >= $length && 'sentence' == $finish && preg_match( '/[\?\.\!]\s*$/uS', $t ) == 1 ) {
                $result .= trim( $t );
                break;
            }

            if ( 'words' == $length_type ) {
                $w++;
            } else { // Count/trim characters
                $chars = trim( $t ); // Remove surrounding space
                $c = strlen( $chars );
                if ( $c + $w > $length && 'sentence' != $finish ) { // Token is too long
                    $c = ( 'word' == $finish ) ? $c : $length - $w; // Keep token to finish word
                    $t = substr( $t, 0, $c );
                }
                $w += $c;
            }
        }

        // Append what's left of the token
        $result .= $t;
    }

    return $result;
}


function reverse_balance_tags( $text ) {
    $tagqueue = "";
    $restartable_tags = array( 'div', 'p', 'span', 'strong', 'em', 'blockquote' );
    preg_match_all("/<(\/?[\w:]*)\s*([^>]*)>/", $text, $regex);
    $match_length = count($regex[1]);

    for ($i = $match_length; $i >= 0; $i--) {

        if ( isset($regex[1][$i][0]) && '/' == $regex[1][$i][0] ) {

            $tag_name = strtolower( substr($regex[1][$i],1));

            $starting_tag_found = false;
            for ( $j = $i-1; $j >= 0; $j-- ) {
                if (strtolower($regex[1][$j]) === $tag_name) {
                    $starting_tag_found = true;
                    break;
                }
            }

            if ($starting_tag_found) {
                continue;
            } else {
                if (in_array($tag_name, $restartable_tags)) {
                    $tag = "<" . $tag_name . ">";
                    $tagqueue .= $tag;
                }
            }
        }
    }

    return $tagqueue .= $text;
}
