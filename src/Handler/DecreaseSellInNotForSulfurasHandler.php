<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class DecreaseSellInNotForSulfurasHandler implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        if ($item->name == 'Aged Brie') {
            return false;
        }

        return $item->name != 'Sulfuras, Hand of Ragnaros';
    }

    public function handle(Item $item): void
    {
        $item->sellIn = $item->sellIn - 1;
    }
}