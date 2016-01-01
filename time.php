<?php
public function elapsed_time($tp,$time = null){ 

//English (default):
$terms = array('now'=>'Now','min'=>'minutes ago','hour'=>'hours ago','day'=>'days ago','yday'=>'yesterday','yday2'=>'2 days ago','week'=>'weeks ago','oneyear'=>'Last year');
$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

//Hungary - Magyar:
//$terms = array('now'=>'Most','min'=>'perce','hour'=>'órája','day'=>'napja','yday'=>'tegnap','yday2'=>'tegnapelőtt','week'=>'hete','oneyear'=>'Tavaly');
//$days = array('Hétfő','Kedd','Szerda','Csütörtök',' Péntek','Szombat','Vasárnap');

//Germany - Deutch:
//$terms = array ('now'=>'Jetzt','min'=>'minuten','hour'=>'stunden','day'=>'tagen','yday'=>'gestern','yday2'=>'vorgestern','week'=>'Wochen','oneyear'=>'letztes Jahr');
//$Tage = array ('Montag','Dienstag','Mittwoch','Donnerstag','Freitag', 'Samstag', 'Sonntag');


$time = Is_null($time) ? time() : $time;
$time_diff = abs($time - $tp);
$sec = $time_diff;
$min = floor ($time_diff / 60);
$min2 = $min % 60;
$hour = floor ($time_diff / 60 / 60);
$hour2 = $hour % 24;
$days = floor ($time_diff / 60 / 60 / 24);
$days2 = $days % 7;
$week = $week2 = floor ($time_diff / 60 / 60 / 24 / 7);

if ($week2 >= 4) {
  $now_year = date('Y');
  $t_year = date('Y', $tp);
  $buff1 = $now_year-$t_year;
  if($buff1==0){
    return date ("m.d H:i", $tp );
  }elseif($buff1==1){
    return $terms['oneyear'].' '.date ("m.d H:i", $tp );
  }else{
    return date ("Y.m.d H:i", $tp );
  }
}


if($days==2){
  return $terms['yday2'].', '.date ("H:i ", $tp );
}

if($days==1){
  return $terms['yday'].', '.date ("H:i ", $tp );
}
if($days==1 and $days2==0){
  return $terms['yday'].', '.$hour2.' '.$terms['hour'];
}
$elap = '';
if ( $sec > 0 ) {
  $elap = $terms['now'];
  if ( $min != 0 ) {
    $elap = $min2.' '.$terms['min'];
    if ( $hour != 0 ) {
      if($hour2<2){
        $elap =$hour2.' '.$terms['hour'].' '.$min2.' '.$terms['min'];
      }else{
        $elap =$hour2.' '.$terms['hour'];
      }
      if ($days != 0 ) {
        if($days==$days2){
          $days3 = $days2;
        }else{
          $days3 = $days2+($days-$days2);
        }
        if($days3>date("N") and $days3<date("N")+7){
          $napja = date ("N",$tp);
          $napja1 = $napja-1;
          $elap = $days[$napja1].', '.date ( "m.d H:i ", $tp );
        }else{
          $elap = $days3.' '.$terms['day'].', '.date ( "m.d H:i ", $tp );
        }
        if ( $week != 0 ) {
          $elap =$week2.' '.$terms['week'].', '.date ( "m.d H:i ", $tp );
        }
      }
    }
  }
}
if ( $elap == '' ) {
  return $terms['now'];
}else {
  return $elap;
}
}
?>
