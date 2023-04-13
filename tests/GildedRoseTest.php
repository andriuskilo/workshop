<?php

declare(strict_types=1);

namespace Tests;

use Generator;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testFoo(int $days, array $expected): void
    {
        $actualItems = [
            new Item('+5 Dexterity Vest', 10, 20),
            new Item('Aged Brie', 2, 0),
            new Item('Elixir of the Mongoose', 5, 7),
            new Item('Sulfuras, Hand of Ragnaros', 0, 80),
            new Item('Sulfuras, Hand of Ragnaros', -1, 80),
            new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
        ];

        $gildedRose = new GildedRose($actualItems);

        for ($i = 0; $i < $days; $i++) {
            $gildedRose->updateQuality();
        }

        $this->assertEquals($actualItems, $expected);
    }

    public function dataProvider(): Generator
    {
        yield [
            'days' => 0,
            'expected' => [
                new Item('+5 Dexterity Vest', 10, 20),
                new Item('Aged Brie', 2, 0),
                new Item('Elixir of the Mongoose', 5, 7),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
                new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
                new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
            ],
        ];

        yield [
            'days' => 1,
            'expected' => [
                new Item('+5 Dexterity Vest', 9, 19),
                new Item('Aged Brie', 1, 1),
                new Item('Elixir of the Mongoose', 4, 6),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 14, 21),
                new Item('Backstage passes to a TAFKAL80ETC concert', 9, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', 4, 50),
            ],
        ];

        yield [
            'days' => 2,
            'expected' => [
                new Item('+5 Dexterity Vest', 8, 18),
                new Item('Aged Brie', 0, 2),
                new Item('Elixir of the Mongoose', 3, 5),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 13, 22),
                new Item('Backstage passes to a TAFKAL80ETC concert', 8, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', 3, 50),
            ],
        ];

        yield [
            'days' => 3,
            'expected' => [
                new Item('+5 Dexterity Vest', 7, 17),
                new Item('Aged Brie', -1, 4),
                new Item('Elixir of the Mongoose', 2, 4),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 12, 23),
                new Item('Backstage passes to a TAFKAL80ETC concert', 7, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', 2, 50),
            ],
        ];

        yield [
            'days' => 4,
            'expected' => [
                new Item('+5 Dexterity Vest', 6, 16),
                new Item('Aged Brie', -2, 6),
                new Item('Elixir of the Mongoose', 1, 3),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 11, 24),
                new Item('Backstage passes to a TAFKAL80ETC concert', 6, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', 1, 50),
            ],
        ];

        yield [
            'days' => 5,
            'expected' => [
                new Item('+5 Dexterity Vest', 5, 15),
                new Item('Aged Brie', -3, 8),
                new Item('Elixir of the Mongoose', 0, 2),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 10, 25),
                new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50),
            ],
        ];

        yield [
            'days' => 6,
            'expected' => [
                new Item('+5 Dexterity Vest', 4, 14),
                new Item('Aged Brie', -4, 10),
                new Item('Elixir of the Mongoose', -1, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 9, 27),
                new Item('Backstage passes to a TAFKAL80ETC concert', 4, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', -1, 0),
            ],
        ];

        yield [
            'days' => 7,
            'expected' => [
                new Item('+5 Dexterity Vest', 3, 13),
                new Item('Aged Brie', -5, 12),
                new Item('Elixir of the Mongoose', -2, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 8, 29),
                new Item('Backstage passes to a TAFKAL80ETC concert', 3, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', -2, 0),
            ],
        ];

        yield [
            'days' => 8,
            'expected' => [
                new Item('+5 Dexterity Vest', 2, 12),
                new Item('Aged Brie', -6, 14),
                new Item('Elixir of the Mongoose', -3, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 7, 31),
                new Item('Backstage passes to a TAFKAL80ETC concert', 2, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', -3, 0),
            ],
        ];

        yield [
            'days' => 9,
            'expected' => [
                new Item('+5 Dexterity Vest', 1, 11),
                new Item('Aged Brie', -7, 16),
                new Item('Elixir of the Mongoose', -4, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 6, 33),
                new Item('Backstage passes to a TAFKAL80ETC concert', 1, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', -4, 0),
            ],
        ];

        yield [
            'days' => 10,
            'expected' => [
                new Item('+5 Dexterity Vest', 0, 10),
                new Item('Aged Brie', -8, 18),
                new Item('Elixir of the Mongoose', -5, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 5, 35),
                new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', -5, 0),
            ],
        ];

        yield [
            'days' => 11,
            'expected' => [
                new Item('+5 Dexterity Vest', -1, 8),
                new Item('Aged Brie', -9, 20),
                new Item('Elixir of the Mongoose', -6, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 4, 38),
                new Item('Backstage passes to a TAFKAL80ETC concert', -1, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -6, 0),
            ],
        ];

        yield [
            'days' => 12,
            'expected' => [
                new Item('+5 Dexterity Vest', -2, 6),
                new Item('Aged Brie', -10, 22),
                new Item('Elixir of the Mongoose', -7, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 3, 41),
                new Item('Backstage passes to a TAFKAL80ETC concert', -2, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -7, 0),
            ],
        ];

        yield [
            'days' => 13,
            'expected' => [
                new Item('+5 Dexterity Vest', -3, 4),
                new Item('Aged Brie', -11, 24),
                new Item('Elixir of the Mongoose', -8, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 2, 44),
                new Item('Backstage passes to a TAFKAL80ETC concert', -3, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -8, 0),
            ],
        ];

        yield [
            'days' => 14,
            'expected' => [
                new Item('+5 Dexterity Vest', -4, 2),
                new Item('Aged Brie', -12, 26),
                new Item('Elixir of the Mongoose', -9, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 1, 47),
                new Item('Backstage passes to a TAFKAL80ETC concert', -4, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -9, 0),
            ],
        ];

        yield [
            'days' => 15,
            'expected' => [
                new Item('+5 Dexterity Vest', -5, 0),
                new Item('Aged Brie', -13, 28),
                new Item('Elixir of the Mongoose', -10, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50),
                new Item('Backstage passes to a TAFKAL80ETC concert', -5, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -10, 0),
            ],
        ];

        yield [
            'days' => 16,
            'expected' => [
                new Item('+5 Dexterity Vest', -6, 0),
                new Item('Aged Brie', -14, 30),
                new Item('Elixir of the Mongoose', -11, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -1, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -6, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -11, 0),
            ],
        ];

        yield [
            'days' => 17,
            'expected' => [
                new Item('+5 Dexterity Vest', -7, 0),
                new Item('Aged Brie', -15, 32),
                new Item('Elixir of the Mongoose', -12, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -2, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -7, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -12, 0),
            ],
        ];

        yield [
            'days' => 18,
            'expected' => [
                new Item('+5 Dexterity Vest', -8, 0),
                new Item('Aged Brie', -16, 34),
                new Item('Elixir of the Mongoose', -13, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -3, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -8, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -13, 0),
            ],
        ];

        yield [
            'days' => 19,
            'expected' => [
                new Item('+5 Dexterity Vest', -9, 0),
                new Item('Aged Brie', -17, 36),
                new Item('Elixir of the Mongoose', -14, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -4, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -9, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -14, 0),
            ],
        ];

        yield [
            'days' => 20,
            'expected' => [
                new Item('+5 Dexterity Vest', -10, 0),
                new Item('Aged Brie', -18, 38),
                new Item('Elixir of the Mongoose', -15, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -5, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -10, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -15, 0),
            ],
        ];

        yield [
            'days' => 21,
            'expected' => [
                new Item('+5 Dexterity Vest', -11, 0),
                new Item('Aged Brie', -19, 40),
                new Item('Elixir of the Mongoose', -16, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -6, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -11, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -16, 0),
            ],
        ];

        yield [
            'days' => 22,
            'expected' => [
                new Item('+5 Dexterity Vest', -12, 0),
                new Item('Aged Brie', -20, 42),
                new Item('Elixir of the Mongoose', -17, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -7, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -12, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -17, 0),
            ],
        ];

        yield [
            'days' => 23,
            'expected' => [
                new Item('+5 Dexterity Vest', -13, 0),
                new Item('Aged Brie', -21, 44),
                new Item('Elixir of the Mongoose', -18, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -8, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -13, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -18, 0),
            ],
        ];

        yield [
            'days' => 24,
            'expected' => [
                new Item('+5 Dexterity Vest', -14, 0),
                new Item('Aged Brie', -22, 46),
                new Item('Elixir of the Mongoose', -19, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -9, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -14, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -19, 0),
            ],
        ];

        yield [
            'days' => 25,
            'expected' => [
                new Item('+5 Dexterity Vest', -15, 0),
                new Item('Aged Brie', -23, 48),
                new Item('Elixir of the Mongoose', -20, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -10, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -15, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -20, 0),
            ],
        ];

        yield [
            'days' => 26,
            'expected' => [
                new Item('+5 Dexterity Vest', -16, 0),
                new Item('Aged Brie', -24, 50),
                new Item('Elixir of the Mongoose', -21, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -11, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -16, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -21, 0),
            ],
        ];

        yield [
            'days' => 27,
            'expected' => [
                new Item('+5 Dexterity Vest', -17, 0),
                new Item('Aged Brie', -25, 50),
                new Item('Elixir of the Mongoose', -22, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -12, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -17, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -22, 0),
            ],
        ];

        yield [
            'days' => 28,
            'expected' => [
                new Item('+5 Dexterity Vest', -18, 0),
                new Item('Aged Brie', -26, 50),
                new Item('Elixir of the Mongoose', -23, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -13, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -18, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -23, 0),
            ],
        ];

        yield [
            'days' => 29,
            'expected' => [
                new Item('+5 Dexterity Vest', -19, 0),
                new Item('Aged Brie', -27, 50),
                new Item('Elixir of the Mongoose', -24, 0),
                new Item('Sulfuras, Hand of Ragnaros', 0, 80),
                new Item('Sulfuras, Hand of Ragnaros', -1, 80),
                new Item('Backstage passes to a TAFKAL80ETC concert', -14, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -19, 0),
                new Item('Backstage passes to a TAFKAL80ETC concert', -24, 0),
            ],
        ];
    }
}
