<?php

declare(strict_types=1);

namespace GildedRose\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;

class ConjuredStrategy implements StrategyInterface
{
    public function __construct(
        private QualityProcessor $qualityProcessor,
    ) {
    }

    public function updateItem(Item $item): void
    {
        $this->qualityProcessor->decreaseQuality($item, 2);

        --$item->sellIn;

        if ($item->sellIn < 0) {
            $this->qualityProcessor->decreaseQuality($item, 2);
        }
    }

    public function canApply(Item $item): bool
    {
        return $item->name === 'Conjured Mana Cake';
    }
}
