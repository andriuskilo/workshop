<?php

declare(strict_types=1);

namespace GildedRose\Strategy;

use GildedRose\Item;

class LegendaryStrategy implements StrategyInterface
{
    public function updateItem(Item $item): void
    {
        // Do nothing
    }

    public function canApply(Item $item): bool
    {
        return $item->name === 'Sulfuras, Hand of Ragnaros';
    }
}
