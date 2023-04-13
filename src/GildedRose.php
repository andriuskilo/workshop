<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ItemStrategy\ItemStrategy;

final class GildedRose
{
    /**
     * @var ItemStrategy[]
     */
    private array $itemStrategies = [];

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function addStrategies(
        ItemStrategy ...$itemsStrategies
    ): self
    {
        $this->itemStrategies = $itemsStrategies;

        return $this;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            /**
             * Check if the new strategy-based flow supports the current Item
             */
            foreach ($this->itemStrategies as $strategy) {
                if ($strategy->supports($item)) {
                    $strategy->updateItem($item);

                    continue 2;
                }
            }

            /**
             * Else, let's go with the old logic:
             */
            if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sellIn < 11) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < 6) {
                            if ($item->quality < 50) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                $item->sellIn = $item->sellIn - 1;
            }

            if ($item->sellIn < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
