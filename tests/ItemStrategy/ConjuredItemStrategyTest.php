<?php

namespace Tests\ItemStrategy;

use GildedRose\Item;
use GildedRose\ItemStrategy\ConjuredItemStrategy;
use PHPUnit\Framework\TestCase;

class ConjuredItemStrategyTest extends TestCase
{
    /**
     * @dataProvider dataProviderForNames
     */
    public function testSupports(Item $item, bool $applicable): void
    {
        $strategy = new ConjuredItemStrategy();
        $this->assertSame($applicable, $strategy->supports($item));
    }

    public function dataProviderForNames(): array
    {
        return [
            [new Item('conjured item', 1, 0), true],
            [new Item('CoNjUreDD weird item', -1, 10), true],
            [new Item('non-applicable item', 0, 0), false],
        ];
    }

    /**
     * @dataProvider dataProviderForQualityAndSellIn
     */
    public function testUpdatesItem(Item $item, int $expectedSellIn, int $expectedQuality): void
    {
        $strategy = new ConjuredItemStrategy();
        $strategy->updateItem($item);
        $this->assertSame($expectedSellIn, $item->sellIn);
        $this->assertSame($expectedQuality, $item->quality);
    }

    public function dataProviderForQualityAndSellIn(): array
    {
        return [
            [new Item('conjured item', 1, 10), 0, 8],
            [new Item('CoNjUreDD weird item', 0, 10), -1, 6],
            [new Item('other conjured item', 0, 0), -1, 0],
        ];
    }
}
