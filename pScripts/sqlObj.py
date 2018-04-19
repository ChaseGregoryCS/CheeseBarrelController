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
        
    def SetSystemIO(newStatus):
        sql = "UPDATE Settings SET value='" + newStatus + "' where name='SystemIO'"
        cursor = self.db_conn
        cursor.execute(sql)
        
    def GetSystemStatus():
        sql = "SELECT value FROM Settings WHERE name='SystemIO'"
        cursor = self.db_conn
        cursor.execute(sql)
        return value in cursor
        
    
    
    
    
