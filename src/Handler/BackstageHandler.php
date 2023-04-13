<?php

namespace GildedRose\Handler;

use GildedRose\Item;

class BackstageHandler implements ItemHandlerInterface
{
    public function supports(Item $item): bool
    {
        return $item->name == Item::NAME_SULFURAS;
    }

    public function handle(Item $item): void
    {
        // TODO: implement
    }
}