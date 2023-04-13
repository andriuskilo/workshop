<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Resolvers\AgedBrieResolver;
use GildedRose\Resolvers\DefaultResolver;
use GildedRose\Resolvers\ResolveManager;
use GildedRose\Resolvers\SulfurasResolver;
use GildedRose\Resolvers\TafkaResolver;

final class GildedRose
{

    private ResolveManager $resolveManager;

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items,
    ) {
        $this->resolveManager = new ResolveManager([
            new AgedBrieResolver(),
            new SulfurasResolver(),
            new TafkaResolver(),
            new DefaultResolver(),
        ]);
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $this->resolveManager->resolve($item);
        }
    }
}
