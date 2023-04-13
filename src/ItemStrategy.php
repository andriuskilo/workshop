<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Handlers\AgedBrieHandler;
use GildedRose\Handlers\BackstageHandler;
use GildedRose\Handlers\ItemHandlerInterface;
use GildedRose\Handlers\NormalItemHandler;
use GildedRose\Handlers\SulfurasHandler;
use RuntimeException;

class ItemStrategy
{
    public function createHandler(string $name): ItemHandlerInterface
    {
        return new NormalItemHandler();
        return match ($name) {
            'Aged Brie' => new AgedBrieHandler(),
            'Sulfuras, Hand of Ragnaros' => new SulfurasHandler(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstageHandler(),
            default => new NormalItemHandler(),
        };
    }
}