<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class AgedBrieHandler implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        return 'Aged Brie' === $item->name;
    }

    public function handle(Item $item): void
    {
        $item->sellIn -= 1;

        if ($item->quality >= 50) {
            return;
        }

        $item->quality += 1;

        if ($item->sellIn < 0) {
            $item->quality += 1;
        }
    }
}