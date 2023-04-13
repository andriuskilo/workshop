<?php

declare(strict_types=1);

namespace Tests\ItemStrategy;

use GildedRose\Item;
use GildedRose\ItemStrategy\LegendaryItemStrategy;
use PHPUnit\Framework\TestCase;

class LegendaryItemStrategyTest extends TestCase
{
    /**
     * @dataProvider dataProviderForNames
     */
    public function testSupports(Item $item, bool $applicable): void
    {
        $strategy = new LegendaryItemStrategy();
        $this->assertSame($applicable, $strategy->supports($item));
    }

    public function dataProviderForNames(): array
    {
        return [
            [new Item(LegendaryItemStrategy::NAME, 1, 80), true],
            [new Item(LegendaryItemStrategy::NAME, -1, 80), true],
            [new Item(LegendaryItemStrategy::NAME . 'non-applicable item', 0, 80), false],
        ];
    }

    /**
     * @dataProvider dataProviderForQualityAndSellIn
     */
    public function testLegendaryItemStaysTheSame(Item $item, int $expectedSellIn, int $expectedQuality): void
    {
        $strategy = new LegendaryItemStrategy();
        $strategy->updateItem($item);
        $this->assertSame($expectedSellIn, $item->sellIn);
        $this->assertSame($expectedQuality, $item->quality);
    }

    public function dataProviderForQualityAndSellIn(): array
    {
        return [
            [new Item(LegendaryItemStrategy::NAME, 1, 80), 1, 80],
            [new Item(LegendaryItemStrategy::NAME, -1, 80), -1, 80],
        ];
    }
}
