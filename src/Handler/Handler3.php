<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class Handler3 implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        if (in_array($item->name, Item::getSkipHandlers())) {
            return false;
        }

        return $item->name === 'Backstage passes to a TAFKAL80ETC concert'
            && $item->sellIn < 6
            && $item->quality < 50;
    }

    public function handle(Item $item): void
    {
        $item->quality = $item->quality + 1;
    }
}