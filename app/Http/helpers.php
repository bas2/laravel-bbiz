<?php

function FixData($data){
  $str=str_replace(' before', '', $data);
  $str=str_replace(' hours', 'h', $str);
  $str=str_replace('week', 'w', $str);
  $str=str_replace(' day', 'd', $str);
  $str=str_replace('ds', 'd', $str);
  return $str;
}