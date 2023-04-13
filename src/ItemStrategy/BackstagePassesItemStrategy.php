<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class BackstagePassesItemStrategy implements ItemStrategy
{
    private const BACKSTAGE_PASSES_TO_A_CONCERT = '#backstage passes to an? .* concert#';

    public function supports(Item $item): bool
    {
        return preg_match(self::BACKSTAGE_PASSES_TO_A_CONCERT, strtolower($item->name)) === 1;
    }

    public function updateItem(Item $item): void
    {
        --$item->sellIn;

        if ($item->sellIn < 0) {
            $item->quality = 0;

            return;
        }

        $qualityUp = 1;
        if ($item->sellIn < 5) {
            $qualityUp = 3;
        } elseif ($item->sellIn < 10) {
            $qualityUp = 2;
        }

        $newQuality = $item->quality + $qualityUp;
        if ($newQuality > 50) {
            $newQuality = 50;
        }

        $item->quality = $newQuality;
    }
}
