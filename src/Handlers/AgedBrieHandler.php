<?php

namespace GildedRose\Handlers;

use GildedRose\Item;

class AgedBrieHandler implements ItemHandlerInterface
{
    public function handle(Item $item): Item
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }

        $item->sellIn = $item->sellIn - 1;

        if ($item->sellIn < 0) {
            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }
        }

        return $item;
    }
}