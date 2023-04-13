<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRoseGPT;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseGPTTest extends TestCase
{
    public function testSuccessDenoteBothSellInAndQuality(): void
    {
        $items = [new Item('foo', 5, 10)];
        $this->buildGildedRose($items)->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(9, $items[0]->quality);
    }

    public function testQualityGoesNegativeAndDoubleDecreaseQuality(): void
    {
        $items = [new Item('foo', 0, 10)];
        $this->buildGildedRose($items)->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testQualityDoesntGoNegative(): void
    {
        $items = [new Item('foo', 0, 0)];
        $this->buildGildedRose($items)->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testAgedBrieIncreasesInQualityTheOlderItGets(): void
    {
        $sellableItem = new Item('Aged Brie', 5, 1);
        $items = [
            $sellableItem
        ];

        $this->buildGildedRose($items)->updateQuality();

        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(2, $items[0]->quality);
    }

    public function testQualityIsNeverMoreThan50(): void
    {
        $sellableItem = new Item('Sulfuras, Hand of Ragnaros', 5, 50);
        $items = [
            $sellableItem
        ];

        $this->buildGildedRose($items)->updateQuality();

        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
        $this->assertSame(5, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testQualityIsNeverMoreThan50ButIfSulfurasHasMoreItStays(): void
    {
        $sellableItem = new Item('Sulfuras, Hand of Ragnaros', 5, 80);
        $items = [
            $sellableItem
        ];

        $this->buildGildedRose($items)->updateQuality();

        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
        $this->assertSame(5, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testBackstagePassesQualityBecomesZeroAfterTheConcert(): void
    {
        $sellableItem = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10);
        $items = [
            $sellableItem
        ];

        $this->buildGildedRose($items)->updateQuality();

        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }


    public function testBackstagePassesQualityDecreaseBy2WhenSellDateMore5Less10(): void
    {
        $items = [
            new Item('Backstage passes to a TAFKAL80ETC concert', 6, 10),
            new Item('Backstage passes to a TAFKAL80ETC concert', 7, 10),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10),
        ];

        $this->buildGildedRose($items)->updateQuality();

        foreach ($items as $item) {
            $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
            $this->assertSame(12, $item->quality);
        }
    }

    public function testBackstagePassesQualityDecreaseBy3WhenSellDateMore0Less5(): void
    {
        $items = [
            new Item('Backstage passes to a TAFKAL80ETC concert', 1, 10),
            new Item('Backstage passes to a TAFKAL80ETC concert', 3, 10),
            new Item('Backstage passes to a TAFKAL80ETC concert', 4, 10),
        ];

        $this->buildGildedRose($items)->updateQuality();

        foreach ($items as $item) {
            $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
            $this->assertSame(13, $item->quality);
        }
    }

    public function testConjuredDecreasesTwice(): void
    {
        $sellableItem = new Item('Conjured', 10, 10);
        $items = [
            $sellableItem
        ];

        $this->buildGildedRose($items)->updateQuality();

        foreach ($items as $item) {
            $this->assertSame('Conjured', $item->name);
            $this->assertSame(8, $item->quality);
        }
    }

    /**
     * @param Item[] $items
     */
    private function buildGildedRose(array $items): GildedRoseGPT
    {
        return new GildedRoseGPT($items);
    }
}
