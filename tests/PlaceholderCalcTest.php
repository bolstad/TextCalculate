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


    public function testJsonStuff()
    {
        $jsonData = json_decode('{"id":4357,"changedfields":0,"date":196440,"user_id":0,"exp_portalvisit":1,"see_portaldisc":0,"hac_hacks":227,"bui_resdeploy":165,"con_linkscreated":7,"min_fieldscreated":0,"pur_resdestroyed":694,"pur_linksdestroyed":152,"pur_fieldsdestroyed":78,"gua_maxtime":2,"dis_xm":1552122,"bui_mucap":0,"bui_longlink":0,"bui_lafield":0,"bui_xmrecharged":1006996,"bui_portalcap":43,"bui_unportalcap":1,"com_portalsneut":100,"def_linkmain":0,"def_linkxdays":0,"def_fieldheld":0,"def_muxdays":0,"hea_distance":7,"innovator":0,"mis_completed":0,"bui_moddeploy":41,"hac_glyph":248,"hac_days":0,"web":0,"logid":4201,"initial":0,"reminder":0,"vanguard":0,"luminary":0,"_uniq":352537075}
',1);

        print_r($jsonData);
        $this->assertEquals($this->cal->calculate('com_portalsneut + bui_portalcap + pur_resdestroyed + con_linkscreated + min_fieldscreated', $jsonData),844);
    }
}
