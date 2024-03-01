<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.rational.php");//Gebruikt!
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
			x/a +/- b/c = d/e x + f
		*/
		$x =	'x';
		$a =	nietnul(2,7);
		$t = 	nietnul(-1,1);
		$b =	nietnul(2,5);
		$c =	nietnulcopriem($b,6,17);
		$bc = new R($b,$c); $bc->haakjes(False); $bc->vereenvoudig();
		$e =	nietnulcopriem($a,2,7);
		$d =	nietnulcopriem($e,-8,8);
		$de = new R($d,$e); $de->haakjes(False); $de->vereenvoudig();
		$f =	nietnul(-8, 8);
		$linkerlid 	= "\\frac{".$x."}{".$a."}" .p($t,0) . $bc;
		$rechterlid	= $de.$x . p($f,2);
		$opgave 	= $linkerlid.'='.$rechterlid;
		//kgv
		$kgv		= kgv($a, kgv($bc->noemer, $de->noemer));
		$oplossing 	= "\\text{".$kgv." is het kleinste gemene veelvoud van ".$a.", ".$bc->noemer." en ".$de->noemer . "} \\\\ ";
		//kgv bij bewerking
		$linkerlid 	= color('blue',$kgv.'.')."(\\frac{".$x."}{".$a."}" .p($t,0) . $bc . ")";
		$rechterlid	= "(".$de.$x . p($f,2).")".color('blue','.'.$kgv);
		$oplossing 	.= "\\begin{align} & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//Distributiviteit, breuken vallen wel YES!
		//rx + s = ux + v
		$xa = new R($kgv, $a); $xa->haakjes(False); $xa->vereenvoudig();
		$r  = $xa->teller;
		$bc= $bc->mul($kgv);
		$bc->vereenvoudig();
		$s = $t * $bc->teller;
		$linkerlid 	= p($r,1) . $x . p($s, 2);
		
		$de= $de->mul($kgv);$de->vereenvoudig();
		$u = $de->teller;
		$v = $f * $kgv;
		$rechterlid	= p($u, 1).$x . p($v,2);
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//balansmethode
		$linkerlid 	= p($r,1) . $x . color('red', p($s, 2)) . color('blue', p(-$s, 2)) . color('blue', p(-$u, 0).$x);
		$rechterlid	= color('red', p($u, 1).$x) . p($v,2) . color('blue', p(-$u, 0).$x) . color('blue', p(-$s, 2));
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//Uitwerken
		$linkerlid 	= p($r,1) . $x .  p(-$u, 0).$x;
		$rechterlid	= $v . p(-$s, 2);
		//Uitwerken
		$linkerlid 	= p($r-$u,1) . $x;
		$rechterlid	= $v-$s;
		$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
		//Coeff
		if($r-$u != 1)
		{
			$linkerlid 	= "\\frac{".p($r-$u,1) . $x."}{".color('red',$r-$u)."}";
			$rechterlid	= new R($v-$s, $r-$u); $rechterlid->haakjes(false);
			$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ."& = & " .$rechterlid. " \\\\";
			$linkerlid 	= $x;
			$rechterlid->vereenvoudig();
			$oplossing 	.= "\\Leftrightarrow & ". $linkerlid ." =  " .$rechterlid. " & & \\\\";
		}
		$oplossing	.= " & V = \\left\\{ $rechterlid \\right\\} & \\\\";
		$oplossing 	.="\\end{align}";
		$stamp		= "11.$a$b$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
