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

    /** @var string */
    private $winnerTable;

    /**
     * Loto constructor.
     * @param DateTimeInterface $date
     * @param int[] $numbers
     * @param int[] $luckyNumbers
     * @param string $jocker
     * @param string $winnerTable
     */
    public function __construct(DateTimeInterface $date, array $numbers, array $luckyNumbers, $jocker, $winnerTable)
    {
        $this->date = $date;
        $this->numbers = $numbers;
        $this->luckyNumbers = $luckyNumbers;
        $this->jocker = $jocker;
        $this->winnerTable = $winnerTable;
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

    /**
     * @return string
     */
    public function getWinnerTable()
    {
        return $this->winnerTable;
    }
}
