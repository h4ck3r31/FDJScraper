<?php

namespace Provider;

require_once __DIR__ . '/Entity/Loto.php';

use DateTime;
use DateTimeInterface;
use RuntimeException;

class LotoProvider
{
    const URL = "https://www.fdj.fr/jeux/jeux-de-tirage/loto/resultats";

    /**
     * @return \Entity\Loto
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

        $luckyNumbers = $this->parseLuckyNumbers($source);
        if (null === $luckyNumbers) {
            throw new RuntimeException("Unable to parse lucky numbers");
        }

        $jocker = $this->parseJocker($source);
        if (null === $jocker) {
            throw new RuntimeException("Unable to parse jocker number");
        }

        return new \Entity\Loto(
            $date,
            $numbers,
            $luckyNumbers,
            $jocker
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
    private function parseLuckyNumbers($source)
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

        $tmp = explode('<span class="game-ball is-special">', $tmp[0]);
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
    private function parseJocker($source)
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
