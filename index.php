<?php
$redis = new Redis();
$redis->connect('10.156.0.26', 6379);

if ($_POST) {
    $num = $_POST["num"];
    if (ctype_digit($num)){
        $int_num = (int)  $num;
        $mas = $redis->sinter('arr');
        $b = True;
        foreach ($mas as $value) {
            if ($value == $int_num){
              $b = False;
              $res = array('error' => "the number has already arrived", 'server ip' => $_SERVER['SERVER_ADDR']);
              echo json_encode($res);
              break;
            }
            if ($value == $int_num + 1){
              $b = False;
              $res = array('error' => "number is 1 less than already received", 'server ip' => $_SERVER['SERVER_ADDR']);
              echo json_encode($res);
              break;
            }
        }
        if ($b == True){
          $answer = $int_num+1;
          $res = array('number' => $answer, 'server ip' => $_SERVER['SERVER_ADDR']);
          echo json_encode($res);
          $redis->sAdd('arr', $int_num);
        }
    } else {
    	$res = array('error' => "string recieved", 'server ip' => $_SERVER['SERVER_ADDR']);
        echo json_encode($res);
    }
}
?>
