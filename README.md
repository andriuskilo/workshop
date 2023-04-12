![docker](https://img.shields.io/badge/Docker-compose-brightgreen.svg)
![php](https://img.shields.io/badge/PHP_FPM-8.2.4-brightgreen.svg)
![xdebug](https://img.shields.io/badge/Xdebug-3.2.0RC1-brightgreen.svg)
![nginx](https://img.shields.io/badge/nginx-1.23.3-brightgreen.svg)

Start container:
````
make up
````
Composer install:
````
make composer-install
````
Stop container:
````
make down
````

## Dependencies

The project uses composer to install:

- [PHPUnit](https://phpunit.de/)
- [ApprovalTests.PHP](https://github.com/approvals/ApprovalTests.php)
- [PHPStan](https://github.com/phpstan/phpstan)
- [Easy Coding Standard (ECS)](https://github.com/symplify/easy-coding-standard)

## Folders

- `src` - contains the two classes:
    - `Item.php` - this class should not be changed
    - `GildedRose.php` - this class needs to be refactored, and the new feature added
- `tests` - contains the tests
    - `GildedRoseTest.php` - starter test.
        - Tip: ApprovalTests has been included as a dev dependency, see the PHP version of
          the [Theatrical Players Refactoring Kata](https://github.com/emilybache/Theatrical-Players-Refactoring-Kata/)
          for an example
- `Fixture`
    - `texttest_fixture.php` this could be used by an ApprovalTests, or run from the command line

## Fixture

To run the fixture from the php directory:

```shell
make fixture count=10
```

Change **10** to the required days.

## Testing

PHPUnit is configured for testing, a composer script has been provided. To run the unit tests, from the root of the PHP
project run:

```shell script
make test
```

## Code Standard

Easy Coding Standard (ECS) is configured for style and code standards, **PSR-12** is used. The current code is not upto
standard!

### Check Code

To check code, but not fix errors:

```shell script
make check-cs
```

### Fix Code

ECS provides may code fixes, automatically, if advised to run --fix, the following script can be run:

```shell script
make fix-cs
```

## Static Analysis

PHPStan is used to run static analysis checks:

```shell script
make phpstan
```

**Happy coding**!

# Gilded Rose Refactoring Kata

This Kata was originally created by Terry Hughes (http://twitter.com/TerryHughes). It is already on GitHub [here](https://github.com/NotMyself/GildedRose). See also [Bobby Johnson's description of the kata](https://iamnotmyself.com/refactor-this-the-gilded-rose-kata/).

I translated the original C# into a few other languages, (with a little help from my friends!), and slightly changed the starting position. This means I've actually done a small amount of refactoring already compared with the original form of the kata, and made it easier to get going with writing tests by giving you one failing unit test to start with. I also added test fixtures for Text-Based approval testing with TextTest (see [the TextTests](https://github.com/emilybache/GildedRose-Refactoring-Kata/tree/master/texttests))

As Bobby Johnson points out in his article ["Why Most Solutions to Gilded Rose Miss The Bigger Picture"](https://iamnotmyself.com/why-most-solutions-to-gilded-rose-miss-the-bigger-picture/), it'll actually give you
better practice at handling a legacy code situation if you do this Kata in the original C#. However, I think this kata
is also really useful for practicing writing good tests using different frameworks and approaches, and the small changes I've made help with that. I think it's also interesting to compare what the refactored code and tests look like in different programming languages.

I use this kata as part of my work as a technical coach. I wrote a lot about the coaching method I use in this book [Technical Agile Coaching with the Samman method](https://leanpub.com/techagilecoach). A while back I wrote this article ["Writing Good Tests for the Gilded Rose Kata"](http://coding-is-like-cooking.info/2013/03/writing-good-tests-for-the-gilded-rose-kata/) about how you could use this kata in a [coding dojo](https://leanpub.com/codingdojohandbook).

## How to use this Kata

The simplest way is to just clone the code and start hacking away improving the design. You'll want to look at the ["Gilded Rose Requirements"](https://github.com/emilybache/GildedRose-Refactoring-Kata/tree/master/GildedRoseRequirements.txt) which explains what the code is for. I strongly advise you that you'll also need some tests if you want to make sure you don't break the code while you refactor.

You could write some unit tests yourself, using the requirements to identify suitable test cases. I've provided a failing unit test in a popular test framework as a starting point for most languages.

Alternatively, use the "Text-Based" tests provided in this repository. (Read more about that in the next section)

Whichever testing approach you choose, the idea of the exercise is to do some deliberate practice, and improve your skills at designing test cases and refactoring. The idea is not to re-write the code from scratch, but rather to practice designing tests, taking small steps, running the tests often, and incrementally improving the design.

### Gilded Rose Requirements in other languages

- [English](GildedRoseRequirements.txt)
- [Español](GildedRoseRequirements_es.md)
- [Français](GildedRoseRequirements_fr.md)
- [日本語](GildedRoseRequirements_jp.md)
- [Português](GildedRoseRequirements_pt-BR.md)
- [Русский](GildedRoseRequirements_ru.txt)
- [ไทย](GildedRoseRequirements_th.md)
- [中文](GildedRoseRequirements_zh.txt)
- [한국어](GildedRoseRequirements_kr.md)
- [German](GildedRoseRequirements_de.md)

## Text-Based Approval Testing

Most language versions of this code have a [TextTest](https://texttest.org) fixture for Approval testing. For information about this, see the [TextTests README](https://github.com/emilybache/GildedRose-Refactoring-Kata/tree/master/texttests)
