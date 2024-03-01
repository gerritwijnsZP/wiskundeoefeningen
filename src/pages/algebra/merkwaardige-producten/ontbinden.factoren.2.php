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
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 33 a-n is oef11-oef23
	//p. 32 c, d oef24-oef25
	private function oef11()
	{
		$x =	randonbekende();
		$a =	nietnul(-9,9);
		$b =	nietnul(-9,9);
		$c = 	nietnul(-9,9);
		$teken	= array(-1,1)[rand(0,1)];
		$f = 	nietnul(2,5);	
		$opgave 	= "(".$x.p($a,2).")(".$x.p($b,2).")".p($teken,0)."(".p($f,1).$x.p($c,2).")(".$x.p($a,2).")";
		$oplossing	= $opgave;
		$oplossing 	.= "\\\\=(".$x.p($a,2).")(".$x.p($b,2).p($teken*$f,0).$x.p($teken*$c,2).")";
		$oplossing 	.= "\\\\=(".$x.p($a,2).")(".p(1+$teken*$f,1).$x.p($b+$teken*$c,2).")";
		
		$stamp		= "11.$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$x =	randonbekende();
		$a =	nietnul(-9,9);
		$b =	nietnul(-9,9);
		$c = 	nietnul(-9,9);
		$teken	= array(-1,1)[rand(0,1)];
		$f = 	nietnul(2,5);
		$g =	nietnulcopriem($f,2,9);	
		$opgave 	= "(".p($g,1).$x.p($a,2).")(".$x.p($b,2).")".p($teken,0)."(".p($g,1).$x.p($a,2).")(".p($f,1).$x.p($c,2).")";
		$oplossing	= $opgave;
		$oplossing 	.= "\\\\=(".p($g,1).$x.p($a,2).")(".$x.p($b,2).p($teken*$f,0).$x.p($teken*$c,2).")";
		$oplossing 	.= "\\\\=(".p($g,1).$x.p($a,2).")(".p(1+$teken*$f,1).$x.p($b+$teken*$c,2).")";
		
		$stamp		= "12.$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		//(ax+b)² +/- (fax+fb)
		$x =	randonbekende();
		$a =	nietnul(1,9);
		$b =	nietnulcopriem($a,-9,9);
		$teken	= array(-1,1)[rand(0,1)];
		$f = 	nietnul(2,5);

		$opgave 	= "(".p($a,1).$x.p($b,2).")^2".p($teken,0)."(".p($f*$a,1).$x.p($f*$b,2).")";
		$oplossing	= $opgave;
		$oplossing 	.= "\\\\=(".p($a,1).$x.p($b,2).")(".p($a,1).$x.p($b,2).")".p($teken*$f,0)."(".p($a,1).$x.p($b,2).")";
		$oplossing 	.= "\\\\=(".p($a,1).$x.p($b+$teken*$f,2).")(".p($a,1).$x.p($b,2).")";
		
		$stamp		= "13.$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
