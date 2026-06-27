drop trigger if exists remove_product;
create trigger remove_product 
after delete on brands
for each row 
delete from products where brand_id = old.id

delete from brands where id = 2;



drop trigger if exists remove_category;
create trigger remove_category
after delete on categories
for each row
delete from products where category_id = old.id;

delete from categories where id = 2;

