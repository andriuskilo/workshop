<?php

declare(strict_types=1);

namespace GildedRose\Resolvers;

use GildedRose\Item;

class ResolveManager
{
    private Resolver $defaultResolver;

    /**
     * @param Resolver[] $resolvers
     */
    public function __construct(private array $resolvers)
    {
        $this->defaultResolver = new DefaultResolver();
    }

    public function resolve(Item $item): void
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->isEligible($item)) {
                $resolver->resolve($item);
                return;
            }
        }

        $this->defaultResolver->resolve($item);
    }
}
