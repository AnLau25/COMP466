<?php
    function xml_quiz_parse($xml) { 
        $output = '';
        if (!$xml) return '';

        $output .='<form>';
        foreach ($xml->question as $question) {
            if (isset($question->$text)) {
                $output .= '<h1 id="question">' . htmlspecialchars($question->$text) . '</h1>';
            }
            foreach($xml->wrong as $wrong){
                
            }
        
        
        
        
        
        }
        
        $output .= '</form>'; 
    }
?>