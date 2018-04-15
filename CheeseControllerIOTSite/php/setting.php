<?php
    require_once('securePhp/mysqli_connect.php');
    
    class ControllerInterface
    {
        private $dbo;
        
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
            function DisplayControlButton($type){
                $pVal = "error";
                $found = false;
                switch ($type) {
                    case "CO":
                        $found = true;
                        break;
                    case "HE":
                        $found = true;
                        break;
                    case "DH":
                        $found = true;
                        break;
                    case "HU":
                        $found = true;
                        break;
                }
                if($found){
                    $temp = $this->StateOf($type);
                    switch ($temp){
                        case 'I':
                             $pVal = '<td><center><div class="btnsOn"> <input class="btnsIOInActive" width=3 type="submit" value="I" name="On'.$type.'> </div> <div class="btnsAuto"> <input class="btnsIOAuto" width=3 type="submit" value="A" name="Auto'.$type.'> </div><div class="btnsOff"> <input class="btnsIOActive" width=3 type="submit" value="O" name="Off'.$type.'"> </div> </center> </td> ';
                            break;
                        case 'O':
                             $pVal = '<td> <center><div class="btnsOn"> <input class="btnsIOActive" width=3 type="submit" value="I" name="On'.$type.'> </div> <div class="btnsAuto"> <input class="btnsIOAuto" width=3 type="submit" value="A" name="Auto'.$type.'> </div> <div class="btnsOff"> <input class="btnsIOInActive" width=3 type="submit" value="O" name="Off'.$type.'"> </div> </center> </td>';
                            break;
                        }
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
                $Query = "SELECT value FROM Settings WHERE name='CaptureRate'";
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
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='SystemIO'";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetSystemIO($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='State'";
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
