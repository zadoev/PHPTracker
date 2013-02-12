<?php

namespace PHPTracker\Bencode\Value;

use PHPTracker\Bencode\Error\InvalidTypeError;

/**
 * Decoded bencode string, representing an ordered set of bytes.
 *
 * @package PHPTracker
 * @subpackage Bencode
 */
class String extends AbstractValue
{
    /**
     * Intializing the object with its parsed value.
     *
     * @throws InvalidTypeError In the value is not a string.
     * @param string $value
     */
    public function __construct( $value )
    {
        if ( !is_string( $value ) )
        {
            throw new InvalidTypeError( "Invalid string value: " . var_export( $value, true ) );
        }
        $this->value = $value;
    }

    /**
     * Convert the object back to a bencoded string when used as string.
     */
    public function __toString()
    {
        return strlen( $this->value ) . ":" . $this->value;
    }

    /**
     * Represent the value of the object as PHP scalar.
     */
    public function represent()
    {
        return $this->value;
    }
}
