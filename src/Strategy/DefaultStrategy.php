<?php

declare(strict_types=1);

namespace GildedRose\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;

class DefaultStrategy implements StrategyInterface
{
    public function __construct(
        private QualityProcessor $qualityProcessor,
    ) {
    }

    public function updateItem(Item $item): void
    {
        $this->qualityProcessor->decreaseQuality($item);

        --$item->sellIn;

        if ($item->sellIn < 0) {
            $this->qualityProcessor->decreaseQuality($item);
        }
    }

    public function canApply(Item $item): bool
    {
        return true;
    }
}
