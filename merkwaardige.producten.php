<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
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
		$opg1		= "(".$x.p($b,2).")^2";
		$opg2		= "($x".p($b,2).")($x".p($b,2).")";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing	= $opgave;
		if($opgave == $opg2){ $oplossing .= "=".$opg1; }
		$oplossing 	.= "=$x^2+\\color{magenta}{2.$x.".h($b)."}+".h($b)."^2";
		$oplossing 	.= "=$x^2"."\\color{magenta}{".p(2*$b,0).$x."}+".($b**2);
		$stamp		= "11.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$x =	randonbekende();
		$a =	nietnul(-16,16);
		$b =	nietnul(-16,16);
		$opg1		= "(".p($a,1).$x.p($b,2).")^2";
		$opg2 		= "(".p($a,1).$x.p($b,2).")(".p($a,1).$x.p($b,2).")";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing	= $opgave;
		if($opgave == $opg2){ $oplossing .= "=".$opg1; }
		$oplossing 	.= "=(".p($a,1)."$x)^2+\\color{magenta}{2.(".p($a,1)."$x).".h($b)."}+".h($b)."^2";
		$oplossing 	.= "=".p($a**2,1)."$x^2\\color{magenta}{".p(2*$a*$b,0).$x."}+".($b**2);
		$stamp		= "12.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$x =	randonbekende();
		$e =	random_int(2,5);
		$a =	nietnul(-16,16);
		$b =	nietnul(-16,16);
		$opg1		= "(".p($a,1).$x."^$e".p($b,2).")^2";
		$opg2 		= "(".p($a,1).$x."^$e".p($b,2).")(".p($a,1).$x."^$e".p($b,2).")";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing	= $opgave;
		if($opgave == $opg2){ $oplossing .= "=".$opg1; }
		$oplossing 	.= "=(".p($a,1)."$x^$e)^2\\color{magenta}{+2.(".p($a,1)."$x^$e).".h($b)."}+".h($b)."^2";
		$oplossing 	.= "=".($a**2)."$x^{".(2*$e)."}\\color{magenta}{".p(2*$a*$b,0).$x."^$e}+".($b**2);
		$stamp		= "13.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		$x =	randonbekende();
		$y =	randonbekende(array($x));
		$e =	random_int(2,5);
		$a =	nietnul(-16,16);
		$b =	nietnul(-16,16);
		$opg1		= "(".p($a,1).$x."^$e".p($b,0).$y.")^2";
		$opg2		= "(".p($a,1).$x."^$e".p($b,0).$y.")(".p($a,1).$x."^$e".p($b,0).$y.")";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing	= $opgave;
		if($opgave == $opg2){ $oplossing .= "=".$opg1; }
		$oplossing 	.= "=(".p($a,1)."$x^$e)^2\\color{magenta}{+2.(".p($a,1)."$x^$e).(".p($b,1).$y.")}+(".p($b,1).$y.")^2";
		$oplossing 	.= "=".p($a**2,1)."$x^{".(2*$e)."}\\color{magenta}{".p(2*$a*$b,0);
		if($x < $y)
		{	$oplossing .= $x."^$e".$y; }
		else
		{	$oplossing .= $y.$x."^$e"; }
		$oplossing .= "}+".($b**2).$y."^2";
		$stamp		= "14.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef15() //(x-a)(x+a)
	{
		$x =	randonbekende();
		$b =	nietnul(-15,15);
		$opgave		= "($x".p($b,2).")($x".p(-$b,2).")";
		$oplossing	= "(\\color{blue}{".$x."}\\color{red}{".p($b,2)."})(\\color{blue}{".$x."}\\color{red}{".p(-$b,2)."})";
		$oplossing 	.= "=\\color{blue}{".$x."}^2-\\color{red}{".abs($b)."}^2";
		$oplossing 	.= "=$x^2-".($b**2);
		$stamp		= "15.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef16() //(ax+b)(ax-b)
	{
		$x =	randonbekende();
		$a =	nietnul(-16,16);
		$b =	nietnul(-16,16);
		$opg1		= "(".p(-$a,1).$x.p($b,2).")(".p($a,1).$x.p($b,2).")";
		$opg2 		= "(".p($a,1).$x.p($b,2).")(".p($a,1).$x.p(-$b,2).")";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		if($opgave == $opg1){
			$oplossing  = "(\\color{red}{".p(-$a,1).$x."}\\color{blue}{".p($b,2)."})(\\color{red}{".p($a,1).$x."}\\color{blue}{".p($b,2)."})";
			$oplossing 	.= "=\\color{blue}{".h($b)."}^2-\\color{red}{(".p(abs($a),1).$x.")}^2";
			$oplossing  .= "=".($b**2)."-".p($a**2,1).$x."^2";
		}else{
			$oplossing 	= "(\\color{blue}{".p($a,1).$x."}\\color{red}{".p($b,2)."})(\\color{blue}{".p($a,1).$x."}\\color{red}{".p(-$b,2)."})";
			$oplossing 	.= "=\\color{blue}{(".p($a,1).$x.")}^2-\\color{red}{(".$b.")}^2";
			$oplossing  .= "=".p($a**2,1).$x."^2-".($b**2);
		}
		$stamp		= "16.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef17() //(ax^e + b)(ax^e - b)
	{
		$x =	randonbekende();
		$e =	random_int(2,5);
		$a =	nietnul(-16,16);
		$b =	nietnul(-16,16);
		$opg1		= "(".p(-$a,1).$x."^$e".p($b,2).")(".p($a,1).$x."^$e".p($b,2).")";
		$opg2 		= "(".p($a,1).$x."^$e".p($b,2).")(".p($a,1).$x."^$e".p(-$b,2).")";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		if($opgave == $opg1){
			$oplossing  = "(\\color{red}{".p(-$a,1).$x."^$e}\\color{blue}{".p($b,2)."})(\\color{red}{".p($a,1).$x."^$e}\\color{blue}{".p($b,2)."})";
			$oplossing 	.= "=\\color{blue}{".h($b)."}^2-\\color{red}{(".p(abs($a),1).$x."^$e)}^2";
			$oplossing  .= "=".($b**2)."-".p($a**2,1).$x."^{".(2*$e)."}";
		}else{
			$oplossing 	= "(\\color{blue}{".p($a,1).$x."^$e}\\color{red}{".p($b,2)."})(\\color{blue}{".p($a,1).$x."^$e}\\color{red}{".p(-$b,2)."})";
			$oplossing 	.= "=\\color{blue}{(".p($a,1).$x."^$e)}^2-\\color{red}{".h($b)."}^2";
			$oplossing  .= "=".p($a**2,1).$x."^{".(2*$e)."}-".($b**2);
		}
		$stamp		= "17.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef18()
	{
		$x =	randonbekende();
		$y =	randonbekende(array($x));
		$e =	random_int(2,5);
		$a =	nietnul(-16,16);
		$b =	nietnul(-16,16);
		$opg1		= "(".p(-$a,1).$x."^$e".p($b,0).$y.")(".p($a,1).$x."^$e".p($b,0).$y.")";
		$opg2		= "(".p($a,1).$x."^$e".p($b,0).$y.")(".p($a,1).$x."^$e".p(-$b,0).$y.")";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		if($opgave == $opg1){
			$oplossing  = "(\\color{red}{".p(-$a,1).$x."^$e}\\color{blue}{".p($b,0).$y."})(\\color{red}{".p($a,1).$x."^$e}\\color{blue}{".p($b,0).$y."})";
			$oplossing 	.= "=\\color{blue}{(".$b.$y.")}^2-\\color{red}{(".p(abs($a),1).$x."^$e)}^2";
			$oplossing  .= "=".($b**2).$y."^2-".p($a**2,1).$x."^{".(2*$e)."}";
		}else{
			$oplossing 	= "(\\color{blue}{".p($a,1).$x."^$e}\\color{red}{".p($b,0).$y."})(\\color{blue}{".p($a,1).$x."^$e}\\color{red}{".p(-$b,0).$y."})";
			$oplossing 	.= "=\\color{blue}{(".p($a,1).$x."^$e)}^2-\\color{red}{(".$b.$y.")}^2";
			$oplossing  .= "=".p($a**2,1).$x."^{".(2*$e)."}-".($b**2).$y."^2";
		}
		$stamp		= "18.$a$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
