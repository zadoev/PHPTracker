<?php

namespace PHPTracker\Bencode\Value;

use PHPTracker\Bencode\Error\InvalidTypeError;

/**
 * Decoded bencode integer, representing a number.
 *
 * @package PHPTracker
 * @subpackage Bencode
 */
class Integer extends AbstractValue
{
    /**
     * Intializing the object with its parsed value.
     *
     * @throws InvalidTypeError In the value is not an integer.
     * @param integer $value
     */
    public function __construct( $value )
    {
        if ( !( is_numeric( $value ) && is_int( ( $value + 0 ) ) ) )
        {
            throw new InvalidTypeError( "Invalid integer value: $value" );
        }
        $this->value = intval( $value );
    }

    /**
     * Convert the object back to a bencoded string when used as string.
     */
    public function __toString()
    {
        return "i" . $this->value . "e";
    }

    /**
     * Represent the value of the object as PHP scalar.
     */
    public function represent()
    {
        return $this->value;
    }
}
