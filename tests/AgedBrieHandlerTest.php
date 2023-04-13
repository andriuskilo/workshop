<?php

declare(strict_types=1);

namespace Tests;

use Generator;
use GildedRose\Handlers\AgedBrieHandler;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class AgedBrieHandlerTest extends TestCase
{
    /**
     * @dataProvider agedBrieDataProvider
     */
    public function testAgedBrieHandler(int $days, Item $expected): void
    {
        $handler = new AgedBrieHandler();

        $item = new Item('Aged Brie', 2, 0);
        for ($i = 0; $i < $days; $i++) {
            $item = $handler->handle($item);
        }

        $this->assertEquals($expected, $item);
    }

    public function agedBrieDataProvider(): Generator
    {
        yield [
            'days' => 1,
            'expected' => new Item('Aged Brie', 1, 1),
        ];

        yield [
            'days' => 2,
            'expected' => new Item('Aged Brie', 0, 2),
        ];

        yield [
            'days' => 3,
            'expected' => new Item('Aged Brie', -1, 4),
        ];

        yield [
            'days' => 4,
            'expected' => new Item('Aged Brie', -2, 6),
        ];

        yield [
            'days' => 5,
            'expected' => new Item('Aged Brie', -3, 8),
        ];

        yield [
            'days' => 18,
            'expected' => new Item('Aged Brie', -16, 34),
        ];
    }
}
