<?php

declare(strict_types=1);

namespace GildedRose\Resolvers;

use GildedRose\Item;

class AgedBrieResolver implements Resolver
{
    public function isEligible(Item $item): bool
    {
        return $item->name === ResolvedItemNames::NAME_BRIE;
    }

    public function resolve(Item $item): void
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
    }
}
