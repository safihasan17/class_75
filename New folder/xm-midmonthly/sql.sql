drop database if exists idb_xm;
create database idb_xm;


drop table if exists manufactuer;
create table manufactuer(
    id int primary key auto_increment,
    name varchar(50),
    address varchar(100),
    contact_no varchar(50)
);


drop table if exists product;
create table product(
   id int primary key auto_increment,
   name varchar(50),
   price int(5),
   manufacturer_id int(10)
);

insert into manufactuer(name, address, contact_no) values("Apple", "USA", 45225);
insert into manufactuer(name, address, contact_no) values("Dell", "US", 454575);
insert into manufactuer(name, address, contact_no) values("Samsung", "Koria", 47445);
insert into manufactuer(name, address, contact_no) values("canon", "Japan", 47445);


insert into product(name, price, manufacturer_id ) values("laptop", "6000", 1);
insert into product(name, price, manufacturer_id ) values("mouse", "800", 2);
insert into product(name, price, manufacturer_id ) values("Montor", "400", 3);
insert into product(name, price, manufacturer_id ) values("Spiker", "900", 2);
insert into product(name, price, manufacturer_id ) values("Mobile", "6000", 1);
insert into product(name, price, manufacturer_id ) values("s23", "9900", 3);
insert into product(name, price, manufacturer_id ) values("camera", "7800", 4);

-- procedure

drop procedure if exists createmanufacturer;
delimiter //
create procedure  createmanufacturer( pname varchar(50), paddress varchar(100), pcontact_no varchar(50) )
begin
insert into manufactuer(name, address, contact_no) values (pname, paddress, pcontact_no );
end //

delimiter ;


-- view
drop view if exists vw_product;
create view  vw_product as 
select p.*, m.name as mfg
from product as p , manufactuer as m
where p.manufacturer_id = m.id and p.price > 5000;

-- trigger

drop trigger if exists delete_mfg;
create trigger delete_mfg
after delete on manufactuer
for each row 
delete from product where manufacturer_id = old.id;













