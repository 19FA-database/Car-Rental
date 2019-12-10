CREATE DATABASE IF NOT EXISTS carRental;
use carRental;

DROP TABLE IF EXISTS model;
create table model (
  modelId INT NOT NULL AUTO_INCREMENT,
  make VARCHAR(20) DEFAULT NULL,
  model VARCHAR(20) DEFAULT NULL,
  year INT,
  PRIMARY KEY (modelId),
  INDEX (make(10)),
  INDEX (model(10))
);

INSERT INTO model VALUES
(1, "Chevrolet", "Malibu", 2012),
(2, "Toyota", "Prius", 2016),
(3, "Jeep", "Grand Cherokee", 2010),
(4, "Ford", "Mustang", 2017);


DROP TABLE IF EXISTS car;
create table car (
  carNo INT NOT NULL AUTO_INCREMENT,
  modelId INT,
  price FLOAT,
  mileage INT,
  licensePlate VARCHAR(8),
  PRIMARY KEY (carNo),
  CONSTRAINT FK_CarModel FOREIGN KEY (modelId)
  REFERENCES model(modelId) ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX (price)
);

INSERT INTO car VALUES
(1, 2, 75.00, 40000, "ABC123"),
(2, 4, 200.00, 10000, "STANG12"),
(3, 3, 80.00, 94000, "JEEP98"),
(4, 1, 110.00, 50000, "ML153");

DROP TABLE IF EXISTS customer;
create table customer (
  customerId INT NOT NULL AUTO_INCREMENT,
  name char(50) NOT NULL,
  address char(100) NOT NULL,
  email char(50) NOT NULL,
  PRIMARY KEY (customerId)
);

INSERT INTO customer VALUES
(1, 'Ryan Schefske', '123 ABC Street', 'ryanschefske@gmail.com'),
(2, 'Anthony Rios', '999 Plum Ave', 'arios@gmail.com'),
(3, 'George Foreman', '456 Grill Lane', 'aforeman@yahoo.com');


DROP TABLE IF EXISTS rental;
create table rental (
  rentalId INT NOT NULL AUTO_INCREMENT,
  dateRented DATE NOT NULL,
  dateReturn DATE,
  carNo INT NOT NULL,
  customerId INT NOT NULL,
  PRIMARY KEY (rentalId),
  CONSTRAINT FK_RentalCar FOREIGN KEY (carNo)
  REFERENCES car(carNo) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT FK_RentalCustomer FOREIGN KEY (customerId)
  REFERENCES customer(customerId) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO rental VALUES
(1, "2019-03-02", "2019-04-01", 2, 1),
(2, "2019-08-09", "2019-08-13", 3, 2),
(3, "2018-12-12", "2018-12-25", 1, 3);

CREATE USER 'carRental'@'localhost' identified by 'test';
GRANT SELECT, INSERT, UPDATE, DELETE on carRental.* TO 'carRental'@'localhost';
