<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

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
		$a 		= nietnul(-6,6);
		$b		= nietnul(-6,6);
		$status = "boven";
		$type	= 0;
		if(min(abs($a),abs($b))==1)
		{
			$c = nietnul(2,6)*array(-1,1)[rand(0,1)];
			//$d = nietnul(2,6)*array(-1,1)[rand(0,1)];
			$d = nietgetal(2,6,array(abs($b)))*array(-1,1)[rand(0,1)];
		}
		else
		{
			$c = array(-1,1)[rand(0,1)];
			//$d = nietnul(-6,6);
			$d		= nietgetal(2,6,array(abs($b)))*array(-1,1)[rand(0,1)];
			if(rand(0,1)==1)
			{
				$dummy = $c;
				$c = $d;
				$d = $dummy;
			}
			$status = "onder";
		}
		$x		= nietnul(-10,10);
		$y		= nietnul(-10,10);
		$r		= $a*$x+$b*$y;
		$s		= $c*$x+$d*$y;
		$opgaves = array(
							p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x".p($d,0)."y=".$s ,
							p($b,1)."y=".$r.p(-$a,0)."x"."\\\\".p($c,1)."x".p($d,0)."y=".$s ,
							p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x=".p(-$d,1)."y".p($s,2) ,
						);
		$keuze	= rand(0,2);
		$opgave = "\\left\\{\\begin{matrix}"
					.$opgaves[$keuze].
					"\\end{matrix}\\right.";
		$oplossing	= $opgave;
		//Prep
		if($status == "boven")
		{
			if($a == 1)	{ $type = 0;}
			elseif($a == -1){ $type = 1;}
			elseif($b == 1)	{ $type = 2;}
			elseif($b == -1){ $type = 3;}
		}else{
			if($c == 1)	{ $type = 4;}
			elseif($c == -1){ $type = 5;}
			elseif($d == 1)	{ $type = 6;}
			elseif($d== -1) { $type = 7;}
		}
		//Stap 0
		if($keuze != 0)
		{
			$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}"
					.p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x".p($d,0)."y=".$s.
					"\\end{matrix}\\right.";
			$oplossing .= "\\text{(Niet verplichte stap, proper schrijven)}";
		}
		//Stap 1
		$stap1 = array(
						p($a,1)."x=".p(-$b,1)."y".p($r,2) ."\\\\ ".p($c,1)."x".p($d,0)."y=".$s,
						p($b,1)."y".p(-$r,2)."=".p(-$a,1)."x\\\\".p($c,1)."x".p($d,0)."y=".$s,
						p($b,1)."y=".p(-$a,1)."x".p($r,2) ."\\\\ ".p($c,1)."x".p($d,0)."y=".$s,
						p($a,1)."x".p(-$r,2)."=".p(-$b,1)."y\\\\".p($c,1)."x".p($d,0)."y=".$s,
						p($a,1)."x".p($b,0)."y=".$r."\\\\ ".p($c,1)."x=".p(-$d,1)."y".p($s,2),
						p($a,1)."x".p($b,0)."y=".$r."\\\\ ".p($d,1)."y".p(-$s,2)."=".p(-$c,1)."x",
						p($a,1)."x".p($b,0)."y=".$r."\\\\ ".p($d,1)."y=".p(-$c,1)."x".p($s,2),
						p($a,1)."x".p($b,0)."y=".$r."\\\\ ".p($c,1)."x".p(-$s,2)."=".p(-$d,1)."y",
					);
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
		$oplossing .= $stap1[$type];
		$oplossing .= "\\end{matrix}\\right.";
		$oplossing .= "\\text{(Afzonderen onbekende met coëff. 1)}";
		//Stap 2
		$stap2 = array(
						p($a,1)."x=".p(-$b,1)."y".p($r,2) ."\\\\ ".p($c,1).".\\left(".p(-$b,1)."y".p($r,2)."\\right)".p($d,0)."y=".$s,
						p(-$a,1)."x=".p($b,1)."y".p(-$r,2)."\\\\ ".p($c,1).".\\left(".p($b,1)."y".p(-$r,2)."\\right)".p($d,0)."y=".$s,
						p($b,1)."y=".p(-$a,1)."x".p($r,2) ."\\\\ ".p($c,1)."x".p($d,0)."\\left(".p(-$a,1)."x".p($r,2)."\\right)=".$s,
						p(-$b,1)."y=".p($a,1)."x".p(-$r,2) ."\\\\ ".p($c,1)."x".p($d,0)."\\left(".p($a,1)."x".p(-$r,2)."\\right)=".$s,
						p($a,1)."\\left(".p(-$d,1)."y".p($s,2)."\\right)".p($b,0)."y=".$r. "\\\\".p($c,1)."x=".p(-$d,1)."y".p($s,2),
						p($a,1)."\\left(".p($d,1)."y".p(-$s,2)."\\right)".p($b,0)."y=".$r. "\\\\".p(-$c,1)."x=".p($d,1)."y".p(-$s,2),
						p($a,1)."x".p($b,0)."\\left(".p(-$c,1)."x".p($s,2)."\\right)=".$r. "\\\\".p($d,1)."y=".p(-$c,1)."x".p($s,2),
						p($a,1)."x".p($b,0)."\\left(".p($c,1)."x".p(-$s,2)."\\right)=".$r. "\\\\".p(-$d,1)."y=".p($c,1)."x".p(-$s,2),
					);
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
		$oplossing .= $stap2[$type];
		$oplossing .= "\\end{matrix}\\right.";
		$oplossing .= "\\text{(Substitutie!)}";
		//Stap 3
		$stap3 = array(
						p($a,1)."x=".p(-$b,1)."y".p($r,2) ."\\\\ ".p(-$b*$c,1)."y".p($r*$c,2).p($d,0)."y=".$s,
						p(-$a,1)."x=".p($b,1)."y".p(-$r,2)."\\\\ ".p($b*$c,1)."y".p(-$r*$c,2).p($d,0)."y=".$s,
						p($b,1)."y=".p(-$a,1)."x".p($r,2) ."\\\\ ".p($c,1)."x".p(-$a*$d,0)."x".p($r*$d,2)."=".$s,
						p(-$b,1)."y=".p($a,1)."x".p(-$r,2) ."\\\\ ".p($c,1)."x".p($a*$d,0)."x".p(-$r*$d,2)."=".$s,
						p(-$d*$a,1)."y".p($s*$a,2).p($b,0)."y=".$r. "\\\\".p($c,1)."x=".p(-$d,1)."y".p($s,2),
						p($d*$a,1)."y".p(-$s*$a,2).p($b,0)."y=".$r. "\\\\".p(-$c,1)."x=".p($d,1)."y".p(-$s,2),
						p($a,1)."x".p(-$c*$b,0)."x".p($s*$b,2)."=".$r. "\\\\".p($d,1)."y=".p(-$c,1)."x".p($s,2),
						p($a,1)."x".p($c*$b,0)."x".p(-$s*$b,2)."=".$r. "\\\\".p(-$d,1)."y=".p($c,1)."x".p(-$s,2),
					);
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
		$oplossing .= $stap3[$type];
		$oplossing .= "\\end{matrix}\\right.";
		$oplossing .= "\\text{(Distributie)}";
		//Stap 4
		$stap4 = array(
						p($a,1)."x=".p(-$b,1)."y".p($r,2) ."\\\\ ".p(-$b*$c+$d,1)."y"."=".$s.p(-$r*$c,2)."=".($s-$r*$c),
						p(-$a,1)."x=".p($b,1)."y".p(-$r,2)."\\\\ ".p($b*$c+$d,1)."y"."=".$s.p( $r*$c,2)."=".($s+$r*$c),
						p($b,1)."y=".p(-$a,1)."x".p($r,2) ."\\\\ ".p($c-$a*$d,1)."x"."=".$s.p(-$r*$d,2)."=".($s-$r*$d),
						p(-$b,1)."y=".p($a,1)."x".p(-$r,2) ."\\\\ ".p($c+$a*$d,1)."x"."=".$s.p( $r*$d,2)."=".($s+$r*$d),
						p(-$d*$a+$b,1)."y"."=".$r.p(-$s*$a,2)."=".($r-$s*$a). "\\\\".p($c,1)."x=".p(-$d,1)."y".p($s,2),
						p($d*$a+$b,1)."y"."=".$r.p( $s*$a,2)."=".($r+$s*$a). "\\\\".p(-$c,1)."x=".p($d,1)."y".p(-$s,2),
						p($a-$c*$b,1)."x"."=".$r.p(-$s*$b,2)."=".($r-$s*$b). "\\\\".p($d,1)."y=".p(-$c,1)."x".p($s,2),
						p($a+$c*$b,1)."x"."=".$r.p( $s*$b,2)."=".($r+$s*$b). "\\\\".p(-$d,1)."y=".p($c,1)."x".p(-$s,2),
					);
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
		$oplossing .= $stap4[$type];
		$oplossing .= "\\end{matrix}\\right.";
		//Stap 5
		$stap5 = array(
						p($a,1)."x=".p(-$b,1)."y".p($r,2) .	"\\\\ y=\\frac{".($s-$r*$c)."}{".(-$b*$c+$d)."}=".$y,
						p(-$a,1)."x=".p($b,1)."y".p(-$r,2) ."\\\\ y=\\frac{".($s+$r*$c)."}{".( $b*$c+$d)."}=".$y,
						p($b,1)."y=".p(-$a,1)."x".p($r,2) .	"\\\\ x=\\frac{".($s-$r*$d)."}{".( $c-$a*$d)."}=".$x,
						p(-$b,1)."y=".p($a,1)."x".p(-$r,2) ."\\\\ x=\\frac{".($s+$r*$d)."}{".( $c+$a*$d)."}=".$x,
						"y = \\frac{".($r-$s*$a)."}{".(-$d*$a+$b)."} = ".$y." \\\\ ".p($c,1)."x=".p(-$d,1)."y".p($s,2),
						"y = \\frac{".($r+$s*$a)."}{".( $d*$a+$b)."} = ".$y." \\\\ ".p(-$c,1)."x=".p($d,1)."y".p(-$s,2),
						"x = \\frac{".($r-$s*$b)."}{".($a-$c*$b)."} = ".$x." \\\\ ".p($d,1)."y=".p(-$c,1)."x".p($s,2),
						"x = \\frac{".($r+$s*$b)."}{".($a+$c*$b)."} = ".$x." \\\\ ".p(-$d,1)."y=".p($c,1)."x".p(-$s,2),
					);
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
		$oplossing .= $stap5[$type];
		$oplossing .= "\\end{matrix}\\right.";
		//Stap 6
		$stap6 = array(
						p($a,1)."x=".p(-$b,1).".(".$y.")".p($r,2) ."=".$x . "\\\\ y=".$y,
						p(-$a,1)."x=".p($b,1).".(".$y.")".p(-$r,2) ."=".$x. "\\\\ y=".$y,
						p($b,1)."y=".p(-$a,1).".(".$x.")".p($r,2) ."=".$y."\\\\ x=".$x,
						p(-$b,1)."y=".p($a,1).".(".$x.")".p(-$r,2) ."=".$y."\\\\ x=".$x,
						"y = ".$y." \\\\ ".p($c,1)."x=".p(-$d,1).".(".$y.")".p($s,2)."=".$x,
						"y = ".$y." \\\\ ".p(-$c,1)."x=".p($d,1).".(".$y.")".p(-$s,2)."=".$x,
						"x = ".$x." \\\\ ".p($d,1)."y=".p(-$c,1).".(".$x.")".p($s,2)."=".$y,
						"x = ".$x." \\\\ ".p(-$d,1)."y=".p($c,1).".(".$x.")".p(-$s,2)."=".$y,
					);
		$oplossing .= "\\\\ \\Leftrightarrow \\left\\{\\begin{matrix}";
		$oplossing .= $stap6[$type];
		$oplossing .= "\\end{matrix}\\right.";
		//Stap 7
		$oplossing .= "\\\\ \\qquad V=\\{(".$x.",".$y.")\\}";
		
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
