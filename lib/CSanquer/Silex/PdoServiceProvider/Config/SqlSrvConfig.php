<?php

namespace CSanquer\Silex\PdoServiceProvider\Config;

/**
 * SqlSrvConfig
 *
 * @author Charles Sanquer <charles.sanquer@gmail.com>
 */
class SqlSrvConfig extends PdoConfig
{
    protected $driver = 'sqlsrv';
    
    protected $required = array(
        'host',
        'port',
        'dbname',
        'user',
        'password',
    );
    
    protected $defaults = array(
        'host' => 'localhost',
        'port' => 1433,
        'MultipleActiveResultSets' => null,
    );
    
    protected $allowedTypes = array(
        'host' => array('string', 'null'),
        'port' => array('integer', 'null'),
        'dbname' => array('string'),
        'user' => array('string'),
        'password' => array('string', 'null'),
        'MultipleActiveResultSets' => array('boolean', 'null'),
    ); 
    
    protected function resolve(array $params)
    {
        $params = parent::resolve($params);
        
        $params['server'] = $params['host'];
        unset($params['host']);
        
        if (is_null($params['MultipleActiveResultSets'])) {
            unset($params['MultipleActiveResultSets']);
        }
        
        return $params;
    }
}