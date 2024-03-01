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
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$y	= array(2,3,5,6,7,8,10,11,13,14,15,17,19)[rand(0,12)];
		$x	= nietnul(2, 60);
		$opgave		= "\\frac{".$x."}{\\sqrt{".$y."}}";
		$oplossing	= $opgave;
		$oplossing .= "=\\frac{".$x."\\cdot".color('red',"\\sqrt{".$y."}")."}{\\sqrt{".$y."}\\cdot".color('red',"\\sqrt{".$y."}")."}";
		$oplossing .= "=\\frac{".$x."\\cdot\\sqrt{".$y."}}{".$y."}";
		$ggd		= ggd($x,$y);
		if($ggd > 1)
		{
			if($ggd == $x)
			{
				$oplossing .= "=\\frac{\\sqrt{".$y."}}{".($y/$ggd)."}";
			}elseif($ggd == $y)
			{
				$oplossing .= "=".($x/$ggd)."\\cdot\\sqrt{".$y."}";
			}else
			{
				$oplossing .= "=\\frac{".($x/$ggd)."\\cdot\\sqrt{".$y."}}{".($y/$ggd)."}";
			}
		}
		$stamp		= '11.'.($x*$y);
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
