<?php

use Felds\SizeStrToBytes\Exception\BadFormat;
use Felds\SizeStrToBytes\SizeStrToBytes;
use PHPUnit\Framework\TestCase;

class SizeStrToBytesTest extends TestCase
{
    /**
     * @dataProvider getNaked
     */
    public function testNakedBytes($str, $bytes)
    {
        $this->assertSame($bytes, SizeStrToBytes::convert($str));
    }

    /**
     * @dataProvider getUnits
     */
    function testUnits($str, $bytes)
    {
        $this->assertEquals($bytes, SizeStrToBytes::convert($str));
    }

    function testBadFormat2() {
        $this->expectException(BadFormat::class);
        SizeStrToBytes::convert("");
    }

    function testBadFormat() {
        $this->expectException(BadFormat::class);
        SizeStrToBytes::convert("12X");
    }

    public function getNaked()
    {
        return [
            ['0', 0],
            ['1234', 1234],
        ];
    }

    public function getUnits()
    {
        return [
            ['0k', 0],
            ['1k', 1024],
            ['1K', 1024],
            ['2k', 2 * 1024],
            ['1000K', 1000 * 1024],
            ['29834k', 29834 * 1024],
            ['0M', 0],
            ['1M', 1024 * 1024],
            ['1000M', 1000 * 1024 ** 2],
            ['34985M', 34985 * 1024 ** 2],
            ['54G', 54 * 1024 ** 3],
            ['987T', 987 * 1024 ** 4],
            ['12P', 12 * 1024 ** 5],
            ['1E', 1 * 1024 ** 6],
        ];
    }

    public function getBadFormats() {
        return [
            'ABC',
            'K',
            '0X',
            '-123',
            '',
        ];
    }
}
