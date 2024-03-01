<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.rational.php");
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
		if(min(abs($a),abs($b))==1)
		{
			$c = nietnul(2,6)*array(-1,1)[rand(0,1)];
			$d = nietnul(2,6)*array(-1,1)[rand(0,1)];
		}
		else
		{
			$c = array(-1,1)[rand(0,1)];
			$d = nietnul(-6,6);
			if(rand(0,1)==1)
			{
				$dummy = $c;
				$c = $d;
				$d = $dummy;
			}
			$status = "onder";
		}
		$z		= new R(1,1);
		$x		= $z->rand();$x->haakjes(false);$x->vereenvoudig();
		$y		= $z->rand();$y->haakjes(false);$y->vereenvoudig();
		$stapr1 = $x->mul($a);
		$stapr2 = $y->mul($b);
		$r 		= $stapr2->add($stapr1);$r->haakjes(false);$r->vereenvoudig();
		$staps1 = $x->mul($c);
		$staps2 = $y->mul($d);
		$s 		= $staps2->add($staps1);$s->haakjes(false);$s->vereenvoudig();
		//$r		= $a*$x+$b*$y;
		//$s		= $c*$x+$d*$y;
		$opgaves = array(
							p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x".p($d,0)."y=".$s ,
							p($b,1)."y=".$r.p(-$a,0)."x"."\\\\".p($c,1)."x".p($d,0)."y=".$s ,
							p($a,1)."x".p($b,0)."y=".$r ."\\\\".p($c,1)."x=".p(-$d,1)."y+".$s ,
						);
		$opgave = "\\left\\{\\begin{matrix}"
					.$opgaves[rand(0,2)].
					"\\end{matrix}\\right.";
		$oplossing	= $opgave;
		$oplossing .= "\\qquad V=\\{(".$x.",".$y.")\\}";
		
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
