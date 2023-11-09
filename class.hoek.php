<?php
require_once('class.math.php');
class Hoek
{
	public $graad, $minuut, $seconde;
	public function __construct($graad, $minuut=0, $seconde=0)
	{
		if(is_int($graad))
		{
			$this->graad = $graad;
			$this->minuut = $minuut;
			$this->seconde = $seconde;
		}else{
			$this->setDeg($graad);
		}
	}
	public function __toString(): string
	{
		$txt = $this->graad."^\circ ";
		if($this->minuut != 0)
		{
			$txt .= "\\text{ }".$this->minuut."'";
		}
		if($this->seconde != 0)
		{
			$txt .= "\\text{ }".round($this->seconde).'"'; //Seconde afronden
		}
		return $txt;
	}
	public function radialen(): string
	{
		return puntkomma(round($this->getRad(),3))." \\text{ rad}";
	}
	public function setDeg($graad)
	{
		$hoek = $this->DDtoDMS($graad);
		$this->graad = $hoek[0];
		$this->minuut = $hoek[1];
		$this->seconde = $hoek[2];
	
	}
	public function setRad($rad)
	{
		$this->setDeg(rad2deg($rad));
	}
	public function getRad()
	{
		return deg2rad($this->DMStoDD($this->graad, $this->minuut, $this->seconde));
	}
	private function DMStoDD($deg,$min,$sec)
	{

		// Converting DMS ( Degrees / minutes / seconds ) to decimal format
		return $deg+((($min*60)+($sec))/3600);
	}    

	private function DDtoDMS($dec)
	{
		// Converts decimal format to DMS ( Degrees / minutes / seconds ) 
		$vars = explode(".","".$dec);
		$deg = $vars[0];
		$tempma = "0.".$vars[1];

		$tempma = $tempma * 3600;
		$min = floor($tempma / 60);
		$sec = $tempma - ($min*60);

		return array($deg,$min,$sec);
	}    
	
}
?>
