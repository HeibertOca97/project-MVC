<?php namespace app\exceptions;

class DatabaseException extends \Exception{
    protected $sql;    

    public function __construct($message, $sql = "", $code = 0, \Exception $previous = null){
        $this->sql = $sql;
        parent::__construct($message, $code, $previous);
    }

    public function getSql(): string{
        return $this->sql;
    }

    public function __toString(): string {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n SQLQuery: {$this->sql}";
    }    
}
