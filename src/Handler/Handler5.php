<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class Handler5 implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        if (in_array($item->name, Item::getSkipHandlers())) {
            return false;
        }

        return $item->sellIn < 0
            && $item->name != 'Aged Brie'
            && $item->name != 'Backstage passes to a TAFKAL80ETC concert'
            && $item->quality > 0
            && $item->name != 'Sulfuras, Hand of Ragnaros';
    }

    public function handle(Item $item): void
    {
        $item->quality = $item->quality - 1;
    }
}