<?php

namespace Entity;

use DateTimeInterface;

final class Euromillion
{
    /** @var DateTimeInterface */
    private $date;

    /** @var int[] */
    private $numbers;

    /** @var int[] */
    private $stars;

    /** @var string */
    private $myMillion;

    /**
     * Euromillion constructor.
     * @param DateTimeInterface $date
     * @param int[] $numbers
     * @param int[] $stars
     * @param string $myMillion
     */
    public function __construct(DateTimeInterface $date, array $numbers, array $stars, $myMillion)
    {
        $this->date = $date;
        $this->numbers = $numbers;
        $this->stars = $stars;
        $this->myMillion = $myMillion;
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
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @return string
     */
    public function getMyMillion()
    {
        return $this->myMillion;
    }
}
