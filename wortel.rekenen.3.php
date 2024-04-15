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
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$x	= array(2,3,5,6,10)[rand(0,4)];
		$y	= nietnulcopriem($x,2,12);
		$a = $x*$y*$y;
		$teken = array("","-")[rand(0,1)];
		$opgave		= $teken."\\sqrt{".$x."}\\cdot\\sqrt{".$a."}";
		$oplossing	= $opgave;
		$oplossing .= "=$teken\\sqrt{".$x." \\cdot ".$a."}";
		$oplossing .= "=$teken\\sqrt{".$x." \\cdot ".$x." \\cdot ".($y*$y)."}";
		$oplossing .= "=$teken".(vkw($x." \\cdot ".$x))." \\cdot ".vkw($y*$y);
		
		//$oplossing .= "=$teken".$x."\\cdot".vkw($y*$y);
		$oplossing .= "=$teken".$x."\\cdot".$y;
		$oplossing .= "=$teken".($x*$y);
		
		$stamp		= '11.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$x  = array(2,3,5,6,7,10,11,13)[rand(0,7)];
		$y	= nietnulcopriem($x,2,20);
		$a = $x*$y*$y;
		$teken = array("","-")[rand(0,1)];
		$opgave		= $teken."\\frac{".vkw($a)."}{".vkw($x)."}";
		$oplossing	= $opgave;
		$oplossing .= "=$teken\\sqrt{ \\frac{".($a)."}{".($x)."}}";
		$oplossing .= "=$teken\\sqrt{ ".($y*$y)."}";
		$oplossing .= "=$teken".($y);
		$stamp		= '12.'.($x*$y);
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}

?>
