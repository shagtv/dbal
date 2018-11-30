<?php
/**
 * @maintainer Timur Shagiakhmetov <shagtv@gmail.com>
 */

namespace unit\Shagtv\DBAL;

use Shagtv\DBAL\Client;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testSettersGetters()
    {
        /** @var \Doctrine\DBAL\Connection $ConnectionMock */
        $ConnectionMock = $this->getMockBuilder('\Doctrine\DBAL\Connection')
            ->disableOriginalConstructor()
            ->setMethods([])
            ->getMock();

        $test_connection_string = 'test_connection_string';

        $client = new Client('sqlite:///:memory:');

        $client
            ->setConnection($ConnectionMock)
            ->setConnectionString($test_connection_string);

        $Connection = $client->getConnection();
        $connection_string = $client->getConnectionString();

        self::assertSame($ConnectionMock, $Connection);
        self::assertSame($test_connection_string, $connection_string);
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testCreateTable()
    {
        $Profiler = new Client('sqlite:///:memory:');

        $result = $Profiler->createTable();

        static::assertTrue($result);
    }
}
