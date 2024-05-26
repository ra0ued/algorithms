<?php

class TagStripper
{
    private string $string = '[НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА][НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА][НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА]';

    public function stripTags(string $string): array
    {
        return $this->pregGrepKeys($string);
    }

    public function doIt(): array
    {
        return $this->stripTags($this->string);
    }

     private function pregGrepKeys($input): array
     {
         return array_intersect_key($input, array_flip(preg_grep('/^(\d+)?\.\d+$/', array_keys($input), 0)));
    }
}

$tagStripper = new TagStripper();

print json_encode($tagStripper->doIt()) . PHP_EOL;