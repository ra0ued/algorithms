<?php

declare(strict_types=1);

class BinarySearch
{
    public function search(array $list, int $item)
    {
        $low = 0;
        $high = count($list) - 1;

        while ($low <= $high) {
            $mid = ceil(($low + $high) / 2);
            $guess = $list[$mid];

            if ($guess === $item) {
                return $mid;
            }

            if ($guess > $item) {
                $high = $mid - 1;
            } else {
                $low = $mid + 1;
            }
        }

        return false;
    }
}

$testList = range(1, 100);
$binarySearch = new BinarySearch();
print $binarySearch->search($testList, 42);