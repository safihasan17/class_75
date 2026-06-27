use round_70a;

drop table if exists manufactures;
create table manufactures(
    id int auto_increment primary key,
    name varchar(100),
    address varchar(255)
);

drop table if exists products;
create table products(
    id int auto_increment primary key,
    name varchar(100),
    manufacture_id int, 
    price float
);

insert into manufactures(name, address) values ("HP", "USA");
insert into manufactures(name, address) values ("DELL", "US");


insert into products(name, manufacture_id, price  ) values ("Mouse", 1, 800);
insert into products(name, manufacture_id, price  ) values ("Monitor", 1, 1100);
insert into products(name, manufacture_id, price  ) values ("Laptop", 2, 1400);
insert into products(name, manufacture_id, price  ) values ("Spicker", 2, 900);



drop procedure if exists createmanufacturer;
delimiter //
create procedure  createmanufacturer( pname varchar(100), paddress varchar(255))
begin
insert into manufactures(name, address) values (pname, paddress);
end //

delimiter ;


drop view if exists vw_product_list;
create view vw_product_list as 
select p.id, p.name, p.price,m.name mfg 
from products p, manufactures m
where p.manufacture_id = m.id and p.price> 1000;


drop trigger if exists delete_mfg;
create trigger delete_mfg
after delete on manufactures
for each row
delete from products where manufacture_id = old.id;










