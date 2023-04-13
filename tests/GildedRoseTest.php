<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    public function testQualityIsNeverBelowZero(): void
    {
        // - The Quality of an item is never negative
        $items = [new Item('foo', -1, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testQualityIsNeverOver50(): void
    {
        // - The Quality of an item is never more than 50
        $items = [new Item(GildedRose::AGED_BRIE, -1, 50)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(50, $items[0]->quality);
    }

    public function testQualityAgedBrieIsIncreasedInQuality(): void
    {
        // - "Aged Brie" actually increases in Quality the older it gets
        $items = [new Item(GildedRose::AGED_BRIE, -1, 45)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(47, $items[0]->quality);
    }

    public function testQualityIsDecreasedByOneBeforeSellByDatePassed(): void
    {
        // - Once the sell by date has passed, Quality degrades twice as fast
        $items = [new Item('foo', 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(19, $items[0]->quality);
    }

    public function testQualityIsDecreasedTwiceAsFastAfterSellByDatePassed(): void
    {
        // - Once the sell by date has passed, Quality degrades twice as fast
        $items = [new Item('foo', -1, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(18, $items[0]->quality);
    }

    public function testSulfurasStayTheSame(): void
    {
        // - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
        $items = [new Item(GildedRose::SULFURAS, 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(20, $items[0]->quality);
        $this->assertSame(10, $items[0]->sellIn);
    }

    public function testBackstagePassesQualityIncreaseByOne(): void
    {
        // - "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
        $items = [new Item(GildedRose::BACKSTAGE_PASSES, 11, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(21, $items[0]->quality);
    }

    public function testBackstagePassesQualityIncreasesByTwo(): void
    {
        // - "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
        $items = [new Item(GildedRose::BACKSTAGE_PASSES, 6, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(22, $items[0]->quality);
    }
    public function testBackstagePassesQualityIncreasesByThree(): void
    {
        // - "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
        $items = [new Item(GildedRose::BACKSTAGE_PASSES, 5, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(23, $items[0]->quality);
    }

    public function testConjuredDegradeTwiceAsFastInQuality(): void
    {
        // - "Conjured" items degrade in Quality twice as fast as normal items
        $items = [new Item(GildedRose::CONJURED, 5, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(18, $items[0]->quality);
    }

    public function testConjuredDegradeTwiceAsFastAfterExpiredInQuality(): void
    {
        // - "Conjured" items degrade in Quality twice as fast as normal items
        $items = [new Item(GildedRose::CONJURED, -1, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(16, $items[0]->quality);
    }
}
