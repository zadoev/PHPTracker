<?php

namespace PHPTracker\Test\Whitebox\Bencode\Value;

use PHPTracker\Bencode\Value\Container;
use PHPTracker\Bencode\Value\Integer;
use PHPTracker\Bencode\Value\String;


class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPTracker\Bencode\Value\Container
     */
    private $object;

    public function setUp()
    {
        // Don't call constructor.
        $this->object = $this->getMockForAbstractClass( 'PHPTracker\Bencode\Value\Container', array(), '', false );
    }

    public function testConstructAssociative()
    {
        $test_array = array(
            'key1' => new Integer( 1 ),
            'key2' => new Integer( 2 ),
        );

        $this->object->expects( $this->at( 0 ) )
            ->method( 'contain' )
            ->with(
                $this->equalTo( $test_array['key1'] ),
                $this->isInstanceOf( 'PHPTracker\Bencode\Value\String' )
            );
        $this->object->expects( $this->at( 1 ) )
            ->method( 'contain' )
            ->with(
                $this->equalTo( $test_array['key2'] ),
                $this->isInstanceOf( 'PHPTracker\Bencode\Value\String' )
            );

        $this->object->__construct( $test_array );
    }

    public function testConstructList()
    {
        $test_array = array(
            new Integer( 3 ),
            new Integer( 4 ),
        );

        $this->object->expects( $this->at( 0 ) )
            ->method( 'contain' )
            ->with(
                $this->equalTo( $test_array[0] )
            );
        $this->object->expects( $this->at( 1 ) )
            ->method( 'contain' )
            ->with(
                $this->equalTo( $test_array[1] )
             );

        $this->object->__construct( $test_array );
    }

}
