<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.rational.php");
require_once(LIB . "class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 17 e.v
	private function oef11()
	{
		$letter = array("a","b","c","p","q","x","y")[rand(0,6)];
		$a 		= nietnul(-4,4);
		$b		= nietnul(-8,8);
		$c		= nietnul(-2,2);
		if($a == 1)
		{
			$opgave 	= "+(".p($b,1).$letter.p($c,2).")";
		}else{
			$opgave 	= p($a,1)."(".p($b,1).$letter.p($c,2).")";
		}
		$oplossing	= $opgave;
		$oplossing .= "=".p($a*$b,1).$letter.p($a*$c,2);
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a 		= nietnul(-2,2);
		$b		= nietnul(-3,3);
		$c		= nietnul(-4,4);
		$d		= nietnul(-4,4);
		$letters = array(array("a","b"),array("p","q"),array("x","y"),array("x","xy"),array("xy","y"))[rand(0,4)];
		$x = $letters[0];
		$y = $letters[1];
		if($a == 1)
		{
			$opgave 	= "+(".p($b,1).$x.p($c,0).$y.p($d,2).")";
		}else{
			$opgave 	= p($a,1)."(".p($b,1).$x.p($c,0).$y.p($d,2).")";
		}
		$oplossing	= $opgave;
		$oplossing .= "=".p($a*$b,1).$x.p($a*$c,0).$y.p($a*$d,2);
		$stamp		= '12.'.$a.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
