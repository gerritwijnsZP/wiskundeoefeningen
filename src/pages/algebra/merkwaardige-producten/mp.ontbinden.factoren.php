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
		$i = random_int(11,18);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 33 a-n is oef11-oef23
	//p. 32 c, d oef24-oef25
	private function oef11()
	{
		$x =	randonbekende();
		$b =	nietnul(-15,15);
		$opgave 	= "$x^2".p(2*$b,0).$x."+".($b**2);
		$oplossing	= $opgave;
		$oplossing 	.= "=(".$x.p($b,2).")^2";
		
		$stamp		= "11.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$x =	randonbekende();
		$a =	nietnul(2,16);
		$b =	nietnulcopriem($a,-16,16);
		$opgave 	= p($a**2,1)."$x^2".p(2*$a*$b,0).$x."+".($b**2);
		$oplossing	= $opgave;
		$oplossing 	.= "="."(".p($a,1).$x.p($b,2).")^2";
		$stamp		= "12.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$x =	randonbekende();
		$e =	random_int(2,5);
		$a =	nietnul(2,16);
		$b =	nietnulcopriem($a,-16,16);
		$opgave 	= ($a**2)."$x^{".(2*$e)."}".p(2*$a*$b,0).$x."^$e+".($b**2);
		$oplossing	= $opgave;
		$oplossing 	.= "=(".p($a,1).$x."^$e".p($b,2).")^2";
		$stamp		= "13.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		$x =	randonbekende();
		$y =	randonbekende(array($x));
		if($x > $y){$dummy = $x; $x = $y; $y = $dummy;}
		$e =	random_int(2,5);
		$a =	nietnul(2,16);
		$b =	nietnulcopriem($a,-16,16);
		$opgave 	= p($a**2,1).$x."^{".(2*$e)."}".p(2*$a*$b,0).$x."^$e".$y."+".($b**2).$y."^2";
		$oplossing	= $opgave;
		$oplossing  .= "=(".p($a,1).$x."^$e".p($b,0).$y.")^2";
		$stamp		= "14.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef15() //(x-a)(x+a)
	{
		$x =	randonbekende();
		$b =	nietnul(-15,15);
		$opgave		= "$x^2-".($b**2);
		$oplossing	= $opgave;
		$oplossing 	.= "=($x".p($b,2).")($x".p(-$b,2).")";
		$stamp		= "15.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef16() //(ax+b)(ax-b)
	{
		$x =	randonbekende();
		$a =	nietnul(2,16);
		$b =	nietnulcopriem($a,1,16);
		$opg1		= "-".p($a**2,1).$x."^2".p($b**2,2);
		$opg2 		= p($a**2,1).$x."^2-".($b**2);
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing  = $opgave;
		if($opgave == $opg1){
			$oplossing  .= "="."(".$b.p(-$a,2).$x.")(".$b.p($a,2).$x.")";
		}else{
			$oplossing  .= "="."(".p($a,1).$x.p($b,2).")(".p($a,1).$x.p(-$b,2).")";
		}
		$stamp		= "16.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef17() //(ax^e + b)(ax^e - b)
	{
		$x =	randonbekende();
		$e =	random_int(2,8);
		$a =	nietnul(2,16);
		$b =	nietnulcopriem($a,1,16);
		$opg1		= ($b**2)."-".p($a**2,1).$x."^{".(2*$e)."}";
		$opg2 		= p($a**2,1).$x."^{".(2*$e)."}-".($b**2);
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing  = $opgave;
		if($opgave == $opg1){
			$oplossing  .= "="."(".$b.p(-$a,2).$x."^$e".")(".$b.p($a,2).$x."^$e".")";
		}else{
			$oplossing  .= "="."(".p($a,1).$x."^$e".p($b,2).")(".p($a,1).$x."^$e".p(-$b,2).")";
		}
		$stamp		= "17.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef18()
	{
		$x =	randonbekende();
		$y =	randonbekende(array($x));
		if($x > $y){$dummy = $x; $x = $y; $y = $dummy;}
		$e =	random_int(2,8);
		$a =	nietnul(1,16);
		$b =	nietnulcopriem($a,2,16);
		$opg1		= ($b**2).$y."^2-".p($a**2,1).$x."^{".(2*$e)."}";
		$opg2		= p($a**2,1).$x."^{".(2*$e)."}-".($b**2).$y."^2";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing  = $opgave;
		if($opgave == $opg1){
			$oplossing  .= "="."(".p($b,1).$y.p(-$a,0).$x."^$e".")(".p($b,1).$y.p($a,0).$x."^$e".")";
		}else{
			$oplossing  .= "="."(".p($a,1).$x."^$e".p($b,0).$y.")(".p($a,1).$x."^$e".p(-$b,0).$y.")";
		}
		$stamp		= "18.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
