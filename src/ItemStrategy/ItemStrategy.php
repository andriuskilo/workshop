<?php

declare(strict_types=1);

namespace GildedRose\ItemStrategy;

use GildedRose\Item;

interface ItemStrategy
{
    public function supports(Item $item): bool;

    public function updateItem(Item $item): void;
}