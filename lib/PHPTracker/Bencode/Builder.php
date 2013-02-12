<?php

namespace PHPTracker\Bencode;

use PHPTracker\Bencode\Value\AbstractValue;
use PHPTracker\Bencode\Value\Container;
use PHPTracker\Bencode\Value\Dictionary;
use PHPTracker\Bencode\Value\Integer;
use PHPTracker\Bencode\Value\ListValue;
use PHPTracker\Bencode\Value\String;
use PHPTracker\Bencode\Error\BuildError;

/**
 * Class creating a Bencode string out of PHP values (arrays, scalars).
 *
 * @package PHPTracker
 * @subpackage Bencode
 */
class Builder
{
    /**
     * Given an input value, converts it to a Bencode value.
     *
     * @param mixed $input Any PHP scalar or array containing arrays of scalars.
     * @return AbstractValue
     */
    static public function build( $input )
    {
        if ( is_int( $input ) )
        {
            return new Integer( $input );
        }
        if ( is_string( $input ) )
        {
            return new String( $input );
        }
        if ( is_array( $input ) )
        {
            // Creating sub-elements to construct list/dictionary.
            $constructor_input = array();
            foreach ( $input as $key => $value )
            {
                $constructor_input[$key] = self::build( $value );
            }

            if ( self::isDictionary( $input ) )
            {
                return new Dictionary( $constructor_input );
            }
            else
            {
                return new ListValue( $constructor_input );
            }
        }

        throw new BuildError( "Invalid input type when building: " . gettype( $input ) );
    }

    /**
     * Tries to tell if an array is associative or an indexed list.
     *
     * @param array $array
     * @return boolean True if the array looks like associative.
     */
    static public function isDictionary( array $array )
    {
        // Checking if the keys are ordered numbers starting from 0.
        return array_keys( $array ) !== range( 0, ( count( $array ) - 1 ) );
    }
}
