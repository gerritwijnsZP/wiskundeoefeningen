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
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$a			= random_int(2,100);
		$voorvoegsels 	= array("seconden","minuten","uren");
		$m 				= random_int(1, 2);
		$n				= random_int(0, $m-1);
		
		$opgave		= "\\)Hoeveel ".$voorvoegsels[$n]." passen er in ".$a." ".$voorvoegsels[$m]."? \\(";
		$oplossing	= $a." \\text{ ".$voorvoegsels[$m]."}\\\\=".$a."\\times".pow(60,$m-$n)."\\text{ ".$voorvoegsels[$n]."}"."\\\\=".($a*pow(60,$m-$n))."\\text{ ".$voorvoegsels[$n]."}";
		$stamp		= '11.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a			= random_int(2,100);
		$voorvoegsels 	= array("seconden","minuten","uren");
		$m 				= random_int(1, 2);
		$n				= random_int(0, $m-1);
		$b				= $a*pow(60,$m-$n);
		
		$opgave		= "\)Hoeveel ".$voorvoegsels[$m]." passen er in ".$b." ".$voorvoegsels[$n]."?\(";
		$oplossing	= $b." \\text{ ".$voorvoegsels[$n]."}\\\\=".$b.":".pow(60,$m-$n)."\\text{ ".$voorvoegsels[$m]."}"."\\\\=".$a."\\text{ ".$voorvoegsels[$m]."}";
		$stamp		= '12.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
