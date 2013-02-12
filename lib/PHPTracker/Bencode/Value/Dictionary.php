<?php

namespace PHPTracker\Bencode\Value;

use PHPTracker\Bencode\Error\InvalidTypeError;
use PHPTracker\Bencode\Error\InvalidValueError;

/**
 * Decoded bencode dictionary, consisting of key-value pairs.
 *
 * @package PHPTracker
 * @subpackage Bencode
 */
class Dictionary extends Container
{
    /**
     * Adds an item to the dictionary.
     *
     * @param AbstractValue $sub_value
     * @param String $key
     */
    public function contain( AbstractValue $sub_value, String $key = null )
    {
        if ( !isset( $key ) )
        {
            throw new InvalidTypeError( "Invalid key value for dictionary: $sub_value" );
        }
        if ( isset( $this->value[$key->value] ) )
        {
            throw new InvalidValueError( "Duplicate key in dictionary: $key->value" );
        }
        $this->value[$key->value] = $sub_value;
    }

    /**
     * Convert the object back to a bencoded string when used as string.
     */
    public function __toString()
    {
        // All keys must be byte strings and must appear in lexicographical order.
        ksort( $this->value );

        $string_represent = "d";
        foreach ( $this->value as $key => $sub_value )
        {
            $key = new String( $key );
            $string_represent .=  $key . $sub_value;
        }
        return $string_represent . "e";
    }
}
