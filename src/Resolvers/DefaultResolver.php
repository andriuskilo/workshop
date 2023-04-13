<?php

declare(strict_types=1);

namespace GildedRose\Resolvers;

use GildedRose\Item;

class DefaultResolver implements Resolver
{
    public function isEligible(Item $item): bool
    {
        if (in_array($item->name, [
            ResolvedItemNames::NAME_BRIE,
            ResolvedItemNames::NAME_TAFKA,
            ResolvedItemNames::NAME_SULFURAS,
        ], true)) {
            return false;
        }

        return true;
    }

    public function resolve(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
        $item->sellIn = $item->sellIn - 1;
        if ($item->sellIn < 0) {
            if ($item->quality > 0) {
                $item->quality = $item->quality - 1;
            }
        }
    }
}
