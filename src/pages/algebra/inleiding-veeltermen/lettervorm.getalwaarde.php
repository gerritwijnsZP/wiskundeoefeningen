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
	//p. 16 e.v
	private function oef11()
	{
		$a	= nietnul(1,10);
		$b	= nietnul(-10,10);
		$x	= nietnul(-5,5);
		$y	= nietnul(-5,5);
		$opgave 	= p($a,1)."a".p($b,0)."b";
		$oplossing	= "\\begin{align} ".$opgave;
		$opgave		.= "\\text{ [met a = $x en b = $y]}";
		$oplossing	.= "&=".$a.".a".p($b,2).".b   \\text{ [met a = $x en b = $y]}\\\\";
		$oplossing	.= "&=".$a.".".h($x).p($b,2).".".h($y). "\\\\";
		$oplossing	.= "&=".($a*$x+$b*$y);
		$oplossing	.= "\\\\ \\end{align}";
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a	= nietnul(1,5);
		$b	= nietnul(-6,6);
		$x	= nietnul(-5,6);
		$y	= nietnul(-5,6);
		$opgave 	= p($a,1)."a^2".p($b,0)."b";
		$oplossing	= "\\begin{align} ".$opgave;
		$opgave		.= "\\text{ [met a = $x en b = $y]}";
		$oplossing	.= "&=".$a.".a^2".p($b,2).".b   \\text{ [met a = $x en b = $y]}\\\\";
		$oplossing	.= "&=".$a.".".h($x)."^2".p($b,2).".".h($y). "\\\\";
		$oplossing	.= "&=".($a*$x*$x+$b*$y);
		$oplossing	.= "\\\\ \\end{align}";
		$stamp		= '12.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$a	= nietnul(1,5);
		$b	= nietnul(-5,5);
		$c	= nietnul(-15,15);
		$x	= nietnul(-5,6);
		$y	= nietnul(-5,6);
		$opgave 	= p($a,1)."ab".p($b,0)."b".p($c,2);
		$oplossing	= "\\begin{align} ".$opgave;
		$opgave		.= "\\text{ [met a = $x en b = $y]}";
		$oplossing	.= "&=".$a.".a.b".p($b,2).".b".p($c,2)."   \\text{ [met a = $x en b = $y]}\\\\";
		$oplossing	.= "&=".$a.".".h($x).".".h($y).p($b,2).".".h($y).p($c,2) . "\\\\";
		$oplossing	.= "&=".($a*$x*$y+$b*$y+$c);
		$oplossing	.= "\\\\ \\end{align}";
		$stamp		= '13.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
