<!--Author Chase Gregory -->


<html>
    <head>
        <?php 
            require_once('php/setting.php');
            $Obj = new ControllerInterface();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
                
                $queryVals = $_SERVER['QUERY_STRING'];
                parse_str($queryVals, $get_array);
                if ($get_array['b'] == '0'){
                    $Obj->SubmitControl($_POST["Temp_Lower_Range"],$_POST["Temp_Upper_Range"],$_POST["Hum_Upper_Range"],$_POST["Hum_Lower_Range"]);
                    $Obj->SetCaptureRate($_POST["Capture_Rate"]);
                } elseif($get_array['b'] == '1') {
                    $currState = $Obj->GetState();
                    $io = substr($get_array['t'],2);
                    switch (substr($get_array['t'],0,2)){
                        case 'HE':
                            switch($io){
                                case 'i':
                                    $temp = "h" . substr($currState,1);
                                    $Obj->SetManualState($temp);
                                    break;
                                case 'o':
                                    $temp = "i" . substr($currState,1);
                                    $Obj->SetManualState($temp);
                                    break;
                                }
                                break;
                        case 'CO':
                            switch($io){
                                case 'i':
                                    $temp = "c" . substr($currState,1);
                                    $Obj->SetManualState($temp);
                                    break;
                                case 'o':
                                    $temp = "i" . substr($currState,1);
                                    $Obj->SetManualState($temp);
                                    break;
                                }
                            break;
                        case 'HU':
                            switch($io){
                                case 'i':
                                    $temp = substr($currState,0,2) . "h";
                                    $Obj->SetManualState($temp);
                                    break;
                                case 'o':
                                    $temp =  substr($currState,0,2) . "i";
                                    $Obj->SetManualState($temp);
                                    break;
                                }
                            break;
                        case 'DH':
                            switch($io){
                                case 'i':
                                    $temp = substr($currState,0,2) . "d";
                                    $Obj->SetManualState($temp);
                                    break;
                                case 'o':
                                    $temp =  substr($currState,0,2) . "i";
                                    $Obj->SetManualState($temp);
                                    break;
                                }
                            break;
                        }
                        if($io == 'a'){
                            $currState = $Obj->GetState();
                            switch (substr($get_array['t'],0,2)){
                                case 'HE':
                                case 'CO':
                                    $temp = strtoupper(substr($currState,0,1)) . substr($currState,1);
                                    $Obj->SetManualState($temp);
                                    break;
                                case 'HU':
                                case 'DH':
                                    $temp = substr($currState,0,2) . strtoupper(substr($currState,2));
                                    $Obj->SetManualState($temp);
                                    break;
                            }
                        }
                    } else {
                        $Obj->TglSystemStatusBtn();
                        
                    }
                    $url = "CheeseMainPage.php";
                    header('Location: '.$url);
                }
        ?>
        <link rel="stylesheet" href="CheeseMainPage.css">
        <div style="background-color: #696969;" >
            <div class="headerDivOne">
                <h2 class="subtitle">Cheese Barrel Controller</h2>
                <h3 class="maintitle">
                    <br/>
                    <br/>
                        <form method="post" action="CheeseMainPage.php?b=2" name="main" id="main" >
                            <?php $Obj->DisplayStatusBtn(); ?>
                        </form>
                </h3>
            </div>
            <br/>
            <div class="headerDivTwo" style="float: right;">
                <form method="post" action="CheeseMainPage.php?b=0" name="main" id="main" >
                    <div class="upperRng" style="padding-top: 2%; float:left;;">
                        :Upper Range  <?php 
                        echo ' <input class="rangeInput " style="float: left;" type="text" size="3" name="Temp_Upper_Range" id="Temp_Upper_Range" value = "' . $Obj->GetTempUpper() . '"><br />';  
                    ?> 
                    </div>
                    <div class="lowerRng" style="padding-top: 2%; float:right;">
                        Lower Range:  <?php 
                        echo ' <input class="rangeInput"  style="float: right;" type="text" size="3" name="Temp_Lower_Range" id="Temp_Lower_Range" value = "' . $Obj->GetTempLower() . '"><br />';  
                    ?> 
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="upperRng" style ="float:left;" >
                        :Upper Range  <?php 
                        echo ' <input class="rangeInput" style="float: left;" type="text" size="3" name="Hum_Upper_Range" id="Hum_Upper_Range" value = "' . $Obj->GetHumdityUpper() . ' "><br />';  
                    ?> 
                    </div>
                    <div class="rangeBar">
                    </div>
                    <div class="lowerRng" style ="float:right;">
                        Lower Range:   <?php 
                        echo ' <input class="rangeInput" style="float: right;" type="text" size="3" name="Hum_Lower_Range" id="Hum_Lower_Range" value = "' . $Obj->GetHumidityLower() . ' "><br />';  
                    ?>
                    </div>
                    <br/>
                    <br/>
                    <div class="upperRng" />
                        Update Rate <?php 
                        echo '<input class="rangeInput" style="float: left; margin-left:15%;" type="text" size="3" name="Capture_Rate" id="Capture_Rate" 
                        value="' . $Obj->GetCaptureRate() . '"><br/>'; ?>
                    </div>
                    <input class="txt_rangeSubmit" type="submit" value="Submit">
                    </form>
                <div>
                <br/>
                    <table style="width:100%">
                            <tr>
                                <th style="width: 25%;"><h5 style = "text-align: center;" > Heater </h5></th>
                                <th style="width: 25%;"><h5 style = "text-align: center;" > Cooler </h5></th>
                                <th style="width: 25%;"><h5 style = "text-align: center;" > Humidifier </h5></th>
                                <th style="width: 25%;"><h5 style = "text-align: center;" > De-Humidifier </h5></th>
                            </tr>
                            <tr>
                                <?php
                                        $Obj->DisplayControlButton("HE");
                                        $Obj->DisplayControlButton("CO");
                                        $Obj->DisplayControlButton("HU");
                                        $Obj->DisplayControlButton("DH");
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </head>
    
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    
    <body bgcolor="gray">
        <div class="bodyDivMain"  >
            <table style="width:100%; margin-bottom:5%;">
                <tr>
                    <th style="width: 25%;"><h5 style = "text-align: center;" > Temperature V Time </h5></th>
                    <th style="width: 25%;"><h5 style = "text-align: center;" > Humidity V Temperature </h5></th>
                    <th style="width: 25%;"><h5 style = "text-align: center;" > Humidity V Time </h5></th>
                </tr>
                <tr>
                    <td>
                        <img src="Charts/SolutionVTime.jpeg" alt="Temp v Time" width="100%" ><img/>
                    </td>
                    <td>
                        <img src="Charts/SolutionVTime.jpeg" alt="Temp v Time" width="100%"><img/>
                    </td>
                    <td>
                        <img src="Charts/SolutionVTime.jpeg" alt="Temp v Time" width="100%"><img/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <-------------------------------------------o-------------------------------------->
                    </td>
                    <td>
                        <-------------------------------------------o-------------------------------------->
                    </td>
                    <td>
                        <-------------------------------------------o-------------------------------------->
                    </td>
                </tr>
            </table>
                
            </div>
        </div>
    </body>
    
</html>
