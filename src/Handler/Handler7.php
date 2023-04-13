<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class Handler7 implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        if (in_array($item->name, Item::getSkipHandlers())) {
            return false;
        }

        return $item->sellIn < 0 && $item->name == 'Aged Brie' && $item->quality < 50;
    }

    public function handle(Item $item): void
    {
        $item->quality = $item->quality + 1;
    }
}