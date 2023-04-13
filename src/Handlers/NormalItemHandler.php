<?php

declare(strict_types=1);

namespace GildedRose\Handlers;

use GildedRose\Item;

class NormalItemHandler implements ItemHandlerInterface
{
    public function handle(Item $item): Item
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality - 1;
        }

        $item->sellIn = $item->sellIn - 1;

        return $item;
    }
}