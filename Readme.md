
# ** Cheese Barrel Controller **
## Author: Chase Gregory, 2018
###### This is a LAMP IoT Device
###### Dependencies
######  	(Prefferred: Arch-Arm 4.14) Linux, Apache, Mysql, PHP7, Python 2.*, Node.js, C
######  	Ras Pi 2 or newer, DHT11 Sensor 

##	Overview

	This project is a template for future projects. But the task came at hand to
	build an evironment controller for an cheese aging barrel. So, it was taken a step 
	further and a site was built around the controller. That way we can control the 
	temperature, and record the data around the cheese to maintain and experiment with a 
	wide variety of cheeses.

	It should be connected to a Humidifier, DeHumidifier, Refridgerator(Cooler) and, Heater

--------------------------------------------------------------------------------------------------

##	RasPi GPIO pins

	In Design (Plans may change)
	  Controls:
	     GPIO 17 -> Humidifier
	     GPIO 27 -> DeHumidifier
	     GPIO 22 -> Refriderator/Cooler
	     GPIO 23 -> Heater

	  Inputs:
	     GPIO  4 -> DHT11 Sensor
	
	  Power:
	     Pin 4/2 -> 5V to DHT11 Sensor
	  
	  Optional:
	     Pin   4 -> 5V to DHT11 Sensor
	     Pin   2 -> 5V to Digital Screen

--------------------------------------------------------------------------------------------------

##      States

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

-------------------------------------------------------------------------------------------------

##      Lamp

	There is a Site included in this project. This means it is remotely 
	possible to change states, manually override a state, change system
	ranges for auto control, view data, output and status of the systems.
	
	The site uses an open source library called smoothie. It allows for 
	real time plotting of the data we are getting from the sensor. 	 

	
