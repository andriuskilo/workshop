<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Resolvers\ResolvedItemNames;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @dataProvider commonProvider
     */
    public function testUpdateQuality(
        string $name,
        int $sellIn,
        int $quality,
        int $expectedSellIn,
        int $expectedQuality,
        ?string $expectedName = null,
    ): void
    {
        if (null === $expectedName) {
            $expectedName = $name;
        }
        $items = [new Item($name, $sellIn, $quality)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame($expectedName, $items[0]->name);
        $this->assertSame($expectedSellIn, $items[0]->sellIn);
        $this->assertSame($expectedQuality, $items[0]->quality);
    }

    private function commonProvider(): array
    {
        return [
            'foo zero' => [
                'name' => 'foo',
                'sellIn' => 0,
                'quality' => 0,
                'expectedSellIn' => -1,
                'expectedQuality' => 0,
                'expectedName' => 'foo',
            ],
            'brie zero' => [
                'name' => ResolvedItemNames::NAME_BRIE,
                'sellIn' => 0,
                'quality' => 0,
                'expectedSellIn' => -1,
                'expectedQuality' => 2,
            ],
            'tafka zero' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 0,
                'quality' => 0,
                'expectedSellIn' => -1,
                'expectedQuality' => 0,
            ],
            'sulf zero' => [
                'name' => ResolvedItemNames::NAME_SULFURAS,
                'sellIn' => 0,
                'quality' => 0,
                'expectedSellIn' => 0,
                'expectedQuality' => 0,
            ],
            'sulf q > 0' => [
                'name' => ResolvedItemNames::NAME_SULFURAS,
                'sellIn' => 0,
                'quality' => 1,
                'expectedSellIn' => 0,
                'expectedQuality' => 1,
            ],
            'foo q > 0' => [
                'name' => 'foo',
                'sellIn' => 0,
                'quality' => 1,
                'expectedSellIn' => -1,
                'expectedQuality' => 0,
            ],
            'brie q > 50' => [
                'name' => ResolvedItemNames::NAME_BRIE,
                'sellIn' => 0,
                'quality' => 51,
                'expectedSellIn' => -1,
                'expectedQuality' => 51,
            ],
            'tafka q > 50' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 0,
                'quality' => 51,
                'expectedSellIn' => -1,
                'expectedQuality' => 0,
            ],
            'tafka q > 50 s < 11' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 10,
                'quality' => 51,
                'expectedSellIn' => 9,
                'expectedQuality' => 51,
            ],
            'tafka q > 50 s > 11' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 12,
                'quality' => 51,
                'expectedSellIn' => 11,
                'expectedQuality' => 51,
            ],
            'tafka q > 50 s < 6' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 5,
                'quality' => 51,
                'expectedSellIn' => 4,
                'expectedQuality' => 51,
            ],
            'tafka q < 50' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 0,
                'quality' => 49,
                'expectedSellIn' => -1,
                'expectedQuality' => 0,
            ],
            'tafka q < 50 s < 11' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 10,
                'quality' => 49,
                'expectedSellIn' => 9,
                'expectedQuality' => 50,
            ],
            'tafka q < 50 s > 11' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 12,
                'quality' => 49,
                'expectedSellIn' => 11,
                'expectedQuality' => 50,
            ],
            'tafka q < 50 s < 6' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 5,
                'quality' => 49,
                'expectedSellIn' => 4,
                'expectedQuality' => 50,
            ],

            'tafka q < 49' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 0,
                'quality' => 48,
                'expectedSellIn' => -1,
                'expectedQuality' => 0,
            ],
            'tafka q < 49 s < 11' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 10,
                'quality' => 48,
                'expectedSellIn' => 9,
                'expectedQuality' => 50,
            ],
            'tafka q < 49 s > 11' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 12,
                'quality' => 48,
                'expectedSellIn' => 11,
                'expectedQuality' => 49,
            ],
            'tafka q < 49 s < 6' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => 5,
                'quality' => 48,
                'expectedSellIn' => 4,
                'expectedQuality' => 50,
            ],
            'foo q < 50' => [
                'name' => 'foo',
                'sellIn' => 0,
                'quality' => 49,
                'expectedSellIn' => -1,
                'expectedQuality' => 47,
            ],
            'brie s < 0 q < 50' => [
                'name' => ResolvedItemNames::NAME_BRIE,
                'sellIn' => -1,
                'quality' => 0,
                'expectedSellIn' => -2,
                'expectedQuality' => 2,
            ],
            'brie s < 0 q > 50' => [
                'name' => ResolvedItemNames::NAME_BRIE,
                'sellIn' => -1,
                'quality' => 51,
                'expectedSellIn' => -2,
                'expectedQuality' => 51,
            ],
            'tafka s < 0' => [
                'name' => ResolvedItemNames::NAME_TAFKA,
                'sellIn' => -1,
                'quality' => 0,
                'expectedSellIn' => -2,
                'expectedQuality' => 0,
            ],
            'sulf s < 0 q < 0' => [
                'name' => ResolvedItemNames::NAME_SULFURAS,
                'sellIn' => -1,
                'quality' => -1,
                'expectedSellIn' => -1,
                'expectedQuality' => -1,
            ],
            'sulf s < 0 q > 0' => [
                'name' => ResolvedItemNames::NAME_SULFURAS,
                'sellIn' => -1,
                'quality' => 1,
                'expectedSellIn' => -1,
                'expectedQuality' => 1,
            ],
            'foo s < 0 q > 0' => [
                'name' => 'foo',
                'sellIn' => -1,
                'quality' => 1,
                'expectedSellIn' => -2,
                'expectedQuality' => 0,
            ],
            'foo s < 0 q < 0' => [
                'name' => 'foo',
                'sellIn' => -1,
                'quality' => -1,
                'expectedSellIn' => -2,
                'expectedQuality' => -1,
            ],
        ];
    }
}
