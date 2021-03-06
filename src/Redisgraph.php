<?php
namespace RedisGraphPhp;

use RedisGraphPhp\{Client, Cypher, Result};

class RedisGraph
{
    /**
     *
     * @var type RedisGraphPhp\Client
     */
    private static $client;
    /**
     *
     * @var type RedisGraph
     */
    private static $instance = null;
    
    /**
     *
     * @var type 
     */
    private static $options = [];
    
    /**
     * 
     * @param Cypher $cypher
     * @return Result
     */
    final public static function run(Cypher $cypher): Result
    {
        self::getInstance();
        
        return self::$client->run($cypher);
    }
    
    /**
     * 
     * @param Cypher $cypher
     * @return array
     */
    final public static function explain(Cypher $cypher): array
    {
        self::getInstance();
        
        return self::$client->explain($cypher);
    }
    
    /**
     * 
     * @param string $graph
     * @return array
     */
    final public static function delete(string $graph): array
    {
        self::getInstance();
        
        return self::$client->delete($string);
    }
    
    /**
     * 
     * @param array $options
     * @return void
     */
    final public static function setOptions(array $options): void
    {
        self::$options = $options;
        self::getInstance();
    }
    
    /**
     * 
     * @return void
     */
    final public static function resetClient(): void
    {
        self::$instance = null;
    }
    
    /**
     * 
     * @param string $graph
     * @return \App\Connectors\RedisGraph
     */
    final public static function graph(string $graph): RedisGraph
    {
        self::$client->setGraph($graph);
        
        return self::$instance;
    }
    
    /**
     * 
     * @return \App\Connectors\RedisGraph
     */
    final private static function getInstance(): RedisGraph
    {
        if (self::$instance == null)
        {
            self::$instance = new RedisGraph();
            self::$client = new Client(self::$options);
        }
 
        return self::$instance;
    }
}