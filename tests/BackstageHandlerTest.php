<?php

declare(strict_types=1);

namespace Tests;

use Generator;
use GildedRose\Handlers\BackstageHandler;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class BackstageHandlerTest extends TestCase
{
    /**
     * @dataProvider backstageDataProvider
     */
    public function testAgedBrieHandler(int $days, Item $expected): void
    {
        $handler = new BackstageHandler();

        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20);
        for ($i = 0; $i < $days; $i++) {
            $item = $handler->handle($item);
        }

        $this->assertEquals($expected, $item);
    }

    public function backstageDataProvider(): Generator
    {
        yield [
            'days' => 1,
            'expected' => new Item('Backstage passes to a TAFKAL80ETC concert', 14, 21),
        ];

        yield [
            'days' => 2,
            'expected' => new Item('Backstage passes to a TAFKAL80ETC concert', 13, 22),
        ];

        yield [
            'days' => 3,
            'expected' => new Item('Backstage passes to a TAFKAL80ETC concert', 12, 23),
        ];

        yield [
            'days' => 4,
            'expected' => new Item('Backstage passes to a TAFKAL80ETC concert', 11, 24),
        ];

        yield [
            'days' => 5,
            'expected' => new Item('Backstage passes to a TAFKAL80ETC concert', 10, 25),
        ];

        yield [
            'days' => 6,
            'expected' => new Item('Backstage passes to a TAFKAL80ETC concert', 9, 27),
        ];

        yield [
            'days' => 11,
            'expected' => new Item('Backstage passes to a TAFKAL80ETC concert', 4, 38),
        ];
    }
}
