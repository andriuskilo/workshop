<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
        $this->itemStrategy = new ItemStrategy();
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $key => $item) {
            $this->items[$key] = $this->itemStrategy->createHandler($item->name)->handle($item);
        }
    }
}
