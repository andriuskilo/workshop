<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class SulfurasHandler implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        return $item->name === Item::NAME_SULFURAS;
    }

    public function handle(Item $item): void
    {
        //
    }
}