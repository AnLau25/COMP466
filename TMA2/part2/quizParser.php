<?php
    function xml_quiz_parse($xml) { 
        $output = '';
        if (!$xml) return '';
    
        $counter = 0; 
        
        foreach ($xml->question as $question) {
            $output .= '<fieldset class="fields">'; 
            
            if (isset($question->text)) {
                $output .= '<legend><strong>' . htmlspecialchars($question->text) . '</strong></legend>';
            }
    
            foreach ($question->choices->children() as $option) {
                if ($option->getName() == 'correct') {
                    $output .= "<input type='radio' class='correct' name='q$counter' value='" . htmlspecialchars($option) . "'> " . htmlspecialchars($option) . "<br>";
                } elseif ($option->getName() == 'wrong'){
                    $output .= "<input type='radio' class='wrong' name='q$counter' value='" . htmlspecialchars($option) . "'> " . htmlspecialchars($option) . "<br>";
                }
            }
    
            $output .= '</fieldset>'; 
            $counter++; 
        }
    
        return $output;
    }
       
?>
