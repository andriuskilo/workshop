<?php

declare(strict_types=1);

namespace GildedRose\Handlers;

use GildedRose\Item;

class BackstageHandler implements ItemHandlerInterface
{
    public function handle(Item $item): Item
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;

            if ($item->sellIn < 11) {
                $item->quality = $item->quality + 1;
            }
            if ($item->sellIn < 6) {
                $item->quality = $item->quality + 1;
            }
        }

        $item->sellIn = $item->sellIn - 1;

        if ($item->sellIn < 0) {
            $item->quality = $item->quality - $item->quality;
        }

        return $item;
    }
}