<?php
	require_once('load.php');
	
	$terminal = php_sapi_name() == "cli";
	$nl = $terminal ? "\n" : "<br/>";
	$tb = $terminal ? "\t" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	
	$tests =
		array(
			array(	//Failure check
				'g' => array('y' => 2016, 'm' => 1, 'd' => 25),
				'b' => array('y' => 172, 'm' => 17, 'd' => 7)
			),
			array(	//Naw Ruz
				'g' => array('y' => 2015, 'm' => 3, 'd' => 21),
				'b' => array('y' => 172, 'm' => 1, 'd' => 1)
			),
			array(	//1 Ridvan
				'g' => array('y' => 2014, 'm' => 4, 'd' => 21),
				'b' => array('y' => 171, 'm' => 2, 'd' => 13)
			),
			array(	//9 ridvan
				'g' => array('y' => 2015, 'm' => 4, 'd' => 29),
				'b' => array('y' => 172, 'm' => 3, 'd' => 2)
			),
			array(	//12 ridvan
				'g' => array('y' => 2015, 'm' => 5, 'd' => 2),
				'b' => array('y' => 172, 'm' => 3, 'd' => 5)
			),
			array(	//Dec of Bab
				'g' => array('y' => 2015, 'm' => 5, 'd' => 24),
				'b' => array('y' => 172, 'm' => 4, 'd' => 8)
			),
			array(	//asc Bah
				'g' => array('y' => 2015, 'm' => 5, 'd' => 29),
				'b' => array('y' => 172, 'm' => 4, 'd' => 13)
			),
			array(	//martyrdom Bab
				'g' => array('y' => 2015, 'm' => 7, 'd' => 10),
				'b' => array('y' => 172, 'm' => 6, 'd' => 17)
			),
			array(	//day of cov
				'g' => array('y' => 2015, 'm' => 11, 'd' => 26),
				'b' => array('y' => 172, 'm' => 14, 'd' => 4)
			),
			array(	//asc AB
				'g' => array('y' => 2015, 'm' => 11, 'd' => 28),
				'b' => array('y' => 172, 'm' => 14, 'd' => 6)
			),
			array(	//ala 1
				'g' => array('y' => 2016, 'm' => 3, 'd' => 1),
				'b' => array('y' => 172, 'm' => 20, 'd' => 1)
			)
		);
	
	function test($one, $two){
		return $one->y == $two->y && $one->m == $two->m && $one->d == $two->d;
	}
	
	function out($date){
		return $date->year(true).'-'.$date->month(true).'-'.$date->day(true);
	}
	
	$results = array('b2g' => array('success' => 0, 'failure' => 0), 'g2b' => array('success' => 0, 'failure' => 0));
	
	foreach($tests as $i => $test){
		$bd = $test['b'];
		$gd = $test['g'];
		
		$bdate = new BadiDate($bd['y'], $bd['m'], $bd['d']);
		$gdate = new BadiDate($gd['y'], $gd['m'], $gd['d']);
		
		$ebdate = BadiCal::GregorianToBadi($gd['y'], $gd['m'], $gd['d']);
		$egdate = BadiCal::BadiToGregorian($bd['y'], $bd['m'], $bd['d']);
		
		echo 'Test '.($i + 1).': '.$nl;
		echo $tb.'Badi to Gregorian: '.$nl;
		echo $tb.$tb.'Badi: '.out($bdate).$nl;
		echo $tb.$tb.'Gregorian: '.$nl;
		echo $tb.$tb.$tb.'Expected: '.out($gdate).$nl;
		echo $tb.$tb.$tb.'Output: '.out($egdate).$nl;
		echo $tb.$tb. (test($egdate, $gdate) ? 'SUCCESS' : 'FAILURE').$nl;
		
		$results['b2g'][test($egdate, $gdate) ? 'success' : 'failure']++;
		
		echo $tb.'Gregorian To Badi: '.$nl;
		echo $tb.$tb.'Gregorian: '.out($gdate).$nl;
		echo $tb.$tb.'Badi: '.$nl;
		echo $tb.$tb.$tb.'Expected: '.out($bdate).$nl;
		echo $tb.$tb.$tb.'Output: '.out($ebdate).$nl;
		echo $tb.$tb. (test($ebdate, $bdate) ? 'SUCCESS' : 'FAILURE').$nl.$nl;
		
		$results['g2b'][test($ebdate, $bdate) ? 'success' : 'failure']++;
		//break;
	}
	
	echo "Summary:\n\tBadi To Gregorian: "
		.$results['b2g']['success']." successes, "
		.$results['b2g']['failure']." failures\n\tGregorian to Badi: "
		.$results['g2b']['success']." successes, "
		.$results['g2b']['failure']." failures";
?>
