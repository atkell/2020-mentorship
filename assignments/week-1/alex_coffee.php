<?php

//global $salesTax = 1.07;

echo "Let's calculate the cost of your coffee purchase!\n";

function inputValidation ($input)
{
    if ($input > 0.0) {
//        echo "Valid input!";
    } else {
        echo "Invalid input! Let\'s try again, shall we? ";
        getInputs();
    }
}

# input validation:
# what makes it valid?
# 1) integer => is_numeric — Finds whether a variable is a number or a numeric string. Tip: this will also handle empty
# 2) greater than 0.0 => $input > 0
# 3) not empty => $input != ""
# if input is not valid, let the user know and allow them to try again. we should make this
# a function too...

//if ($input != "" || $input > 0 || is_numeric($input) ) {
//    echo "Error";
//} else {
//    proceed to next step
//}

# Prompting for input in this way will result in a string. We need to cast the input as an integer. If the input is
# non-numeric or a mix of numeric and alphanumeric, the var_dump() will result in a int == 0, which is great!
# There's a bug though, that if the number isn't a whole number (like an integer), it wont work. So let's try floatval()
# instead...

echo "Tell me how many pounds of coffee you want to buy? ";
$weight = floatval(fgets(STDIN));
inputValidation($weight);

echo "\nTell me the cost per pound of this coffee? ";
$unitCost = floatval(fgets(STDIN));
inputValidation($unitCost);

$salesTax = 1.07;
$subTotal = $weight * $unitCost;
$grandTotal = $subTotal * $salesTax;
printReceipt($weight, $unitCost, $subTotal, $grandTotal);

function printReceipt($weight, $unitCost, $subTotal, $grandTotal)
{
    echo "\n\n----\n";
    echo "Thank you for shopping with us!";
    echo "\n----\n";
    echo "Weight (lbs.):           " . $weight . "\n";
    echo "Unit Cost (per lbs.):    " . $unitCost;
    echo "\n----\n";
    echo "Sub-total:               $" . round($subTotal, 2) . "\n";
    echo "Grand total (w/ tax):    $" . round($grandTotal, 2) . "\n";
    echo "Sales tax:               7.0%\n";
    echo "----\n";
}
