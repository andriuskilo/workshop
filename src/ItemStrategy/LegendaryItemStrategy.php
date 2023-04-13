<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

class LegendaryItemStrategy implements ItemStrategy
{
    public const NAME = 'Sulfuras, Hand of Ragnaros';

    public function supports(Item $item): bool
    {
        return $item->name === self::NAME;
    }

    public function updateItem(Item $item): void
    {
        //do nothing as it is a LEGENDARY Item ;)
    }
}
