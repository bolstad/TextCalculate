<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 2017-04-23
 * Time: 19:40
 */

namespace Bolstad\TextCalculate;

/**
 * Class FieldCalc
 * @package Bolstad\TextCalculate
 *
 * This class tokenize a string with simple math formulation and perform calculations
 * on each part and finally return the  result.
 *
 * It's based on the code by Stack Overflow user `clackk` http://stackoverflow.com/users/555222/clarkk published
 * at http://stackoverflow.com/questions/18880772/calculate-math-expression-from-a-string-using-eval/27077376#27077376
 *
 * It support:
 *
 *  - addition
 *  - subtraction
 *  - division
 *  - multiplication
 *
 * Please see `tests/FieldCalcTest.php` for example code
 *
 */

class FieldCalc
{

    const PATTERN = '/(?:\-?\d+(?:\.?\d+)?[\+\-\*\/])+\-?\d+(?:\.?\d+)?/';

    const PARENTHESIS_DEPTH = 10;

    public function calculate($input)
    {
        if (strpos($input, '+') != null ||
            strpos($input, '-') != null ||
            strpos($input, '/') != null ||
            strpos($input, '*') != null
        ) {
            // Replace , with .
            $input = str_replace(',', '.', $input);
            //  Remove white spaces and invalid math chars - and everything that isn't numbers
            $input = preg_replace('/[^0-9\.\+\-\*\/\(\)]/', '', $input);

            //  Calculate each of the parenthesis from the top
            $i = 0;

            // Repeat while we still have paranthesis in the $input string
            while (strpos($input, '(') || strpos($input, ')')) {

                // find the next paranthesis, fetch the content - send it to the callback and place it's return
                // into $input
                $input = preg_replace_callback('/\(([^\(\)]+)\)/', 'self::callback', $input);
                $i++;
                if ($i > self::PARENTHESIS_DEPTH) {
                    break;
                }
            }

            //  Now when we have a string without paranthesis left - calculate the result
            if (preg_match(self::PATTERN, $input, $match)) {
                return $this->compute($match[0]);
            }

            return 0;
        }

        return $input;
    }

    /**
     * Calculate $input and return the result
     *
     * @param $input
     * @return int
     */
    private function compute($input)
    {
        // Perform the calculation using a eval() - scary ^_^
        $compute = eval('return ' . $input . ';');
        return 0 + $compute;
    }

    /**
     * Evaluate $input - if it's not a a numeric value, perform a calculation on it and return the result
     * @param $input
     * @return int|string
     */
    private function callback($input)
    {
        if (is_numeric($input[1])) {
            return $input[1];
        } elseif (preg_match(self::PATTERN, $input[1], $match)) {
            return $this->compute($match[0]);
        }

        return 0;
    }
}