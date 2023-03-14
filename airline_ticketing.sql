DROP Database IF EXISTS airline_ticketing;
Create Database airline_ticketing;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

Create table IF NOT EXISTS administrative(

  administrative_id int(30) ,
  firstname varchar(200) NOT NULL,
  lastname varchar(200) NOT NULL,
  email varchar(200) NOT NULL,
  password text NOT NULL,
   primary KEY (administrative_id)
);

INSERT INTO administrative (administrative_id,firstname, lastname, email,password) VALUES ( 1, 'M' , 'A' , 'admin@yahoo.com' , '1234');

CREATE TABLE customer (
  customer_id int(30) AUTO_INCREMENT,
  first_name varchar(20) NOT  NULL,
  last_name varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  email varchar(35) NOT NULL,
  pwd varchar(40) NOT NULL,
  phone_no int(20) NOT NULL,
  `address` varchar(150) NOT NULL,
  primary KEY (customer_id)
);
INSERT INTO `customer` (`customer_id`, `pwd`, `first_name`,`last_name`,`gender`, `email`, `phone_no`, `address`) VALUES ('1', '1234', 'A','A','F','c@yahoo.com', '1234', 'c') ;

CREATE TABLE airlines_list (
  airline_id int(30) AUTO_INCREMENT,
  airlines text NOT NULL,
  logo_path text NOT NULL,
  package_weight float NOT NULL,
  package_width float NOT NULL,
  package_height float NOT NULL,
  primary KEY (airline_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table airlines_list
--

INSERT INTO airlines_list (airline_id, airlines, logo_path,package_weight,package_width,package_height) VALUES
(1, 'AirAsia', '1600999080_kisspng-flight-indonesia-airasia-airasia-japan-airline-tic-asia-5abad146966736.8321896415221927106161.jpg',50,50,100),
(2, 'Philippine Airlines', '1600999200_Philippine-Airlines-Logo.jpg',45,100,200),
(3, 'Cebu Pacific', '1600999200_43cada0008538e3c1a1f4675e5a7aabe.jpeg',30,120,250);



CREATE TABLE airport_list (
  airport_id int(30) ,
  airport text NOT NULL,
  location text NOT NULL,
  PRIMARY KEY(airport_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `airport_list` (`airport_id`, `airport`, `location`) VALUES
(1, 'NAIA', 'Metro Manila'),
(2, 'Beijing Capital International Airport', 'Chaoyang-Shunyi, Beijing'),
(3, 'Los Angeles International Airport', 'Los Angeles, California'),
(4, 'Dubai International Airport', 'Garhoud, Dubai'),
(5, 'Mactan-Cebu Airport', 'Cebu');


CREATE TABLE flight_details (
  flight_id int(30) AUTO_INCREMENT ,
  airline_id int(30) NOT NULL,
  plane_no text NOT NULL,
  departure_airport_id int(30) NOT NULL,
  arrival_airport_id int(30) NOT NULL,
 departure_date datetime NOT NULL,
  arrival_date datetime NOT NULL,
  seats int(5) DEFAULT NULL,
  adult_price float(30) NOT NULL,
  child_price float(30) NOT NULL,
  date_created datetime NOT NULL DEFAULT current_timestamp(),
  primary KEY (flight_id),
  FOREIGN KEY(airline_id)REFERENCES airlines_list(airline_id),
  FOREIGN KEY(departure_airport_id)REFERENCES airport_list(airport_id),
  FOREIGN KEY(arrival_airport_id)REFERENCES airport_list(airport_id)
);
INSERT INTO `flight_details` (`flight_id`, `airline_id`, `plane_no`, `departure_airport_id`, `arrival_airport_id`, `departure_date`, `arrival_date`, `seats`, `adult_price`,`child_price`, `date_created`) VALUES
(4, 3, 'CEB10023', 1, 5, '2022-06-20 01:00:00', '2022-08-20 02:00:00', 100, 2500,300, '2022-03-02 14:50:47');

INSERT INTO `flight_details` (`flight_id`, `airline_id`, `plane_no`, `departure_airport_id`, `arrival_airport_id`, `departure_date`, `arrival_date`, `seats`, `adult_price`,`child_price`, `date_created`) VALUES
(5, 3, 'CEB10022', 5, 1, '2022-07-20 01:00:00', '2022-08-20 02:00:00', 100, 2500,300, '2022-03-02 14:50:47');


CREATE TABLE ticket_details (
  ticket_id int AUTO_INCREMENT,
  flight_id int(30) DEFAULT NULL,
  customer_id int(30) DEFAULT NULL,
  ticket_price float(30) DEFAULT NULL,
  no_child int(30) NOT NULL,
  no_adult int(30) NOT NULL,
  date_created datetime NOT NULL,
  primary KEY (ticket_id),
  FOREIGN KEY(flight_id)REFERENCES flight_details(flight_id),
  FOREIGN KEY(customer_id)REFERENCES customer(customer_id)
  
);

CREATE TABLE booked_flight (
  id int(30) AUTO_INCREMENT,
  customer_id int(30),
  flight_id int(30) ,
  passport_no varchar(30),
  name varchar(30) ,
  contact text NOT NULL,
  date_booked datetime NOT NULL,
  primary KEY (id),
  FOREIGN KEY(flight_id)REFERENCES flight_details(flight_id),
  FOREIGN KEY(customer_id)REFERENCES customer(customer_id)
);



CREATE TABLE system_settings (
  id int(30) ,
  name text NOT NULL,
  email varchar(200) NOT NULL,
  contact varchar(20) NOT NULL,
  cover_img text NOT NULL,
  about_content text NOT NULL,
  primary KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table system_settings
--

INSERT INTO system_settings (id, name, email, contact, cover_img, about_content) VALUES
(1, 'Online Airline Ticketing System ', 'info@sample.comm', '+6948 8542 623', '1615490820_banner.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Online Flight Booking System&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply an airline reservation system with different airlines and airports facilitating the reservation for customers having many options to choose the most suitable option.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------



