<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require_once('class.math.php');
class O //Onbekende
{
	public $letter;
	public $exponent;
	public function __construct($l='', $e=0)
	{
		$this->letter = $l;
		$this->exponent = $e;
	}
	public function __toString(): string
	{
		if($this->letter == '')
		{
			return $this->letter;
		}
		else
		{
			if($this->exponent == 0)
			{
				return '';
			}
			elseif($this->exponent == 1)
			{
				return $this->letter;
			}
			else
			{
				return $this->letter . "^{". $this->exponent . "}";
			}
		}
	}
}
/////////////////////////////////////////////
class Ol //bvb a^2bc^3 Onbekendenlijst
{
	public $lijst;
	public function __construct($zin = "")
	{
		$this->lijst = array();
		$stop = false;
		$h = 0;
		$i = 1;
		$o = null;
		$alfabet = explode(' ','a b c d e f g h i j k l m n o p q r s t u v w x y z');
		if($zin == '')
		{
			$o = new O('',0);
			array_push($this->lijst, $o);
		}
		while(True)
		{
			if($i >= strlen($zin))
			{
				$stop = true;
			}
			if($stop or in_array($zin[$i], $alfabet))
			{
				$x = explode('^',substr($zin, $h, $i-$h));
				if(count($x)==2){
					if($x[1][0] == '{')
					{
						$x[1] = substr($x[1],1,strlen($x[1])-2);
					}		
					$o = new O($x[0], (int) $x[1]);
				}else{
					$o = new O($x[0], 1);
				}
				array_push($this->lijst, $o);
				$h = $i;
			}
			if($stop){break;}
			$i++;
		}
	}
	public function __toString(): string
	{
		return implode('', $this->lijst);
	}
	private static function lettersort($a, $b)
	{
		if ($a->letter == $b->letter) {
			return 0;
		}
		return ($a->letter < $b->letter) ? -1 : 1;
	}
	public function sorteer()
	{
		usort($this->lijst, array('Ol','lettersort'));
	}
	public function graad()
	{
		$x = 0;
		for($i=0; $i < count($this->lijst);$i++)
		{
			$x += $this->lijst[$i]->exponent;
		}
		return $x;
	}
}
///////////////////////////////////////////////////////////////
class Eenterm
{
	public $coeff;
	public $onbekenden;
	public function __construct($zin = "3x^2")
	{
		if($zin == '')
		{
			$this->coeff = 0;
			$this->onbekenden = new Ol('');
			return True;
		}
		$alfabet = explode(' ','a b c d e f g h i j k l m n o p q r s t u v w x y z');
		$i = 0;
		while($i < strlen($zin) and !in_array($zin[$i], $alfabet))
		{ $i++; }
		$c = substr($zin, 0, $i);
		$x = substr($zin, $i, strlen($zin)-$i);
		//}
		if($c == '')
		{	$this->coeff = 1; }
		elseif($c == '-')
		{	$this->coeff = -1; }
		else
		{
			$this->coeff = (int) $c;
		}
		$this->onbekenden = new Ol($x);
		return True;
	}
	public function __toString(): string
	{
		if($this->coeff == 0)
		{ return ""; }
		elseif($this->coeff == 1)
		{ 
			
			if('' == (string) $this->onbekenden)
			{ return "1";}
			else
			{ return $this->onbekenden; }
		}
		elseif($this->coeff == -1)
		{
			if('' == (string) $this->onbekenden)
			{ return "-1";}
			else
			{ return "-".$this->onbekenden; }
		}
		else
		{
			return "" . $this->coeff . $this->onbekenden;
		}
	}
	public function sorteer()
	{
		return $this->onbekenden->sorteer();
		//return $x;
	}
	
	public function graad()
	{
		return $this->onbekenden->graad();
	}
	
}
///////////////////////////////////////////////////////////////////////
class Veelterm
{
	public $lijst;
	public function __construct($zin = "")
	{
		$this->lijst = array();
		$stop = false;
		$h = 0;
		$i = 1;
		$e = null;
		if($zin == '')
		{
			$e = new Eenterm('0');
			array_push($this->lijst, $e);
			return True;
		}
		while(True)
		{
			if($i >= strlen($zin))
			{
				$stop = True;
			}
			if($stop or $zin[$i]=='+' or ($zin[$i]=='-' and $zin[$i-1]!='{')) 
			{
				$e = new Eenterm(substr($zin, $h, $i-$h));
				array_push($this->lijst, $e);
				$h = $i;
			}//}
			if($stop){break;}
			$i++;
		}
		return True;
	}
	public function __toString(): string
	{
		$text = "";
		for($i=0;$i<count($this->lijst);$i++)
		{
			$teken = '';
			if($i>0 and $this->lijst[$i]->coeff > 0)
			{
				//Eerste eenterm, geen teken
				$teken = '+';
			}
			$text .= $teken.$this->lijst[$i];
		}
		return $text;
	}
	public static function eentermsort($a, $b)
	{
		if ($a->graad() == $b->graad()) {
			return 0;
		}
		return ($a->graad() > $b->graad()) ? -1 : 1;
	}
	public function sorteer()
	{
		for($i=0; $i < count($this->lijst); $i++)
		{
			//x^2a^3 wordt a^3x^2
			$this->lijst[$i]->sorteer();
		}
		//sorteren op graad
		usort($this->lijst, array('Veelterm','eentermsort'));
	}
}
/*
$e = new Eenterm('-3x^2a');
echo $e."<br/>";
$e->sorteer();
echo $e;
print_r($e);
$v = new Veelterm('4x^{-2}+3x^2');
print_r($v);
echo $v;
echo $v->sorteer();
echo $v;
*/
$x = array(	"3x^2a^1-3x^2a^4+7xa^5-x^9a",
			"-7zyxw+4x^2y^{-2}-x^3y^{-3}+x^1y^{-1}",
			"1+3x+4x^2",
			"7x^2-9x+1"); 
foreach($x as $k=>$item)
{
	echo $item;
	echo "<br/>";
	$v = new Veelterm($item);
	print_r($v);
	echo $v;
	echo "<br/>";
	$v->sorteer();
	echo $v;
	echo "<br/>";
}
?>