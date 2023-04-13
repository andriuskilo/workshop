<?php

declare(strict_types=1);

namespace GildedRose\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;

class AgingStrategy implements StrategyInterface
{
    public function __construct(
        private QualityProcessor $qualityProcessor,
    ) {
    }

    public function updateItem(Item $item): void
    {
        $this->qualityProcessor->increaseQuality($item);

        --$item->sellIn;

        if ($item->sellIn < 0) {
            $this->qualityProcessor->increaseQuality($item);
        }
    }

    public function canApply(Item $item): bool
    {
        return $item->name === 'Aged Brie';
    }
}
