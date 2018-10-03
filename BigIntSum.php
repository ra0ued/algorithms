<?php

class BigIntSum
{
    /**
     *
     *
     * @param string $input
     * @return string
     */
    public function sum(string $input): string
    {
        $base = 10;
        $result = '';
        $numbers = $this->parseInput($input);
        $output = [0];

        if (count($numbers) < 2) {
            return $result;
        }

        $a = strrev($numbers[0]);
        $b = strrev($numbers[1]);

        if (strlen($a) > strlen($b)) {
            $out = &$a;
            $in = &$b;
        } else {
            $out = &$b;
            $in = &$a;
        }

        for ($i = 0, $n = strlen($out); $i < $n; $i++) {
            $temp = (integer)$in[$i] + (integer)$out[$i];
            if ($temp >= $base) {
                $output[$i + 1] = 1;
                $temp -= $base;
            }
            $output[$i] += $temp;
        }

        $result = implode('', array_reverse($output));

        return $result;
    }

    /**
     * Returns two first met digits from input string
     *
     * @param string $input
     * @return array
     */
    private function parseInput(string $input): array
    {
        $result = [];

        preg_match_all('/\d+/', $input, $result);

        return $result[0];
    }
}

// Checking...
$test = new BigIntSum();
var_dump($test->sum("73842937042034023784073133453453452345234527, 46236419945554532344539494040020304523454023 8777asdf 324324 ахаха я невменяемый юзер!!111адинадин"));