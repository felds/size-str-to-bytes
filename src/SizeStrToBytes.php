<?php
declare(strict_types=1);

namespace Felds\SizeStrToBytes;

use Felds\SizeStrToBytes\Exception\BadFormat;
use Felds\SizeStrToBytes\Exception\BadUnit;
use Felds\SizeStrToBytes\Exception\NegativeBase;

class SizeStrToBytes
{
    /**
     * Converts a measurement in units of information to its equivalent in bytes,
     * according to https://en.wikipedia.org/wiki/Units_of_information
     *
     * Known issues:
     *     - It doesn't convert zettabytes and yottabytes since the resulting number would exceed PHP_INT_MAX
     *
     * @param string $str The size to be converted.
     * @return int The size in bytes.
     * @throws BadFormat When the format can't be parsed.
     */
    public static function convert(string $str): int
    {
        $unitMultiplyers = [
            'k' => 1,
            'K' => 1,
            'M' => 2,
            'G' => 3,
            'T' => 4,
            'P' => 5,
            'E' => 6,
        ];

        preg_match('{^(?<base>\d+)(?<unit>[kKMGTPE]?)$}', trim($str), $matches);
        if (!$matches) {
            throw new BadFormat($str);
        }

        $base = intval($matches['base']);

        $unit = $matches['unit'];
        if ($unit) {
            return $base * 1024 ** $unitMultiplyers[$unit];
        }

        return $base;
    }
}