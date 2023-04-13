<?php

declare(strict_types=1);

namespace GildedRose\Processor;

use GildedRose\Item;

class QualityProcessor
{
    public function increaseQuality(Item $item): void
    {
        if ($item->quality < 50) {
            ++$item->quality;
        }
    }

    public function decreaseQuality(Item $item, int $by = 1): void
    {
        if ($item->quality > 0) {
            $item->quality -= $by;
        }

        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }
}
