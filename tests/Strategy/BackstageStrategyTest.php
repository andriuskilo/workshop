<?php

declare(strict_types=1);

namespace Tests\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;
use GildedRose\Strategy\BackstagePassesStrategy;
use PHPUnit\Framework\TestCase;

class BackstageStrategyTest extends TestCase
{
    public function testBackstageStrategy(): void
    {
        $processor = new QualityProcessor();
        $strategy = new BackstagePassesStrategy($processor);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20);

        $strategy->updateItem($item);

        $this->assertEquals(14, $item->sellIn);
        $this->assertEquals(21, $item->quality);
    }

    public function testWhenSellInLessThanEleven(): void
    {
        $processor = new QualityProcessor();
        $strategy = new BackstagePassesStrategy($processor);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 20);

        $strategy->updateItem($item);

        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(22, $item->quality);
    }

    public function testWhenSellInLessThanSix(): void
    {
        $processor = new QualityProcessor();
        $strategy = new BackstagePassesStrategy($processor);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 20);

        $strategy->updateItem($item);

        $this->assertEquals(4, $item->sellIn);
        $this->assertEquals(23, $item->quality);
    }

    public function testWhenSellInLessThanZero(): void
    {
        $processor = new QualityProcessor();
        $strategy = new BackstagePassesStrategy($processor);

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 20);

        $strategy->updateItem($item);

        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
}
