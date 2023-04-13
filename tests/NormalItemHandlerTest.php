<?php

declare(strict_types=1);

namespace Tests;

use Generator;
use GildedRose\Handlers\NormalItemHandler;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class NormalItemHandlerTest extends TestCase
{

//+5 Dexterity Vest, 10, 20

    /**
     * @dataProvider normalBrieDataProvider
     */
    public function testAgedBrieHandler(int $days, Item $expected): void
    {
        $handler = new NormalItemHandler();

        $item = new Item('+5 Dexterity Vest', 10, 20);

        for ($i = 0; $i < $days; $i++) {
            $item = $handler->handle($item);
        }

        $this->assertEquals($expected, $item);
    }

    public function normalBrieDataProvider(): Generator
    {
        yield [
            'days' => 1,
            'expected' => new Item('+5 Dexterity Vest', 9, 19),
        ];

        yield [
            'days' => 2,
            'expected' => new Item('+5 Dexterity Vest', 8, 18),
        ];

        yield [
            'days' => 3,
            'expected' => new Item('+5 Dexterity Vest', 7, 17),
        ];

        yield [
            'days' => 4,
            'expected' => new Item('+5 Dexterity Vest', 6, 16),
        ];
    }
}