<?php

namespace PHPTracker\Test\Whitebox\Bencode\Value;

use PHPTracker\Bencode\Value\Dictionary;
use PHPTracker\Bencode\Value\Integer;
use PHPTracker\Bencode\Value\String;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPTracker\Bencode\Value\Dictionary
     */
    private $object;

    public function setUp()
    {
        $this->object = new Dictionary( array(
            'b' => new Integer( 12 ),
            'a' => new String( 'abc' ),
        ) );
    }

    public function testStringConversion()
    {
        // Keys are ABC ordered.
        $this->assertSame( 'd1:a3:abc1:bi12ee', (string) $this->object );
    }

    public function testRepresent()
    {
        $this->assertSame( array( 'b' => 12, 'a' => 'abc' ), $this->object->represent() );
    }

    /**
     * @expectedException PHPTracker\Bencode\Error\InvalidValueError
     */
    public function testDuplicate()
    {
        $this->object->contain( new String( 'xxx' ), new String( 'a' ) );
    }

    /**
     * @expectedException PHPTracker\Bencode\Error\InvalidTypeError
     */
    public function testNoKey()
    {
        $this->object->contain( new String( 'xxx' ) );
    }

}
