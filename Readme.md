
# ** Cheese Barrel Controller **
## Author: Chase Gregory, 2018
###### This is a LAMP IoT Device
###### Dependencies
######  	(Prefferred: Arch-Arm 4.14) Linux, Apache, Mysql, PHP7, Python 2.*, R
######  	Ras Pi 2+
 
added in the html wireframe <br/>
working on the php scripts and database <br/>
Fixed PHP serverside issues <br/>
Fixed PHP scripting issues <br/>
Added core.py <br/>
Added Button and State Logic: <br/>
	We dont want to have the heater on at the same time as the cooler <br/>
	nor Humidifier and DeHumidifier. So either one is on and the other <br/> 
	is off OR they are both off. <br/> <br/>

	<value1> 'n' <value2> eg: InI <br/>
	
	<value1> =  H/C/I <br/>
	<value2> =  H/D/I

	UpperCase value = auto control
	LowerCase value = user override
	
	H = Heater/Humidifier
	C = Cooler
	D = DeHumidifier
	I = Off

