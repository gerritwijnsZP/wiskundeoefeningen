<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.rational.php"); //Gebruikt!
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
		/*
			a(bx + c) = d +/- (e + fx)
		*/
		$x =	'x';
		$a =	nietnul(2,6);
		$b =	nietnul(-6,6);
		$c =	nietnul(-7,7);
		$d =	nietnul(-15,15);
		$t =	nietnul(-1,1);
		$e =	nietnul(-15,15);
		$f =	nietnulcopriem(abs($a*$b), -5, 5);
		$linkerlid 	= p($a,1).'('.p($b,1).$x.p($c,2).')';
		$rechterlid	= $d.p($t,0).'('.$e.p($f,0).$x.')';
		$opgave 	= $linkerlid.'='.$rechterlid;
		
		//Coeff in kleur a(bx + c) = d teken (e + fx)
		$linkerlid 	= color('red', p($a,1)).'('.p($b,1).$x.p($c,2).')';
		$rechterlid	= $d.color('red', p($t,0) ) . '('.$e.p($f,0).$x.')';
		$oplossing 	= "\\begin{align} & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//Distr abx + ac = d + te + tfx
		$linkerlid 	= p($a*$b,1).$x . p($a*$c, 2);
		$rechterlid	= $d . p($t*$e,2) . p($t*$f,0).$x;
		$oplossing	.="\\Leftrightarrow & ".$linkerlid . "& = &" .$rechterlid. " \\\\";
		//Rechterlid verder uitrekenen + over te brengen delen
		$linkerlid 	= p($a*$b,1).$x . color('red',p($a*$c, 2));
		$rechterlid	= ($d+$t*$e) . color('red',p($t*$f,0).$x);
		$oplossing	.="\\Leftrightarrow & ".$linkerlid . "& = &" .$rechterlid. " \\\\";
		//Balansmethode
		$linkerlid 	= p($a*$b,1).$x . color('red',p($a*$c, 2)) . color('blue',p(-$a*$c, 2)) . color('blue',p(-$t*$f,0).$x);
		$rechterlid	= ($d+$t*$e) . color('red',p($t*$f,0).$x)  . color('blue',p(-$t*$f,0).$x). color('blue',p(-$a*$c, 2));
		$oplossing	.="\\Leftrightarrow & ".$linkerlid . "& = &" .$rechterlid. " \\\\";
		//Uitwerken
		$linkerlid 	= p($a*$b,1).$x . p(-$t*$f,0).$x;
		$rechterlid	= ($d+$t*$e) . p(-$a*$c, 2);
		$oplossing	.="\\Leftrightarrow & ".$linkerlid . "& = &" .$rechterlid. " \\\\";
		//Uitwerken
		$linkerlid 	= p($a*$b-$t*$f,1).$x;
		$rechterlid	= $d+$t*$e-$a*$c;
		$oplossing	.="\\Leftrightarrow & ".$linkerlid . "& = &" .$rechterlid. " \\\\";
		//Coefficient delen
		$alfa		= $a*$b-$t*$f;
		$beta		= $d+$t*$e-$a*$c;
		if($alfa != 1)
		{
			$linkerlid 	= "\\frac{".p($alfa,1).$x ."}{".color('red',$alfa)."}";
			$rechterlid	= "\\frac{". $beta ."}{".color('red',$alfa)."}";
			$oplossing	.="\\Leftrightarrow & ".$linkerlid . "& = &" .$rechterlid. " \\\\";
			$res 	= new R($beta, $alfa);
			$res->haakjes(False);
			$res->vereenvoudig();
			$oplossing	.="\\Leftrightarrow & ".$x . " = " .$res. "  & & \\\\";
			$oplossing	.= " & V = \\left\\{ $res \\right\\} & \\\\";
		}
		else
		{
			$oplossing	.= " & V = \\left\\{ $rechterlid \\right\\} & \\\\";
		}
		$oplossing 	.="\\end{align}";
		$stamp		= "11.$a$b$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
