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
		$i = random_int(11,12);
		$i=12;
		return call_user_func(array($this,"oef".$i));
	}

	private function oef11()
	{
		// Oefeningen op zoeken van argument en modulus van complex getal
		$kwadrant = random_int(1,5);
		//5e kwadrant: bijzonder gevallen waarbij a of b gelijk aan 0

		switch ($kwadrant){
			case 1:
				$ga =	nietnul(1,10);
				$gb =	nietnul(1,10);
				break;
			case 2:
				$ga =	nietnul(-10,-1);
				$gb =	nietnul(1,10);
				break;
			case 3:
				$ga =	nietnul(-10,-1);
				$gb =	nietnul(-10,-1);
				break;
			case 4:
				$ga =	nietnul(1,10);
				$gb =	nietnul(-10,-1);
				break;
			case 5:
				$bijzondergeval=random_int(1,2);
				if ($bijzondergeval==1){
					$ga =	nietnul(-10,10);
					$gb =	0;
				}else{
					$ga =	0;
					$gb =	nietnul(-10,10);
				}
				break;
		}

		if (($ga!=0)&($gb!=0)){
			$opg1= $ga.p($gb,0)."i";
			$opgave 	= $opg1;
			$oplossing	= $opgave;
			$oplossing .= "\\\\ r = \\sqrt{(".$ga.")^2+(".p($gb).")^2} = ";
			$oplossing .= "\\sqrt{".pow($ga,2)+pow($gb,2)."} ";
			$hoek=atan($gb/$ga)*180/pi();
			if ($hoek<0){
				$hoek=$hoek+180;
			}
			$oplossing .= "\\\\ \\alpha = tan^{-1}() = ".ddtodms($hoek)."\\text{ of } \\alpha = ".ddtodms($hoek+180);
			$oplossing .= "\\\\".$opgave."\\text{ ligt in kwadrant }".$kwadrant.", \\alpha \\text{ ligt dus tussen }".($kwadrant-1)*90;
			$oplossing .= "^\\circ \\text{ en }".($kwadrant*90)."^\\circ";
			$oplossing .= "\\\\ \\alpha = ".strval(ddtodms($hoek+(intdiv($kwadrant-1,2))*180));

		}elseif ($ga==0){
			$opg1= p($gb,1)."i";
			$opgave 	= $opg1;
			$oplossing	= $opgave;
			if ($gb<0){
				$oplossing .="\\\\ \\text{ Dit complex getal ligt op het negatief gedeelte van de y-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
				$oplossing .="\\text{r =  }".abs($gb)."\\\\";
				$oplossing .="\\alpha = 270 ^\\circ \\\\";

			}else{
				$oplossing .="\\\\ \\text{ Dit complex getal ligt op het positief gedeelte van de y-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
				$oplossing .="\\text{r =  }".abs($gb)."\\\\";
				$oplossing .="\\alpha = 90 ^\\circ \\\\";

			}
		}else{
			$opg1= $ga;
			$opgave 	= $opg1;
			$oplossing	= $opgave;
			if ($ga<0){
				$oplossing .="\\\\ \\text{ Dit complex getal ligt op het negatief gedeelte van de x-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
				$oplossing .="\\text{r =  }".abs($ga)."\\\\";
				$oplossing .="\\alpha = 180 ^\\circ \\\\";
			}else{
				$oplossing .="\\\\ \\text{ Dit complex getal ligt op het positief gedeelte van de x-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
				$oplossing .="\\text{r =  }".abs($ga)."\\\\";
				$oplossing .="\\alpha = 0 ^\\circ \\\\";

			}
		}

		$b =	nietnul(-20,20);
		$stamp		= "11.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		// Oefeningen opomzetten van a+bi naar gon. vorm en omgekeerd
		$keuze=random_int(1,2);

		if (keuze=1){
			$kwadrant = random_int(1,5);
			//5e kwadrant: bijzonder gevallen waarbij a of b gelijk aan 0

			switch ($kwadrant){
				case 1:
					$ga =	nietnul(1,10);
					$gb =	nietnul(1,10);
					break;
				case 2:
					$ga =	nietnul(-10,-1);
					$gb =	nietnul(1,10);
					break;
				case 3:
					$ga =	nietnul(-10,-1);
					$gb =	nietnul(-10,-1);
					break;
				case 4:
					$ga =	nietnul(1,10);
					$gb =	nietnul(-10,-1);
					break;
				case 5:
					$bijzondergeval=random_int(1,2);
					if ($bijzondergeval==1){
						$ga =	nietnul(-10,10);
						$gb =	0;
					}else{
						$ga =	0;
						$gb =	nietnul(-10,10);
					}
					break;
			}

			if (($ga!=0)&($gb!=0)){
				$opg1= $ga.p($gb,0)."i";
				$opgave 	= $opg1;
				$oplossing	= $opgave;
				$oplossing .= "\\\\ r = \\sqrt{(".$ga.")^2+(".p($gb).")^2} = ";
				$oplossing .= "\\sqrt{".pow($ga,2)+pow($gb,2)."} ";
				$hoek=atan($gb/$ga)*180/pi();
				if ($hoek<0){
					$hoek=$hoek+180;
				}
				$oplossing .= "\\\\ \\alpha = tan^{-1}() = ".ddtodms($hoek)."\\text{ of } \\alpha = ".ddtodms($hoek+180);
				$oplossing .= "\\\\".$opgave."\\text{ ligt in kwadrant }".$kwadrant.", \\alpha \\text{ ligt dus tussen }".($kwadrant-1)*90;
				$oplossing .= "^\\circ \\text{ en }".($kwadrant*90)."^\\circ";
				$oplossing .= "\\\\ \\alpha = ".strval(ddtodms($hoek+(intdiv($kwadrant-1,2))*180));

			}elseif ($ga==0){
				$opg1= p($gb,1)."i";
				$opgave 	= $opg1;
				$oplossing	= $opgave;
				if ($gb<0){
					$oplossing .="\\\\ \\text{ Dit complex getal ligt op het negatief gedeelte van de y-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
					$oplossing .="\\text{r =  }".abs($gb)."\\\\";
					$oplossing .="\\alpha = 270 ^\\circ \\\\";

				}else{
					$oplossing .="\\\\ \\text{ Dit complex getal ligt op het positief gedeelte van de y-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
					$oplossing .="\\text{r =  }".abs($gb)."\\\\";
					$oplossing .="\\alpha = 90 ^\\circ \\\\";

				}
			}else{
				$opg1= $ga;
				$opgave 	= $opg1;
				$oplossing	= $opgave;
				if ($ga<0){
					$oplossing .="\\\\ \\text{ Dit complex getal ligt op het negatief gedeelte van de x-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
					$oplossing .="\\text{r =  }".abs($ga)."\\\\";
					$oplossing .="\\alpha = 180 ^\\circ \\\\";
				}else{
					$oplossing .="\\\\ \\text{ Dit complex getal ligt op het positief gedeelte van de x-as. We hebben geen berekeningen nodig om r of } \\alpha \\text{ te berekenen.} \\\\";
					$oplossing .="\\text{r =  }".abs($ga)."\\\\";
					$oplossing .="\\alpha = 0 ^\\circ \\\\";

				}

			}
		}else{

		}

		$b =	nietnul(-20,20);
		$stamp		= "12.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}


}

?>
