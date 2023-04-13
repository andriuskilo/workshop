<?php

declare(strict_types=1);

namespace Tests\ItemStrategy;

use GildedRose\Item;
use GildedRose\ItemStrategy\AgedBrieItemStrategy;
use PHPUnit\Framework\TestCase;

class AgedBrieItemStrategyTest extends TestCase
{
    /**
     * @dataProvider dataProviderForNames
     */
    public function testSupports(Item $item, bool $applicable): void
    {
        $strategy = new AgedBrieItemStrategy();
        $this->assertSame($applicable, $strategy->supports($item));
    }

    public function dataProviderForNames(): array
    {
        return [
            [new Item('aged brie', 1, 0), true],
            [new Item('agedbrie', 11, 10), false],
            [new Item('this should not works', 0, 0), false],
        ];
    }

    /**
     * @dataProvider dataProviderForQualityAndSellIn
     */
    public function testUpdatesItem(Item $item, int $expectedSellIn, int $expectedQuality): void
    {
        $strategy = new AgedBrieItemStrategy();
        $strategy->updateItem($item);
        $this->assertSame($expectedSellIn, $item->sellIn);
        $this->assertSame($expectedQuality, $item->quality);
    }

    public function dataProviderForQualityAndSellIn(): array
    {
        return [
            [new Item('aged brie', 3, 4), 2, 5],
            [new Item('Aged brie', 49, 10), 48, 11],
            [new Item('Aged Brie', 1, 50), 0, 50],
        ];
    }
}
