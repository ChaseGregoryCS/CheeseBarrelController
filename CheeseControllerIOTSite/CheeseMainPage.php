<!--Author Chase Gregory -->


<html>
    <head>
        <script type="text/javascript" src="Charts/smoothie.js"></script>
    
    
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
                    $Obj->controlDistplay(substr($get_array['t'],0,2),$io);
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
            <h2 style="text-align:center;"> Data View <h2/>
            <div style="float:right; margin-right:3%; margin-bottom:3%;">
                <canvas id="temperature" height= 200 width =800 style="float: right; margin 25%"></canvas>
                <script type="text/javascript">
                    var updateRate = <?php echo $Obj->GetCaptureRate(); ?>
                    // Random data
                    var temp = new TimeSeries();
                    setInterval(function() {
                        temp.append(new Date().getTime(), Math.random());
                    }, (updateRate * 360));

                    var smoothieT = new SmoothieChart({ grid: {lineWidth: 1, millisPerLine: (updateRate * 360) ,verticalSections: 6 } });
                    smoothieT.addTimeSeries(temp, { strokeStyle: 'rgb(255, 0, 0)', fillStyle: 'rgba(125, 0, 0, 0.4)', lineWidth: 3 });
                    
                    smoothieT.streamTo(document.getElementById("temperature"), (updateRate * 360));
                </script>
            </div>
            <div  style="float:left; margin-left:25%; margin-bottom:3%;">
                Current Humidity
                <p id="temp"><?php $Obj->GetCurrHum(); ?></p>
            </div>
            <br />
            <br />
            <br />
            <br />
            <div style="float:right; margin-right:3%; margin-bottom:3%;margin-top:3%;">
                <canvas id="humididty" height= 200 width =800 style="float: right; margin 25%"></canvas>
                <script type="text/javascript">
                    var updateRate = <?php echo $Obj->GetCaptureRate(); ?>
                    // Random data
                    var humididty = new TimeSeries();
                    setInterval(function() {
                        humididty.append(new Date().getTime(), Math.random());
                    }, (updateRate * 360));

                    var smoothieH = new SmoothieChart({ grid: {lineWidth: 1, millisPerLine: (updateRate * 360), verticalSections: 6 } });
                    smoothieH.addTimeSeries(humididty, {strokeStyle: 'rgb(0, 0, 255)', fillStyle: 'rgba(0, 0, 125, 0.4)', lineWidth: 3 });
                    
                    smoothieH.streamTo(document.getElementById("humididty"), (updateRate * 360));
                </script>
            </div>
            <div   style="float:left; margin-left:25%; margin-bottom:3%;">
                Current Temperature
                <p id="temp"><?php $Obj->GetCurrTemp(); ?></p>
            </div>
        </div>
    </body>
    
</html>
