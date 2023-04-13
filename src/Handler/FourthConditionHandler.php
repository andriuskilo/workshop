<?php

namespace GildedRose\Handler;

use GildedRose\Enum\ItemName;
use GildedRose\Item;

class FourthConditionHandler implements UpdateQualityInterface
{
    public function canApply(Item $item): bool
    {
        return $item->getSellIn() < 0;
    }

    public function updateQuality(Item $item): void
    {
        if ($item->getName() !== 'Aged Brie') {
            if ($item->getName() !== 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->getQuality() > 0) {
                    if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                $item->quality = $item->quality - $item->quality;
            }
        } else {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
        }
    }
}
