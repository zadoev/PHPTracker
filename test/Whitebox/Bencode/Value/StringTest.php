<?php

namespace PHPTracker\Test\Whitebox\Bencode\Value;

use PHPTracker\Bencode\Value\String;


class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPTracker\Bencode\Value\String
     */
    private $object;

    public function setUp()
    {
        $this->object = new String( 'abcdef' );
    }

    public function testStringConversion()
    {
        $this->assertSame( '6:abcdef', (string) $this->object );
    }

    public function testRepresent()
    {
        $this->assertSame( 'abcdef', $this->object->represent() );
    }

    /**
     * @expectedException PHPTracker\Bencode\Error\InvalidTypeError
     */
    public function testInvalidValue()
    {
        new String( array() );
    }
}
