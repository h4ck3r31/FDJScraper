<?php

namespace Entity;

use DateTimeInterface;

final class Loto
{
    /** @var DateTimeInterface */
    private $date;

    /** @var int[] */
    private $numbers;

    /** @var int[] */
    private $luckyNumbers;

    /** @var string */
    private $jocker;

    /**
     * Loto constructor.
     * @param DateTimeInterface $date
     * @param int[] $numbers
     * @param int[] $luckyNumbers
     * @param string $jocker
     */
    public function __construct(DateTimeInterface $date, array $numbers, array $luckyNumbers, $jocker)
    {
        $this->date = $date;
        $this->numbers = $numbers;
        $this->luckyNumbers = $luckyNumbers;
        $this->jocker = $jocker;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return int[]
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * @return int[]
     */
    public function getLuckyNumbers()
    {
        return $this->luckyNumbers;
    }

    /**
     * @return string
     */
    public function getJocker()
    {
        return $this->jocker;
    }
}
