<?php

declare(strict_types=1);

namespace Tests\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;
use GildedRose\Strategy\ConjuredStrategy;
use PHPUnit\Framework\TestCase;

class ConjuredStrategyTest extends TestCase
{
    public function testConjuredStrategy(): void
    {
        $processor = new QualityProcessor();
        $strategy = new ConjuredStrategy($processor);

        $item = new Item('Conjured Mana Cake', 15, 20);

        $strategy->updateItem($item);

        $this->assertEquals(14, $item->sellIn);
        $this->assertEquals(18, $item->quality);
    }

    public function testWhenSellInLessThanZero(): void
    {
        $processor = new QualityProcessor();
        $strategy = new ConjuredStrategy($processor);

        $item = new Item('Conjured Mana Cake', 0, 20);

        $strategy->updateItem($item);

        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(16, $item->quality);
    }
}
