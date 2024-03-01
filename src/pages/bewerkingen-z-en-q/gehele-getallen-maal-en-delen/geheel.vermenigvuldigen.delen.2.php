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
	private function oef11()
	{	
		$a	= nietnul(-5,5);
		$b	= nietnul(-5,5);
		$c	= nietnul(-5,5);
		$d	= nietnul(-5,5);
		$opgave = "(".p($a,2).").(".p($b,2).").(".p($c,2).").(".p($d,2).")";
		$oplossing = $opgave . "\\\\=". p($a*$b,2).".(".p($c,2).").(".p($d,2).")";
		$oplossing .= "\\\\ =". p($a*$b*$c,2).".(".p($d,2).")";
		$oplossing .= "\\\\ =". p($a*$b*$c*$d,2);
		$stamp		= "$a.$b.$c.$d";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{	
		$a	= nietnul(-5,5);
		$b	= nietnul(-5,5);
		$c	= nietnul(-5,5);
		$opgave = "(".p($a,2).").(".p($b,2).").(".p($c,2).")";
		$oplossing = $opgave . "\\\\=". p($a*$b,2).".(".p($c,2).")";
		$oplossing .= "\\\\ =". p($a*$b*$c,2);
		$stamp		= "$a.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{	
		$a	= nietnul(-5,5);
		$b	= nietnul(-5,5);
		$c	= nietnul(-5,5);
		$d	= nietnul(-5,5);
		$e	= nietnul(-5,5);
		$opgave = "(".p($a,2).").(".p($b,2).").(".p($c,2).").(".p($d,2).").(".p($e,2).")";
		$oplossing = $opgave . "\\\\=". p($a*$b,2).".(".p($c,2).").(".p($d,2).").(".p($e,2).")";
		$oplossing .= "\\\\ =". p($a*$b*$c,2).".(".p($d,2).").(".p($e,2).")";
		$oplossing .= "\\\\ =". p($a*$b*$c*$d,2).".(".p($e,2).")";
		$oplossing .= "\\\\ =". p($a*$b*$c*$d*$e,2);
		$stamp		= "$a.$b.$c.$d.$e";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
