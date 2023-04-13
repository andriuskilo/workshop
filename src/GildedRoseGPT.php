<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRoseGPT
{
    public const AGED_BRIE = 'Aged Brie';
    public const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    public const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    public const CONJURED = 'Conjured';

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
            match ($item->name) {
                self::AGED_BRIE => $this->updateAgedBrie($item),
                self::BACKSTAGE_PASSES => $this->updateBackstagePasses($item),
                self::SULFURAS => null, // No update needed for Sulfuras
                self::CONJURED => $this->updateConjured($item),
                default => $this->updateOther($item),
            };
        }
    }

    private function updateAgedBrie(Item $item): void
    {
        $item->quality = min(50, $item->quality + 1);
        $item->sellIn -= 1;
    }

    private function updateBackstagePasses(Item $item): void
    {
        if ($item->sellIn <= 0) {
            $item->quality = 0;
        } elseif ($item->sellIn <= 5) {
            $item->quality = min(50, $item->quality + 3);
        } elseif ($item->sellIn <= 10) {
            $item->quality = min(50, $item->quality + 2);
        } else {
            $item->quality = min(50, $item->quality + 1);
        }

        $item->sellIn -= 1;
    }

    private function updateConjured(Item $item): void
    {
        $item->quality = max(0, $item->quality - 2);
        $item->sellIn -= 1;
    }

    private function updateOther(Item $item): void
    {
        $item->quality = max(0, $item->quality - ($item->sellIn <= 0 ? 2 : 1));
        $item->sellIn -= 1;
    }
}
