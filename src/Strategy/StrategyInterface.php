<?php

declare(strict_types=1);

namespace GildedRose\Strategy;

use GildedRose\Item;

interface StrategyInterface
{
    public function updateItem(Item $item): void;

    public function canApply(Item $item): bool;
}
