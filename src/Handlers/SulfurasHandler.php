<?php

namespace GildedRose\Handlers;

use GildedRose\Item;

class SulfurasHandler implements ItemHandlerInterface
{
    public function handle(Item $item): Item
    {
        return $item;
    }
}