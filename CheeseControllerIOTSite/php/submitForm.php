<?php
  require_once('php/setting.php');
  $temp = new ControllerInterface();
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $temp ->SubmitControl($_POST["Temp_Upper_Range"],$_POST["Temp_Lower_Range"],$_POST["Hum_Upper_Range"],$_POST["Hum_Lower_Range"]);
    }?>
}
?>
