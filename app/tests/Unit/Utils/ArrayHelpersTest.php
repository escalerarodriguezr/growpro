<?php
declare(strict_types=1);

namespace Tests\Unit\Utils;

use Grow\Utils\ArrayHelpers;
use PHPUnit\Framework\TestCase;

class ArrayHelpersTest extends TestCase
{

    public function testSortArrayNullCondition(): void
    {
        $array = [
            ['user' => 'Andres', 'age' => 90, 'scoring' => 99],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Andres', 'age' => 25, 'scoring' => 10],
            ['user' => 'Borja', 'age' => 25, 'scoring' => 9],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => 100],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];

        $response = ArrayHelpers::sortByConditions($array);

        $firstAndres = $response[0];

        self::assertSame('Andres',$firstAndres['user']);
        self::assertSame(90,$firstAndres['age']);
        self::assertSame(99,$firstAndres['scoring']);

        $last = $response[6];
        self::assertSame('Patricio',$last['user']);
    }


    public function testSortArrayByThreeConditions(): void
    {
        $array = [
            ['user' => 'Andres', 'age' => 90, 'scoring' => 99],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Andres', 'age' => 25, 'scoring' => 10],
            ['user' => 'Borja', 'age' => 25, 'scoring' => 9],
            ['user' => 'Zulueta', 'age' => 33, 'scoring' => 100],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];

        $sortCriterion = ['user' => 'ASC', 'age' => 'DESC', 'scoring' => 'ASC'];
        $response = ArrayHelpers::sortByConditions($array,$sortCriterion);

        $firstAndres = $response[0];

        self::assertSame('Andres',$firstAndres['user']);
        self::assertSame(90,$firstAndres['age']);
        self::assertSame(99,$firstAndres['scoring']);

        $secondAndres = $response[1];
        self::assertSame('Andres',$secondAndres['user']);
        self::assertSame(25,$secondAndres['age']);
        self::assertSame(10,$secondAndres['scoring']);

        $last = $response[6];
        self::assertSame('Zulueta',$last['user']);

    }


    public function testSortArrayByNullUserFieldAndASCOrder(): void
    {

        $array = [
            ['user' => 'Andres', 'age' => 90, 'scoring' => 99],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Andres', 'age' => 25, 'scoring' => 10],
            ['user' => 'Borja', 'age' => 25, 'scoring' => 9],
            ['name' => 'Zulueta', 'age' => 33, 'scoring' => 100],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];

        $sortCriterion = ['user' => 'ASC', 'age' => 'DESC', 'scoring' => 'ASC'];

        $response = ArrayHelpers::sortByConditions($array,$sortCriterion);

        $first = $response[0];

        self::assertSame('Zulueta',$first['name']);

        $second = $response[1];
        self::assertSame('Andres',$second['user']);

    }

    public function testSortArrayByNullUserFieldAndDESCOrder(): void
    {
        $array = [
            ['user' => 'Andres', 'age' => 90, 'scoring' => 99],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 10],
            ['user' => 'Andres', 'age' => 25, 'scoring' => 10],
            ['user' => 'Borja', 'age' => 25, 'scoring' => 9],
            ['name' => 'Zulueta', 'age' => 33, 'scoring' => 100],
            ['user' => 'Mario', 'age' => 45, 'scoring' => 78],
            ['user' => 'Patricio', 'age' => 22, 'scoring' => 9],
        ];

        $sortCriterion = ['user' => 'DESC', 'age' => 'DESC', 'scoring' => 'ASC'];

        $response = ArrayHelpers::sortByConditions($array,$sortCriterion);

        $first = $response[0];

        self::assertSame('Patricio',$first['user']);

        $second = $response[6];
        self::assertSame('Zulueta',$second['name']);

    }


    public function testSortArrayOtherFields(): void
    {
        $array = [
            ['name' => 'Andres', 'money' => 90],
            ['name' => 'Mario', 'money' => 90,],
            ['name' => 'Andres', 'money' => 25,],

        ];

        $sortCriterion = ['money' => 'ASC', 'name' => 'DESC'];

        $response = ArrayHelpers::sortByConditions($array,$sortCriterion);

        $first = $response[0];

        self::assertSame(25,$first['money']);
        self::assertSame('Andres',$first['name']);

        $second = $response[1];
        self::assertSame(90,$second['money']);
        self::assertSame('Mario',$second['name']);

        $third = $response[2];
        self::assertSame(90,$third['money']);
        self::assertSame('Andres',$third['name']);

    }

}