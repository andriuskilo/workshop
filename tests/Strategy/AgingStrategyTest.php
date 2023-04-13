<?php

declare(strict_types=1);

namespace Tests\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;
use GildedRose\Strategy\AgingStrategy;
use PHPUnit\Framework\TestCase;

class AgingStrategyTest extends TestCase
{
    public function testAgingStrategy(): void
    {
        $processor = new QualityProcessor();
        $strategy = new AgingStrategy($processor);

        $item = new Item('Aged Brie', 10, 20);

        $strategy->updateItem($item);

        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(21, $item->quality);
    }

    public function testWhenSellInLessThanZero(): void
    {
        $processor = new QualityProcessor();
        $strategy = new AgingStrategy($processor);

        $item = new Item('Aged Brie', 0, 21);

        $strategy->updateItem($item);

        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(23, $item->quality);
    }

    public function testWhenQualityFifty(): void
    {
        $processor = new QualityProcessor();
        $strategy = new AgingStrategy($processor);

        $item = new Item('Aged Brie', 10, 50);

        $strategy->updateItem($item);

        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(50, $item->quality);
    }
}
