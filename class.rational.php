<?php
require_once('class.math.php');
class R
{
	public $teller;
	public $noemer;
	private $haakjes;
	public function __construct($t, $n)
	{
		$this->teller = $t;
		$this->noemer = $n;
		$this->haakjes = $this->teller / $this->noemer < 0;
			
	}
	public function vereenvoudig()
	{
		if($this->noemer < 0)
		{
			$this->teller *= -1;
			$this->noemer *= -1;
		}
		$ggd = ggd(abs($this->teller), abs($this->noemer)); //abs tussen haakjes ipv er rond om devideByZero Error te voorkomen (16 feb '21)
		$this->teller /= $ggd;
		$this->noemer /= $ggd;
	}
	public function haakjes($bla=True)
	{
		$this->haakjes = $bla;
	}
	public function teken()
	{
		if($this->teller/$this->noemer < 0){return "-";}else{return "+";}
	}
	public function abs()
	{
		return new R(abs($this->teller),abs($this->noemer));
	}
	public function kleinerDan(R $r):bool
	{
		return ($this->teller/$this->noemer) < ($r->teller/$r->noemer);
	}
	public function __toString(): string
	{
		if($this->noemer == 1)
		{
			if($this->haakjes)
			{
				return "(".$this->teller.")";
			}
			else
			{
				return $this->teller;
			}
		}
		elseif($this->noemer == 0)
		{
			if($this->teller >= 0)
			{
				return "\\inf";
			}else{
				return "-\\inf";
			}
		}
		else
		{
			if($this->haakjes)
			{
				return "(\\frac{".$this->teller."}{".$this->noemer."})";
			}
			else
			{
				return "\\frac{".$this->teller."}{".$this->noemer."}";	
			}
		}
	}
	public function rand()
	{
		return new R(nietnul(-20,20), nietnul(1,20));
	}
	public function randav()
	{
		$r = new R(1,1);
		while($r->teller == 1)
		{	
			$r  = $r->rand();
			$r 	= $r->abs();
			$r->vereenvoudig();
		}
		return $r;
	}
	public function add($r) : R
	{
		if (is_int($r)) {
            return $this->addInt($r);
        }else{
            return $this->addRational($r);
        }
	}
	private function addInt(int $i):R
	{
		return new R($this->teller + $i * $this->noemer, $this->noemer);
	}
	private function addRational(R $r):R
	{
		$kgv = kgv($this->noemer, $r->noemer);
		return new R($this->teller * $kgv / $this->noemer + $r->teller * $kgv / $r->noemer, $kgv);
	}
	public function tegengestelde()
	{
		$this->teller *= -1;
	}
	public function sub($r) : R
	{
		if (is_int($r)) {
            return $this->addInt(-$r);
        }else{
			$x = $r;
			$x->tegengestelde();
            return $this->addRational($x);
        }
	}
	public function mul($r) : R
	{
		if (is_int($r)) {
            return $this->mulInt($r);
        }else{
            return $this->mulRational($r);
        }
	}
	private function mulInt(int $i):R
	{
		return new R($this->teller * $i, $this->noemer);
	}
	private function mulRational(R $r):R
	{
		return new R($this->teller * $r->teller, $this->noemer * $r->noemer);
	}
	public function omgekeerde()
	{
		$bla = $this->teller;
		$this->teller = $this->noemer;
		$this->noemer = $bla;
	}
	public function div($r) : R
	{
		if (is_int($r)) {
			$x = new R(1,$r);
            return $this->mulInt($x);
        }else{
            return $this->mulRational($r->omgekeerde());
        }
	}
	public function pow($n) : R 
	{
		return new R(pow($this->teller, $n), pow($this->noemer, $n));
	}
}
/*
$gen = new R(1,1);
$x = $gen->rand();
$y = $gen->rand();
$z = $gen->rand();
echo $x."+".$y.".".$z."<br/>";
$x->vereenvoudig();$y->vereenvoudig();$z->vereenvoudig();
echo $x."+".$y.".".$z."<br/>";
$m = $y->mul($z);
echo $x."+".$m."<br/>";
$m->vereenvoudig();
echo $x."+".$m."<br/>";
$res = $x->add($m);
echo $res."<br/>";
$res->vereenvoudig();
echo $res;
*/
?>
