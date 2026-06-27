create table if not exists student_logs(
    id int unsigned auto_increment primary key,
    student_id int,
    status varchar(20),
    time timestamp
);


-- tigget--

create trigger add_student
after insert  on students
for each row
insert into student_logs(student_id, status, time)
values(new.id, "added", now());

insert into students(name, email)
values("Readoy", "redoy@gmail.com");



create trigger update_student
after update on students
for each row
insert into student_logs(student_id, status, time)
values(new.id, "updated" , now());

update  students 
set name="mursalin" , email= "mursa@gmail.com" 
where id=7;

update  students 
set name="Fahim" , email= "fahim@gmail.com" 
where id=5;




drop trigger is exists delete_student;
create trigger delete_student
after delete on students
for each row
insert into student_logs(student_id, status, time)
values(old.id, "Delated" , now());

delete from students
where id = 5;












