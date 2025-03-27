<?php

namespace Illuminate\CodeIgniter;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Illuminate\Database\Schema\Builder as SchemaBuilder;

class CodeIgniterConnectionTest extends TestCase
{
    protected $ci;
    protected $connection;

    protected function setUp(): void
    {
        $this->ci = m::mock('ci');
        $this->ci->db = m::mock('ci_db');
        $this->ci->db->dbprefix = 'zzz_';
        $this->ci->db->dbdriver = 'mysql';

        $this->connection = new CodeIgniterConnection($this->ci);
    }

    public function testConstruct()
    {
        $this->assertSame('zzz_', $this->connection->getTablePrefix());
    }
}
