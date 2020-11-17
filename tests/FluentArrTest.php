<?php


namespace Atlas\FluentArr\Test;

use PHPUnit\Framework\TestCase;
use Atlas\FluentArr\FluentArr;

class FluentArrTest extends TestCase
{
    const SIMPLE_INDEXES_ARRAY = [1,2,3,4,5];
    const SIMPLE_ASSOC_ARRAY = ['key1' => 'value1', 'key2' => 'value2'];

    /** @test */
    public function test_countable()
    {
        $fluentArr = new FluentArr(self::SIMPLE_INDEXES_ARRAY);
        $this->assertEquals(count(self::SIMPLE_INDEXES_ARRAY), count($fluentArr));
    }

    /** @test */
    public function test_correct_count_after_unset()
    {
        $testArray = self::SIMPLE_INDEXES_ARRAY;
        $fluentArr = new FluentArr($testArray);
        unset($testArray[2]);
        unset($fluentArr[2]);
        $this->assertEquals(count($testArray), count($fluentArr));
    }

    /** @test */
    public function test_correct_offset_add()
    {
        $fluentArr = new FluentArr(self::SIMPLE_INDEXES_ARRAY);
        $addElement = [2];
        $fluentArr[]= $addElement;
        $this->assertEquals($addElement, $fluentArr[count($fluentArr)-1]);
    }

    /** @test */
    public function test_foreach()
    {
        $fluentArr = new FluentArr(self::SIMPLE_INDEXES_ARRAY);
        foreach ($fluentArr as $key => $value) {
            $this->assertEquals($value, self::SIMPLE_INDEXES_ARRAY[$key]);
        }
    }

    public function test_get_reference()
    {
        $key = 'key2';
        $newValue = 'value3';
        $fluentArr = new FluentArr(self::SIMPLE_ASSOC_ARRAY);
        $elt = &$fluentArr->get($key);
        $elt = $newValue;
        $this->assertEquals($newValue, $fluentArr[$key]);
    }

    public function test_chaining_set()
    {
        $fluentArr = new FluentArr();
        $fluentArr->set('key1', 'value1')->set('key2', 'value2');
        $this->assertCount(2, $fluentArr);
        $this->assertEquals($fluentArr['key1'], 'value1');
        $this->assertEquals($fluentArr['key2'], 'value2');
    }

    public function test_magic_set()
    {
        $value = 'value';
        $fluentArr = new FluentArr();
        $fluentArr->key = $value;
        $this->assertEquals($fluentArr['key'], $value);
        $this->assertCount(1, $fluentArr);
    }

    public function test_magic_get()
    {
        $key = 'key2';
        $newValue = 'value3';
        $fluentArr = new FluentArr(self::SIMPLE_ASSOC_ARRAY);
        $elt = &$fluentArr->$key;
        $elt = $newValue;
        $this->assertEquals($newValue, $fluentArr[$key]);
    }
}