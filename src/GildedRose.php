<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    const NAME_BRIE = 'Aged Brie';
    const NAME_TAFKA = 'Backstage passes to a TAFKAL80ETC concert';
    const NAME_SULFURAS = 'Sulfuras, Hand of Ragnaros';

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
            switch ($item->name) {
                case self::NAME_BRIE:
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                    $item->sellIn = $item->sellIn - 1;
                    if ($item->sellIn < 0) {
                        if ($item->quality < 50) {
                            $item->quality = $item->quality + 1;
                        }
                    }
                    break;
                case self::NAME_TAFKA:
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
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
                    $item->sellIn = $item->sellIn - 1;
                    if ($item->sellIn < 0) {
                        $item->quality = 0;
                    }
                    break;
                case self::NAME_SULFURAS:

                    break;
                default:
                    if ($item->quality > 0) {
                        $item->quality = $item->quality - 1;
                    }
                    $item->sellIn = $item->sellIn - 1;
                    if ($item->sellIn < 0) {
                        if ($item->quality > 0) {
                            $item->quality = $item->quality - 1;
                        }
                    }
            }
        }
    }
}
