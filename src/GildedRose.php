<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Handler\UpdateQualityInterface;

final class GildedRose
{
    /**
     * @param Item[] $items
     * @param iterable<UpdateQualityInterface> $updateQualityHandlers
     */
    public function __construct(
        private array $items,
        private iterable $updateQualityHandlers,
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            foreach ($this->updateQualityHandlers as $handler) {
                if ($handler->canApply($item)) {
                    $handler->updateQuality($item);
                }
            }

//            if ($item->name !== 'Aged Brie' and $item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
//                if ($item->quality > 0) {
//                    if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
//                        $item->quality = $item->quality - 1;
//                    }
//                }
//            } else {
//                if ($item->quality < 50) {
//                    $item->quality = $item->quality + 1;
//                    if ($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
//                        if ($item->sellIn < 11) {
//                            if ($item->quality < 50) {
//                                $item->quality = $item->quality + 1;
//                            }
//                        }
//                        if ($item->sellIn < 6) {
//                            if ($item->quality < 50) {
//                                $item->quality = $item->quality + 1;
//                            }
//                        }
//                    }
//                }
//            }
//
//            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
//                $item->sellIn = $item->sellIn - 1;
//            }
//
//            if ($item->sellIn < 0) {
//                if ($item->name !== 'Aged Brie') {
//                    if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
//                        if ($item->quality > 0) {
//                            if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
//                                $item->quality = $item->quality - 1;
//                            }
//                        }
//                    } else {
//                        $item->quality = $item->quality - $item->quality;
//                    }
//                } else {
//                    if ($item->quality < 50) {
//                        $item->quality = $item->quality + 1;
//                    }
//                }
//            }
        }
    }
}
