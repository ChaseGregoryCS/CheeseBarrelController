#!bin/python
import sqlObj.py
        
#Statemachine Object. This is the logic behind when Considering to turn things off and on.
class StateMachine:
    
    
    def __init__(self):
        self.CtlArr = [False,False,False,False]
        self.State = "I|I" 
        Proceed()
        
    def Capture(dbo):
        #TODO:Hardware inputs
        th = dbo.GetOneValueStatsQuerry("temperature")
        tt = dbo.GetOneValueStatsQuerry("humidity")
        return [tt,tt,th,th]
    
    def TakeAction():
            SetHeat(self.CtlArr[0])
            SetCool(self.CtlArr[1])
            SetHumid(self.CtlArr[2])
            SetDeHumid(self.CtlArr[3])
    
    
    def ReadableState():
        rVal = "error" 
            
        if(CtlArr[0]):
            rVal = "H"
        elif(CtlArr[1]):
            rVal = "C"
        else:
            rVal = "I"
            
        rVal = rVal + "|"
        
        if(CtlArr[2]):
            rVal = rVal + "H"
        elif(CtlArr[3]):
            rVal = rVal + "D"
        else:
            rVal = rVal + "I"
        
        return rVal
            
    def Proceed():
        #we need to capture the data
        dbo = sqlOBJ()
        
        #Take a capture [tt,tt,th,th] then we will do some trickery
        currValues = Capture(dbo)
        
        #read the database for current values
        settings =[ dbo.GetOneValueSettingQuerry("TempUpper"),dbo.GetOneValueSettingQuerry("TempLower"),dbo.GetOneValueSettingQuerry("HumUpper"),dbo.GetOneValueSettingQuerry("HumLower")]
        
        #trickery
        for i in range(0,4):
            if (i % 2 == 0):
                if (curValues[i] >= settings[i]):
                    self.CtlArr[i] = True
                else:
                    self.CtlArr[i] = False
            else:
                if (curValues[i] <= settings[i]):
                    self.CtlArr[i] = True
                else:
                    self.CtlArr[i] = False
        
        
        #build the readable state
        self.State = ReadableState()
        
        #take action
        TakeAction()
        
        #Flush it into the database
        dbo.InsertObservations(self.state, currValues[0], currValues[3], datetime.now().strftime('%Y-%m-%d %H:%M:%S'))
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
