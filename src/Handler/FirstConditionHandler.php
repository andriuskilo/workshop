<?php

namespace GildedRose\Handler;

use GildedRose\Enum\ItemName;
use GildedRose\Item;

class FirstConditionHandler implements UpdateQualityInterface
{
    private const INVALID_ITEM_NAMES = [
        ItemName::AGED_BRIE,
        ItemName::BACKSTAGE_PASSES,
        ItemName::HAND_OF_RAGNAROS,
    ];

    public function canApply(Item $item): bool
    {
        return !in_array($item->getName(), self::INVALID_ITEM_NAMES) && $item->getQuality() > 0;
    }

    public function updateQuality(Item $item): void
    {
        $item->setQuality($item->getQuality() - 1);
    }
}
