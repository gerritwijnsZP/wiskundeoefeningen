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
		$e1	   	= rand(1,8);
		$e2		= rand(0,9);
		$e		= $e1*10+$e2;
		$f1	   	= rand(1,9-$e1);
		$f2		= rand(0,9-$e2);
		$f		= $f1*10+$f2;
		$opgave	= "$e + $f = \\ldots";
		$oplossing = "\\begin{align} & $e + $f\\\\";
		if($e2 == 0)
		{
			$oplossing .= "= &$e + ".color("green",$f1*10)."+".color("red",$f2)."\\\\";
			$oplossing .= "= &".color("green",$e+$f1*10)."+".color("red",$f2)."\\\\";
			$oplossing .= "= &".color("red",$e+$f);
		}elseif($f2==0)
		{
			$oplossing .= "= &$f+$e\\\\";
			$oplossing .= "= &$f + ".color("green",$e1*10)."+".color("red",$e2)."\\\\";
			$oplossing .= "= &".color("green",$f+$e1*10)."+".color("red",$e2)."\\\\";
			$oplossing .= "= &".color("red",$e+$f);
		}else{
			$oplossing .= "= &".color("green",$e1*10)."+".color("red",$e2)."+".color("green",$f1*10)."+".color("red",$f2)."\\\\";
			$oplossing .= "= &".color("green",($e1+$f1)*10)."+".color("red",$e2+$f2)."\\\\";
			$oplossing .= "= &".color("red",$e+$f);
		}
		$oplossing .= "\\end{align}";
		$stamp = $e.".".$f;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
