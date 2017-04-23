<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 2017-04-23
 * Time: 19:43
 */

namespace Bolstad\TextCalculate;


class FieldCalcTest extends \PHPUnit_Framework_TestCase
{

    var $cal;

    public function setUp()
    {
        $this->cal  = new FieldCalc();
    }

    public function testSimpleAdditon()
    {
        $this->assertEquals($this->cal->calculate('5+7'),12);
        $this->assertEquals($this->cal->calculate('5+7 rm'),12);

    }

    public function testSimpleForula1()
    {
        $this->assertEquals($this->cal->calculate('(5+9)*5'),70);
    }

    public function testSimpleForula2()
    {
        $this->assertEquals($this->cal->calculate('(10.2+0.5*(2-0.4))*2+(2.1*4)'),30.4);
    }


}
