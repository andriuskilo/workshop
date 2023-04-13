<?php

namespace GildedRose\Handler;

use GildedRose\Enum\ItemName;
use GildedRose\Item;

class SecondConditionHandler implements UpdateQualityInterface
{
    private const VALID_ITEM_NAMES = [
        ItemName::AGED_BRIE,
        ItemName::BACKSTAGE_PASSES,
    ];

    public function canApply(Item $item): bool
    {
        return in_array($item->getName(),self::VALID_ITEM_NAMES) && $item->getQuality() < 50;
    }

    public function updateQuality(Item $item): void
    {
        $item->quality = $item->quality + 1;

        if ($item->name !== ItemName::BACKSTAGE_PASSES) {
            return;
        }

        if ($item->sellIn < 11) {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
        }

        if ($item->sellIn < 6) {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
        }
    }
}
