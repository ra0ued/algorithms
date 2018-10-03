<?php

class TagStripper
{
    private $string = '[НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА][НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА][НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА]';

    public function stripTags(string $string): array
    {
        $tags = $this->pregGrepKeys('/^(\d+)?\.\d+$/', $string);

        return $tags;
    }

    public function doIt()
    {
        $this->stripTags($this->string);
    }

     private function pregGrepKeys($pattern, $input, $flags = 0) {
        return array_intersect_key($input, array_flip(preg_grep($pattern, array_keys($input), $flags)));
    }
}
