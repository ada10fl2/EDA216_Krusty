#EDA216 - Database Technology - Project

This is a school project made in the course http://cs.lth.se/eda216/project/ at Faculty of engineering, Lund Univerity, Sweden

## Project Description
http://fileadmin.cs.lth.se/cs/Education/EDA216/project/dbtproject.pdf

## ER Design
<img src='https://github.com/ada10fl2/EDA216_Project/raw/master/Krusty_Design.PNG'>

## Screenshots
<img src='https://github.com/ada10fl2/EDA216_Project/raw/master/Krusty_Screen_2.PNG'>

<img src='https://github.com/ada10fl2/EDA216_Project/raw/master/Krusty_Screen_1.PNG'>

<img src='https://github.com/ada10fl2/EDA216_Project/raw/master/Krusty_Screen_3.PNG'>

## Stack
 * PHP 5.4
 * MySql
 * Ubuntu 12.04 LTS 

## Setup
Run in console
```sh
sudo apt-get update
sudo apt-get install python-software-properties
sudo add-apt-repository ppa:ondrej/php5
sudo apt-get update
sudo apt-get install php5
php5 -v
sudo service apache2 restart
sudo cp apache.conf /etc/mysql/my.cnf
sudo nano /etc/mysql/my.cnf
```

Run `mysql -u root -p`
```mysql
CREATE USER 'eda216'@'localhost' IDENTIFIED BY 'eda216';
GRANT ALL PRIVILEGES ON *.* TO 'eda216'@'localhost' IDENTIFIED BY 'eda216';
FLUSH PRIVILEGES;
```
