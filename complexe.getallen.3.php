<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,15);
		return call_user_func(array($this,"oef".$i));
	}
	//p. 33 a-n is oef11-oef23
	//p. 32 c, d oef24-oef25
	private function oef11()
	{
		//Oefeningen op optellingen van de vorm a+bi
		$ga =	nietnul(-10,10);
		$gb =	nietnul(-10,10);
		$gc =	nietnul(-10,10);
		$gd =	nietnul(-10,10);

		$opg1		= "(".$ga.p($gb,0)."i)+(".$gc.p($gd,0)."i)";
		$opgave 	= $opg1;
		$oplossing	= $opgave;
		$oplossing .= "= ".$ga.p($gb,0)."i ".p($gc,2).p($gd,0)."i =";
		$oplossing .= "\\color{red}{".$ga.p($gc,2)."}\\color{blue}{".p($gb,0)."i ".p($gd,0)."i}=";


		if ($ga+$gc==0){
		  if ($gb+$gd==0){
			  $oplossing .= "\\color{red}{".($ga+$gc)."}";
		  }	else{
			  $oplossing .= "\\color{blue}{".p($gb+$gd,1)."i}";
		  }
		}else{
			if ($gb+$gd==0){
				$oplossing .= "\\color{red}{".($ga+$gc)."}";
			}else{
				$oplossing .= "\\color{red}{".($ga+$gc)."}\\color{blue}{".p($gb+$gd,0)."i}";
			}
		}
		$b =	nietnul(-20,20);
		$stamp		= "11.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}

	private function oef12()
	{
		//Oefeningen op aftrekkingen van de vorm a+bi
		$ga =	nietnul(-10,10);
		$gb =	nietnul(-10,10);
		$gc =	nietnul(-10,10);
		$gd =	nietnul(-10,10);

		$opg1		= "(".$ga.p($gb,0)."i)-(".$gc.p($gd,0)."i)";
		$opgave 	= $opg1;
		$oplossing	= $opgave;
		$gc=-$gc;
		$gd=-$gd;
		$oplossing .= "= ".$ga.p($gb,0)."i ".p($gc,2).p($gd,0)."i =";
		$oplossing .= "\\color{red}{".$ga.p($gc,2)."}\\color{blue}{".p($gb,0)."i ".p($gd,0)."i}=";


		if ($ga+$gc==0){
			if ($gb+$gd==0){
				$oplossing .= "\\color{red}{".($ga+$gc)."}";
			}	else{
				$oplossing .= "\\color{blue}{".p($gb+$gd,1)."i}";
			}
		}else{
			if ($gb+$gd==0){
				$oplossing .= "\\color{red}{".($ga+$gc)."}";
			}else{
				$oplossing .= "\\color{red}{".($ga+$gc)."}\\color{blue}{".p($gb+$gd,0)."i}";
			}
		}
		$b =	nietnul(-20,20);
		$stamp		= "12.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}


	private function oef13()
	{
		//Oefeningen op vermenigvuldigen van de vorm (a+bi)(c+di)
		$ga =	nietnul(-10,10);
		$gb =	nietnul(-10,10);
		$gc =	nietnul(-10,10);
		$gd =	nietnul(-10,10);

		$opg1		= "(".$ga.p($gb,0)."i) \cdot (".$gc.p($gd,0)."i)";
		$opgave 	= $opg1;
		$oplossing	= $opgave;
		$oplossing .= "= ".$ga*$gc.p($ga*$gd,0)."i ".p($gb*$gc,2)." i".p($gb*$gd,0)."i^2 ";
		$oplossing .= "= ".$ga*$gc.p($ga*$gd,0)."i ".p($gb*$gc,2)." i".p(-$gb*$gd,0);
		$oplossing .= "= \\color{red}{".$ga*$gc.p(-$gb*$gd,2)."}\\color{blue}{".p($ga*$gd,0)."i ".p($gb*$gc,0)."i}=";
		$oplga=$ga*$gc-$gb*$gd;
		$oplgb=$ga*$gd+$gb*$gc;


		if ($oplga==0){
			if ($oplgb==0){
				$oplossing .= "\\color{red}{0}";
			}	else{
				$oplossing .= "\\color{blue}{".p($oplgb,1)."i}";
			}
		}else{
			if ($oplgb==0){
				$oplossing .= "\\color{red}{".($oplga)."}";
			}else{
				$oplossing .= "\\color{red}{".($oplga)."}\\color{blue}{".p($oplgb,0)."i}";
			}
		}
		$b =	nietnul(-20,20);
		$stamp		= "13.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}

	private function oef14()
	{
		//Oefeningen op vermenigvuldigen van de vorm (bi)(c+di)

		$ga =	nietnul(-10,10);
		$gb =	nietnul(-10,10);
		$gc =	nietnul(-10,10);
		$gd =	nietnul(-10,10);


		$opg1		= "(".p($gb,0)."i) \cdot (".$gc.p($gd,0)."i)";
		$opg2		= "(".$gc.p($gd,0)."i)"."\cdot (".p($gb,0)."i)";
		$opgave 	= array($opg1,$opg2)[random_int(0,1)];
		$oplossing	= $opgave;
		$oplossing .= "= ".p($gb*$gc,2)." i".p($gb*$gd,0)."i^2 = ";
//		$oplossing .= "= \\color{red}{".$ga*$gc.p(-$gb*$gd,2)."}\\color{blue}{".p($ga*$gd,0)."i ".p($gb*$gc,0)."i}=";
		$oplga=-$gb*$gd;
		$oplgb=$gb*$gc;


		if ($oplga==0){
			if ($oplgb==0){
				$oplossing .= "\\color{red}{0}";
			}	else{
				$oplossing .= "\\color{blue}{".p($oplgb,1)."i}";
			}
		}else{
			if ($oplgb==0){
				$oplossing .= "\\color{red}{".($oplga)."}";
			}else{
				$oplossing .= "\\color{red}{".($oplga)."}\\color{blue}{".p($oplgb,0)."i}";
			}
		}
		$b =	nietnul(-20,20);
		$stamp		= "14.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}

	private function oef15()
	{
		//Oefeningen op delingen van de vorm (a+bi)/(c+di)

		$ga =	nietnul(-10,10);
		$gb =	nietnul(-10,10);
		$gc =	nietnul(-10,10);
		$gd =	nietnul(-10,10);
		$teller=$ga.p($gb,0)."i";
		$noemer=$gc.p($gd,0)."i";
		$opg1 = "\\frac{".$teller."}{".$noemer."}";
		$opgave 	= $opg1;
		$oplossing	= $opgave;
		$noemercompl=$gc.p(-$gd,0)."i";
		$oplossing .= "= ".$opgave." \cdot \\frac{".$noemercompl."}{".$noemercompl."} ";

		$teller = $ga*$gc.p($ga*-$gd,0)."i ".p($gb*$gc,2)." i".p($gb*-$gd,0)."i^2 ";
		$noemer="(".$gc.")^2-(".$gd."i)^2";
		$oplossing .= "= \\frac{".$teller."}{".$noemer."} ";


		$noemer=pow($gc,2)." + ".pow($gd,2);
		$teller= $ga*$gc.p(-$ga*$gd,0)."i ".p($gb*$gc,2)." i".p($gb*$gd,0);
		$oplossing .= "= \\frac{".$teller."}{".$noemer."} ";

		$noemer=pow($gc,2)+pow($gd,2);
		$teller= $ga*$gc+$gb*$gd.p(-$ga*$gd+$gb*$gc,0)."i ";
		$oplossing .= "= \\frac{".$teller."}{".$noemer."} ";

		$ggd1=abs(ggd($ga*$gc+$gb*$gd,$noemer));
		$ggd2=abs(ggd(-$ga*$gd+$gb*$gc,$noemer));
		if ($noemer/$ggd1==1){
			$oplossing .= "= ".($ga*$gc+$gb*$gd)/$ggd1;
		}else{
			$oplossing .= "= \\frac{".($ga*$gc+$gb*$gd)/$ggd1."}{".$noemer/$ggd1."} ";
		}

		$teller=-(-$ga*$gd+$gb*$gc)/$ggd2;


		$noemer=$noemer/$ggd2;
		if ($teller<0){
			if ($noemer==1){
				$oplossing .= "- ".$teller."i";
			}else{
				$oplossing .= "- \\frac{".($teller)."}{".$noemer."}i ";
			}
		}else{
			if ($noemer==1){
				$oplossing .= "+ ".$teller."i";
			}
			else{
				$oplossing .= "+ \\frac{".-$teller."}{".$noemer."}i ";
			}


		}



		$b =	nietnul(-20,20);
		$stamp		= "15.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}

}

?>
