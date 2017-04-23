<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 2017-04-23
 * Time: 19:58
 */

namespace Bolstad\TextCalculate {

    /**
     * Class PlaceholderCalc
     * @package Bolstad\TextCalculate
     *
     * Perform calculation on strings and replace placeholders according as configured in an array.
     *
     * Example:
     *
     *  Given that ITEMS_SOLD = 10 & TAX_RATE = 0.25 AND PROCESS_FEE = 3, calculate() can
     *  solve '((ITEMS_SOLD * 15) + PROCESS_FEE) * 0.25'
     *
     * Please see `tests/PlaceholderCalcTest.php` for example code
     */

    class PlaceholderCalc
    {

        /** Run match calculations on $input and do a string replace on each key in $placeholders
         *  with it's value.
         *
         * $input example = '((12 * ITEMS_SOLD) + 0.25) * TAX_RATE'
         * $placeholders = ['ITEMS_SOLD'=>3, 'TAX_RATE' = '0.25']
         *
         * @param $input
         * @param array $placeholders
         */
        public function calculate($input, $placeholders = array())
        {
            foreach ($placeholders as $placeholder => $value) {
                $input = str_replace($placeholder, $value, $input);
            }

            echo "parsed '$input'\n";
            $calc = new FieldCalc();
            $result = $calc->calculate($input);

            return $result;
        }

    }
}