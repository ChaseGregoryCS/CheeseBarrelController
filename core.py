#!bin/python
import sys
import datetime
import MySQLdb

#This is the core
#it reads settings from the cheesedatabase then makes actions according to the settings
#and the gauged input


#sqlOBJ  
class sqlOBJ:
    
    def __init__(self):
        try:
            self.db_conn = mysql.connect(user='---', password='---', host='---', database='---')
        except mysql.connector.Error as err:
            if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
                print("Something is wrong with your user name or password")
            elif err.errno == errorcode.ER_BAD_DB_ERROR:
                print("Database does not exist")
            else:
                print(err)
            
    def __del__(self):
        self.db_conn.close()
        
    def GetOneValueSettingQuerry(var):
        sql = "SELECT value FROM Settings WHERE name='" + var + "'"
        cursor = self.db_conn
        cursor.execute(sql)
        return value in cursor
        
    def GetOneValueStatsQuerry(search):
        sql = "SELECT TOP 1 " + search + " FROM Stats ORDER BY StateID DESC"
        cursor = self.db_conn
        cursor.execute(sql)
        return value in cursor
        
    def InsertObservations(state, temp, humidity, date):
        sql = "INSERT INTO Stats (State, temperature, humidity, date) VALUES (" + state + ","  + temp + ","  + humidity + ","  + date + ")"
        cursor = self.db_conn
        cursor.execute(sql)
        
#Statemachine Object. This is the logic behind when Considering to turn things off and on.
class StateMachine:
    
    
    def __init__(self):
        self.CtlArr = [False,False,False,False]
        self.State = "I|I" 
        Proceed()
        
    def Capture(dbo):
        #TODO:Hardware inputs
        th = dbo.GetOneValueStatsQuerry("humidity")
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
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
