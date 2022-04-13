# BIM-Travel
This project contains information containing a Bus Tracking System I architected using an Arduino board which was programmed using C++, PHP, Javascript, Google Maps API, CSS, HTML. This gadget collected and sent coordinates to a databased I created on a web server on 000webhost.com.



### Rationale
This project was designed to sync the coordination of bus arrivals and passengers.  Presently, in Barbados, we do not know when the next bus will be available, or the time it will arrive at a bus stop. To solve this problem, I have come up with an ingenious way of tracking the location of the bus. This location determined by using an arduino microcontroller which would be placed inside the bus to send the longitude and latitude every 30 secs. By utilising this information, passengers would known the distance away from the bus stop and the estimated time buses will arrive at the bus stop. Passengers would then be able to synchronise and manage their time with the bus’s arrival time.

![logo](https://github.com/khalilgreenidge/BIM-Travel/blob/main/architecture.jpg "logo")

# Getting Started
- `git clone` this folder
- Install `Apache XAMPP` using this [link](https://www.apachefriends.org/index.html)
- Open up XAMPP control panel, and start `Apache` and `MySQL` modules
- Click the `Admin` button for MySQL to be directed to PhpMyAdmin, where you can import the `.sql` seen inside the repository.
- Go to `localhost/bimtravel/index.php` to see the landing page. 
- The tracking isn't available because you need the microcontroller device pictured below. However, you can still get the idea.


# Features
- Dashboard
- Map - display vehicle location
- Update location (via Arduino Microcontroller)
- Add drivers
- Add vehicles


# Appendix
The below image shows the arduino microcontroller setup.

![logo](https://github.com/khalilgreenidge/BIM-Travel/blob/main/sketch.png "arduino")
