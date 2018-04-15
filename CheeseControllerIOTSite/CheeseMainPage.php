<!--Author Chase Gregory -->


<html>
    <head>
        <?php require_once('php/setting.php');
            $Obj = new ControllerInterface();
        ?>
    
        <link rel="stylesheet" href="CheeseMainPage.css">
        <div style="background-color: gray;" >
            <div class="headerDivOne">
                <h2 class="subtitle"> Cheese Controller </h2>
                <h2 class="maintitle">Data View</h2>
            </div>

            <br/>
            <div class="headerDivTwo" style="float: right;">
                <form 
                    action="<?php $Obj->SubmitControl($_GET["Temp_Upper_Range"],$_GET["Temp_Lower_Range"],
                                                      $_GET["Hum_Upper_Range"],$_GET["Hum_Lower_Range"]);?>" 
                    method="get">
                    <div class="upperRng" style="padding-top: 2%; float:left;;">
                        :Upper Range  <?php 
                        echo ' <input class="rangeInput " style="float: left;" type="text" size="3" name="Temp_Upper_Range" id="Temp_Upper_Range" value = "' . $Obj->GetTempUpper() . ' "><br />';  
                    ?> 
                    </div>
                    <div class="lowerRng" style="padding-top: 2%; float:right;">
                        Lower Range:  <?php 
                        echo ' <input class="rangeInput"  style="float: right;" type="text" size="3" name="Temp_Lower_Range" id="Temp_Lower_Range" value = "' . $Obj->GetTempLower() . ' "><br />';  
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
                                <td>
                                    <div class="btnsOn">
                                        <input class="btnsIO" width=3 type="submit" value="I">
                                    </div>
                                    <div class="btnsOff">
                                        <input class="btnsIO" width=3 type="submit" value="O">
                                    </div>
                                </td>
                                <td>
                                    <div class="btnsOn">
                                        <input class="btnsIO" width=3 type="submit" value="I">
                                    </div>
                                    <div class="btnsOff">
                                        <input class="btnsIO" width=3 type="submit" value="O">
                                    </div>
                                </td>
                                <td>
                                    <div class="btnsOn">
                                        <input class="btnsIO" width=3 type="submit" value="I">
                                    </div>
                                    <div class="btnsOff">
                                        <input class="btnsIO" width=3 type="submit" value="O">
                                    </div>
                                </td>
                                <td>
                                    <div class="btnsOn">
                                        <input class="btnsIO" width=3 type="submit" value="I">
                                    </div>
                                    <div class="btnsOff">
                                        <input class="btnsIO" width=3 type="submit" value="O">
                                    </div>
                                </td>
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
    
    <body>
        <div class="bodyDivMain" >
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
