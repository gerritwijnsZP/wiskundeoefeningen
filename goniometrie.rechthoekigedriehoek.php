<?php

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
$type = rand(1,2);


if ($type == 1) {
// de 2 gegevens van de opdracht gaan zijde en zijde zijn.
$a = rand(3,20);
$b = rand(3,20);

$c = sqrt($a*$a + $b*$b);

$alpha = rad2deg(atan($a/$b));
	$beta = 90 - $alpha;
$opgave = "a = $a, b = $b";
$oplossing = "c = ".round($c,2)." | alpha = ".round($alpha,2)."° | beta = ".round($beta,2)."°";

}else {
// opdracht gegevens zullen zijde en hoek zijn.
$a = rand(3,20);
 $alpha = rand(20,70);
$b = $a / tan(deg2rad($alpha));
$c = $a / sin(deg2rad($alpha));
$beta = 90 - $alpha;
$opgave = "a = $a, alpha = {$alpha}°";
$oplossing = "b = ".round($b,2)." | c = ".round($c,2)." | beta = ".round($beta,2)."°";

}
$stamp = "driehoek";
echo "<img src='Stelling_van_Pythagoras_rechthoekige_driehoek.png' alt='Pythagoras driehoek' style='max-width:300px;'><br>";
 return new Oefening($this->titel, $opgave, $oplossing, $stamp);

	}

}
?>
