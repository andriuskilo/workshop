<?php

declare(strict_types=1);

namespace Tests\Strategy;

use GildedRose\Item;
use GildedRose\Strategy\LegendaryStrategy;
use PHPUnit\Framework\TestCase;

class LegendaryStrategyTest extends TestCase
{
    public function testLegendaryStrategy(): void
    {
        $strategy = new LegendaryStrategy();

        $item = new Item('Sulfuras, Hand of Ragnaros', 10, 80);

        $strategy->updateItem($item);

        $this->assertEquals(10, $item->sellIn);
        $this->assertEquals(80, $item->quality);
    }
}
