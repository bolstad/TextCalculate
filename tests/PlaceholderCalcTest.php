<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 2017-04-23
 * Time: 19:43
 */

namespace Bolstad\TextCalculate;


class PlaceholderCalcTest extends \PHPUnit_Framework_TestCase
{

    var $cal;
    var $placeholders = ['ITEMS_SOLD' => 13, 'TAX_RATE' => 0.25];

    public function setUp()
    {
        $this->cal = new PlaceholderCalc();
    }

    public function testSimpleAdditon()
    {
        $this->assertEquals($this->cal->calculate('5+7'), 12);
    }

    public function testSimpleFormula1()
    {
        $this->assertEquals($this->cal->calculate('(5+9)*5'), 70);
    }

    public function testSimpleFormula2()
    {
        $this->assertEquals($this->cal->calculate('(10.2+0.5*(2-0.4))*2+(2.1*4)'), 30.4);
    }

    public function testSimpleFormula3()
    {
        $this->assertEquals($this->cal->calculate('10*5'), 50);
    }

    public function testSimplePlaceholderFormula()
    {
        $this->assertEquals($this->cal->calculate('10 * 13', $this->placeholders), 130);
        $this->assertEquals($this->cal->calculate('10 * ITEMS_SOLD', $this->placeholders), 130);
    }

    public function testSimplePlaceholderFormula2()
    {
        $this->assertEquals($this->cal->calculate('(10 * 13) + 5.5', $this->placeholders), 135.5);
        $this->assertEquals($this->cal->calculate('(10 * ITEMS_SOLD) + 5.5', $this->placeholders), 135.5);
    }


}
