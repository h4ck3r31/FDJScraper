<?php

namespace Provider;

require_once __DIR__ . '/Entity/Euromillion.php';

use DateTime;
use DateTimeInterface;
use Entity\Euromillion;
use RuntimeException;

class EuroMillionProvider
{
    const URL = "https://www.fdj.fr/jeux/jeux-de-tirage/euromillions/resultats";

    /**
     * @return \Entity\Euromillion
     */
    public function getData()
    {
        $source = $this->getSource();
        if (null === $source) {
            throw new RuntimeException(sprintf("Unable to get content from %s", self::URL));
        }

        $date = $this->parseDate($source);
        if (null === $date) {
            throw new RuntimeException("Unable to parse date");
        }

        $numbers = $this->parseNumbers($source);
        if (null === $numbers) {
            throw new RuntimeException("Unable to parse numbers");
        }

        $stars = $this->parseStars($source);
        if (null === $stars) {
            throw new RuntimeException("Unable to parse stars");
        }

        $myMillion = $this->parseMyMillion($source);
        if (null === $myMillion) {
            throw new RuntimeException("Unable to parse MyMillion number");
        }

        return new Euromillion(
            $date,
            $numbers,
            $stars,
            $myMillion
        );
    }

    /**
     * @return string|null
     */
    private function getSource()
    {
        $source = @file_get_contents(self::URL);
        return $source ?: null;
    }

    /**
     * @param string $source
     * @return int[]|null
     */
    private function parseNumbers($source)
    {
        $numbers = [];
        $tmp = explode('<ul class="result-full__list">', $source);
        if (count($tmp) < 2) {
            return null;
        }

        $tmp = explode('</ul>', $tmp[1]);
        if (count($tmp) < 2) {
            return null;
        }

        $tmp2 = explode('<span class="game-ball">', $tmp[0]);
        if (count($tmp2) < 2) {
            return null;
        }

        for ($i = 1; $i < count($tmp2); $i++) {
            $tmp3 = explode("</span>", $tmp2[$i]);
            if (count($tmp3) < 2) {
                return null;
            }

            $numbers[] = (int)$tmp3[0];
        }
        return $numbers;
    }

    /**
     * @param string $source
     * @return int[]|null
     */
    private function parseStars($source)
    {
        $numbers = [];
        $tmp = explode('<ul class="result-full__list">', $source);
        if (count($tmp) < 2) {
            return null;
        }
        $tmp = explode('</ul>', $tmp[1]);
        if (count($tmp) < 2) {
            return null;
        }

        $tmp = explode('<span class="game-ball is-special has-bgstar">', $tmp[0]);
        if (count($tmp) < 2) {
            return null;
        }

        for ($i = 1; $i < count($tmp); $i++) {
            $tmp2 = explode("</span>", $tmp[$i]);
            if (count($tmp2) < 2) {
                return null;
            }
            $luckyNumbers[] = (int)$tmp2[0];
        }
        return $luckyNumbers;
    }

    /**
     * @param string $source
     * @retrun string|null
     */
    private function parseMyMillion($source)
    {
        $tmp = explode('<span class="result-full__bonus-code">', $source);
        if (count($tmp) < 2) {
            return null;
        }

        $tmp = explode("</span>", $tmp[1]);
        if (count($tmp) < 2) {
            return null;
        }

        $jocker = $tmp[0];
        return $jocker;
    }

    /**
     * @param string $source
     * @return DateTimeInterface|null
     */
    private function parseDate($source)
    {
        $tmp = explode("resultats::datepicker", $source);
        if (count($tmp) < 2) {
            return null;
        }
        $tmp = explode("<span>", $tmp[1]);
        if (count($tmp) < 2) {
            return null;
        }
        $tmp = explode("</span>", $tmp[1]);
        if (count($tmp) < 2) {
            return null;
        }

        $date = $tmp[0];
        $dateExploded = explode('/', $date);

        $dateTime = new DateTime(sprintf('%s-%s-%s', $dateExploded[2], $dateExploded[1], $dateExploded[0]));
        return $dateTime;
    }
}
