<?php

namespace WP\FuncPro\util;
use \Closure;
use Exception;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Hook
{   
    private string $type;
    private string $hookname;
    private Closure $callback;
    private int $priority = 10;
    private int $args = 1;
    private string $id = '';
    private string $description = '';

    public function __construct(string $type){
        $this->type = $type;
    }    
    /**
     * setHookName
     *
     * @param  string $hookname
     * @return self
     */
    public function setHookName(string $hookname){
        $this->hookname = $hookname;
        return $this;
    }    
    /**
     * setCallback
     *
     * @param  Closure $callback
     * @return self
     */
    public function setCallback(Closure $callback){
      $this->callback = $callback;
      return $this;
    }    
    /**
     * setPriority
     *
     * @param  int $priority
     * @return self
     */
    public function setPriority(int $priority = 10){
        $this->priority = $priority;
        return $this;
    }    
    /**
     * setQtdArgs
     *
     * @param  int $args
     * @return self
     */
    public function setQtdArgs(int $args = 1){
        $this->setQtdArgs = $args;
        return $this;
    }      
    /**
     * setDescription
     *
     * @param  mixed $description
     * @return self
     */
    public function setDescription(string $description){
        $this->description = $description;
        return $this;
    }      
    /**
     * setId
     *
     * @param string $id
     * @return self
     */
    public function setId(string $id){
        $this->id= $id;
        return $this;
    }
    /**
     * build
     *
     * @return self
     */
    public function build(){
        if ( $this->id === '' ){
            throw new Exception("Id do Hook {$this->hookname} não pode ser vazio");
        }
        return $this;
    }    
    /**
     * Invoke hook
     *
     * @return void
     */
    public function __invoke(){
        $start = $this->type;
        $start(
            $this->hookname,
            $this->callback,
            $this->priority,
            $this->args
        );
    }
    public function getData(){
        return array(
            'id' => $this->id,
            'description' => $this->description
        );
    }
}