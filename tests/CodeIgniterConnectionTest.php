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

    public function testGetSchemaBuilder()
    {
        $builder = $this->connection->getSchemaBuilder();
        $this->assertInstanceOf(SchemaBuilder::class, $builder);
    }

    public function testGetName()
    {
        $this->assertSame('codeigniter', $this->connection->getName());
    }

    public function testGetConfig()
    {
        $this->assertNull($this->connection->getConfig('some_option'));
        $this->assertSame([], $this->connection->getConfig());
    }

    public function testInsertId()
    {
        $this->ci->db->shouldReceive('insert_id')->once()->andReturn(123);
        $this->assertSame(123, $this->connection->insert_id());
    }

    public function testLastInsertId()
    {
        $this->ci->db->shouldReceive('insert_id')->once()->andReturn(456);
        $this->assertSame(456, $this->connection->lastInsertId());
    }

    public function testReconnectIfMissingConnection()
    {
        $result = $this->connection->reconnectIfMissingConnection();
        $this->assertNull($result);
    }

    public function testGetPdo()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('PDO is not supported by CodeIgniter database driver');
        $this->connection->getPdo();
    }
}
