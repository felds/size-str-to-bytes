<?php
declare(strict_types=1);

namespace Felds\SizeStrToBytes\Exception;

class BadFormat extends \InvalidArgumentException
{
    public function __construct(string $str)
    {
        parent::__construct("Bad format: {$str}");
    }
}