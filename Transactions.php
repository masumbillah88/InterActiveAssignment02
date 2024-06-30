<?php
class Transactions{
    public $amount;
    public $category;
    public $type;

    public function __construct($amount, $category,$type){
        $this->amount = $amount;
        $this->category = $category;
        $this->type = $type;
    }
}