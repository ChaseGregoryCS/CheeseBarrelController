
# ** Cheese Barrel Controller **
## Author: Chase Gregory, 2018
###### This is a LAMP IoT Device
###### Dependencies
######  	(Prefferred: Arch-Arm 4.14) Linux, Apache, Mysql, PHP7, Python 2.*, R
######  	Ras Pi 2+
 
	We dont want to have the heater on at the same time as the cooler 
	nor Humidifier and DeHumidifier. So either one is on and the other 
	is off OR they are both off. 

	<value1> 'n' <value2> eg: InI
	
	<value1> =  H/C/I
	<value2> =  H/D/I

	UpperCase value = auto control
	LowerCase value = user override
	
	H = Heater/Humidifier
	C = Cooler
	D = DeHumidifier
	I = Off

	Update Rate is the rate at which the system captures data and makes 
	decisions
	
	There are two upper ranges for the heater and humidifier, and two 
	lower ranges for the Cooler and DeHumidifier. These are what change 
	the state in 'Auto' mode.
