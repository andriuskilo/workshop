<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class AgedBrieItemStrategy implements ItemStrategy
{
    private const AGED_BRIE = 'aged brie';

    public function supports(Item $item): bool
    {
        return str_contains(strtolower($item->name), self::AGED_BRIE);
    }

    public function updateItem(Item $item): void
    {
        --$item->sellIn;

        if ($item->quality < 50) {
            ++$item->quality;
        }
    }
}
