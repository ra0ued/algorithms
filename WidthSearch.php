<?php

class WidthSearch
{
    public function search(string $name): bool
    {
        $graph = $this->getGraph();
        $searchQueue = new SplQueue();
        $searchQueue->push($graph[$name]);
        $searched = [];

        while (!$searchQueue->isEmpty()) {
            $person = $searchQueue->pop();

            if (!in_array($person, $searched)) {
                if ($this->personIsSeller($person)) {
                    print $person . ' is a mango seller!';

                    return true;
                }

                $searchQueue->push($graph[$person]);
                $searched[] = $person;
            }
        }

        return false;
    }

    private function personIsSeller( $person): bool
    {
        return false;
    }

    private function getGraph(): array
    {
        $graph = [
            'you' => [
                'alice',
                'bob',
                'claire'
            ],
            'anuj' => [],
            'peggy' => [],
            'thom' => [],
            'jonny' => []
        ];

        $graph['bob'] = [
            'anuj',
            'peggy'
        ];

        $graph['alice'] = [
            'peggy'
        ];

        $graph['claire'] = [
            'thom',
            'jonny'
        ];

        return $graph;
    }
}

$search = new WidthSearch();

$search->search('you');