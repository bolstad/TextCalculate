<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 2017-04-23
 * Time: 19:58
 */

namespace Bolstad\TextCalculate {


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

            $calc = new FieldCalc();
            $result = $calc->calculate($input);

            return $result;
        }

    }
}