<?php

declare(strict_types=1);

namespace GildedRose\Handlers;

use GildedRose\Item;

interface ItemHandlerInterface
{
    public function handle(Item $item): Item;
}