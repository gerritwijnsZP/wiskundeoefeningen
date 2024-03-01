<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.rational.php"); //Effectief gebruikt (oef 25 ev)

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,28);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 33 a-n is oef11-oef23
	//p. 32 c, d oef24-oef25
	private function oef11()
	{
		$a 	= nietnul(-20,20);
		$b	= nietnul(2,20);
		$c 	= nietnul(-20,-2);
		$opgave 	= $a . '+' . $b .'.('.$c.')';
		$oplossing	= $opgave;
		$oplossing 	.= '=' . $a . '+' . '(' . $b*$c.')';
		$oplossing	.= '=' . ($a + $b * $c);
		$stamp		= '11.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a 	= nietnul(-20,20);
		$c	= nietnul(-10, -2);
		$b 	= abs($c * nietnul(2,15));
		$opgave 	= $a . "+" . $b . ":(" . $c . ")";
		$oplossing  = $opgave;
		$oplossing 	.= "=" . $a . "+ (" . $b / $c . ")";
		$oplossing 	.= "=" . ($a + ($b / $c));
		$stamp 		= '12'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$a	= nietnul(-20, -2);
		$b 	= nietnul(-20, -2);
		$c 	= nietnul(2,20);
		$opgave = "(".$a.").(".$b.")+".$c;
		$oplossing = $opgave;
		$oplossing .= "=" .($a*$b)."+".$c;
		$oplossing .= "=" .($a*$b+$c);
		$stamp 		= '13'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		$c 	= nietnul(2,7);
		$b	= $c * nietnul(2, 5);
		$a 	= abs($b * nietnul(2,7));
		$d 	= nietnul(1,20);
		$opgave = $a . "-" . $b . ":" . $c . "+" . $d;
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '-' .($b/$c) . '+' . $d;
		$oplossing .= "=" . ($a - ($b / $c) + $d);
		$stamp 		= '14'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef15()
	{
		$a	= nietnul(-20, -2);
		$b 	= nietnul(2, 20);
		$c 	= nietnul(2,20);
		$opgave = $a . '.'. $b .'^2+'. $c;
		$oplossing = $opgave;
		$oplossing .= "=" .$a . '.'. pow($b, 2) .'+'. $c;
		$oplossing .= "=" .($a * pow($b, 2)) .'+'. $c;
		$oplossing .= "=" .(($a * pow($b, 2)) + $c);
		$stamp 		= '15'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef16()
	{
		$a	= nietnul(2, 20);
		$b 	= nietnul(2, 20);
		$c 	= nietnul(2,20);
		$d 	= nietnul(-20, -2);
		$opgave = $a . '+' . $b . '-' . $c .'.('. $d . ')';
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '+' . $b . '+' . abs($c * $d);
		$oplossing .= "=" . ($a + $b - ($c * $d));
		$stamp 		= '16'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef17()
	{
		$b	= nietnul(2, 10);
		$a 	= nietnul(-10, -2)*$b;
		$d 	= nietnul(-10, -2);
		$c 	= abs($b*$d);
		$opgave = $a . ':' . $b . '+' . $c .':('. $d . ')';
		$oplossing = $opgave;
		$oplossing .= "=" . ($a / $b) . '+(' . ($c / $d ).')';
		$oplossing .= "=" . (($a / $b) + ($c / $d ));
		$stamp 		= '17'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef18()
	{
		$a 	= nietnul(-15, -2);
		$b 	= nietnul(2,8);
		$c 	= nietnul(-10,-2);
		$d 	= nietnul(2,20);
		$e 	= nietnul(2,20);
		$opgave = $a . '-' . $b . '.(' . $c .'-'. $d . ')+'.$e;
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '-' . $b . '.(' . ($c - $d) . ')+'.$e;
		$oplossing .= "=" . $a . '-' . '('. ($b*($c - $d)) . ')+'.$e;
		$oplossing .= "=" . ($a - ($b*($c - $d)) + $e);
		$stamp 		= '18'.$a.$b.$c.$d.$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef19()
	{
		$a 	= nietnul(2, 10);
		$b 	= nietnul(2,10);
		$c 	= nietnul(2,10);
		$d 	= nietnul(2,10);
		$opgave = $a . '+' . $b . '.' . $c .'^2-'. $d;
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '+' . $b . '.' . pow($c,2).'-'. $d;
		$oplossing .= "=" . $a . '+' . ($b * pow($c,2)).'-'. $d;
		$oplossing .= "=" . ($a + ($b * pow($c,2))- $d);
		$stamp 		= '19'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef20()
	{
		$a 	= nietnul(2, 8);
		$b 	= nietnul(2, 5);
		$c 	= $a;
		$d 	= $b;
		$opgave = $a . '.' . $b . '^2+(' . $c .'.'. $d.')^2';
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '.' . $b . '^2+(' . ($c * $d).')^2';
		$oplossing .= "=" . $a . '.' . pow($b,2) . '+' . pow(($c * $d),2);
		$oplossing .= "=" . ($a * pow($b,2)) . '+' . pow(($c * $d),2);
		$oplossing .= "=" . (($a * pow($b,2)) + pow(($c * $d),2));
		$stamp 		= '20'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef21()
	{
		$a 	= nietnul(2, 10);
		$c 	= nietnul(2,10);
		$d 	= nietnul(2,12);
		$dummy = rand(2,20);
		$b = pow($dummy,2)+$c*pow($d,2);
		$opgave = $a . '-\\sqrt{' . $b . '-' . $c .'.'. $d .'^2}';
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '-\\sqrt{' . $b . '-' . $c .'.'. pow($d,2) .'}';
		$oplossing .= "=" . $a . '-\\sqrt{' . $b . '-' . ($c * pow($d,2)) .'}';
		$oplossing .= "=" . $a . '-\\sqrt{' . ($b - ($c * pow($d,2))) .'}';
		$oplossing .= "=" . $a . '-'.$dummy;
		$oplossing .= "=" . ($a - $dummy);
		$stamp 		= '21'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef22()
	{
		$a 	= nietnul(2, 10);
		$b = nietnul(2,5);
		$c 	= nietnul(2,10);
		$d 	= nietnul(2,12);
		$opgave = $a . '+' . $b . '.(' . $c .'^2-'. $d .')';
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '+' . $b . '.(' . pow($c,2) .'-'. $d .')';
		$oplossing .= "=" . $a . '+' . $b . '.(' . (pow($c,2) - $d) .')';
		$oplossing .= "=" . $a . '+' . ($b * (pow($c,2) - $d));
		$oplossing .= "=" . ($a + ($b * (pow($c,2) - $d)));
		$stamp 		= '22'.$a.$b.$c.$d;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef23()
	{
		$a 	= nietnul(2, 10);
		$b 	= nietnul(2,10);
		$c 	= nietnul(2,10);
		$e 	= nietnul(2,6);
		$d 	= nietnul(2,12)*$e;
		$f 	= nietnul(2,10);
		$opgave = $a . '+' . $b . '.' . $c .'-'. $d .':' . $e .'+'.$f;
		$oplossing = $opgave;
		$oplossing .= "=" . $a . '+' . ($b * $c) .'-'. ($d / $e) .'+'.$f;
		$oplossing .= "=" . ($a + ($b * $c) - ($d / $e) + $f);
		$stamp 		= '23'.$a.$b.$c.$d.$e.$f;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef24()
	{
		//32c
		$a 	= nietnul(2, 10);
		$b 	= nietnul(-10,-2);
		$c 	= nietnul(2,10);
		$d 	= nietnul(-10,-2);
		$e 	= nietnul(2,10);
		$opgave = $a . '.(' . $b . ')-' . $c .'.('. $d .')-' . $e;
		$oplossing = $opgave;
		$oplossing .= "=" .($a * $b) . '+' . abs($c * $d) .'-' . $e;
		$oplossing .= "=" .(($a * $b) + abs($c * $d) - $e);
		$stamp 		= '24'.$a.$b.$c.$d.$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef25()
	{
		//32d
		$a 	= nietnul(-10, -2);
		$dummy 	= new R(1,1);
		$dummy 	= $dummy->rand();
		$dummy->vereenvoudig();
		$dummy 	= $dummy->abs();
		$b	= $dummy->mul($dummy);
		$c 	= $b->rand();
		$c->haakjes(false);
		$d 	= nietnul(2,9);
		$e 	= nietnul(-4,-2);
		$opgave = $a . '.\\sqrt{' . $b . '}-\\left[(' . $c .'-'. $d .')-(' . $e.')^3\\right]';
		$oplossing = $opgave;
		$c->vereenvoudig();
		$oplossing .= "=" .$a . '.' . $dummy . '-\\left[(' . $c .'-'. $d .')+' . abs(pow($e,3)).'\\right]';
		$a = new R($a, 1);
		$x = $dummy->mul($a);
		$x->vereenvoudig();
		$x->haakjes(false);
		$d = new R($d,1);
		$y = $c->sub($d);
		$y->vereenvoudig();
		$z = new R(abs(pow($e,3)), 1);
		$oplossing .= "=" .$x . '-\\left['.$y.'+'.$z .'\\right]';
		$w  = $y->add($z);
		$w->vereenvoudig();
		$w->haakjes(false);
		$oplossing .= "=" .$x . '-\\left['.$w.'\\right]';
		$v = $x->sub($w);
		$v->vereenvoudig();
		$v->haakjes(false);
		$oplossing .= "=" .$v;
		
		$stamp 		= '25'.$a.$d.$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef26()
	{
		$a = nietnul(2,16);
		$b = nietnulcopriem($a,2, 8);
		$d = 2*$b;
		$c = nietnulcopriem($d, 2, 16);
		$opgave = "\\sqrt{\\dfrac{".($a*$a)."}{".($b*$b)."}}-\\left(\\dfrac{".$c."}{".$d."}\\right)^2";
		$oplossing = $opgave;
		$oplossing .= "= \\dfrac{".$a."}{".$b."} - \\dfrac{".($c*$c)."}{".($d*$d)."}";
		$kgv		= kgv($b, $d*$d);
		$ggd		= ggd($b, $d*$d);
		$oplossing .= "= \\dfrac{".($a*$d*$d/$b)."}{".($d*$d)."} - \\dfrac{".($c*$c)."}{".($d*$d)."}";
		$oplossing .= "= \\dfrac{".($a*$d*$d/$b-$c*$c)."}{".$kgv."}";
		$ggdx = ggd($a*$d*$d/$b-$c*$c, $kgv);
		if($ggdx > 1)
		{
			$oplossing .= "=\\dfrac{".(($a*$d*$d/$b-$c*$c)/$ggdx)."}{".($kgv/$ggdx)."}";
		}
		$stamp 		= '26'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef27()
	{	//a/b - c/b . d/c
		$a = nietnul(5,16);
		$c = $a - nietnul(1,4);
		$b = nietnulcopriem($a*$c,2, 7);
		$d = nietnulcopriem($c, 2, 12);
		$opgave = "\\dfrac{".$a."}{".$b."}-\\dfrac{".$c."}{".$b."}\\cdot\\dfrac{".$d."}{".$c."}";
		$oplossing = $opgave;
		$oplossing .= "= \\dfrac{".$a."}{".$b."}-\\dfrac{".$c."\\cdot ".$d."}{".$b."\\cdot".$c."}";
		$oplossing .= "= \\dfrac{".$a."}{".$b."}-\\dfrac{".$d."}{".$b."}";
		$oplossing .= "= \\dfrac{".$a."-".$d."}{".$b."}";
		$oplossing .= "= \\dfrac{".($a-$d)."}{".$b."}";
		$ggd = ggd($a-$d,$b);
		if ($ggd > 1)
		{
			$oplossing .= "= \\dfrac{".(($a-$d)/$ggd)."}{".($b/$ggd)."}";
		}
		$stamp 		= '27'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef28()
	{	//-f/s . bla/(f*n) - 1/n
		$factor = nietnul(4,7);
		$small	= nietnulcopriem($factor,2,5);
		$noemer	= nietnulcopriem($small,7,13);
		$salt 	= $noemer - nietnulcopriem($small,2,5);
		$bla = $small * $salt;
		
		$opgave = "\\left(-\\dfrac{".$factor."}{".$small."}\\cdot\\dfrac{".$bla."}{".($factor*$noemer)."}-\\dfrac{1}{".$noemer."}\\right)^2";
		$oplossing = $opgave;
		$oplossing .= "= \\left(-\\dfrac{".$factor.".".$bla."}{".$small.".".($factor*$noemer)."}-\\dfrac{1}{".$noemer."}\\right)^2";
		$tlr = $bla;
		$nmr = $small*$noemer;
		$ggd = ggd($tlr, $nmr);
		if($ggd > 1)
		{
			$tlr /= $ggd;
			$nmr /= $ggd;
		}
		$oplossing .= "= \\left(-\\dfrac{".$tlr."}{".$nmr."}-\\dfrac{1}{".$noemer."}\\right)^2";
		$ggdx = ggd($nmr, $noemer);
		if($ggdx > 1)
		{
			$oplossing .= "= \\left(-\\dfrac{".$tlr*$noemer/$ggdx."}{".($nmr*$noemer/$ggdx)."}-\\dfrac{".$nmr/$ggdx."}{".($nmr*$noemer/$ggdx)."}\\right)^2";
			$oplossing .= "= \\left(\\dfrac{".(-$tlr*$noemer/$ggdx-$nmr/$ggdx)."}{".($nmr*$noemer/$ggdx)."}\\right)^2";
		}
		
		$tlrx = -$tlr*$noemer/$ggdx-$nmr/$ggdx;
		$nmrx = $nmr*$noemer/$ggdx;
		$ggd = ggd($tlrx,$nmrx);
		if ($ggd > 1)
		{
			$tlrx /= $ggd;
			$nmrx /= $ggd;
			$oplossing .= "= \\left(\\dfrac{".$tlrx."}{".($nmrx)."}\\right)^2";
		}
		if($nmrx != 1)
		{
			$oplossing .= "= \\dfrac{".($tlrx*$tlrx)."}{".($nmrx*$nmrx)."}";
		}else{
				$oplossing .= "= ".($tlrx*$tlrx);
		}
		$stamp 		= '28'.$factor.$small;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
