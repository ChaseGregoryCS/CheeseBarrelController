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
                } elseif(substr($Query, 1) == "S" ) {
                    $temp = $response->fetch_assoc();
                    $rVal = $temp["value"];
                } else {
                    $rVal = true;
                    $rVal = "Shit";
                }
                return $rVal;
        }
            
        public
        
            function __construct(){
                $this->dbo = new dbConnectObj();
            }
        
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
                        $rVal = substr($rVal,0);
                        break;
                    case "HE":
                        $rVal = substr($rVal,0);
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
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='TempUpper';";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetTempLower($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='TempLower';";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetHumdityUpper($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='HumUpper';";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetHumidityLower($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='HumLower';";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetUpdateRate($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='Update';";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetCaptureRate($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='SystemIO';";
                $rVal = $this->RunQuerry($Query);
                if(! $rVal) {echo "error";}
                return $rVal;
            }
            
            function SetSystemIO($value){
                $Query = "UPDATE Settings SET value='" . $value . "' WHERE name='State';";
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
