<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{

    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name == self::SULFURAS) {
                continue;
            }

            if ($item->name == self::AGED_BRIE) {
                $this->updateAgedBrieQuality($item);
                continue;
            }

            if ($item->name == self::BACKSTAGE_PASSES) {
                $this->updateBackstagePassesQuality($item);
                continue;
            }

            if ($item->quality > 0) {
                $item->quality--;
            }

            $item->sellIn--;

            if ($item->sellIn < 0 && $item->quality > 0) {
                $item->quality--;
            }
        }
    }

    private function updateAgedBrieQuality(Item $item): void
    {
        $item->quality++;

        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality++;
        }

        $item->quality = min(50, $item->quality);
    }

    private function updateBackstagePassesQuality(Item $item): void
    {
        $item->quality++;

        if ($item->sellIn < 11) {
            $item->quality++;
        }
        if ($item->sellIn < 6) {
            $item->quality++;
        }
        $item->quality = min(50, $item->quality);

        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }
}
