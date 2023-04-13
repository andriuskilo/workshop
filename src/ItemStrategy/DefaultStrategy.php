<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class DefaultStrategy
{
    public function updateItem(Item $item): void
    {
        if ($item->quality > 0) {
            --$item->quality;
        }

        --$item->sellIn;

        if ($item->sellIn < 0 && $item->quality > 0) {
            --$item->quality;
        }
    }
}
