<?php

class QuickSort
{
    public function sort(array $array): array
    {
        if (count($array) < 2) {
            return $array;
        }

        $pivot = $array[0];
        $greater = [];
        $less = [];

        foreach ($array as $item) {
            if ($item > $pivot) {
                $greater[] = $item;
            }

            if ($item < $pivot) {
                $less[] = $item;
            }
        }

        return array_merge($this->sort($less), [$pivot], $this->sort($greater));
    }
}

$testArray = [10, 5, 2, 3, 1000, 200, 200, 30, 9, 0, 5, 0, 30, 200, 0, 9, 77777777777777];

$quickSort = new QuickSort();

print json_encode($quickSort->sort($testArray)) . PHP_EOL;

