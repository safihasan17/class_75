drop database if exists create_db;
create database create_db;

drop table if exists teacher;
create table teacher(
    id int primary key auto_increment,
    name varchar(50),
    qualification varchar(50),
    contact_no varchar(20)
);


drop table if exists course;
create table course(
    id int primary key auto_increment,
    course_name varchar(50),
    fee int(6),
    teacher_id int(10)
);


insert into teacher(name, qualification , contact_no) values("jaber", "MA", 45454);
insert into teacher(name, qualification , contact_no) values("safi", "BBA", 4545564);
insert into teacher(name, qualification , contact_no) values("Sahed", "BA", 4544454);


insert into course(course_name, fee, teacher_id ) values("bangla", 16000, 1);
insert into course(course_name, fee, teacher_id ) values("ENGLISH", 17000, 3);
insert into course(course_name, fee, teacher_id ) values("Math", 18000, 2);
insert into course(course_name, fee, teacher_id ) values("History", 14000, 2);


-- procedure

drop procedure if exists createteacher;
delimiter //
create procedure createteacher(pname varchar(50), pqualification varchar(50), pcontact_no varchar(20) )
begin
insert into teacher(name,qualification, contact_no) values(pname,pqualification, pcontact_no );
end //
delimiter ;

-- view
DROP VIEW IF EXISTS vw_course;

CREATE VIEW vw_course AS
SELECT c.*, t.name AS teacher
FROM teacher AS t, course AS c
WHERE c.teacher_id = t.id
AND c.fee > 15000;


-- trigger

drop trigger if exists delete_teacher;
create trigger delete_teacher
after delete on teacher
for each row 
delete from course where teacher_id = old.id;

