<?php

# Input validation:
# what makes it valid?
# 1) integer => is_numeric — Finds whether a variable is a number or a numeric string. Tip: this will also handle empty
# 2) greater than 0.0 => $input > 0
# 3) not empty => $input != ""
# if input is not valid, let the user know and allow them to try again. we should make this
# a function too...

# Prompting for input in this way will result in a string. We need to cast the input as an integer. If the input is
# non-numeric or a mix of numeric and alphanumeric, the var_dump() will result in a int == 0, which is great!
# There's a bug though, that if the number isn't a whole number (like an integer), it wont work.
# So let's try floatval() instead...

class Coffee
{
    public $salesTax = 0.07;
    public $weight = 0.0;
    public $unitCost = 0.0;

    public function askUserForOrderDetails()
    {
        $this->askUserForCoffeeWeight();
        $this->askUserForCoffeeUnitCost();
    }

    public function askUserForCoffeeWeight()
    {
        echo "Tell me how many pounds of coffee you want to buy? ";
        $userInputCoffeeWeight = floatval(fgets(STDIN));
        if ($userInputCoffeeWeight <= 0.0) {
//            throw new Exception('Weight must be a number greater than 0!');
            echo "\nUh oh! Coffee weight must be a number and greater than 0.0\n";
            $this->askUserForCoffeeWeight();
        }
        $this->setCoffeeWeight($userInputCoffeeWeight);
    }

    public function setCoffeeWeight($weight)
    {
        $this->weight = $weight;
    }

    public function askUserForCoffeeUnitCost()
    {
        echo "Tell me how many pounds of coffee you want to buy? ";
        $userInputCoffeeUnitCost = floatval(fgets(STDIN));
        if ($userInputCoffeeUnitCost <= 0.0) {
//            throw new Exception('Unit cost must be a number greater than 0!');
            echo "\nUh oh! Coffee unit cost must be a number and greater than 0.0\n";
            $this->askUserForCoffeeUnitCost();
        }
        $this->setCoffeeUnitCost($userInputCoffeeUnitCost);
    }


    public function setCoffeeUnitCost($unitCost)
    {
        $this->unitCost = $unitCost;
    }

//    public function validateInput($input)
//    {
//        if ($input <= 0.0) {
//            echo "I'm sorry, but {$input} is not a valid input.";
////            die();
//            $this->getOrderDetails();
//        }
//    }


    public function printReceipt()
    {
        echo "\n\n----\n";
        echo "Thank you for shopping with us!";
        echo "\n----\n";
        echo "Weight (lbs.):           " . $this->weight . "\n";
        echo "Unit Cost (per lbs.):    " . $this->unitCost;
        echo "\n----\n";
        echo "Sub-total:               $" . round($this->weight * $this->unitCost, 2) . "\n";
        echo "Grand total (w/ tax):    $" . round($this->weight * $this->unitCost * ($this->salesTax + 1.0), 2) . "\n";
        echo "Sales tax:               7.0%\n";
        echo "----\n";
    }
}


$purchase = new Coffee();
$purchase->askUserForOrderDetails();
$purchase->printReceipt();
