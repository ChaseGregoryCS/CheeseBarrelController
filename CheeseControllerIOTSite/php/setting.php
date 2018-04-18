<?php
    require_once('securePhp/mysqli_connect.php');
    
    class ControllerInterface
    {
        private $dbo;
        
        private function GetControlArr(){
            $rArr = array('HE'=>0,'CO'=>0,'HU'=>0,'DH'=>0);
            $val = strtoupper($this->StateOf("HE"));
            if ($val == "H"){
                $rArr['HE'] = 1;
            } elseif ($val == "C") {
                $rArr['CO'] = 1;
            }
            
            $val = strtoupper($this->StateOf("HU"));
            if ($val == "H"){
                $rArr['HU'] = 1;
            } elseif ($val == "D") {
                $rArr['DH'] = 1;
            }
            return $rArr;
        }
        
        protected function RunQuerry($Query){
                $rVal = false;

                $response = $this->dbo->dbc->query($Query);
                if (!$response){
                    $rVal = "Error! " . $this->dbo->dbc->error;
                } elseif(substr($Query, 0,1) == 'S') {
                    $temp = $response->fetch_assoc();
                    $rVal = $temp["value"];
                } else {
                    $rVal = true;
                }
                return $rVal;
        }
            
            
        public
        
            function __construct(){
                $this->dbo = new dbConnectObj();
            }
        
            #Button Control
            function TglSystemStatusBtn(){
                $status = strtolower($this->GetSystemIO());
                if($status == "on"){
                    $this->SetSystemIO("off");
                } else {
                    $this->SetSystemIO("on");
                }
            }
            
            #DisplaySystemButtons
            function DisplayStatusBtn(){
                $status = $this->GetSystemIO();
                echo '<button id="btnIO" style="background-color:transparent;margin-left: 40%; margin-top: 3%;"><img src="img/' . $status . 'Button.jpeg"></button>';
            }
            
            function DisplayControlButton($type){
                $ctlArr = $this->GetControlArr();
                if ($this->StateOf($type) == strtoupper($this->StateOf($type))){
                    $auto = "on";
                } else { 
                    $auto = "off"; 
                }
    
                if($ctlArr[ $type ] == 1) {
                        $pVal = '
                            <td>
                                <table style="width:100%; border:solid;">
                                    <tr>
                                        <th style="width: 25%;"><h5 style = "text-align: center;" > Off </h5></th>
                                        <th style="width: 25%;"><h5 style = "text-align: center;" > Auto </h5></th>
                                        <th style="width: 25%;"><h5 style = "text-align: center;" > On </h5></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <form method="post" action="CheeseMainPage.php?b=1&t='. $type . 'o">
                                                <button id="btnIO" style="background-color:transparent;"><img src="img/offButton.jpeg"></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="CheeseMainPage.php?b=1&t='. $type . 'a">
                                                <button id="btnIO" style="background-color:transparent;"><img src="img/' . $auto . 'Button.jpeg"></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="CheeseMainPage.php?b=1&t='. $type . 'i">
                                                <button id="btnIO" style="background-color:transparent;"><img src="img/onButton.jpeg"></button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </td>';
                    } else {
                        $pVal = '
                            <td>
                                <table style="width:100%; border:solid;">
                                    <tr>
                                        <th style="width: 25%;"><h5 style = "text-align: center;" > Off </h5></th>
                                        <th style="width: 25%;"><h5 style = "text-align: center;" > Auto </h5></th>
                                        <th style="width: 25%;"><h5 style = "text-align: center;" > On </h5></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <form method="post" action="CheeseMainPage.php?b=1&t='. $type . 'o">
                                                <button id="btnIO" style="background-color:transparent;"><img src="img/onButton.jpeg"></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="CheeseMainPage.php?b=1&t='. $type . 'a">
                                                <button id="btnIO" style="background-color:transparent;"><img src="img/' . $auto . 'Button.jpeg"></button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="CheeseMainPage.php?b=1&t='. $type . 'i">
                                                    <button id="btnIO" style="background-color:transparent;"><img src="img/offButton.jpeg"></button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </td>';
                    }
            echo $pVal;
            }
            
            #Transformers/Accessors
            function GetTempUpper(){
                $Query = "SELECT value FROM Settings WHERE name='TempUpper'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function GetTempLower(){
                $Query = "SELECT value FROM Settings WHERE name='TempLower'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function GetHumdityUpper(){
                $Query = "SELECT value FROM Settings WHERE name='HumUpper'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function GetHumidityLower(){
                $Query = "SELECT value FROM Settings WHERE name='HumLower'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function GetUpdateRate(){
                $Query = "SELECT value FROM Settings WHERE name='Update'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function GetCaptureRate(){
                $Query = "SELECT value FROM Settings WHERE name='CaptureRat'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function GetSystemIO(){
                $Query = "SELECT value FROM Settings WHERE name='SystemIO'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function GetState(){
                $Query = "SELECT value FROM Settings WHERE name='State'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {return "error";}
                return $rVal;
            }
            
            function StateOf($which){
                $Query = "SELECT value FROM Settings WHERE name='State'";
                $rVal = $this->RunQuerry($Query);
                switch ($which){
                    case "CO":
                        $rVal = substr($rVal,0,1);
                        break;
                    case "HE":
                        $rVal = substr($rVal,0,1);
                        break;
                    case "DH":
                        $rVal = substr($rVal,2);
                        break;
                    case "HU":
                        $rVal = substr($rVal,2);
                        break;
                    default:
                        $rVal = "I";
                        break;
                }
                return $rVal;
            }
                        
            function SetManualState($state){
                $Query = "UPDATE Settings SET value='" . $state . "' WHERE name='State'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetTempUpper($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='TempUpper'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetTempLower($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='TempLower'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetHumdityUpper($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='HumUpper'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetHumidityLower($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='HumLower'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetUpdateRate($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='Update'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetCaptureRate($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='CaptureRat'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetSystemIO($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='SystemIO'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SubmitControl($CO, $HE, $HU, $DH){
                $this->SetTempLower($CO);
                $this->SetTempUpper($HE);
                $this->SetHumdityUpper($HU);
                $this->SetHumidityLower($DH);
            }
        }
?>
