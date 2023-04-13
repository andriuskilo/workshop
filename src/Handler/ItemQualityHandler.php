<?php

declare(strict_types=1);

namespace GildedRose\Handler;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;
use GildedRose\Strategy\AgingStrategy;
use GildedRose\Strategy\BackstagePassesStrategy;
use GildedRose\Strategy\ConjuredStrategy;
use GildedRose\Strategy\DefaultStrategy;
use GildedRose\Strategy\LegendaryStrategy;
use GildedRose\Strategy\StrategyInterface;

class ItemQualityHandler
{
    private DefaultStrategy $defaultStrategy;

    /**
     * @var array<StrategyInterface>
     */
    private array $strategies;

    public function __construct()
    {
        $processor = new QualityProcessor();

        $this->strategies = [
            new BackstagePassesStrategy($processor),
            new AgingStrategy($processor),
            new ConjuredStrategy($processor),
            new LegendaryStrategy(),
        ];

        $this->defaultStrategy = new DefaultStrategy($processor);
    }

    public function handle(Item $item): void
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->canApply($item)) {
                $strategy->updateItem($item);

                return;
            }
        }

        $this->defaultStrategy->updateItem($item);
    }
}
