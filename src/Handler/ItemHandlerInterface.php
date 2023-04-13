<?php

namespace GildedRose\Handler;

use GildedRose\Item;

interface ItemHandlerInterface
{
    public function supports(Item $item): bool;

    public function handle(Item $item): void;
}