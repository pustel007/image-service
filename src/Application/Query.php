<?php

declare(strict_types=1);

namespace Pustel007\ImageService\Application;

final class Query
{
    private const MODIFIER_SEPARATOR = '.';

    public static function extractFilename(string $path): string
    {
        $pathElements = explode('/', trim($path, '/'));
        return array_shift($pathElements);
    }

    /** @return array[] */
    public static function extractModifiersNameAndArgs(string $query): array
    {
        $modifiersArray = [];

        foreach (self::parseModifiersQuery($query) as $modifierQuery) {
            $modifierName = self::extractModifierName($modifierQuery);
            $modifierArgs = self::extractModifierArgs($modifierQuery);
            $modifiersArray[$modifierName] = $modifierArgs;
        }

        return $modifiersArray;
    }

    private static function parseModifiersQuery(string $query): array
    {
        if ($query) {
            $modifierQueries = [];
            preg_match_all('/mod=([^\&]+)/', $query, $modifierQueries);

            if (is_array($modifierQueries[1])) {
                return $modifierQueries[1];
            }
        }

        return [];
    }

    private static function extractModifierName(string $queryParam): string
    {
        $params = explode(
            self::MODIFIER_SEPARATOR,
            $queryParam
        );

        return array_shift($params);
    }

    /** @return string[] */
    private static function extractModifierArgs(string $queryParam): array
    {
        $params = [];

        if (strpos($queryParam, self::MODIFIER_SEPARATOR) !== false) {
            $params = explode(
                self::MODIFIER_SEPARATOR,
                $queryParam
            );

            // ommit first element
            array_shift($params);
        }

        return $params;
    }
}
