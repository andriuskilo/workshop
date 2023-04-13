<?php

declare(strict_types=1);

namespace Tests\Processor;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;
use PHPUnit\Framework\TestCase;

class QualityProcessorTest extends TestCase
{
    public function testIncreaseQualityLessThanFifty(): void
    {
        $item = new Item('+5 Dexterity Vest', 10, 20);
        $processor = new QualityProcessor();

        $processor->increaseQuality($item);
        $this->assertEquals(21, $item->quality);
    }

    public function testIncreaseQualityMoreThanFifty(): void
    {
        $item = new Item('+5 Dexterity Vest', 10, 50);
        $processor = new QualityProcessor();

        $processor->increaseQuality($item);
        $this->assertEquals(50, $item->quality);
    }

    public function testDecreaseQualityMoreThanZero(): void
    {
        $item = new Item('+5 Dexterity Vest', 10, 50);
        $processor = new QualityProcessor();

        $processor->decreaseQuality($item);
        $this->assertEquals(49, $item->quality);
    }

    public function testDecreaseQualityLessThanZero(): void
    {
        $item = new Item('+5 Dexterity Vest', 10, 0);
        $processor = new QualityProcessor();

        $processor->decreaseQuality($item);
        $this->assertEquals(0, $item->quality);
    }

    public function testDecreaseQualityByTwo(): void
    {
        $item = new Item('+5 Dexterity Vest', 10, 1);
        $processor = new QualityProcessor();

        $processor->decreaseQuality($item, 2);
        $this->assertEquals(0, $item->quality);
    }
}
