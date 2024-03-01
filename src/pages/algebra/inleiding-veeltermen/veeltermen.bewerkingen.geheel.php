<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,28);
		return call_user_func(array($this,"oef".$i));
	}

	private function oef11()
	{
		$a 	= nietnul(-20,20);
		$b	= nietnul(-20,20);
		$c 	= nietnul(-20,20);
		$r	= nietnul(-20,-2);
		$s	= nietnul(-20,20);
		$t	= nietnul(-20,20);
		// (ax^3 + bx^2 + cx) - (rx^2 + sx + tx^3)
		$opgave 	=  "(".p($a, 1)."x^3".p($b)."x^2".p($c)."x)-(".p($r, 1)."x^2".p($s)."x".p($t)."x^3)";
		$oplossing	= $opgave;
		$oplossing	.= "\\\\=".p($a, 1)."x^3".p($b)."x^2".p($c)."x".p(-$r)."x^2".p(-$s)."x".p(-$t)."x^3";
		$oplossing	.= "\\\\=";
		$eerste = 1;
		if($a!=$t)
		{
			$oplossing	.= p($a-$t, $eerste)."x^3";
			$eerste = 0;
		}
		if($b!=$r)
		{
			$oplossing	.= p($b-$r, $eerste)."x^2";
			$eerste = 0;
		}
		if($c!=$s)
		{
			$oplossing .= p($c-$s)."x";
			$eerste = 0;
		}
		$stamp		= '11.'.$a.$b.$c;

		return new Oefening($this->titel,$opgave, $oplossing, $stamp);

	}
	private function oef12()

	{
		//(ax^3 + bx + c) + (rx^3 + sx^2 + t)
		$a 	= nietnul(-20,20);
		$b	= nietnul(-20,20);
		$c 	= nietnul(-20,20);
		$r	= nietnul(-20,-2);
		$s	= nietnul(-20,20);
		$t	= nietnul(-20,20);
		
		$opgave 	=  "(".p($a, 1)."x^3".p($b)."x".p($c,2).")+(".p($r, 1)."x^3".p($s)."x^2".p($t,2).")";
		$oplossing	= $opgave;
		$oplossing	.= "\\\\=".p($a, 1)."x^3".p($b)."x".p($c,2).p($r)."x^3".p($s)."x^2".p($t,2);
		$oplossing	.= "\\\\=";
		$eerste = 1;
		if($a!=-$r)
		{
			$oplossing	.= p($a+$r, $eerste)."x^3";
			$eerste = 0;
		}
		$oplossing .= p($s,$eerste)."x^2";
		$eerste *= 0;
		$oplossing .=p($b)."x";
		if($c!=-$t)
		{
			$oplossing .= p($c+$t, 2);
		}
		$stamp		= '12.'.$a.$b.$c;

		return new Oefening($this->titel,$opgave, $oplossing, $stamp);

	}
	private function oef13()

	{
		$a 	= nietnul(-20,20);
		$b	= nietnul(-20,20);
		$c 	= nietnul(-20,20);
		
		$f 	= nietnul(-20,20);
		$g	= nietnul(-20,20);
		$h 	= nietnul(-20,20);
				
		$r	= nietnul(-20,-2);
		$s	= nietnul(-20,20);
		$t	= nietnul(-20,20);
		
		//(ax^3 + bx^2 + c) - (fx^3 + g + hx) - (rx + sx^2 + tx^3)
		$opgave 	=  "(".p($a, 1)."x^3".p($b)."x^2".p($c,2).")-(".p($f, 1)."x^3".p($g,2).p($h)."x)-(".p($r, 1)."x".p($s)."x^2".p($t)."x^3)";
		$oplossing	= $opgave;
		$oplossing	.= "\\\\=".p($a, 1)."x^3".p($b)."x^2".p($c,2).p(-$f)."x^3".p(-$g,2).p(-$h)."x".p(-$r)."x".p(-$s)."x^2".p(-$t)."x^3";
		$oplossing	.= "\\\\=";
		$eerste = 1;
		if($a-$f-$t!=0)
		{
			$oplossing	.= p($a-$f-$t, $eerste)."x^3";
			$eerste = 0;
		}
		if($b-$s!=0)
		{
			$oplossing	.= p($b-$s, $eerste)."x^2";
			$eerste = 0;
		}
		if($h+$r!=0)
		{
			$oplossing	.= p(-$h-$r, $eerste)."x";
			$eerste = 0;
		}
		if($c-$g!=0)
		{
			$oplossing	.= p($c-$g, 2);
		}
		$stamp		= '13.'.$a.$b.$c;

		return new Oefening($this->titel,$opgave, $oplossing, $stamp);

	}
	private function oef14()

	{
		$a 	= nietnul(-20,20);
		$b	= nietnul(-20,20);
		$c 	= nietnul(-20,20);
		$d	= nietnul(-20,-2);
		// (ax + b) + (cx + d)
		$opgave 	=  "(".p($a, 1)."x".p($b,2).")+(".p($c, 1)."x".p($d,2).")";
		$oplossing	= $opgave;
		$oplossing	.= "\\\\=".p($a, 1)."x".p($b,2).p($c)."x".p($d,2);
		$oplossing	.= "\\\\=";
		$eerste = 1;
		
		if($a+$c!=0)
		{
			$oplossing	.= p($a+$c, $eerste)."x";
			$eerste = 0;
		}
		if($b+$d!=0)
		{
			$oplossing	.= p($b+$d, 2);
		}
		if($a+$c==0 and $b+$d==0)
		{
			$oplossing .= 0;
		}
		
		$stamp		= '14.'.$a.$b.$c;

		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef15()
	{
		$a 	= nietnul(-20,20);
		$b	= nietnul(-20,20);
		$c 	= nietnul(-20,20);
		$d	= nietnul(-20,-2);
		// (ax^2 + b) - (cx^2 + dx)
		$opgave 	=  "(".p($a, 1)."x^2".p($b,2).")-(".p($c, 1)."x^2".p($d)."x)";
		$oplossing	= $opgave;
		$oplossing	.= "\\\\=".p($a, 1)."x^2".p($b,2).p(-$c, 1)."x^2".p(-$d)."x";
		$oplossing	.= "\\\\=";
		$eerste = 1;
		if($a-$c!=0)
		{
			$oplossing	.= p($a-$c, $eerste)."x^2";
			$eerste = 0;
		}
		if($eerste = 1)
		{
			$oplossing	.= p(-$d)."x";
		}
		$oplossing	.= p($b,2);
		$stamp		= '15.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef16()
	{
		$a 	= nietnul(-20,20); //x^2
		$b	= nietnul(-20,20); //x
		$c 	= nietnul(-20,20); //x^0
		// (ax^2 + bx) + (bx + c) - (2bx - c)
		$opgave 	=  "(".p($a, 1)."x^2".p($b)."x) +(".p($b, 1)."x".p($c,2).") -(".p($b*2)."x".p(-$c,2).")";
		$oplossing	= $opgave;
		
		$oplossing	.= "\\\\=".p($a, 1)."x^2".p($b)."x".p($b)."x".p($c,2).p(-$b*2)."x".p($c,2);
		$oplossing	.= "\\\\=".p($a, 1)."x^2".p(2*$c,2);
		
		$stamp		= '16.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef17()
	{
		$a 	= nietnul(-20,20); //x^2
		$b	= nietnul(-20,20); //x
		$c 	= nietnul(-20,20); //x^0
		$be	= nietnul(4,8);
		$ce = nietnul(2,$be-1);
		// ax . (bx^e + cx^f) = abx^(e+1) + acx^(f+1)
		$opgave 	=  p($a, 1)."x(".p($b,1)."x^".$be.p($c)."x^".$ce.")";
		$oplossing	= $opgave;
		
		$oplossing	.= "=".p($a*$b,1)."x^".($be+1).p($a*$c)."x^".($ce+1);
		
		$stamp		= '17.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef18()
	{
		$p	= nietnul(-8,8);
		$a 	= nietnul(-20,20); 
		$b	= nietnul(-20,20); 
		$c 	= nietnul(-20,20); 
		// px . (ax + by + c) = pax^2 + pbxy + pcx
		$opgave 	=  p($p, 1)."x(".p($a,1)."x".p($b)."y".p($c,2).")";
		$oplossing	= $opgave;
		
		$oplossing	.= "=".p($p*$a, 1)."x^2".p($p*$b)."xy".p($p*$c,0)."x";
		
		$stamp		= '18.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef19()
	{
		//39b
		$p	= nietnul(-8,8);
		$a 	= nietnul(-8,8); 
		$b	= nietnul(-10,10); 
		$c 	= nietnul(-5,5);
		
		$opgave 	=  p($p, 1)."x(".p($a,1)."x^2".p($b)."x".p($c,2).")";
		$oplossing	= $opgave;
		
		$oplossing	.= "=".p($p*$a, 1)."x^3".p($p*$b)."x^2".p($p*$c)."x";
		
		$stamp		= '19.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef20()
	{
		//39b
		$p	= nietnul(-8,8);
		$pe	= nietnul(2,5);
		$a 	= nietnul(-8,8);
		$ae = nietnul(2,4);
		$b	= nietnul(-10,10); 
		$c 	= nietnul(-5,5);
		
		$opgave 	=  p($p, 1)."x^".$pe."(".p($a,1)."x^".$ae.p($b)."x".p($c,2).")";
		$oplossing	= $opgave;
		
		$oplossing	.= "=".p($p*$a, 1)."x^".($pe+$ae).p($p*$b)."x^".($pe+1).p($p*$c)."x^".$pe;
		
		$stamp		= '20.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef21()
	{
		//39b
		$p	= nietnul(-8,8);
		$pe	= nietnul(2,5);
		$a 	= nietnul(-8,8);
		$ae = nietnul(3,7);
		$b	= nietnul(-10,10); 
		$be	= nietnul(2,$ae-1);
		$c 	= nietnul(-5,5);
		
		$opgave 	=  p($p, 1)."x^".$pe."(".p($a,1)."x^".$ae.p($b)."x^".$be.p($c,2).")";
		$oplossing	= $opgave;
		
		$oplossing	.= "=".p($p*$a, 1)."x^{".($pe+$ae)."}".p($p*$b)."x^{".($pe+$be)."}".p($p*$c,2)."x^".$pe;
		
		$stamp		= '21.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef22()
	{
		//39b
		$p	= nietnul(-8,8);
		$pe	= nietnul(2,5);
		$a 	= nietnul(-8,8);
		$ae = nietnul(3,7);
		$b	= nietnul(-10,10); 
		$be	= nietnul(2,$ae-1);
		$c 	= nietnul(-5,5);
		
		$opgave 	=  p($p, 1)."x^".$pe."(".p($b,1)."x^".$be.p($a)."x^".$ae.p($c,2).")";
		$oplossing	= $opgave;
		
		$oplossing	.= "=".p($p*$a, 1)."x^{".($pe+$ae)."}".p($p*$b)."x^{".($pe+$be)."}".p($p*$c,2)."x^".$pe;
		
		$stamp		= '22.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef23()
	{
		//40
		$a 	= nietnul(-8,8);
		$b	= nietnul(-10,10); 
		$c 	= nietnul(-5,5);
		$d	= nietnul(-8,8);
		
		$opgave 	=  "(". p($a,1)."x".p($b,2) .")(". p($c,1)."x".p($d,2) .")";
		$oplossing	= $opgave;
		
		$oplossing	.= "\\\\=". p($a*$c,1)."x^2". p($a*$d)."x".p($b*$c)."x".p($b*$d,2);
		$oplossing	.= "\\\\=". p($a*$c,1)."x^2";
		if($a*$d+$b*$c!=0)
		{
			$oplossing .= p($a*$d+$b*$c)."x";
		}
		$oplossing .= p($b*$d,2);
		$stamp		= '23.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef24()
	{
		//40
		$a 	= nietnul(-8,8);
		$b	= nietnul(-10,10); 
		$c 	= nietnul(-5,5);
		$d	= nietnul(-8,8);
		
		$opgave 	=  "(". p($a,1)."x^2".p($b) ."x)(". p($c,1)."x".p($d,2) .")";
		$oplossing	= $opgave;
		
		$oplossing	.= "\\\\=". p($a*$c,1)."x^3". p($a*$d)."x^2".p($b*$c)."x^2".p($b*$d)."x";
		$oplossing	.= "\\\\=". p($a*$c,1)."x^3";
		if($a*$d+$b*$c!=0)
		{
			$oplossing .= p($a*$d+$b*$c)."x^2";
		}
		$oplossing .= p($b*$d)."x";
		$stamp		= '24.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef25()
	{
		//40
		$a 	= nietnul(-8,8);
		$b	= nietnul(-6,6); 
		$c 	= nietnul(-5,5);
		$d	= nietnul(-8,8);
		
		$opgave 	=  "(". p($a,1)."x^2".p($b,2) .")(". p($c,1)."x^2".p($d,2) .")";
		$oplossing	= $opgave;
		
		$oplossing	.= "\\\\=". p($a*$c,1)."x^4". p($a*$d)."x^2".p($b*$c)."x^2".p($b*$d,2);
		$oplossing	.= "\\\\=". p($a*$c,1)."x^4";
		if($a*$d+$b*$c!=0)
		{
			$oplossing .= p($a*$d+$b*$c)."x^2";
		}
		$oplossing .= p($b*$d,2);
		$stamp		= '25.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef26()
	{
		//40
		$a 	= nietnul(-3,3);
		$b	= nietnul(-6,6); 
		$c 	= nietnul(-5,5);
		$d	= nietnul(-3,3);
		$e 	= nietnul(-5,5);
		
		$opgave 	=  "(". p($a,1)."x^4".p($b)."x^2".p($c,2).")(". p($d,1)."x^2".p($e,2) .")";
		$oplossing	= $opgave;
		
		$oplossing	.= "\\\\=". p($a*$d,1)."x^6". p($a*$e)."x^4".p($b*$d)."x^4".p($b*$e)."x^2".p($c*$d)."x^2".p($c*$e,2);
		$oplossing	.= "\\\\=". p($a*$d,1)."x^6";
		if($a*$e+$b*$d!=0)
		{
			$oplossing .= p($a*$e+$b*$d)."x^4";
		}
		if($b*$e+$c*$d!=0)
		{
			$oplossing .= p($b*$e+$c*$d)."x^2";
		}
		$oplossing .= p($c*$e,2);
		$stamp		= '26.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef27()
	{
		//40
		$a 	= nietnul(-3,3);
		$b	= nietnul(-4,4); 
		$c 	= nietnul(-4,4);
		$d	= nietnul(-3,3);
		$e 	= nietnul(-5,5);
		$exp = nietnul(3,8);
		
		$opgave 	=  "(". p($a,1)."x^2".p($b)."x".p($c,2).")(". p($d,1)."x^{".$exp."}".p($e,2) .")";
		$oplossing	= $opgave;
		
		$oplossing	.= "\\\\=". p($a*$d,1)."x^{".($exp+2)."}".p($a*$e)."x^2".p($b*$d)."x^{".($exp+1)."}".p($b*$e)."x".p($c*$d)."x^".$exp.p($c*$e,2);
		$oplossing  .= "\\\\=". p($a*$d,1)."x^{".($exp+2)."}".p($b*$d)."x^{".($exp+1)."}".p($c*$d)."x^".$exp.p($a*$e)."x^2".p($b*$e)."x".p($c*$e,2);
		$stamp		= '27.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef28()
	{
		//40
		$a 	= nietnul(-3,3);
		$b	= nietnul(-4,4); 
		$c 	= nietnul(-4,4);
		$d	= nietnul(-3,3);
		$e 	= nietnul(-5,5);
		$f 	= nietnul(-3,3);
		
		$opgave 	=  "(". p($a,1)."x^2".p($b)."x".p($c,2).")(". p($d,1)."x^2".p($e) ."x".p($f,2).")";
		$oplossing	= $opgave;
		$oplossing	.= "\\\\=". p($a*$d,1)."x^4".p($a*$e)."x^3".p($a*$f)."x^2".p($b*$d)."x^3".p($b*$e)."x^2".p($b*$f)."x".p($c*$d)."x^2".p($c*$e)."x".p($c*$f,2);
		$oplossing	.= "\\\\=". p($a*$d,1)."x^4";
		if($a*$e+$b*$d!=0)
		{
			$oplossing .= p($a*$e+$b*$d)."x^3";
		}
		if($a*$f+$b*$e+$c*$d!=0)
		{
			$oplossing .= p($a*$f+$b*$e+$c*$d)."x^2";
		}
		$oplossing .= p($b*$f+$c*$e)."x".p($c*$f,2);
		$stamp		= '28.'.$a.$b.$c;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}

?>
