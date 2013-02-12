<?php

namespace PHPTracker\Test\Whitebox\Bencode\Value;

use PHPTracker\Bencode\Value\Integer;

/**
 * Test class for PHPTracker\Bencode\Value\Integer.
 */
class IntegerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPTracker\Bencode\Value\Integer
     */
    private $object;

    public function setUp()
    {
        $this->object = new Integer( 111 );
    }

    public function testStringConversion()
    {
        $this->assertSame( 'i111e', (string) $this->object );
    }

    public function testRepresent()
    {
        $this->assertSame( 111, $this->object->represent() );
    }

    /**
     * @expectedException PHPTracker\Bencode\Error\InvalidTypeError
     */
    public function testInvalidValue()
    {
         new Integer( 'abcdef' );
    }

}
