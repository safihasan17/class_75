delimiter //
create procedure if not exists show_products()
begin 
select * from vw_active_product;
select * from products;
end //
delimiter ;
//
call show_products();
show procedure status where db = "my_db";
drop procedure show_products;


delimiter //
create procedure  create_product(p_name varchar(100), p_brand_id int, p_category_id int, p_price float, p_is_active tinyint)
begin 
insert into products(name, brand_id, category_id, price, is_active)
values(p_name, p_brand_id, p_category_id, p_price , p_is_active);
end //
delimiter ;

show procedure status where db = "my_db";
call create_product("ipad", 1, 1, 1200, 0);
call create_product("ipad-mini", 1, 1, 1100, 1);
