<?php

declare(strict_types=1);

namespace GildedRose\Processor;

use GildedRose\Item;

class QualityProcessor
{
    private const MAX_QUALITY = 50;
    private const MIN_QUALITY = 0;

    public function increaseQuality(Item $item): void
    {
        if ($item->quality < self::MAX_QUALITY) {
            ++$item->quality;
        }
    }

    public function decreaseQuality(Item $item, int $by = 1): void
    {
        if ($item->quality > self::MIN_QUALITY) {
            $item->quality -= $by;
        }

        if ($item->quality < self::MIN_QUALITY) {
            $item->quality = self::MIN_QUALITY;
        }
    }
}
