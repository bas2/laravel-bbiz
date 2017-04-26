<?php

function FixData($data){
  $str=str_replace(' before', '', $data);
  $str=str_replace(' second', 's', $str);
  $str=str_replace(' hour', 'h', $str);
  $str=str_replace('hs', 'h', $str);
  $str=str_replace(' minutes', 'm', $str);
  $str=str_replace(' week', 'wk', $str);
  $str=str_replace(' day', 'd', $str);
  $str=str_replace('ds', 'd', $str);
  return $str;
}