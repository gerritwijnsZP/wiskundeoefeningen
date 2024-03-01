<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
//require_once(LIB . "class.rational.php");
//require_once(LIB . "class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$d 			= rand(2,9);
		$e			= rand(1,8)*10 + $d;
		$f			= rand(10-$d+1,9);
		$g 			= 10 - $d;
		$h 			= $f + $d - 10;
		$coin		= rand(0,1);
		if($coin == 0)
		{
			$opgave 	= "$e + $f = \\ldots";
			$oplossing 	= "\\begin{align} & $e + $f \\\\";
		}else{
			$opgave 	= "$f + $e = \\ldots";
			$oplossing 	= "\\begin{align} & $f + $e \\\\";
			$oplossing 	.= "= & $e + $f \\\\";
		}
		$oplossing .= "= & $e + ".color("green",$g)." + ".color("red",$h)." \\\\";
		$oplossing .= "= & ".color("green",$e+$g)."+".color("red",$h)." \\\\";
		$oplossing .= "= & ".color("red",$e+$f)."\\end{align}";
		$stamp = $coin.".".$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
