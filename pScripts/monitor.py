#!bin/python

import core.py


def main():
    sqc = sqlOBJ()
    hwInterface = StateMachine()
    #TODO: Filelog for page with output stream.
    isOn = True
    while(isOn):
        if sqc.GetSystemStatus() == "off":
            isOn = False
        
        hwInterface.Proceed()
    
    
    
    
if __name__=="__main__":
    main()
