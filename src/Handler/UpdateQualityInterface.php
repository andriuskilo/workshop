<?php

namespace GildedRose\Handler;

use GildedRose\Item;

interface UpdateQualityInterface
{
    public function canApply(Item $item): bool;

    public function updateQuality(Item $item): void;
}
