<?php
    function xml_lesson_parse($xml) {  
        $output = '';
        if (!$xml) return '';

        $header = explode(':', trim((string) $xml->head->title), 2);

        $output .= '<div class="top">
                        <h1 class="section-title">' . htmlspecialchars($header[0] . ' :') . '<span> ' . htmlspecialchars($header[1] ?? '');
        $output .= '</span></h1>
                    <p class="section-subtitle">' . htmlspecialchars($xml->head->subtitle) . '</p>
                    </div>
                <div class="bottom">';
                    
        foreach ($xml->lesson as $lesson) {
            $output .= '<div class="item">
                    <div class="subs">
                        <img class="icon" src="https://img.icons8.com/bubbles/100/000000/services.png" />
                        <h2>' . htmlspecialchars($lesson->title) . '</h2>
                    </div>';

            foreach ($lesson->paragraph as $paragraph) {
                $output .= '<p>' . htmlspecialchars($paragraph) . '</p>';
            }

            if (isset($lesson->list)) {
                $output .= '<div class="section-ul">
                        <p><strong>' . htmlspecialchars($lesson->list->{'list-paragraph'}) . '</strong></p>
                        <ul>';

                foreach ($lesson->list->item as $item) {
                    $parts = explode(':', $item, 2);
                    $output .= '<li><strong>' . htmlspecialchars($parts[0] . ':') . '</strong> ' . htmlspecialchars($parts[1] ?? '');

                    if (!empty($item->list->item)) {
                        $output .= '<ul>';
                        foreach ($item->list->item as $subItem) {
                            $output .= '<li>' . htmlspecialchars(trim((string) $subItem)) . '</li>';
                        }
                        $output .= '</ul>';
                    }

                    $output .= '</li>';
                }

                $output .= '</ul></div>';
            }

            $output .= '</div>'; 
        }

        foreach ($xml->{'example-block'} as $block) {
            $output .= '<div class="all-exmpls">';
        
            foreach ($block->example as $example) {
                $output .= '<div class="exmpl-item">
                        <div class="exmpl-info">
                            <h1>' . htmlspecialchars(trim($example->title)) . '</h1>';
                
                foreach ($example->paragraph as $paragraph) {
                    $output .= '<p>' . htmlspecialchars(trim($paragraph)) . '</p>';
                }
        
                foreach ($example->list as $list) {
                    $output .= '<div class="section-ul">';
        
                    if (isset($list->{'list-paragraph'})) {
                        $output .= '<p><strong>' . htmlspecialchars(trim($list->{'list-paragraph'})) . '</strong></p>';
                    }
        
                    $output .= '<ul>';
                    foreach ($example->list->item as $item) {
                        $parts = explode(':', trim((string) $item), 2);
                        if (count($parts) === 1) {
                            $output .= '<li>' . htmlspecialchars($parts[0]) . '</li>';
                        } else {
                            $output .= '<li><strong>' . htmlspecialchars($parts[0] . ':') . '</strong> ' . htmlspecialchars($parts[1] ?? '');
                        }

                        if (!empty($item->list->item)) {
                            $output .= '<ul>';
                            foreach ($item->list->item as $subItem) {
                                $output .= '<li>' . htmlspecialchars(trim((string) $subItem)) . '</li>';
                            }
                            $output .= '</ul>';
                        }

                        $output .= '</li>';
                    }
                    $output .= '</ul></div>';
                }
        
                $output .= '</div>
                    <div class="exmpl-cont">
                        <img src="' . htmlspecialchars(trim($example->img)) . '" alt="img">
                    </div>
                </div>';
            }
        
            $output .= '</div>'; 
        }
      

        $output .= '</div>'; 

        return $output;
    }

?>
