<?php
declare(strict_types=1);

namespace Grow\Utils;

class ArrayHelpers
{
    public static function sortByConditions(array &$array, ?array $criteria=null): array
    {
        if (empty($criteria)) {
            return $array;
        }

        $queryConditions = [];
        foreach ($criteria as $field => $order) {
            $queryCondition = new \stdClass();
            $queryCondition->field = $field;
            $queryCondition->order = $order;
            $queryConditions[] = $queryCondition;
        }


        usort($array, function($a, $b) use ($queryConditions) {
            foreach ($queryConditions as $index => $queryCondition){
                $valueA = array_key_exists($queryCondition->field, $a) ? $a[$queryCondition->field] : null;
                $valueB = array_key_exists($queryCondition->field, $b) ? $b[$queryCondition->field] : null;
                $order = $queryCondition->order;
                if( $valueA === $valueB ){
                    $valueA = array_key_exists($queryConditions[$index+1]->field, $a) ? $a[$queryConditions[$index+1]->field] : null;
                    $valueB = array_key_exists($queryConditions[$index+1]->field, $b) ? $b[$queryConditions[$index+1]->field] : null;
                    $order = $queryConditions[$index+1]->order;
                }else{
                    break;
                }
            }

            if (is_string($valueA) && is_string($valueB)) {
                $result = strnatcmp(
                    strtolower($valueA),
                    strtolower($valueB)
                );
                if ($result !== 0) {
                    return ($order === 'ASC') ? $result : -$result;
                }
            }

            if ($order == 'ASC') {
                return ($valueA < $valueB) ? -1 : 1;
            } else {
                return ($valueA < $valueB) ? 1 : -1;
            }

        });

        return $array;

    }

}