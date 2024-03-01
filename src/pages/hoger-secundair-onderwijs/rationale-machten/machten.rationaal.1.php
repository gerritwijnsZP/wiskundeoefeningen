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
	//p. 33 a-n is oef11-oef23
	//p. 32 c, d oef24-oef25
	private function oef11()
	{
		$a	= array("a","q","x","y")[rand(0,3)];
		$e  = new R(nietnul(-5,5),rand(2,6));
		$e->vereenvoudig();
		$e->haakjes(False);
		$f	= new R(nietnul(-5,5),rand(2,6));
		$f->vereenvoudig();
		$f->haakjes(False);
		$opgave 	= "$a^{".$e."}.$a^{".$f."}";
		$oplossing	= $opgave;
		if($f->teller < 0){$f->haakjes(True);}
		$oplossing .= "\\\\= $a^{ $e + $f }";
		$e = $e->add($f);
		$e->vereenvoudig();
		$e->haakjes(False);
		$oplossing .= "= $a^{".$e."}";
		$oplossing .= "\\\\".$this->solve($a,$e)."\\\\---------------";
		$stamp		= "$e.$f";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function solve($a,$e)
	{
		$oplossing = "";
		$x = $e->teller; $y = $e->noemer;
		$abs = "";
		if($y % 2 == 0){$abs = "|";}
		if($e->teller == 0)
		{
			$oplossing .= "=".proot($a,0,1);
		}elseif(($e->noemer == 1) and $e->teller < 0)
		{
			$oplossing .= "=\\frac{1}{".proot($a,abs($x),$y)."}";
		}elseif(($e->teller > 0) and ($e->noemer > 1))
		{
			$oplossing .= "=".proot($a, $e->teller, $e->noemer);
			if($e->teller >= $e->noemer)
			{
				$oplossing .= "=".$abs.proot($a, intdiv($x,$y), 1).$abs;
				$oplossing .= ".".proot($a, $x % $y, $y);
			}
		}elseif(($e->teller < 0) and ($e->noemer > 1)){
			$oplossing .= "=\\frac{1}{".proot($a, abs($e->teller), $e->noemer)."}";
			if(abs($e->teller) >= $e->noemer)
			{
				//De meest complexe
				$oplossing .= "\\\\=\\frac{1}{".$abs.proot($a, intdiv(abs($x),$y), 1).$abs.".".proot($a, abs($x) % $y, $y)."}";
				$oplossing .= "=\\frac{1}{".$abs.proot($a, intdiv(abs($x),$y), 1).$abs.".".proot($a, abs($x) % $y, $y)."}
						".color("purple", "\\frac{".proot($a,$y-(abs($x)%$y),$y)."}{".proot($a,$y-(abs($x)%$y),$y)."}");
				$oplossing .= "\\\\=\\frac{".proot($a,$y-(abs($x)%$y),$y)."}{".$abs.(proot($a,intdiv(abs($x),$y)+1,1)).$abs."}";
			}else{
				//Gewoon wortelvrij maken
				$oplossing .= "=\\frac{1}{".proot($a, abs($x), $y)."}.
							".color("purple", "\\frac{".proot($a,$y+$x,$y)."}{".proot($a,$y+$x,$y)."}");
				$oplossing .= "\\\\=\\frac{".proot($a,$y+$x,$y)."}{".$abs.$a.$abs."}";
			}
		}
		
		return $oplossing;
	}
}
