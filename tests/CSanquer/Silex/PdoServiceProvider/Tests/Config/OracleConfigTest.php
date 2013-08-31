<?php

namespace CSanquer\Silex\PdoServiceProvider\Tests\Config;

use CSanquer\Silex\PdoServiceProvider\Config\OracleConfig;
use CSanquer\Silex\PdoServiceProvider\Config\PdoConfig;

/**
 * TestCase for OracleConfig
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 *
 */
class OracleConfigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PdoConfig
     */
    protected $pdoConfig;

    public function setUp()
    {
        $this->pdoConfig = new OracleConfig();
    }

    /**
     * @dataProvider dataProviderPrepareParameters
     */
    public function testPrepareParameters($params, $expected)
    {
        $result = $this->pdoConfig->prepareParameters($params);
        $this->assertEquals($expected, $result);
    }
    
    public function dataProviderPrepareParameters()
    {
        return array(
            array(
                array(
                    'dbname' => 'fake-db',
                    'user' => 'fake-user',
                    'password' => 'fake-password',
                ),
                array(
                    'dsn' => 'oci:dbname=(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)))(CONNECT_DATA=(SID=fake-db)))',
                    'user' => 'fake-user',
                    'password' => 'fake-password',
                ),
            ),
            array(
                array(
                    'host' => '127.0.0.1',
                    'port' => null,
                    'dbname' => 'fake-db',
                    'user' => 'fake-user',
                    'password' => 'fake-password',
                ),
                array(
                    'dsn' => 'oci:dbname=(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=127.0.0.1)(PORT=1521)))(CONNECT_DATA=(SID=fake-db)))',
                    'user' => 'fake-user',
                    'password' => 'fake-password',
                ),
            ),
        );
    }
}