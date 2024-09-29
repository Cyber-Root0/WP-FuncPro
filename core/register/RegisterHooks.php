<?php
namespace WP\FuncPro\register;
use WP\FuncPro\util\Type;
use WP\FuncPro\util\Hook;
use \Closure;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class RegisterHooks
{
    private static $instance = null;
    private static $hooks = [];
    private function __construct(){
        
    }    
    /**
     * getInstance
     *
     * @return RegisterHooks
     */
    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }    
    /**
     * add hook in collection
     *
     * @param string $type
     * @param string $hookname
     * @param Closure $function
     * @param int $priority
     * @param int $args
     * @return void
     */
    public static function set(Hook $hook){
        self::$hooks[] = $hook;
    }
    /**
     * rules
     *
     * @param string $type
     * @return bool
     */
    private function rules(string $type){
        return $type == Type::ACTION || $type == Type::FILTER;  
    }    
    /**
     * get all hooks
     *
     * @return array
     */
    public function getHooks(){
        return self::$hooks;
    }
}