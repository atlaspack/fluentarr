<?php


namespace Atlas\FluentArr\Test;

use PHPUnit\Framework\TestCase;
use Atlas\FluentArr\FluentArr;

class FluentArrTest extends TestCase
{
    const SIMPLE_INDEXES_ARRAY = [1,2,3,4,5];

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
}