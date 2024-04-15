<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.rational.php");//Gebruikt
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		/*
			ax + b = c met a, b, c \in \Z
		*/
		$a =	nietnul(-15,15);
		$x =	'x';
		$b =	nietnul(-15,15);
		$c =	nietnul(-15,15);
		$opgave 	= p($a,1).$x.p($b,2).'='.$c;
		$oplossing 	= "\\begin{align} & ".p($a,1).$x." \\color{red}{".p($b,2)."}& = &".$c." \\\\";
		$oplossing	.="\\Leftrightarrow & ".p($a,1).$x." \\color{red}{".p($b,2)."}\\color{blue}{".p(-$b,2)."} 
						& = &".$c."\\color{blue}{".p(-$b,2)."} \\\\";
		$oplossing	.= "\\Leftrightarrow &".p($a,1).$x."
						& = &".($c-$b)."\\\\";
		$oplossing	.= "\\Leftrightarrow & \\color{red}{".p($a,1)."}".$x."
						& = &".($c-$b)."\\\\";
		$breuk = new R($c-$b, $a);
		$breuk->haakjes(False);
		$oplossing	.= "\\Leftrightarrow & \\frac{\\color{red}{".p($a,1)."}".$x."}{ \\color{blue}{$a}}
						& = & $breuk \\\\";
		$breuk->vereenvoudig();
		$oplossing	.= "\\Leftrightarrow & \\color{green}{ $x = $breuk } & & \\\\";
		$oplossing	.= " & V = \\left\\{ $breuk \\right\\} & \\\\";
		$oplossing 	.="\\end{align}";
		$stamp		= "11.$a$b$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
