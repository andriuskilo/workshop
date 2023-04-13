<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\ItemStrategy\DefaultStrategy;
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
        private array $items,
        private DefaultStrategy $defaultStrategy
    ) {
    }

    public function addStrategies(
        ItemStrategy ...$itemsStrategies
    ): self {
        $this->itemStrategies = $itemsStrategies;

        return $this;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            foreach ($this->itemStrategies as $strategy) {
                if ($strategy->supports($item)) {
                    $strategy->updateItem($item);

                    continue 2;
                }
            }

            /**
             * Use default strategy explicitly not to depend on configuration to ensure there is one
             */
            $this->defaultStrategy->updateItem($item);
        }
    }
}
