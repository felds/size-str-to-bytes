<?php

use PHPUnit\Framework\TestCase;
use Felds\SizeStrToBytes\SizeStrToBytes;

class SizeStrToBytesTest extends TestCase
{

    /**
     * @dataProvider getNaked
     */
    public function test_naked_bytes($str, $bytes)
    {
        $this->assertSame($bytes, SizeStrToBytes::convert($str));
    }

    /**
     * @dataProvider getKilobytes
     */
    function testKilobytes($str, $bytes) {
        self::markTestSkipped();
        // $this->assertEquals($bytes, SizeStrToBytes::convert($str));
    }

    public function getKilobytes()
    {
        return [
            ['0k', 0],
            ['1k', 1024],
            ['1K', 1024],
            ['2k', 2 * 1024],
            ['1000K', 1000 * 1024],
            ['29834k', 29834 * 1024],
        ];
    }

    public function getNaked()
    {
        return [
            ['0', 0],
            ['1234', 1234],
        ];
    }
}
