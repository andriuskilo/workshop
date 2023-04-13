<?php

declare(strict_types=1);

namespace GildedRose\Resolvers;

use GildedRose\Item;

class ResolveManager
{
    /**
     * @param Resolver[] $resolvers
     */
    public function __construct(private array $resolvers)
    {

    }

    public function resolve(Item $item): void
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->isEligible($item)) {
                $resolver->resolve($item);
            }
        }
    }
}
