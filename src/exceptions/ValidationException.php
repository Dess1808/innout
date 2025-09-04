<?php

class ValidationException extends AppException {
    
    private $errors = [];
    
    public function __construct(
        $errors = [], 
        $message = 'Validation error', 
        $code = 0, 
        $priveous = null){
        parent::__construct($message, $code = 0, $priveous = null);
        $this->errors = $errors;
    }

    //get arrray
    public function getErrors(){
        return $this->errors;
    }

    //get only value from array
    public function getErrorsValue($value){
        return $this->errors[$value];
    }
}