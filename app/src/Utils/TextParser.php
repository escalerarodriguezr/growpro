<?php
declare(strict_types=1);

namespace Grow\Utils;

class TextParser
{
    public static function getUserIdentifiersFromText(string $text): array
    {
        $pattern = '/(user-gpe-\d+)/';
        preg_match_all($pattern, $text, $matches);
        return array_map(function ($value){
            $parse = explode('user-gpe-', $value);
            return $parse[1];
        },$matches[0]);

    }

    public static function replaceUserIdentifierWithName(string $text): string
    {

        $pattern = '/@\[([^\]]+)\]\(user-gpe-\d+\)/';
        $replacement = '@$1';
        return preg_replace($pattern, $replacement, $text);
    }

}