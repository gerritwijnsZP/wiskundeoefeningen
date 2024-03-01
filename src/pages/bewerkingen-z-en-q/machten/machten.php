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

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,16);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 33 a-n is oef11-oef23
	//p. 32 c, d oef24-oef25
	private function oef11()
	{
		$r  = new R(1,1);
		$r  = $r->randav();
		$e 	= nietnul(-6,-1);
		$opgave 	= "(-".$r.")^{".$e."}";
		$oplossing	= $opgave;
		$r->omgekeerde();
		$e	= abs($e);
		$oplossing 	.= "=(-".$r.")^{".$e."}";
		$teken = "";
		if($e % 2 == 1){$teken = "-";}else{$teken = "+";}
		$oplossing .= "=".$teken."\\frac{".$r->teller."^{".$e."}}{".$r->noemer."^{".$e."}}";
		if($e % 2 == 0){$teken = "";}
		$r = $r->pow($e);
		if(abs($e) > 2){ $oplossing .= "=\\text{ZRM}";}
		$oplossing	.= "= \\left[=".$teken.$r."\\right]";
		$stamp		= '11.'.($r->teller).($r->noemer).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$r  = new R(1,1);
		$r  = $r->randav();
		$e 	= nietnul(-6,-1);
		$opgave 	= "-(-".$r.")^{".$e."}";
		$oplossing	= $opgave;
		$r->omgekeerde();
		$e	= abs($e);
		$oplossing 	.= "=-(-".$r.")^{".$e."}";
		$teken = "";
		if($e % 2 == 0){$teken = "-";}else{$teken = "+";}
		$oplossing .= "=".$teken."\\frac{".$r->teller."^{".$e."}}{".$r->noemer."^{".$e."}}";
		if($teken =="+"){$teken = "";}
		$r = $r->pow($e);
		if(abs($e) > 2){ $oplossing .= "=\\text{ZRM}";}
		$oplossing	.= "\\left[=".$teken.$r."\\right]";
		$stamp		= '12.'.($r->teller).($r->noemer).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$r  = new R(1,1);
		$r  = $r->randav();
		$a 	= array("a","b","c","x","y")[rand(0,4)];
		$e 	= nietnul(-10,10);
		$f  = nietnul(-10,10);
		$opgave 	= "($r$a)^{".$e."}.($r$a)^{".$f."}";
		$oplossing	= $opgave;
		if($f < 0){$bla = "(".$f.")";}else{$bla = $f;}
		$oplossing 	.= "=($r$a)^{".$e."+".$bla."}";
		$g = $e + $f;
		$oplossing 	.= "=($r$a)^{".$g."}";
		if($g < 0)
		{
			$r->omgekeerde();
			$fa = "\\frac{1}{".$a."}";
			$g = abs($g);
			$oplossing 	.= "=($r$fa)^{".$g."}";
			$r = $r->pow($g);
			$oplossing 	.= "\\left[=$r \\frac{1}{".$a."^{".$g."}}\\right]";
		}else{
			$r = $r->pow($g);
			$oplossing 	.= "\\left[=$r$a^{".$g."}\\right]";
		}
		if(abs($g) > 2){ $oplossing .= "=\\text{ZRM}";}
		if($g == 0){$oplossing 	.= "\\left[=$r\\right]";}
		$stamp		= '13.'.($r->teller).($r->noemer).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{
		$r  = new R(1,1);
		$r  = $r->randav();
		$a 	= array("a","b","c","x","y")[rand(0,4)];
		$e 	= nietnul(-10,10);
		$f  = nietnul(-10,10);
		$opgave 	= "($r$a)^{".$e."}:($r$a)^{".$f."}";
		$oplossing	= $opgave;
		if($f < 0){$bla = "(".$f.")";}else{$bla = $f;}
		$oplossing 	.= "=($r$a)^{".$e."-".$bla."}";
		$g = $e - $f;
		$oplossing 	.= "=($r$a)^{".$g."}";
		$opl = "";
		if($g < 0)
		{
			$r->omgekeerde();
			$fa = "\\frac{1}{".$a."}";
			$g = abs($g);
			$oplossing 	.= "=($r$fa)^{".$g."}";
			$r = $r->pow($g);
			$opl 	= "=$r \\frac{1}{".$a."^{".$g."}}";
		}else{
			$r = $r->pow($g);
			$opl 	= "=$r$a^{".$g."}";
		}
		if(abs($g) > 2){ $oplossing .= "=\\text{ZRM}";}
		if($g == 0){$oplossing 	.= $opl."\\left[= $r \\right]";}
		else{ $oplossing .= "\\left[ $opl \\right]"; }
		$stamp		= '14.'.($r->teller).($r->noemer).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef15()
	{
		$r  = new R(1,1);
		$r  = $r->randav();
		$q  = new R(1,1);
		$q 	= $q->randav();
		$e 	= nietnul(-10,10);
		$opgave 	= "($r)^{".$e."}.($q)^{".$e."}";
		$oplossing	= $opgave;
		$oplossing 	.= "=($r$q)^{".$e."}";
		$p  = $r->mul($q);
		$p->vereenvoudig();
		$oplossing 	.= "=($p)^{".$e."}";
		if($e < 0)
		{
			$p->omgekeerde();
			$e = abs($e);
			$oplossing 	.= "=($p)^{".$e."}";
		}
		$p = $p->pow($e);
		if(abs($e) > 2){ $oplossing .= "=\\text{ZRM}";}
		$oplossing .= "=\\left[".$p."\\right]";
		$stamp		= '15.'.($r->teller).($r->noemer).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef16()
	{
		$r  = new R(nietnul(-20,20),1);
		$r->haakjes(false);
		$a 	= array("a","b","c","x","y")[rand(0,4)];
		$ae = nietnul(2,10);
		$e 	= array(nietnul(-10,-2),nietnul(2,10))[rand(0,1)];
		$opgave 	= "($r$a^{".$ae."})^{".$e."}";
		$oplossing	= $opgave;
		$oplossing .= "=($r)^{".$e."}.($a^{".$ae."})^{".$e."}";
		$bla ="";
		if($e < 0)
		{
			$r->omgekeerde();
			$e = abs($e);
			$bla = "\\frac{1}{".$a."^{".$ae."}"."}";
			$oplossing .= "=($r)^{".$e."}.($bla)^{".$e."}";
		}
		$r = $r->pow($e);
		$g = $e * $ae;
		if(abs($g) > 2){ $oplossing .= "=\\text{ZRM}";}
		if($bla == ""){
			$oplossing .= "\\left[=$r$a^{".$g."}\\right]";
		}else{
			$oplossing .= "\\left[=$r \\frac{1}{".$a."^{".$g."}}\\right]";
		}
		
		$stamp		= '16.'.($r->teller).($r->noemer).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
