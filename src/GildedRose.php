<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Handler\AgedBrieHandler;
use GildedRose\Handler\BackstageHandler;
use GildedRose\Handler\Handler1;
use GildedRose\Handler\Handler2;
use GildedRose\Handler\Handler3;
use GildedRose\Handler\DecreaseSellInNotForSulfurasHandler;
use GildedRose\Handler\Handler5;
use GildedRose\Handler\Handler6;
use GildedRose\Handler\Handler7;
use GildedRose\Handler\Handler8;
use GildedRose\Handler\SulfurasHandler;
use GildedRose\Handler\ItemHandlerInterface;

final class GildedRose
{
    /**
     * @var ItemHandlerInterface[]
     */
    private array $handlers = [];

    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
        $this->handlers = [
            new Handler1(),
            new Handler2(),
            new Handler3(),
            new DecreaseSellInNotForSulfurasHandler(),
            new Handler5(),
            new Handler7(),
            new Handler8(),
            new Handler6(),
            new AgedBrieHandler(),
            new SulfurasHandler(),
            new BackstageHandler(),
        ];
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            foreach ($this->handlers as $handler) {
                if ($handler->supports($item)) {
                    $handler->handle($item);
                }
            }
        }
    }
}
