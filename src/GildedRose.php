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

            if ($item->name == self::AGED_BRIE || $item->name == self::BACKSTAGE_PASSES) {

                $item->quality++;
                if ($item->name == self::BACKSTAGE_PASSES) {
                    if ($item->sellIn < 11) {
                        $item->quality++;
                    }
                    if ($item->sellIn < 6) {
                        $item->quality++;
                    }
                }

                $item->quality = min(50, $item->quality);

            } elseif ($item->quality > 0) {
                $item->quality--;
            }

            $item->sellIn--;

            if ($item->sellIn < 0) {
                if ($item->name == self::AGED_BRIE) {
                    if ($item->quality < 50) {
                        $item->quality++;
                    }
                } elseif ($item->name == self::BACKSTAGE_PASSES) {
                    $item->quality = 0;
                } elseif ($item->quality > 0) {
                    $item->quality--;
                }
            }
        }
    }
}
