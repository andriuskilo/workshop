<?php

declare(strict_types=1);

namespace Tests\Strategy;

use GildedRose\Item;
use GildedRose\Processor\QualityProcessor;
use GildedRose\Strategy\DefaultStrategy;
use PHPUnit\Framework\TestCase;

class DefaultStrategyTest extends TestCase
{
    public function testDefaultStrategy(): void
    {
        $processor = new QualityProcessor();
        $strategy = new DefaultStrategy($processor);

        $item = new Item('+5 Dexterity Vest', 10, 20);

        $strategy->updateItem($item);

        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(19, $item->quality);
    }

    public function testWhenSellInLessThanZero(): void
    {
        $processor = new QualityProcessor();
        $strategy = new DefaultStrategy($processor);

        $item = new Item('+5 Dexterity Vest', 0, 20);

        $strategy->updateItem($item);

        $this->assertEquals(-1, $item->sellIn);
        $this->assertEquals(18, $item->quality);
    }

    public function testWhenQualityZero(): void
    {
        $processor = new QualityProcessor();
        $strategy = new DefaultStrategy($processor);

        $item = new Item('+5 Dexterity Vest', 2, 0);

        $strategy->updateItem($item);

        $this->assertEquals(1, $item->sellIn);
        $this->assertEquals(0, $item->quality);
    }
}
