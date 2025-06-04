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
        $i = random_int(1, 2);
        return call_user_func(array($this, "oef" . $i));
    }

    // Oefening 1: Bissectrices bepalen van twee rechten (eenvoudige vorm)
    private function oef1()
    {
        // Genereer twee rechten door het snijpunt (0,0) met verschillende richtingscoëfficiënten
        $m1 = rand(1, 4);
        $m2 = rand(-4, -1);
        
        // Zorg dat de rechten niet evenwijdig zijn
        while($m1 == $m2) {
            $m2 = rand(-4, -1);
        }

        // Hoeken van de rechten met x-as
        $alpha1 = atan($m1);
        $alpha2 = atan($m2);
        
        // Bissectrices maken hoeken van (alpha1 + alpha2)/2 en (alpha1 + alpha2)/2 + π/2
        $beta1 = ($alpha1 + $alpha2) / 2;
        $beta2 = $beta1 + M_PI / 2;
        
        $mb1 = tan($beta1);
        $mb2 = tan($beta2);
        
        // Formattering
        $mb1_formatted = number_format($mb1, 2);
        $mb2_formatted = number_format($mb2, 2);

        $opgave = "Bepaal de vergelijkingen van de bissectrices van de rechten y = {$m1}x en y = {$m2}x.";
        
        $oplossing = $opgave . "\\\\\\\\";
        $oplossing .= "\\text{Voor rechten door de oorsprong gebruiken we de formule:}\\\\";
        $oplossing .= "\\text{Als de rechten richtingscoëfficiënten } m_1 \\text{ en } m_2 \\text{ hebben,}\\\\";
        $oplossing .= "\\text{dan zijn de bissectrices:}\\\\\\\\";
        $oplossing .= "\\frac{y - 0}{x - 0} = \\frac{m_1 + m_2 \\pm \\sqrt{(1 + m_1^2)(1 + m_2^2)}}{2}\\\\\\\\";
        $oplossing .= "\\text{Met } m_1 = {$m1} \\text{ en } m_2 = {$m2}:\\\\";
        $oplossing .= "\\text{Bissectrice 1: } y \\approx {$mb1_formatted}x\\\\";
        $oplossing .= "\\text{Bissectrice 2: } y \\approx {$mb2_formatted}x";

        $stamp = "bis({$m1}x)({$m2}x)";

        return new Oefening($this->titel, $opgave, $oplossing, $stamp);
    }

    // Oefening 2: Bissectrices van twee rechten in algemene vorm
    private function oef2()
    {
        // Genereer twee rechten ax + by + c = 0
        $a1 = rand(1, 3);
        $b1 = rand(1, 3);
        $c1 = rand(-5, 5);
        
        $a2 = rand(-3, -1);
        $b2 = rand(1, 3);
        $c2 = rand(-5, 5);

        // Zorg dat de rechten niet evenwijdig zijn
        while($a1 * $b2 == $a2 * $b1) {
            $a2 = rand(-3, -1);
            $b2 = rand(1, 3);
        }

        $opgave = "Bepaal de vergelijkingen van de bissectrices van de rechten {$a1}x + {$b1}y + {$c1} = 0 en {$a2}x + {$b2}y + {$c2} = 0.";
        
        $oplossing = $opgave . "\\\\\\\\";
        $oplossing .= "\\text{Voor rechten in de vorm } ax + by + c = 0 \\text{ zijn de bissectrices:}\\\\\\\\";
        $oplossing .= "\\frac{a_1x + b_1y + c_1}{\\sqrt{a_1^2 + b_1^2}} = \\pm \\frac{a_2x + b_2y + c_2}{\\sqrt{a_2^2 + b_2^2}}\\\\\\\\";
        
        // Bereken de normalisatiefactoren
        $norm1 = sqrt($a1*$a1 + $b1*$b1);
        $norm2 = sqrt($a2*$a2 + $b2*$b2);
        
        $norm1_formatted = number_format($norm1, 2);
        $norm2_formatted = number_format($norm2, 2);
        
        $oplossing .= "\\text{Met } \\sqrt{{$a1}^2 + {$b1}^2} = \\sqrt{" . ($a1*$a1 + $b1*$b1) . "} = {$norm1_formatted}\\\\";
        $oplossing .= "\\text{en } \\sqrt{{$a2}^2 + {$b2}^2} = \\sqrt{" . ($a2*$a2 + $b2*$b2) . "} = {$norm2_formatted}\\\\\\\\";
        $oplossing .= "\\text{De bissectrices zijn:}\\\\";
        $oplossing .= "\\frac{{$a1}x + {$b1}y + {$c1}}{{$norm1_formatted}} = \\frac{{$a2}x + {$b2}y + {$c2}}{{$norm2_formatted}}\\\\";
        $oplossing .= "\\text{en}\\\\";
        $oplossing .= "\\frac{{$a1}x + {$b1}y + {$c1}}{{$norm1_formatted}} = -\\frac{{$a2}x + {$b2}y + {$c2}}{{$norm2_formatted}}";

        $stamp = "bis({$a1}x+{$b1}y+{$c1})({$a2}x+{$b2}y+{$c2})";

        return new Oefening($this->titel, $opgave, $oplossing, $stamp);
    }
}