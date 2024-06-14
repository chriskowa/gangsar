<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('product_name')) {
    function product_name($name, $size = 0)
    {
        if (!$size) {
            $size = 42;
        }
        return character_limiter($name, ($size - 5));
    }
}

if (!function_exists('drawLine')) {
    function drawLine($size)
    {
        $line = '';
        for ($i = 1; $i <= $size; $i++) {
            $line .= '-';
        }
        return $line . "\n";
    }
}

if (!function_exists('printLine')) {
    function printLine($str, $size, $sep = ':', $space = null)
    {
        $size                 = $space ? $space : $size;
        $lenght               = strlen($str);
        list($first, $second) = explode(':', $str, 2);
        $line                 = $first . ($sep == ':' ? $sep : '');
        for ($i = 1; $i < ($size - $lenght); $i++) {
            $line .= ' ';
        }
        $line .= ($sep != ':' ? $sep : '') . $second;
        return $line;
    }
}

if (!function_exists('printText')) {
    function printText($text, $size)
    {
        $line = wordwrap($text, $size, '\\n');
        return $line;
    }
}

if (!function_exists('taxLine')) {
    function taxLine($name, $code, $qty, $amt, $tax, $size)
    {
        return printLine(printLine(printLine(printLine($name . ':' . $code, 16, '') . ':' . $qty, 22, '') . ':' . $amt, 33, '') . ':' . $tax, $size, '');
    }
}

if (!function_exists('character_limiter')) {
    function character_limiter($str, $n = 500, $end_char = '&#8230;')
    {
        if (mb_strlen($str) < $n) {
            return $str;
        }
        $str = preg_replace('/ {2,}/', ' ', str_replace(["\r", "\n", "\t", "\x0B", "\x0C"], ' ', $str));
        if (mb_strlen($str) <= $n) {
            return $str;
        }

        $out = '';
        foreach (explode(' ', trim($str)) as $val) {
            $out .= $val . ' ';
            if (mb_strlen($out) >= $n) {
                $out = trim($out);
                return (mb_strlen($out) === mb_strlen($str)) ? $out : $out . $end_char;
            }
        }
    }
}

if (!function_exists('word_wrap')) {
    function word_wrap($str, $charlim = 76)
    {
        is_numeric($charlim) or $charlim = 76;
        $str                             = preg_replace('| +|', ' ', $str);
        if (strpos($str, "\r") !== false) {
            $str = str_replace(["\r\n", "\r"], "\n", $str);
        }
        $unwrap = [];
        if (preg_match_all('|\{unwrap\}(.+?)\{/unwrap\}|s', $str, $matches)) {
            for ($i = 0, $c = count($matches[0]); $i < $c; $i++) {
                $unwrap[] = $matches[1][$i];
                $str      = str_replace($matches[0][$i], '{{unwrapped' . $i . '}}', $str);
            }
        }

        $str    = wordwrap($str, $charlim, "\n", false);
        $output = '';
        foreach (explode("\n", $str) as $line) {
            if (mb_strlen($line) <= $charlim) {
                $output .= $line . "\n";
                continue;
            }
            $temp = '';
            while (mb_strlen($line) > $charlim) {
                if (preg_match('!\[url.+\]|://|www\.!', $line)) {
                    break;
                }
                $temp .= mb_substr($line, 0, $charlim - 1);
                $line = mb_substr($line, $charlim - 1);
            }
            if ($temp !== '') {
                $output .= $temp . "\n" . $line . "\n";
            } else {
                $output .= $line . "\n";
            }
        }

        if (count($unwrap) > 0) {
            foreach ($unwrap as $key => $val) {
                $output = str_replace('{{unwrapped' . $key . '}}', $val, $output);
            }
        }

        return $output;
    }
}

function get_hari_all(){
    return array(
        '1'=>'Senin',
        '2'=>'Selasa',
        '3'=>'Rabu',
        '4'=>'Kamis',
        '5'=>"Jum'at",
        '6'=>'Sabtu',
        '7'=>'Minggu'
        );
}

function get_bulan_all($getBulan=null){
    $bulan=array(
        '01'=>'Januari',
        '02'=>'Februari',
        '03'=>'Maret',
        '04'=>'April',
        '05'=>'Mei',
        '06'=>'Juni',
        '07'=>'Juli',
        '08'=>'Agustus',
        '09'=>'September',
        '10'=>'Oktober',
        '11'=>'November',
        '12'=>'Desember'
    );
    if($getBulan == null)
        return $bulan;
    else{
        $i = $getBulan;
        if($getBulan < 10) $i = $getBulan;
        return $bulan[$i];
    }
}

function dateToIndo($date="",$day=false,$time=false){

    $bulan=get_bulan_all();
    $hari=get_hari_all();
    $d=date('d',  strtotime($date));
    $m=date('m',  strtotime($date));
    $y=date('Y',  strtotime($date));
    $n=date('N',  strtotime($date));
    $t=date('H:i', strtotime($date));
    if($day)
        $date = $hari[$n].", ".$d." ".$bulan[$m]." ".$y." ";
    else
        $date = $d." ".$bulan[$m]." ".$y." ";
        
    if($time)
        $date .= $t;
        
    return $date;
}

function numIndo($num,$precision=2,$decimal='.',$thousand=','){
  if (is_null($num)) {
    return 0;
  }
  if($num===''){
   return null;
  }
  $num = (float) $num;
  return number_format($num,$precision,$decimal,$thousand);
}