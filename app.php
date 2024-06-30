<?php

require 'category.php';
require 'Transactions.php';
require 'FinanceManager.php';
require 'Console.php';

$manager = new FinanceManager();

 function printMenu(){
    echo "\n";
    echo Console::BOLD.Console::GREEN."Welcome to personal finance manager:".Console::RESET."\n"; 
    echo Console::BOLD.Console::RED.str_repeat("=", 40).Console::RESET.PHP_EOL;
    echo Console::BOLD.Console::CYAN."Please choose an option from the list: \n".Console::RESET;
    echo Console::BOLD.Console::RED.str_repeat("=", 40).Console::RESET.PHP_EOL;
    echo "\n1. Add Income \n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "2. Add Expense \n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "3. View Incomes \n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "4. View Expenses\n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "5. View Savings \n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "6. Add Category \n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "7. View Category \n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "0. Exit \n";
    echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
    echo "Enter your option :\n";
    echo Console::BOLD.Console::RED.str_repeat("=", 40).Console::RESET.PHP_EOL;
}

while(true){
    printMenu();
    
    $option = trim(fgets(STDIN));

    switch($option){
        case '1':
            echo "Enter income amount ";
            $amount = trim(fgets(STDIN));
            echo "Enter category ";
            $category = trim(fgets(STDIN));
            $manager->addTransaction($amount, $category, 'income');
            break;
        
        case '2' :
            echo "Enter expense amount : ";
            $amount = trim(fgets(STDIN));
            echo "Enter category \n";
            $category = trim(fgets(STDIN));
            $manager->addTransaction($amount, $category, 'expenditure');
            break;

        case '3' :
            $incomes = $manager->viewTransaction('income');
            echo "\n Incomes: \n";
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            foreach($incomes as $income){
                echo "Amount: {$income->amount}, Category: {$income->category} \n";
            }
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            break;
        
        case '4' :
            $expenditures = $manager->viewTransaction('expenditures');
            
            echo "\n Expenses : \n";
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            foreach($expenditures as $expense){
                echo "Amount : {$expense->amount}, Category: {$expense->category} \n";
            }
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            break;
        
        case '5':
            $savings = $manager->calculateSavings();
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            echo "Savings : {$savings} \n";
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            break;
        
        case '6':
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            echo "Enter category name: \n";
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            $categoryName = trim(fgets(STDIN));
            $manager->addCategory($categoryName);
            break;

        case '7' :
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            $categories = $manager->viewCategories();
            echo "Category : \n";
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            foreach($categories as $category){
                echo "{$category->name} \n";
            }
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            
            break;

        case '0' :
            echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
            echo "Exiting application \n";
            exit;
        
        default :
        echo Console::BOLD.Console::GREEN.str_repeat("=",40).Console::RESET.PHP_EOL;
        echo "Invalid input given. Please try again \n";
        echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
        echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;
        echo Console::BOLD.Console::RED.str_repeat("=",40).Console::RESET.PHP_EOL;

        break;
    }

}