<?php

class TwilightSparkle
{
    /**
     * @return string
     */
    public function getInputData(): string
    {
        $n = rand(2, 105);

        $result = '';

        for ($i = 0; $i < $n; $i++) {
            $result .= rand(1, 105) . ($i === $n - 1 ? null : ', ');
        }

        return $result;
    }

    /**
     * @param string $sequence
     * @return int
     */
    public function sort(string $sequence): int
    {
        $sequence = explode(', ', $sequence);

        $tries = count($sequence);
        $sortedSequence = $sequence;
        sort($sortedSequence);
        $actions = 0;

        while ($tries) {
            if ($sequence === $sortedSequence) {
                return $actions;
            }

            if ($sequence !== $sortedSequence) {
                array_unshift($sequence, array_pop($sequence));
                $actions++;
                $tries--;
            }
        }

        return -1;
    }
}

$twilightSparkle = new TwilightSparkle();

echo $twilightSparkle->sort($twilightSparkle->getInputData());

class Singleton
{
    private static $uniqueInstance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (static::$uniqueInstance === null) {
            static::$uniqueInstance = new Singleton();
        }

        return static::$uniqueInstance;
    }
}