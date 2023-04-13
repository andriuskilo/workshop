<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class Handler6 implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        if (in_array($item->name, Item::getSkipHandlers())) {
            return false;
        }

        return $item->sellIn < 0 && $item->name != 'Aged Brie' && $item->name === 'Backstage passes to a TAFKAL80ETC concert';
    }

    public function handle(Item $item): void
    {
        $item->quality = $item->quality - $item->quality;
    }
}