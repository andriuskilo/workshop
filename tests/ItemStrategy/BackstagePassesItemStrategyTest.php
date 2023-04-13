<?php

declare(strict_types=1);

namespace Tests\ItemStrategy;

use GildedRose\Item;
use GildedRose\ItemStrategy\BackstagePassesItemStrategy;
use PHPUnit\Framework\TestCase;

class BackstagePassesItemStrategyTest extends TestCase
{
    /**
     * @dataProvider dataProviderForNames
     */
    public function testSupports(Item $item, bool $applicable): void
    {
        $strategy = new BackstagePassesItemStrategy();
        $this->assertSame($applicable, $strategy->supports($item));
    }

    public function dataProviderForNames(): array
    {
        return [
            [new Item('backstage passes to a Metallica concert', 1, 0), true],
            [new Item('Backstage Passes To An Iron Maiden Concert', 11, 10), true],
            [new Item('Backstage Passes To Something Different Than A Concert', 0, 0), false],
        ];
    }

    /**
     * @dataProvider dataProviderForQualityAndSellIn
     */
    public function testUpdatesItem(
        Item $item,
        int $expectedSellInAfterFirstDay,
        int $expectedQualityAfterFirstDay,
    ): void {
        $strategy = new BackstagePassesItemStrategy();
        $strategy->updateItem($item);
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $item->name);
        $this->assertSame($expectedSellInAfterFirstDay, $item->sellIn);
        $this->assertSame($expectedQualityAfterFirstDay, $item->quality);
    }

    public function dataProviderForQualityAndSellIn(): array
    {
        return [
            [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 1), 11, 2],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 11, 1), 10, 2],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 9, 1), 8, 3],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 7, 1), 6, 3],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 6, 1), 5, 3],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 4, 1), 3, 4],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 2, 1), 1, 4],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 1, 1), 0, 4],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 1), -1, 0],
        ];
    }
}
