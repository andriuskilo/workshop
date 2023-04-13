<?php

declare(strict_types=1);

namespace GildedRose\Resolvers;

use GildedRose\Item;

class SulfurasResolver implements Resolver
{
    public function isEligible(Item $item): bool
    {
        return $item->name === ResolvedItemNames::NAME_SULFURAS;
    }

    public function resolve(Item $item): void
    {

    }
}
