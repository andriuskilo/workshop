<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class Handler8 implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        if (in_array($item->name, Item::getSkipHandlers())) {
            return false;
        }

        if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
            return false;
        }

        return $item->quality < 50;
    }

    public function handle(Item $item): void
    {
        $item->quality = $item->quality + 1;
    }
}