<?php

declare(strict_types=1);

namespace Tests\ItemStrategy;

use GildedRose\Item;
use GildedRose\ItemStrategy\DefaultStrategy;
use PHPUnit\Framework\TestCase;

class DefaultStrategyTest extends TestCase
{
    /**
     * @dataProvider dataProviderForQualityAndSellIn
     */
    public function testUpdatesItem(Item $item, int $expectedSellIn, int $expectedQuality): void
    {
        $strategy = new DefaultStrategy();
        $strategy->updateItem($item);
        $this->assertSame($expectedSellIn, $item->sellIn);
        $this->assertSame($expectedQuality, $item->quality);
    }

    public function dataProviderForQualityAndSellIn(): array
    {
        return [
            [new Item('One more item', 1, 1), 0, 0],
            [new Item('Any other', 2, 5), 1, 4],
            [new Item('Another item', 0, 5), -1, 3],
            [new Item('Empty item', 0, 0), -1, 0],
        ];
    }
}
