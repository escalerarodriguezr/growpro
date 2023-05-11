<?php
declare(strict_types=1);

namespace Tests\Unit\Utils;

use Grow\Utils\TextParser;
use PHPUnit\Framework\TestCase;

class TextParserTest extends TestCase
{
    public function testGetUserIdentifiersFromText(): void
    {
        $text = "Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)";

        $response = TextParser::getUserIdentifiersFromText($text);
        self::assertCount(2,$response);
        list($first,$second) = $response;
        self::assertSame('1071',$first);
        self::assertSame('1061',$second);

    }

    public function testReplaceUserIdentifierWithName(): void
    {
        $text = "Hola @[Franklin](user-gpe-1071) avisa a @[Ludmina](user-gpe-1061)";
        $response = TextParser::replaceUserIdentifierWithName($text);
        self::assertSame('Hola @Franklin avisa a @Ludmina',$response);
    }


}