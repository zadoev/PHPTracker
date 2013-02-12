<?php

namespace PHPTracker\Test\Whitebox\Bencode;

use PHPTracker\Bencode\Builder;

class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider buildableInputs
     */
    public function testBuild( $input )
    {
       // Parse method returns AbstractValue objects, and they
       // should return PHP representation of themselves when calling represent.
       $this->assertSame( $input, Builder::build( $input )->represent() );
    }

    public static function buildableInputs()
    {
        return array(
            array( 12345 ), // Integer.
            array( 'foobar' ), // String.
            array( array( 'foo', 'bar', 'baz' ) ), // List.
            array( array( 'foo' => 'bar', 'baz' => 'bat' ) ), // Dictionary.
            array( array( 'foo' => array( 'baz', 'bat' ), 'baz' => 123 ) ), // Complex.
        );
    }

    /**
     * @expectedException PHPTracker\Bencode\Error\BuildError
     */
    public function testBuildErrorFloat()
    {
        Builder::build( 1.1111 );
    }

    /**
     * @expectedException PHPTracker\Bencode\Error\BuildError
     */
    public function testBuildErrorObject()
    {
        Builder::build( (object) array( 'attribute' => 'something' ) );
    }

}
