set foreign_key_checks = 0;

drop table if exists customers;
drop table if exists orders;
drop table if exists orderContents;
drop table if exists products;
drop table if exists ingredients;
drop table if exists productIngredients;
drop table if exists ingredientTransactions;
drop table if exists pallets;
drop table if exists loadingOrders;
drop table if exists loadingOrderContents;

set foreign_key_checks = 1;

/* 
--------------------------- ORDERs  ---------------------------
 */
create table customers ( 
	customerID INT NOT NULL AUTO_INCREMENT,
	customerName VARCHAR(255),
	address VARCHAR(255) ,
	PRIMARY KEY(customerID)
);

create table orders (
	orderID INT NOT NULL AUTO_INCREMENT,
	delivery DATE,
	customerID INT NOT NULL,
	PRIMARY KEY(orderID),
	FOREIGN KEY(customerID) REFERENCES customers(customerID)
);

create table products ( 
	productID INT NOT NULL AUTO_INCREMENT,
	productName VARCHAR(255),
	PRIMARY KEY(productID)
);

create table orderContents (
	orderID INT NOT NULL,
	orderAmount INT,
	productID INT NOT NULL,
	FOREIGN KEY(orderID) REFERENCES orders(orderID),
	FOREIGN KEY(productID) REFERENCES products(productID)
);

/*
--------------------------- INGREDIENTS  --------------------------- 
*/
create table ingredients (
	ingredientID INT NOT NULL AUTO_INCREMENT,
	amountInStorage INT,
	name VARCHAR(255),
	PRIMARY KEY(ingredientID)
);

create table productIngredients (
	productID INT NOT NULL,
	ingredientID INT NOT NULL,
	ingredientAmount INT,
	FOREIGN KEY(productID) REFERENCES products(productID),
	FOREIGN KEY(ingredientID) REFERENCES ingredients(ingredientID)
);

create table ingredientTransactions (
	ingredientID INT NOT NULL,
	transactionAmount INT,
	transactionDate Date,
	FOREIGN KEY(ingredientID) REFERENCES ingredients(ingredientID)
);
/* 
--------------------------- LOADING  --------------------------- 
*/
create table pallets (
	palletID INT NOT NULL AUTO_INCREMENT,
	productID INT NOT NULL,
	orderID INT NOT NULL,
	currentState VARCHAR(255),
	creationDate Date,
	FOREIGN KEY(productID) REFERENCES products(productID),
	FOREIGN KEY(orderID) REFERENCES orders(orderID),
	PRIMARY KEY(palletID)
);

create table loadingOrders (
	loadingOrderlD INT NOT NULL AUTO_INCREMENT,
	orderID INT NOT NULL,
	loadingDate Date,
	FOREIGN KEY(orderID) REFERENCES orders(orderID),
	PRIMARY KEY(loadingOrderlD)
);

create table loadingOrderContents (
	loadingOrderlD INT NOT NULL,
	palletID INT NOT NULL,
	FOREIGN KEY(loadingOrderlD) REFERENCES loadingOrders(loadingOrderlD),
	FOREIGN KEY(palletID) REFERENCES pallets(palletID)
);


insert into customers (customerName,address) values('Finkakor AB','Helsingborg');
insert into customers (customerName,address) values('Småbröd AB','Malmö');
insert into customers (customerName,address) values('Kaffebrod AB','Landskrona');

insert into products (productName) values('Nut Ring');
insert into products (productName) values('Almond delight ');
insert into products (productName) values('Tango');

insert into orders (delivery,customerID) values('2014-05-01',1);
insert into orders (delivery,customerID) values('2014-05-02',2);

insert into orderContents (orderID,orderAmount,productID) values(1,20,1);
insert into orderContents (orderID,orderAmount,productID) values(1,10,2);
insert into orderContents (orderID,orderAmount,productID) values(2,30,3);

insert into ingredients (amountInStorage,name) values(10000,'Butter');
insert into ingredients (amountInStorage,name) values(10000,'Flour');
insert into ingredients (amountInStorage,name) values(20000,'Sugar');
insert into ingredients (amountInStorage,name) values(15000,'Eggs');

insert into productIngredients (productID,ingredientID,ingredientAmount) values(1,1,450);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(1,2,450);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,1,400);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,2,400);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,3,270);

insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(1,10000,'2014-01-01');
insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(2,10000,'2014-01-01');
insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(3,20000,'2014-01-02');
insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(4,15000,'2014-01-03');

insert into pallets (productID,orderID,currentState,creationDate) values(1,2,'BLOCKED', '2014-02-20');
insert into pallets (productID,orderID,currentState,creationDate) values(1,2,'', '2014-02-20');