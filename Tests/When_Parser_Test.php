<?php

require_once '../When.php';
require_once '../When_Parser.php';

class When_Parser_Test extends PHPUnit_Framework_TestCase
{
    /**
     * @group yearly
     */
    public function testYearlyFromCurrDate ()
    {
        $string = 'yearly';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime((date('Y')+1).'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}

    /**
     * @group yearly
     * @group every_year
     */
    public function testEveryYearFromCurrDate ()
    {
        $string = 'every year';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime((date('Y')+1).'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}

    /**
     * @group yearly
     * @group each_year
     */
    public function testEachYearFromCurrDate ()
    {
        $string = 'each year';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime((date('Y')+1).'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}

    /**
     * @group yearly
     * @group once_a_year
     */
    public function testOnceAYearFromCurrDate ()
    {
        $string = 'once a year';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime((date('Y')+1).'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}

    /**
     * @group monthly
     */
    public function testMonthlyFromCurrDate ()
    {
        $string = 'monthly';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime(date('Y').'-'.(date('m')+1).'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}
	
    /**
     * @group monthly
     * @group every_month
     */
    public function testEveryMonthFromCurrDate ()
    {
        $string = 'every month';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime(date('Y').'-'.(date('m')+1).'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}

    /**
     * @group monthly
     * @group once_a_month
     */
    public function testOnceAMonthFromCurrDate ()
    {
        $string = 'once a month';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime(date('Y').'-'.(date('m')+1).'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}

    /**
     * @group monthly
     * @group each_month
     */
    public function testEachMonthFromCurrDate ()
    {
        $string = 'each month';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime(date('Y').'-'.(date('m')+1).'-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
	}

    /**
     * @monthly
     * @group every_month_on_day
     */
    public function testEveryMonthOnDay ()
    {
        $string = 'every month on the 15';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-'.date('m').'-15 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime(date('Y').'-'.(date('m')+1).'-15 00:00:00');
        $this->assertEquals($expect,$r->next());
    }

    /**
     * @yearly
     * @group every_jan
     */
    public function testEveryJan ()
    {
        $string = 'every january';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-01-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime((date('Y')+1).'-01-'.date('d').' 00:00:00');
        $this->assertEquals($expect,$r->next());
    }

    /**
     * @yearly
     * @group every_jan_on_day
     */
    public function testEveryJanOnDay ()
    {
        $string = 'every january on the 15';

        $p = new When_Parser();
        $r = $p->parse($string);

        $expect = new DateTime(date('Y').'-01-15 00:00:00');
        $this->assertEquals($expect,$r->next());

        $expect = new DateTime((date('Y')+1).'-01-15 00:00:00');
        $this->assertEquals($expect,$r->next());
    }

}
