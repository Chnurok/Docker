<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

if ($_POST) {
    $num = $_POST["num"];
    if (ctype_digit($num)){
        $int_num = (int)  $num;
        $mas = $redis->sinter('arr');
        $b = True;
        foreach ($mas as $value) {
            if ($value == $int_num){
              $b = False;
              $res = array('error' => "the number has already arrived");
              echo json_encode($res);
              break;
            }
            if ($value == $int_num + 1){
              $b = False;
              $res = array('error' => "number is 1 less than already received");
              echo json_encode($res);
              break;
            }
        }
        if ($b == True){
          $answer = $int_num+1;
          $res = array('number' => $answer);
          echo json_encode($res);
          $redis->sAdd('arr', $int_num);
        }
      }
    }
?>
