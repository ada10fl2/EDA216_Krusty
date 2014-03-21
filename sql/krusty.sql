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
	FOREIGN KEY(productID) REFERENCES products(productID),
	PRIMARY KEY(orderID, productID)
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
	FOREIGN KEY(ingredientID) REFERENCES ingredients(ingredientID),
	PRIMARY KEY(productID, ingredientID)
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
	creationDate DateTime,
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
	FOREIGN KEY(palletID) REFERENCES pallets(palletID),
	PRIMARY KEY(loadingOrderlD, palletID)
);


insert into customers (customerName,address) values('Finkakor AB','Helsingborg');
insert into customers (customerName,address) values('Småbröd AB','Malmö');
insert into customers (customerName,address) values('Kaffebrod AB','Landskrona');
insert into customers (customerName,address) values('Bjudkakor AB','Ystad');
insert into customers (customerName,address) values('Kalaskakor AB','Trelleborg');
insert into customers (customerName,address) values('Partykakor AB','Kristianstad');
insert into customers (customerName,address) values('Gästkakor AB','Hässleholm');
insert into customers (customerName,address) values('Skånekakor AB','Perstorp');		


insert into products (productName) values('Nut Ring'); 		# 1
insert into products (productName) values('Nut cookie');	# 2
insert into products (productName) values('Amneris');		# 3
insert into products (productName) values('Tango');			# 4
insert into products (productName) values('Almond delight');# 5 
insert into products (productName) values('Berliner');		# 6


insert into orders (delivery,customerID) values('2014-05-01',1);
insert into orders (delivery,customerID) values('2014-05-02',2);

insert into orderContents (orderID,orderAmount,productID) values(1,20,1);
insert into orderContents (orderID,orderAmount,productID) values(1,10,2);
insert into orderContents (orderID,orderAmount,productID) values(2,30,3);

insert into ingredients (amountInStorage,name) values(100,'Flour'); 				# 1
insert into ingredients (amountInStorage,name) values(100,'Butter'); 				# 2
insert into ingredients (amountInStorage,name) values(100,'Icing sugar');			# 3
insert into ingredients (amountInStorage,name) values(100,'Roasted, chopped nuts');	# 4
insert into ingredients (amountInStorage,name) values(100,'Fine-ground nuts');		# 5
insert into ingredients (amountInStorage,name) values(100,'Ground, roasted nuts');	# 6
insert into ingredients (amountInStorage,name) values(100,'Bread crumbs');			# 7
insert into ingredients (amountInStorage,name) values(100,'Sugar');					# 8
insert into ingredients (amountInStorage,name) values(100,'Egg whites');			# 9
insert into ingredients (amountInStorage,name) values(100,'Chocolate');				# 10
insert into ingredients (amountInStorage,name) values(100,'Marzipan');				# 11
insert into ingredients (amountInStorage,name) values(100,'Butter');				# 12
insert into ingredients (amountInStorage,name) values(100,'Eggs');					# 13
insert into ingredients (amountInStorage,name) values(100,'Potato starch');			# 14
insert into ingredients (amountInStorage,name) values(100,'Wheat ﬂour');			# 15
insert into ingredients (amountInStorage,name) values(100,'Sodium bicarbonate');	# 16
insert into ingredients (amountInStorage,name) values(100,'Vanilla');				# 17
insert into ingredients (amountInStorage,name) values(100,'Chopped almonds');		# 18
insert into ingredients (amountInStorage,name) values(100,'Cinnamon');				# 19
insert into ingredients (amountInStorage,name) values(100,'Vanilla sugar');			# 20

# Nut Rings
insert into productIngredients (productID,ingredientID,ingredientAmount) values(1,1,450);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(1,2,450);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(1,3,190);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(1,4,225);

# Nut Cookie
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,5,750);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,6,625);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,7,125);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,8,375);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,9,35);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(2,10,50);

# Amneris
insert into productIngredients (productID,ingredientID,ingredientAmount) values(3,11,750);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(3,2,250);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(3,13,250);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(3,14,35);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(3,15,35);

# Tango
insert into productIngredients (productID,ingredientID,ingredientAmount) values(4,2,200);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(4,8,250);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(4,1,300);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(4,16,4);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(4,17,2);

# Almond
insert into productIngredients (productID,ingredientID,ingredientAmount) values(5,2,400);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(5,8,270);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(5,18,279);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(5,1,400);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(5,19,10);

# Berliner
insert into productIngredients (productID,ingredientID,ingredientAmount) values(6,1,350);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(6,2,250);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(6,3,100);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(6,13,50);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(6,20,5);
insert into productIngredients (productID,ingredientID,ingredientAmount) values(6,10,50);

insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(1,10000,'2014-01-01');
insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(2,10000,'2014-01-01');
insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(3,20000,'2014-01-02');
insert into ingredientTransactions (ingredientID,transactionAmount,transactionDate) values(4,15000,'2014-01-03');

insert into pallets (productID,orderID,currentState,creationDate) values(1,2,'BLOCKED', '2014-02-20');
insert into pallets (productID,orderID,currentState,creationDate) values(2,2,'', '2014-02-21');
insert into pallets (productID,orderID,currentState,creationDate) values(3,1,'', '2014-02-22');

INSERT INTO loadingOrders(orderID, loadingDate) values(1, '2014-02-20');

insert into loadingOrderContents(loadingOrderlD, palletID) values(1, 3);
