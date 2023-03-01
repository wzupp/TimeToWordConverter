<?php

interface TimeToWordConvertingInterface {
    public function convert(int $hours, int $minutes): string;
}

class TimeToWordConverter implements TimeToWordConvertingInterface {
    public function convert(int $hours, int $minutes): string {
        $numbers = array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять', 'десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать','двадцать','двадцать одна', 'двадцать две', 'двадцать три', 'двадцать четыре', 'двадцать пять', 'двадцать шесть', 'двадцать семь', 'двадцать восемь', 'двадцать девять',' ','двадцать девять','двадцать восемь', 'двадцать семь', 'двадцать шесть', 'двадцать пять', 'двадцать четыре', 'двадцать три', 'двадцать две', 'двадцать одна', '', 'девятнадцать', 'восемнадцать', 'семнадцать', 'шестнадцать', 'пятнадцать', 'четырнадцать', 'тринадцать', 'двенадцать', 'одинадцать','','девять', 'восемь', 'семь', 'шесть', 'пять', 'четыре', 'три', 'две','одна','',);
        $hours1 = array ('','одного','двух','трех','четырех','пяти ','шести','семи','восьми','девяти','десяти','одиннадцати','двенадцати');
        $hours2 = array ('','один','два','три','четыре','пять','шесть','семь','восемь','девять','десять','одиннадцать','двенадцать');
        $hours3 = array ('','','второго','третьего','четвертого','пятого','шестого','седьмого','восьмого','девятого','десятого','одиннадцатого','двенадцатого');
        $hours4 = array ('','','двух','трех','четырех','пяти','шести','семи','восьми','девяти','десяти','одиннадцати','двенадцати');
        //словари  
        $hours_in_words = '';
        $minutes_in_words = '';
        
    
        if ($hours > 12 || $hours < 1 || $minutes > 59 || $minutes < 0) {
            return 'Неверное время.';
        }
        
        if ($minutes == 0) {
            $minutes_in_words = '';
        } elseif ($minutes == 1 || $minutes == 59 ) {
            $minutes_in_words = 'одна минута';
        } elseif ($minutes > 1 && $minutes < 5 || $minutes < 59 && $minutes > 54 || $minutes > 21 && $minutes < 25){
            $minutes_in_words = $numbers[$minutes] . ' минуты';
        } elseif ($minutes < 59 && $minutes != 15 && $minutes != 45 && $minutes <54 && $minutes !=21 && $minutes !=39){
            $minutes_in_words = $numbers[$minutes] . ' минут';
        } elseif ($minutes == 15){
            return 'четверть часа.';
        } elseif ($minutes == 45){
            return 'без пятнадцати ' . $numbers[$hours+1];
        } elseif ($minutes == 21){
            return 'двадцать одна минута после ' . $hours1[$hours+1] . '.';
        } elseif ($minutes ==  39){
            return 'двадцать одна минута до ' . $hours1[$hours+1] . '.';
        }
        //реализация склонений минут и использование обиходных выражений 
        
        /*if ($hours == 2 || $hours == 3 || $hours == 4) {
            return $hours2[$hours] . ' часа.';
        } elseif ($hours == 5 || $hours == 6 || $hours == 7 || $hours == 8 || $hours == 9 || $hours == 10 || $hours == 11 || $hours == 12 ) {
            return $hours_in_words[$hours] . ' часов.';
        } elseif ( $hours == 1 ){
            return $hours2[$hours] . ' час';
        }*/
        
        if ($hours > 1 && $hours < 5) {
            $hours_in_words = $hours2[$hours] . ' часа.';
        } else {
            $hours_in_words = $hours2[$hours] . ' часов.';
        } 
        if ( $hours == 1){
            return $hours_in_words = $hours2[$hours] . ' час.';
        }
        
        if ($minutes == 0) {
            return $hours_in_words;
        } elseif ($minutes > 0 && $minutes < 30) {
            return $minutes_in_words . ' после ' . $hours1[$hours].  ' часов.';
        } 
        if ( $minutes  == 30){
            return 'половина ' . $hours3[$hours+1] .'.';
        }
        if ( $minutes > 30 && $minutes < 60){
            return $minutes_in_words . ' до ' . $hours4[$hours+1] .'.';
        }
        //реализация склонений часов 


        /*elseif ($minutes == 30) {
            return 'половина ' . $hours_in_words[$i+1];
        } elseif ($minutes > 30 && $minutes < 60) {
            $halfHours = $hours + 1;
            return $minutes_in_words . ' до ' . $hours_in_words;
        }*/
    }
}

$tc = new TimeToWordConverter();
echo "7:00 - ".$tc->convert(7, 0) . PHP_EOL;    // Семь часов
echo "7:01 - ".$tc->convert(7, 1) . PHP_EOL;    // Одна минута после семи часов
echo "7:03 - ".$tc->convert(7, 3) . PHP_EOL;    // Пятнадцать минут после семи часов
echo "7:12 - ".$tc->convert(7, 12) . PHP_EOL;   // Двенадцать минут после семи часов 
echo "7:15 - ".$tc->convert(7, 15) . PHP_EOL;   // Четверть часа 
echo "7:22 - ".$tc->convert(7,22) . PHP_EOL;    // двадцать две минуты после семи часов
echo "7:30 - ".$tc->convert(7,30) . PHP_EOL;    // Половина восьмого
echo "7:35 - ".$tc->convert(7, 35) . PHP_EOL;   // Двадцать пять минут до восьми 
echo "7:41 - ".$tc->convert(7, 41) . PHP_EOL;   // Девятнадцать минут до восьми
echo "7:56 - ".$tc->convert(7, 56) . PHP_EOL;   // Четыре минуты до восьми
echo "7:59 - ".$tc->convert(7, 59) . PHP_EOL;   // Одна минута до восьми

?>