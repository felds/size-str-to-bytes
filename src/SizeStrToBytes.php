<?php
declare(strict_types=1);

namespace Felds\SizeStrToBytes;

class SizeStrToBytes
{
    public static function convert(string $str): int
    {
        return intval($str);
    }
}