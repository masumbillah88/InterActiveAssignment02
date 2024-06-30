<?php
class FinanceManager{
    public $incomes= [];
    public $expenditures = [];
    public $categories = [];
    public $incomeFile = 'incomes.json';
    public $expenditureFile = 'expense.json';
    public $categoryFile = 'category.json';

    public function __construct(){
        $this->loadData();
    }
    public function addCategory($name){
        $category = new Category($name);
        $this->categories[] = $category;
        $this->saveData();
    }
    public function addTransaction($amount,$category, $type){
        $transaction = new Transactions($amount, $category, $type);
        if($type == 'income'){
            $this->incomes[] = $transaction;
        }else{
            $this->expenditures[] = $transaction;
        }
        $this->saveData();
    }
    public function viewTransaction($type){
        return $type == 'income'?$this->incomes : $this->expenditures;
    }
    public function viewCategories(){
        return $this->categories;
    }
    public function calculateSavings(){
        $totalIncomes = array_reduce($this->incomes, fn($sum, $income)=>$sum + $income->amount, 0);
        $totalExpenses = array_reduce($this->expenditures, fn($sum, $expenditure)=>$sum + $expenditure->amount, 0);
        return $totalIncomes - $totalExpenses;
    }
    private function loadData(){
        if(file_exists($this->incomeFile)){
            $this->incomes = json_decode(file_get_contents($this->incomeFile))??[];
        }
        if(file_exists($this->expenditureFile)){
            $this->expenditures = json_decode(file_get_contents($this->expenditureFile))??[];
        }
        if(file_exists($this->categoryFile)){
            $this->categories = json_decode(file_get_contents($this->categoryFile))??[];
        }
    }
    private function saveData(){
        file_put_contents($this->incomeFile, json_encode($this->incomes));
        file_put_contents($this->expenditureFile, json_encode($this->expenditures));
        file_put_contents($this->categoryFile, json_encode($this->categories));
    }
}