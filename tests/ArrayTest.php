<?php

use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase {
    protected $array;
    public function setUp() {
        $this->array = [];
        $this->array[0] = 'one';
    }

    public function testArrayInitiallyHasOneItem() {

        $this->assertNotEmpty($this->array);
        $this->assertEquals("one", $this->array[0]);
    }

    public function testCanAddItemToArray() {

        $this->array[] = "two";

        $this->assertEquals("two", $this->array[1]);
        $this->assertCount(2, $this->array);
    }
}
