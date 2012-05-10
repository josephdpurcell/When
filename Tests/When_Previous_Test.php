<?php

require_once '../When.php';
require_once '../When_Parser.php';

class When_Previous_Test extends PHPUnit_Framework_TestCase
{

    function testPrev ()
	{
		$results[] = new DateTime('1998-05-05 09:00:00');
		$results[] = new DateTime('1998-04-05 09:00:00');
		$results[] = new DateTime('1998-03-05 09:00:00');
		$results[] = new DateTime('1998-02-05 09:00:00');
		$results[] = new DateTime('1998-01-05 09:00:00');
		$results[] = new DateTime('1997-12-05 09:00:00');
		
		$r = new When();
		$r->recur('19980605T090000', 'monthly')->count(6);
		
		foreach($results as $result)
		{
			$this->assertEquals($result, $r->prev());
		}
	}

}
