<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class ConjuredItemStrategy implements ItemStrategy
{
    public function supports(Item $item): bool
    {
        return str_contains(strtolower($item->name), 'conjured');
    }

    public function updateItem(Item $item): void
    {
        $item->sellIn -= 1;

        $qualityDrop = 2;
        if ($item->sellIn < 0) {
            $qualityDrop *= 2;
        }

        $newQuality = $item->quality - $qualityDrop;
        if ($newQuality < 0) {
            $newQuality = 0;
        }

        $item->quality = $newQuality;
    }
}