<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRoseConfig
{
    public const AGED_BRIE = 'Aged Brie';
    public const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    public const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    public const CONJURED = 'Conjured';

    private const CONFIG = [
        self::AGED_BRIE => [
            'increase' => [
                'quality' => [
                    [
                        ['by' => 1],
                    ],
                ],
            ],
        ],
        self::BACKSTAGE_PASSES => [
            'increase' => [
                [ // 32
                    'quality' => [
                        [
                            'minSellIn' => 10,
                            'by' => 1,
                        ],
                    ],
                ],
                [ // 37
                    'quality' => [
                        [
                            'minSellIn' => 5,
                            'by' => 1,
                        ],
                    ],
                ]
            ],
        ],
        self::SULFURAS => [
            'decrease' => [
                'sellIn' => [ // 45
                    [
                        'by' => 0,
                    ],
                ],
            ],
        ],
        self::CONJURED => [

        ],
        'default' => [
            'decrease' => [
                'quality' => [
                    [
                        ['by' => 1], // 23
                        ['by' => 1, 'minSellIn' => -1], // 53
                    ]
                ],
                'sellIn' => [ // 45
                    'by' => 1,
                ],
            ],
            'increase' => [
                'quality' => [
                    [
                        'by' => 1,
                    ],
                ],
                'sellIn' => [
                    'min' => 0,
                    'max' => 0,
                    'by' => 1,
                ],
            ],
        ],
    ];

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
            if ($this->isSpecialItem($item)) {
                $this->increaseForHalfQuality($item);
                $this->increaseQualityForBackPasses($item);
            } else {
                $this->decreaseSellableQuality($item);
            }

            if ($item->name === self::CONJURED) {
                $this->decreaseSellableQuality($item);
                continue;
            }

            if ($this->isSellable($item)) {
                --$item->sellIn;
            }

            if ($this->isUpToDate($item)) {
                continue;
            }

            if ($item->name === self::AGED_BRIE) {
                $this->increaseForHalfQuality($item);
                continue;
            }

            if ($item->name !== self::BACKSTAGE_PASSES) {
                $this->decreaseSellableQuality($item);
                continue;
            }

            $this->setZeroQuality($item);
        }
    }

    private function isSpecialItem(Item $item): bool
    {
        return in_array($item->name, [self::AGED_BRIE, self::BACKSTAGE_PASSES]);
    }

    public function increaseForHalfQuality(Item $item): void
    {
        if ($this->isHalfQuality($item)) {
            $item->quality = $item->quality + 1;
        }
    }

    private function isSellable(Item $item): bool
    {
        return self::SULFURAS !== $item->name;
    }

    public function decreaseSellableQuality(Item $item): void
    {
        if ($item->quality > 0 && $this->isSellable($item)) {
            $item->quality = $item->quality - 1;
        }
    }

    private function isHalfQuality(Item $item): bool
    {
        return $item->quality < 50;
    }

    private function increaseQualityForBackPasses(Item $item): void
    {
        if ($item->name != self::BACKSTAGE_PASSES) {
            return;
        }

        if ($item->sellIn < 11) {
            $this->increaseForHalfQuality($item);
        }

        if ($item->sellIn < 6) {
            $this->increaseForHalfQuality($item);
        }
    }

    private function isUpToDate(Item $item): bool
    {
        return $item->sellIn >= 0;
    }

    private function setZeroQuality(Item $item): void
    {
        $item->quality = 0;
    }
}
