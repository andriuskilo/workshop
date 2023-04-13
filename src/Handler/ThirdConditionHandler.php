<?php

namespace GildedRose\Handler;

use GildedRose\Enum\ItemName;
use GildedRose\Item;

class ThirdConditionHandler implements UpdateQualityInterface
{
    public function canApply(Item $item): bool
    {
        return $item->getName() !== ItemName::HAND_OF_RAGNAROS;
    }

    public function updateQuality(Item $item): void
    {
        $item->setSellIn($item->getSellIn() - 1);
    }
}
