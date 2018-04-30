<?php
$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    
    function encoder($text, $key){
        global $letters;
        $text = strtolower($text);                          // text to lower                    
        $text_arr = str_split($text);                       //string -> array
        for($i = 0, $count = count($text_arr); $i < $count; $i++){
            for($j = 0, $jcount = count($letters); $j < $jcount; $j++){
                if ($text_arr[$i] == ' '){
                    $encoderText[$i] = ' ';
                } 
                if ($text_arr[$i] == $letters[$j]){
                    if($j < $jcount - $key){
                        $encoderText[$i] = $letters[$j + $key];
                    }
                    elseif($j >= $jcount - $key){
                        $new_key = $j + $key - $jcount;
                        $encoderText[$i] = $letters[$new_key];
                    }
                } 
            }    
        }
        return $encoderText;
    }
    function encoder_word($text, $key_word){
        global $letters;
        $key_word = strtolower($key_word);                  // text to lower  
        $key_word = str_split($key_word);                   //string -> array

        $text = strtolower($text);                          // text to lower                    
        $text_arr = str_split($text);                       //string -> array

        for($m = 0, $mcount = count($key_word); $m < $mcount; $m++){ 
            for($j = 0, $jcount = count($letters); $j < $jcount; $j++){
                if ($key_word[$m] == $letters[$j]){
                    $m_key2[$m] = $j;                          //numbers array
                }
            }
        }
        for($i = 0, $count = count($text_arr); $i < $count; $i++){
            for($j = 0, $jcount = count($letters); $j < $jcount; $j++){
                if ($text_arr[$i] == $letters[$j]){
                    $m_key1[$i] = $j;
                }
            }  
        }
        $c = 0;
        for($j = 0, $jcount = count($text_arr); $j < $jcount; $j++){
            if ($text_arr[$j] == ' '){
                $encoder_wordText[$j] = ' ';
            }
            else{
                $m = $c % count($m_key2);
                $x = $m_key1[$j] + $m_key2[$m];
                $x_m = $x % count($letters);
                $encoder_wordText[$j] = $letters[$x_m];
                $c++;
            }
        }
        return $encoder_wordText;
    }
    
    function decoder($text, $key){
        global $letters;
        $text = strtolower($text);                          // text to lower                    
        $text_arr = str_split($text);                       //string -> array
        $key = count($letters) - $key;
        for($i = 0, $count = count($text_arr); $i < $count; $i++){
            for($j = 0, $jcount = count($letters); $j < $jcount; $j++){
                if ($text_arr[$i] == ' '){
                    $decoder[$i] = ' ';
                } 
                if ($text_arr[$i] == $letters[$j]){
                    if($j < $jcount - $key){
                        $decoder[$i] = $letters[$j + $key];
                    }
                    elseif($j >= $jcount - $key){
                        $new_key = $j + $key - $jcount;
                        $decoder[$i] = $letters[$new_key];
                    }
                } 
            }    
        }
        return $decoder;
    }

    function decoder_word($text, $key_word){
        global $letters;
        $key_word = strtolower($key_word);                  // text to lower  
        $key_word = str_split($key_word);                   //string -> array

        $text = strtolower($text);                          // text to lower                    
        $text_arr = str_split($text);                       //string -> array

        for($m = 0, $mcount = count($key_word); $m < $mcount; $m++){ 
            for($j = 0, $jcount = count($letters); $j < $jcount; $j++){
                if ($key_word[$m] == $letters[$j]){
                    $m_key2[$m] = $j;                          //numbers array
                }
            }
        }
        for($i = 0, $count = count($text_arr); $i < $count; $i++){
            for($j = 0, $jcount = count($letters); $j < $jcount; $j++){
                if ($text_arr[$i] == $letters[$j]){
                    $m_key1[$i] = $j;
                }
            }  
        }
        $c = 0;
        for($j = 0, $jcount = count($text_arr); $j < $jcount; $j++){
            if ($text_arr[$j] == ' '){
                $decoder_word[$j] = ' ';
            }
            else{
                $m = $c % count($m_key2);
                $x = $m_key1[$j] - $m_key2[$m];
                if ($x < 0){
                    $x = count($letters) + $x;
                }
                $x_m = $x % count($letters);
                $decoder_word[$j] = $letters[$x_m];
                $c++;
            }
        }
        return $decoder_word;
    }
    
    //include('view.php');

     $text = 'London is a capital of Great Britain XyZ';
     //$text = 'eogloa il a vipvttl hn geett uzigabn qgz';

     $key = 3;                                               //offset
     $key_word = 'Tatiana';                                  //offset
     $encoderText = encoder($text, $key);
     $encoder_word = encoder_word($text, $key_word);
     $decoder = decoder($text, $key);
     $decoder_word = decoder_word($text, $key_word);

     echo implode($encoderText)."<hr>";                             //array -> string
     echo implode($encoder_word)."<hr>";                            
     echo implode($decoder)."<hr>";                                 
     echo implode($decoder_word);  
?>