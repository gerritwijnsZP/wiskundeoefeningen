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
	//p. 17 e.v
	private function oef11()
	{
		$a 		= nietnul(2,10)*array(-1,1)[rand(0,1)];
		$b		= nietnul(2,10)*array(-1,1)[rand(0,1)];
		$c 		= nietnul(2,10)*array(-1,1)[rand(0,1)];
		$d		= nietgetal(2,10,array(abs($b)))*array(-1,1)[rand(0,1)];
		$x		= nietnul(-10,10);
		$y		= nietnul(-10,10);
		$r		= $a*$x+$b*$y;
		$s		= $c*$x+$d*$y;
		$opgaves = array(
							p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x".p($d,0)."y=".$s ,
							p($b,1)."y=".$r.p(-$a,0)."x"."\\\\".p($c,1)."x".p($d,0)."y=".$s ,
							p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x=".p(-$d,1)."y".p($s,2) ,
							p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($d,1)."y".p($c,0)."x=".$s ,
							p($b,1)."y".p($a,0)."x=".$r ."\\\\".p($c,1)."x".p($d,0)."y=".$s ,
						);
		$keuze	= rand(0,4);
		$opgave = "\\left\\{\\begin{matrix}"
					.$opgaves[$keuze].
					"\\end{matrix}\\right.";
		$oplossing	= $opgave;
		//Stap 0
		if($keuze != 0)
		{
			$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}"
					.p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x".p($d,0)."y=".$s.
					"\\end{matrix}\\right.";
			$oplossing .= "\\text{(Niet verplichte stap, proper schrijven)}";
		}
		//Stap 1a : factoren bepalen
		$fx1 = abs(kgv($a,$c))/abs($a);
		if( ($a < 0 && $c < 0) || ($a > 0 && $c > 0) )
		{
			$fx2 = -abs(kgv($a,$c))/abs($c);
		}else{
			$fx2 = abs(kgv($a,$c))/abs($c);
		}
		$fy1 = abs(kgv($b,$d))/abs($b);
		if( ($b < 0 && $d < 0) || ($b > 0 && $d > 0) )
		{
			$fy2 = -abs(kgv($b,$d))/abs($d);
		}else{
			$fy2 = abs(kgv($b,$d))/abs($d);
		}
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{array}{c|c|c}";
			$oplossing .= 
							p($a,1)."x".p($b,0)."y=".$r. "&". color("red",$fx1.".") . "&". color("blue",$fy1.".") . 
					"\\\\".	p($c,1)."x".p($d,0)."y=".$s. "&". color("red",$fx2.".") . "&". color("blue",$fy2.".")  ;
		$oplossing .= "\\end{array}\\right.";
		//Stap 1b
		/*
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
			$oplossing .= "\\left\\{\\begin{matrix}";
				$oplossing .= color("red",$fx1."."). "\\left(". p($a,1)."x".p($b,0)."y=".$r. "\\right)" .
						"\\\\".color("red",$fx2."."). "\\left(".p($c,1)."x".p($d,0)."y=".$s. "\\right)";
			$oplossing .= "\\end{matrix}\\right.";
			$oplossing .= "\\text{x zal verdwijnen}";
			$oplossing .=" \\\\";
			$oplossing .= "\\left\\{\\begin{matrix}";
				$oplossing .= color("blue",$fy1."."). "\\left(". p($a,1)."x".p($b,0)."y=".$r. "\\right)" .
						"\\\\".color("blue",$fy2."."). "\\left(".p($c,1)."x".p($d,0)."y=".$s. "\\right)";
			$oplossing .= "\\end{matrix}\\right.";
			$oplossing .= "\\text{y zal verdwijnen}";
		$oplossing .= "\\end{matrix}\\right.";
		*/
		//Stap 2
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
			$oplossing .= color("red", "\\underline{".p($fx1*$a,1)."x".p($fx2*$c,0)."x"."}".p($fx1*$b,0)."y".p($fx2*$d,0)."y=".($fx1*$r).p($fx2*$s,2));
			$oplossing .=" \\\\";
			$oplossing .= color("blue",p($fy1*$a,1)."x".p($fy2*$c,0)."x"."\\underline{". p($fy1*$b,0)."y".p($fy2*$d,0)."y"."}"."=".($fy1*$r).p($fy2*$s,2));
		$oplossing .= "\\end{matrix}\\right.";
		//Stap 3
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
			$oplossing .= p($fx1*$b+$fx2*$d,1)."y=".($fx1*$r+$fx2*$s);
			$oplossing .=" \\\\";
			$oplossing .= p($fy1*$a+$fy2*$c,1)."x=".($fy1*$r+$fy2*$s);
		$oplossing .= "\\end{matrix}\\right.";
		//Stap 4
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
			$oplossing .= "y=\\frac{".($fx1*$r+$fx2*$s)."}{".($fx1*$b+$fx2*$d)."}=".$y;
			$oplossing .=" \\\\";
			$oplossing .= "x=\\frac{".($fy1*$r+$fy2*$s)."}{".($fy1*$a+$fy2*$c)."}=".$x;
		$oplossing .= "\\end{matrix}\\right.";
		//Oplossing
		$oplossing .= "\\\\ \\qquad V=\\{(".$x.",".$y.")\\}";
		
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
