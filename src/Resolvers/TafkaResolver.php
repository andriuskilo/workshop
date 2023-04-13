<?php

declare(strict_types=1);

namespace GildedRose\Resolvers;

use GildedRose\Item;

class TafkaResolver implements Resolver
{
    public function isEligible(Item $item): bool
    {
        return $item->name === ResolvedItemNames::NAME_TAFKA;
    }

    public function resolve(Item $item): void
    {
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
    }
}
