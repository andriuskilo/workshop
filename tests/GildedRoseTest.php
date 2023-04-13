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

    public function testUpdateQuality(): void
    {
        $items = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            new Item('Conjured Mana Cake', 3, 6),
        ];

        $expectedDayOne = [
            [
                'sellIn' => 9,
                'quality' => 19,
            ],
            [
                'sellIn' => 1,
                'quality' => 1,
            ],
            [
                'sellIn' => 4,
                'quality' => 6,
            ],
            [
                'sellIn' => 0,
                'quality' => 80,
            ],
            [
                'sellIn' => -1,
                'quality' => 80,
            ],
            [
                'sellIn' => 14,
                'quality' => 21,
            ],
            [
                'sellIn' => 9,
                'quality' => 50,
            ],
            [
                'sellIn' => 4,
                'quality' => 50,
            ],
            [
                'sellIn' => 2,
                'quality' => 4,
            ],
        ];

        $rose = new GildedRose($items);
        $rose->updateQuality();

        foreach ($items as $key => $item) {
            $this->assertEquals($expectedDayOne[$key]['sellIn'], $item->sellIn);
            $this->assertEquals($expectedDayOne[$key]['quality'], $item->quality);
        }
    }
}
