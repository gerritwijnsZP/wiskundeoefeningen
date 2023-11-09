<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.rational.php"); //Gebruikt!
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
			a (bx +/- c/d) = ex + f/g
		*/
		$x =	'x';
		$a =	nietnul(-7,7);
		$b =	nietnul(-5,5);
		$t = 	nietnul(-1,1);
		$c =	nietnul(2,5);
		$d =	nietnulcopriem($c, 2, 16);
		$cd = new R($c,$d); $cd->haakjes(False); $cd->vereenvoudig();
		$e =	nietnulcopriem($a*$b,-10,10);
		$f =	nietnul(2,10);
		$g =	nietnulcopriem($f,2,16);
		$fg = new R($f,$g); $fg->haakjes(False); $fg->vereenvoudig();
		$linkerlid 	= p($a,1) . "(" . p($b,1) . $x . p($t,0) . $cd .")";
		$rechterlid	= p($e,1) . $x . '+' . $fg;
		$opgave 	= $linkerlid.'='.$rechterlid;
		//coeff in kleur
		$linkerlid 	= color('red', p($a,1)) . "(" . p($b,1) . $x . p($t,0) . $cd .")";
		$rechterlid	= p($e,1) . $x . '+' . $fg;
		$oplossing 	= "\\text{(1) Haakjes (2) Breuken weg (3) + - (4) . /} \\\\ 
					\\begin{align}
								& ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//Distributiviteit
		$cd 		= $cd->mul(abs($a));
		$cd->vereenvoudig();
		$t			*= $a/abs($a);
		$linkerlid 	= p($a*$b,1) . $x . p($t,0) . $cd;
		$rechterlid	= p($e,1) . $x . '+' . $fg;
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//kgv
		$kgv 		= kgv($cd->noemer, $fg->noemer);
		$oplossing  .= " & & & \\text{kgv van noemers ".$cd->noemer." en ".$fg->noemer." is ".$kgv ."} \\\\";
		$linkerlid 	= color('blue',$kgv) . ".(" . p($a*$b,1) . $x . p($t,0) . $cd . ")";
		$rechterlid	= "(". p($e,1) . $x . '+' . $fg .").".color('blue',$kgv);
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//Distributiviteit
		$cd			= $cd->mul($kgv); $cd->vereenvoudig(); $c = $t * $cd->teller;
		$fg			= $fg->mul($kgv); $fg->vereenvoudig(); $f = $fg->teller;
		$u			= $a*$b*$kgv;
		$v			= $e*$kgv;
		$linkerlid 	= p($u,1) . $x . color('red', p($c,2));
		$rechterlid	= color('red', p($v,1). $x)  . p($f,2);
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//+-
		$linkerlid 	= p($u,1) . $x . color('red', p($c,2)). color('blue', p(-$c,2)) . color('blue', p(-$v,0). $x);
		$rechterlid	= color('red', p($v,1). $x)  . p($f,2). color('blue', p(-$v,0). $x). color('blue', p(-$c,2)) ;
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//Uitwerken
		$linkerlid 	= p($u,1) . $x .  p(-$v,0). $x;
		$rechterlid	= $f.  p(-$c,2) ;
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//./
		$linkerlid 	= color('red',p($u-$v,1)) . $x;
		$rechterlid	= $f-$c;
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//+-
		$res		= new R($f-$c ,$u-$v);$res->haakjes(False);
		$linkerlid 	= $x;
		$rechterlid	= $res;
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ." =  " .$rechterlid. " & & \\\\";
		//oplossing
		$teller		= $res->teller;
		$res->vereenvoudig();
		if($res->teller != $teller)
		{
			$linkerlid 	= $x;
			$rechterlid	= $res;
			$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ." =  " .$rechterlid. " & & \\\\";
		}
		$oplossing	.= " & V = \\left\\{ $rechterlid \\right\\} & \\\\";
		$oplossing 	.="\\end{align}";
		$stamp		= "11.$a$b$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
