<?php

declare(strict_types=1);

namespace GildedRose\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;

class BackstagePassesStrategy implements StrategyInterface
{
    public function __construct(
        private QualityProcessor $qualityProcessor,
    ) {
    }

    public function updateItem(Item $item): void
    {
        $this->qualityProcessor->increaseQuality($item);

        if ($item->sellIn < 11) {
            $this->qualityProcessor->increaseQuality($item);
        }

        if ($item->sellIn < 6) {
            $this->qualityProcessor->increaseQuality($item);
        }

        --$item->sellIn;

        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }

    public function canApply(Item $item): bool
    {
        return $item->name === 'Backstage passes to a TAFKAL80ETC concert';
    }
}
