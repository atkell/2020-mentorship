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
    private $salesTax = 0.07;
    public $weight = 0.0;
    public $unitCost = 0.0;
    private $subTotal = 0.0;
    private $grandTotal = 0.0;
    
    public function takeCustomerOrder()
    {
        $this->askUserForCoffeeWeight();
        $this->askUserForCoffeeUnitCost();
        $this->printReceipt();
    }
    
    public function askUserForCoffeeWeight()
    {
        echo "Hello! How many pounds of coffee would you like to purchase today? ";
        $userInputCoffeeWeight = floatval(fgets(STDIN));
        $this->setCoffeeWeight($userInputCoffeeWeight);
    }
    
    public function askUserForCoffeeUnitCost()
    {
        echo "What's the cost per pound of those sweet, sweet beans? ";
        $userInputCoffeeUnitCost = floatval(fgets(STDIN));
        $this->setCoffeeUnitCost($userInputCoffeeUnitCost);
    }

    public function setSalesTax($salesTax)
    {
        $salesTax = $salesTax + 1;
        $this->salesTax = $salesTax;
    }
    
    public function setCoffeeWeight($weight)
    {
        if ($weight <= 0.0) {
            echo "\nUh oh! Our coffee beans aren't gravity defying...yet.\nTry again with a value greater than 0.\n\n";
            $this->askUserForCoffeeWeight();
        }
        $this->weight = $weight;
    }

    public function setCoffeeUnitCost($unitCost)
    {
        if ($unitCost <= 0.0) {
            echo "\nUh oh! Coffee unit cost must be a number and greater than 0.0\n";
            $this->askUserForCoffeeUnitCost();
        }
        $this->unitCost = $unitCost;
    }
    
    public function setSubTotal()
    {
        $this->subTotal = $this->getWeight() * $this->getUnitCost();
    }

    public function setGrandTotal()
    {
        $this->grandTotal = round($this->weight * $this->unitCost * ($this->getSalesTax() + 1.0), 2);
    }

    public function getSalesTax()
    {
        return $this->salesTax;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getUnitCost()
    {
        return $this->unitCost;
    }
    
    public function getSubTotal()
    {
        return $this->getWeight() * $this->getUnitCost();
    }
    
    public function getGrandTotal()
    {
        return $this->getSubTotal() * $this->getSalesTax();
    }

    public function printReceipt()
    {
        echo "\n\n----\n";
        echo "Thank you for shopping with us!";
        echo "\n----\n";
        echo "Weight (lbs.):           " . $this->getWeight() . "\n";
        echo "Unit Cost (per lbs.):    " . $this->getUnitCost() . "\n";
        echo "\n----\n";
        echo "Sub-total:               $" . $this->getSubTotal() . "\n";
        echo "Grand total (w/ tax):    $" . $this->getGrandTotal() . "\n";
        echo "Sales tax:               " . $this->getSalesTax() . "%\n";
        echo "----\n";
    }
}


$purchase = new Coffee();
$purchase->takeCustomerOrder();
