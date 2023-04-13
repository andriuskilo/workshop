<?php

declare(strict_types=1);

namespace GildedRose;

final class Item implements \Stringable
{
    const NAME_AGED_BRIE = 'Aged Brie';
    const NAME_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    const NAME_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    public function __construct(
        public string $name,
        public int $sellIn,
        public int $quality
    ) {
    }

    public function __toString(): string
    {
        return (string) "{$this->name}, {$this->sellIn}, {$this->quality}";
    }

    public static function getSkipHandlers(): array
    {
        return [Item::NAME_AGED_BRIE, Item::NAME_SULFURAS];
    }
}
