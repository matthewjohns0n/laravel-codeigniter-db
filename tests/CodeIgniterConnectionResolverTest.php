<?php

namespace Illuminate\CodeIgniter;

use Mockery as m;
use PHPUnit\Framework\TestCase;

class CodeIgniterConnectionResolverTest extends TestCase
{
    protected $ci;
    protected $resolver;

    protected function setUp(): void
    {
        $this->ci = m::mock('ci');
        $this->ci->db = m::mock('ci_db');
        $this->ci->db->dbprefix = 'zzz_';
        $this->ci->db->dbdriver = 'mysql';

        $this->resolver = new CodeIgniterConnectionResolver($this->ci);
    }

    public function testConnection()
    {
        $connection = $this->resolver->connection();

        $this->assertInstanceOf('\Illuminate\CodeIgniter\CodeIgniterConnection', $connection);
    }
}
