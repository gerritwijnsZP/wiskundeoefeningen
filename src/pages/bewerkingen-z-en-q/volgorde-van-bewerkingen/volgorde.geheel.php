<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,15);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 33 a-n is oef11-oef23
	//p. 32 c, d oef24-oef25
	private function oef11()
	{
		$a 	= nietnul(-20,20);
		$b	= nietnul(2,20);
		$c 	= nietnul(-20,-2);
		$opgave 	= $a . '+' . $b .'.('.$c.')';
		$oplossing	= $opgave;
		$oplossing 	.= '=' . $a . '+' . '(' . $b*$c.')';
		$oplossing	.= '=' . ($a + $b * $c);
		$stamp		= '11.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a 	= nietnul(-20,20);
		$c	= nietnul(-10, -2);
		$b 	= abs($c * nietnul(2,15));
		$opgave 	= $a . "+" . $b . ":(" . $c . ")";
		$oplossing  = $opgave;
		$oplossing 	.= "=" . $a . "+ (" . $b / $c . ")";
		$oplossing 	.= "=" . ($a + ($b / $c));
		$stamp 		= '12'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$a	= nietnul(-20, -2);
		$b 	= nietnul(-20, -2);
		$c 	= nietnul(2,20);
		$opgave = "(".$a.").(".$b.")+".$c;
		$oplossing = $opgave;
		$oplossing .= "=" .($a*$b)."+".$c;
		$oplossing .= "=" .($a*$b+$c);
		$stamp 		= '13'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		$c 	= nietnul(2,7);
		$b	= $c * nietnul(2, 5);
		$a 	= abs($b * nietnul(2,7));
		$d 	= nietnul(1,20);
		$opgave = $a . "-" . $b . ":" . $c . "+" . $d;
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '-' .($b/$c) . '+' . $d;
		$oplossing .= "=" . ($a - ($b / $c) + $d);
		$stamp 		= '14'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef15()
	{
		$a	= nietnul(-30, 30);
		$b 	= nietnul(-30, 30);
		$c 	= nietnul(-30, 30);
		$opgave = $a . p($b,2) . p($c,2);
		$oplossing = $opgave;
		$oplossing .= "=".($a+$b+$c);
		$stamp 		= '15'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
