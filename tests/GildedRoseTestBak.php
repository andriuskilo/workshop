<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\GuildedRoseBak;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testSuccessDenoteBothSellInAndQuality(): void
    {
        $items = [new Item('foo', 5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(4, $items[0]->sellIn);
        $this->assertSame(9, $items[0]->quality);
    }

    public function testQualityGoesNegativeAndDoubleDecreaseQuality(): void
    {
        $items = [new Item('foo', 0, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testQualityDoesntGoNegative(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
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
        $sellableItem = new Item('Sulfuras, Hand of Ragnaros', 5, 10);
        $items = [
            $sellableItem
        ];

        $this->buildGildedRose($items)->updateQuality();

        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
        $this->assertSame(5, $items[0]->sellIn);
        $this->assertSame(10, $items[0]->quality);
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

    /**
     * @param Item[] $items
     */
    private function buildGildedRose(array $items): GuildedRoseBak
    {
        return new GuildedRoseBak($items);
    }
}
