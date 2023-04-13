<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Handler\ItemQualityHandler;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        $handler = new ItemQualityHandler();
        foreach ($this->items as $item) {
            $handler->handle($item);
        }
    }
}
