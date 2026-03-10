<?php
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
    public function run()
    {
        $i = random_int(11,11);
        return call_user_func(array($this,"oef".$i));
    }

    private function oef11()
    {
        // Drie willekeurige niet-collineaire punten
        do {
            $A = [rand(-10, 10), rand(-10, 10)];
            $B = [rand(-10, 10), rand(-10, 10)];
            $C = [rand(-10, 10), rand(-10, 10)];
        } while ($this->collinear($A, $B, $C)
                || $A[0] == $B[0]  // Delen door 0 tegen gaan
                || $B[0] == $C[0]  
                || $A[0] == $C[0]  
                || $A[1] == $B[1]  
                || $B[1] == $C[1] 
                || $A[1] == $C[1] 
            );

        $opgave = "\\text{Gegeven de driehoek met hoekpunten } A(".$A[0].",".$A[1]."), B(".$B[0].",".$B[1]."), C(".$C[0].",".$C[1].")\\text{.} \\\\ \\text{Bepaal het middelpunt, de straal van de omschreven cirkel en de cirkel vergelijking.}";

        $M_AB = [( ($A[0]+$B[0])/2 ), ( ($A[1]+$B[1])/2 )]; // Midden van koorde AB
        $M_BC = [( ($B[0]+$C[0])/2 ), ( ($B[1]+$C[1])/2 )]; // Midden van koorde BC
        $M_AC = [( ($A[0]+$C[0])/2 ), ( ($A[1]+$C[1])/2 )]; // Midden van koorde AC

        $m_AB = ( ($B[1]-$A[1])/($B[0]-$A[0]) ); // Rico AB
        $m_BC = ( ($C[1]-$B[1])/($C[0]-$B[0]) ); // Rico BC
        $m_AC = ( ($C[1]-$A[1])/($C[0]-$A[0]) ); // Rico AC

        $rc_middeloodlijnAB = -1 / $m_AB; // Helling middeloodlijn AB
        $snijpuntYas_AB = $M_AB[1] - $rc_middeloodlijnAB * $M_AB[0]; // Snijpunt Y as AB

        $rc_middeloodlijnBC = -1 / $m_BC; // Helling middeloodlijn BC
        $snijpuntYas_BC = $M_BC[1] - $rc_middeloodlijnBC * $M_BC[0]; // Snijpunt Y as BC

        $rc_middeloodlijnAC = -1 / $m_AC; // Helling middeloodlijn BC
        $snijpuntYas_AC = $M_AC[1] - $rc_middeloodlijnBC * $M_AC[0]; // Snijpunt Y as BC

        $x_Middelpunt = ($snijpuntYas_BC - $snijpuntYas_AB) / ($rc_middeloodlijnAB - $rc_middeloodlijnBC);
        $y_Middelpunt = $rc_middeloodlijnAB * $x_Middelpunt + $snijpuntYas_AB;

        // Straal van de omschreven cirkel
        $r = sqrt((($A[0] - $x_Middelpunt)*($A[0] - $x_Middelpunt)) + (($A[1] - $y_Middelpunt) * ($A[1] - $y_Middelpunt)));

        $vergelijking_x_Middelpunt = ($x_Middelpunt < 0 ? "+ " : "- ") . abs(round($x_Middelpunt,2));
        $vergelijking_y_Middelpunt = ($y_Middelpunt < 0 ? "+ " : "- ") . abs(round($y_Middelpunt,2));

        $cirkelvergelijking_x_Middelpunt = ($x_Middelpunt < 0 ? "+ " : "- ") . abs(round($x_Middelpunt*2,2));
        $cirkelvergelijking_y_Middelpunt = ($y_Middelpunt < 0 ? "+ " : "- ") . abs(round($y_Middelpunt*2,2));

        $c = ($x_Middelpunt * $x_Middelpunt) + ($y_Middelpunt * $y_Middelpunt) - ($r * $r);
        $cikelvergelijking_c = ($c < 0 ? "- " : "+ ") . abs(round($c,2));

        

        // Opgave en oplossing
        $oplossing = $opgave;
        $oplossing .= "\\\\ \\textbf{Stap 1: Vind het midden van de zijdens}";
        $oplossing .= "\\\\ M_{AB} = ".round($M_AB[0],2).",\\quad M_{BC} = ".round($M_BC[0],2).", \\quad M_{AC} = ".round($M_AC[0],2);

        $oplossing .= "\\\\ \\textbf{Stap 2: Bepaal de richtingscoëfficiënten (rc)}";
        $oplossing .= "\\\\ m_{AB} = ".round($m_AB,2).",\\quad m_{BC} = ".round($m_BC,2).", \\quad m_{AC}".round($m_AC,2);

        $oplossing .= "\\\\ \\textbf{Stap 3: Bereken de richtingscoëfficiënten van de middelloodlijnen}";
        $oplossing .= "\\\\ rc_{middelloodlijn AB} = ".round($rc_middeloodlijnAB,2).",\\quad rc_{middelloodlijn BC} = ".round($rc_middeloodlijnBC,2).",\\quad rc_{middelloodlijn AC} = ".round($rc_middeloodlijnAC,2);

        $oplossing .= "\\\\ \\textbf{Stap 4: Bereken het middelpunt van de cirkel}";
        $oplossing .= "\\\\ Middelpunt = (x_midden, y_midden) = (".round($x_Middelpunt,2).", ".round($y_Middelpunt,2).")";

        $oplossing .= "\\\\ \\textbf{Stap 5: Bereken de straal van de omschreven cirkel}";
        $oplossing .= "\\\\ r = \\sqrt{(x_{midden} - x)^2 + (y_{midden} - y)^2} = ".round($r,2);
        
        $oplossing .= "\\\\ \\textbf{Stap 6: Maak de vergelijking van de cirkel}";
        $oplossing .= "\\\\ Middelpuntvergelijking = (x - x_{midden})^2 + (y - y_{midden})^2 = r^2 <=> (x ".$vergelijking_x_Middelpunt.")^2 + (y ".$vergelijking_y_Middelpunt.")^2 = ".round($r,2)."^2";
        $oplossing .= "\\\\ Algemene \\ vergelijking = x^2 + y^2 ".$cirkelvergelijking_x_Middelpunt."x ".$cirkelvergelijking_y_Middelpunt."y ".$cikelvergelijking_c." = 0";
        $oplossing .= "\\\\ r = ".round($r, 2);

        $stamp = "11.".$A[0].$A[1].$B[0].$B[1].$C[0].$C[1];
        return new Oefening("Omschreven cirkel van 3 niet collineaire punten", $opgave, $oplossing, $stamp);
    }

    private function collinear($A, $B, $C)
    {
        // Controleer of de punten collineair zijn
        return ($B[0] - $A[0]) * ($C[1] - $A[1]) == ($C[0] - $A[0]) * ($B[1] - $A[1]);
    }
}
?>