<?php

declare(strict_types=1);

namespace GildedRose\Resolvers;

use GildedRose\Item;

interface Resolver
{


    public function isEligible(Item $item): bool;

    public function resolve(Item $item): void;
}
