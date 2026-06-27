<?php
require_once("db-confiq.php");

$sql = "select count(*) as stu_num from students where address= 'Mothijheel'";
$sql = "select count(*) from students where address= 'Mothijheel'";

$sql = "select sum(score) total_score from results where student_id= 1";
$sql = "select sum(score) total_score from results where exam_type= 'Mid-1'";


$sql = "select r.student_id, max(r.score) max_score, s.full_name
 from results r , students s where
  exam_type= 'Mid-1' and r.student_id = s.id ";


  $sql = "select r.student_id, r.score,  s.full_name
 from results r , students s where
  r.exam_type= 'Mid-1' and r.student_id = s.id and
  r.score = (select max(score)from results where exam_type = 'mid-1')
  ";



$sql = "select p.manufacturer_id, min(p.price) min_price, p.name, m.name
 from manufactuer m , product p where
 p.manufacturer_id =m.id ";


 $sql = "select avg(price) from products";

 $sql = "select avg(score) from results where exam_type= 'Mid-1' ";

 $sql = "select exam_type, avg(score) from results group by exam_type ";
 








?>