<?php

/**
 * Class Elf
 */
class Elf
{
    /**
     * @var int $address
     */
    private int $address = 0;

    /**
     * @var array $intCode
     */
    private array $intCode;

    /**
     * Elf constructor.
     * @param string $intCode
     */
    public function __construct(string $intCode)
    {
        $this->intCode = array_map('intval', explode(',', $intCode));
    }

    public function handle(): void
    {
        while ($this->address < $this->getCodeLength()) {
            $this->calculate($this->read());

            $this->address += 4;
        }
    }

    /**
     * @param int $opcode
     */
    public function calculate(int $opcode): void
    {
        switch ($opcode) {
            case 1:
                $this->write($this->read($this->readWithOffset(1)) + $this->read($this->readWithOffset(2)), $this->readWithOffset(3));
                break;
            case 2:
                $this->write($this->read($this->readWithOffset(1)) * $this->read($this->readWithOffset(2)), $this->readWithOffset(3));
                break;
            case 99;
                $this->address = $this->getCodeLength();
                break;
        }
    }

    /**
     * @return int
     */
    public function getAddress(): int
    {
        return $this->address;
    }

    /**
     * @param int $address
     * @return Elf
     */
    public function setAddress(int $address): Elf
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return array
     */
    public function getIntCode(): array
    {
        return $this->intCode;
    }

    /**
     * @return int
     */
    public function getCodeLength(): int
    {
        return count($this->intCode);
    }

    /**
     * @param int|null $position
     * @return int
     */
    public function read(int $position = null): int
    {
        if (is_null($position)) {
            $position = $this->address;
        }

        return $this->intCode[$position];
    }

    /**
     * @param int $offset
     * @return int
     */
    public function readWithOffset(int $offset = 0): int
    {
        return $this->intCode[$this->address + $offset];
    }

    /**
     * @param int $value
     * @param null $address
     */
    public function write(int $value, $address = null): void
    {
        if (is_null($address)) {
            $address = $this->address;
        }

        $this->intCode[$address] = $value;
    }
}

/**
 * Part 1
 */
$input = file_get_contents('./puzzle_input.txt');
$elf = new Elf($input);
$elf->write(12, 1);
$elf->write(2, 2);
$elf->handle();
echo 'Part 1: ' . $elf->getIntCode()[0] . PHP_EOL;


/**
 * Part 2
 */
for ($noun = 0; $noun <= 99; $noun++) {
    for ($verb = 0; $verb <= 99; $verb++) {
        $elf = new Elf($input);
        $elf->write($noun, 1);
        $elf->write($verb, 2);
        $elf->handle();

        if ($elf->getIntCode()[0] === 19690720) {
            echo 'Part 2: ' . (100 * $noun + $verb) . PHP_EOL;
        }
    }
}