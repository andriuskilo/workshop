<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\ItemStrategy\AgedBrieItemStrategy;
use GildedRose\ItemStrategy\BackstagePassesItemStrategy;
use GildedRose\ItemStrategy\ConjuredItemStrategy;
use GildedRose\ItemStrategy\DefaultStrategy;
use GildedRose\ItemStrategy\LegendaryItemStrategy;

echo 'OMGHAI!' . PHP_EOL;

$items = [
    new Item('+5 Dexterity Vest', 10, 20),
    new Item('Aged Brie', 2, 0),
    new Item('Elixir of the Mongoose', 5, 7),
    new Item('Sulfuras, Hand of Ragnaros', 0, 80),
    new Item('Sulfuras, Hand of Ragnaros', -1, 80),
    new Item('Backstage passes to a TAFKAL80ETC concert', 15, 20),
    new Item('Backstage passes to a TAFKAL80ETC concert', 10, 49),
    new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49),
    // this conjured item does not work properly yet
    new Item('Conjured Mana Cake', 3, 6),
];

$app = new GildedRose($items, new DefaultStrategy());
$app->addStrategies(
    new AgedBrieItemStrategy(),
    new BackstagePassesItemStrategy(),
    new ConjuredItemStrategy(),
    new LegendaryItemStrategy(),
);

$days = 2;
if ((is_countable($argv) ? count($argv) : 0) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo '-------- day '.$i.' --------' . PHP_EOL;
    echo 'name, sellIn, quality' . PHP_EOL;
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}
