<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testBasicQualityDepreciation(): void
    {
        $items = [new Item('foo', 1, 1)];
        $gildedRose = $this->getSut($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testQualityShouldNotGoBelowZero(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = $this->getSut($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testQualityShouldFallTwiceAsFastAfterSellDatePassed(): void
    {
        $items = [new Item('foo', 0, 3)];
        $gildedRose = $this->getSut($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testQualityOfAgedBrieShouldGoUpInTime(): void
    {
        $items = [new Item('Aged Brie', 1, 3)];
        $gildedRose = $this->getSut($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(4, $items[0]->quality);
    }

    public function testQualityOfAnItemShouldNotExceedFifty(): void
    {
        $items = [new Item('Aged Brie', 2, 49)];
        $gildedRose = $this->getSut($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(1, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testQualityAndSellInOfALegendaryItemShouldNotDecrease(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 2, 80)];
        $gildedRose = $this->getSut($items);
        $gildedRose->updateQuality();
        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
        $this->assertSame(2, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame(2, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
    }

    /**
     * @dataProvider dataProviderForBackstagePasses
     */
    public function testQualityOfBackstagePassesIncreasesFaster(
        Item $item,
        int $expectedSellInAfterFirstDay,
        int $expectedQualityAfterFirstDay,
        int $expectedSellInAfterSecondDay,
        int $expectedQualityAfterSecondDay
    ): void {
        $items = [$item];
        $gildedRose = $this->getSut($items);
        $gildedRose->updateQuality();
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame($expectedSellInAfterFirstDay, $items[0]->sellIn);
        $this->assertSame($expectedQualityAfterFirstDay, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertSame($expectedSellInAfterSecondDay, $items[0]->sellIn);
        $this->assertSame($expectedQualityAfterSecondDay, $items[0]->quality);
    }

    /**
     * @param Item[] $items
     */
    public function getSut(array $items): GildedRose
    {
        return new GildedRose($items);
    }

    /**
     * @return Item[]
     */
    public function dataProviderForBackstagePasses(): array
    {
        return [
            [
                new Item('Backstage passes to a TAFKAL80ETC concert', 11, 1),
                10,
                2,
                9,
                4,
            ],
            [
                new Item('Backstage passes to a TAFKAL80ETC concert', 6, 1),
                5,
                3,
                4,
                6,
            ],
            [
                new Item('Backstage passes to a TAFKAL80ETC concert', 1, 1),
                0,
                4,
                -1,
                0,
            ],
        ];
    }
}
