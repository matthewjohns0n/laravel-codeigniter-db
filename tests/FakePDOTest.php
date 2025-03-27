<?php

namespace Illuminate\CodeIgniter;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class FakePDOTest extends TestCase
{
    public function testConstants()
    {
        $this->assertSame(2, FakePDO::FETCH_ASSOC);
        $this->assertSame(5, FakePDO::FETCH_OBJ);
    }
}
