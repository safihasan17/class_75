drop table if exists my_db;
create database my_db;
use my_db;

drop table if exists brands;
create table brands
     (
     id int unsigned primary key auto_increment,
     Name varchar(100)
    );

-- insert into brands(name) values ("APPle") , ("Dell"), ("Samsung");
insert into brands(name) values ("APPle");
insert into brands(name) values ("samsung");
insert into brands(name) values ("Techno");



drop table if exists categories;
create table categories
    (
     id int unsigned primary key auto_increment,
      Name varchar(100)
     );

insert into categories(name) values ("Mobile");
insert into categories(name) values ("smart Watch");
insert into categories(name) values ("laptop");



drop table if exists products;
create table products
       (
         id int unsigned primary key auto_increment,
        name varchar(100),
        brand_id int,
        category_id int,
        price float,
        is_active tinyint
        );

insert into products(name,brand_id,category_id,price,is_active) 
values("iPhone 14",1,1,1000,1),
("Samsung Galaxy S22",2,1,800,1),
("Techno X2",3,2,600,1),
("Smart Watch 2",1,2,300,1),
("Laptop 2",1,3,2000,1),
("Smart Watch 3",2,2,400,1);


drop view if exists vw_active_product;
create view vw_active_product as
select p.id, p.name, b.name as brand, c.name as category, p.price
from products p ,  brands b, categories c
where p.brand_id = b.id and p.category_id=c.id and p.is_active =1;


select * from 
vw_active_product where price >1000;

select * from 
vw_active_product where  category = "Mobile" and brand ="Apple";

select * from 
vw_active_product where  category = "Mobile" and price>500 and price <1500;












