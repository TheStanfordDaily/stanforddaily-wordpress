<?php
class Helper {
    public static $ipv4NetMask = "255.255.255.0";
    public static $ipv6NetMask = "ffff:ffff:ffff:ffff:ffff:ffff:0:0";
    public static function objectToArray( $d ) {
        if ( is_object( $d ) ) {
            $d = get_object_vars( $d );
        }
        if ( is_array( $d ) ) {
            return array_map( [__CLASS__, __METHOD__], $d );
        }
        else {
            return $d;
        }
    }
    public static function group_other_answers( $other_answers ) {
        $grouped = [];
        foreach ( $other_answers as $oa ) {
            foreach ( $oa['other_answers'] as $a ) {
                if ( '' !== $a ) {
                    $grouped[$oa['question_id']][] = $a;
                }
            }
        }
        return $grouped;
    }
    public static function yop_fputcsv( $handle, $fields, $delimiter = ',', $enclosure = '"', $escape = '\\' ) {
        foreach ( $fields as $key => $field ) {
            $field = addslashes ( $field );
            if ( !preg_match('/^(["\']).*\1$/m', $field ) ) {
                $fields[$key] =  $enclosure.$field.$enclosure;
            } else {
                $fields[$key] = $field;
            }
        }
        $line = implode( $delimiter, $fields );
        fwrite( $handle, "$line\n" );
        return true;
    }
	public static function anonymize_ip( $address ) {
        $packedAddress = inet_pton( $address );
        if ( 4 == strlen( $packedAddress ) ) {
            return self::anonymize_ipv4( $address );
        } elseif ( 16 == strlen( $packedAddress ) ) {
            return self::anonymize_ipv6( $address );
        } else {
            return "";
        }
    }
	public static function anonymize_ipv4( $address ) {
        return inet_ntop(inet_pton( $address ) & inet_pton( self::$ipv4NetMask ) );
    }
    public static function anonymize_ipv6( $address ) {
        return inet_ntop( inet_pton( $address ) & inet_pton( self::$ipv6NetMask ) );
    }
}
