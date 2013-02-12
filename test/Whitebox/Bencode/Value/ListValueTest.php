<?php

namespace PHPTracker\Test\Whitebox\Bencode\Value;

use PHPTracker\Bencode\Value\ListValue;
use PHPTracker\Bencode\Value\Integer;
use PHPTracker\Bencode\Value\String;

class ListValueTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPTracker\Bencode\Value\ListValue
     */
    private $object;

    public function setUp()
    {
        $this->object = new ListValue( array(
            new Integer( 12 ),
            new String( 'abc' ),
        ) );
    }

    public function testStringConversion()
    {
        $this->assertSame( 'li12e3:abce', (string) $this->object );
    }

    public function testRepresent()
    {
        $this->assertSame( array( 12, 'abc' ), $this->object->represent() );
    }

}
