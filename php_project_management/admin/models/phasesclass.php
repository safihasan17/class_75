<?php

class Phases
{
    public $id;
    public $project_category_id;
    public $title;


    public function __construct($_id, $_project_category_id, $_title)
    {
        $this->id = $_id;
        $this->project_category_id = $_project_category_id;
        $this->title = $_title;
    }


    public function create(){
        global $db;
        $sql = "INSERT INTO phases(project_category_id, title)
        values($this->project_category_id, '$this->title')";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }

    public function update(){
        global $db;
        $sql = "UPDATE phases SET project_category_id = $this->project_category_id, title = '$this->title' WHERE id = $this->id";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }

    static public function readALL($_pg = 1, $_limit= 20){
        global $db;
        $skip = ($_pg -1)*$_limit;
        $sql = "SELECT p.id, pc.name as project_category, p.title 
        FROM phases as p , project_categories as pc 
        where p.project_category_id = pc.id  ORDER BY id DESC limit $_limit OFFSET $skip";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readById($_id){
        global $db;
        $sql = "SELECT id, project_category_id, title FROM phases WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    static public function delete($_id){
        global $db;
        $db->query("DELETE FROM phases WHERE id = $_id");
        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }


    /**
     * একটা phase-এর আন্ডারে থাকা সব task-এর allocated/actual cost আর time এর
     * AVERAGE বের করে phase_costs_and_timing টেবিলে sync করে।
     * এরপর project এর budget_cost ও sync করে দেয় (chain reaction)।
     */
    static public function syncFromTasks($_phase_id, $_project_id){
        global $db;
        $phase_id = (int)$_phase_id;
        $project_id = (int)$_project_id;

        $sql = "SELECT
                    COALESCE(SUM(allocated_cost), 0) as sum_allocated,
                    COALESCE(SUM(actual_cost), 0) as sum_actual,
                    MIN(expected_time) as min_expected_time,
                    MAX(actual_time) as max_actual_time,
                    
                    COALESCE(AVG(
                        CASE
                            WHEN allocated_cost = 0 OR allocated_cost IS NULL THEN 0
                            ELSE LEAST((actual_cost / allocated_cost) * 100, 100)
                        END
                    ), 0) as avg_completion_percent
                FROM tasks
                WHERE phase_id = $phase_id AND project_id = $project_id";

        $result = $db->query($sql)->fetch_assoc();

        $avg_allocated      = $result['sum_allocated'];
        $avg_actual         = $result['sum_actual'];
        $completion_percent = round($result['avg_completion_percent'], 1);
        $expected_time = !empty($result['min_expected_time']) && $result['min_expected_time'] != '0000-00-00 00:00:00'
                          ? $result['min_expected_time'] : '0000-00-00 00:00:00';
        $actual_time   = !empty($result['max_actual_time']) && $result['max_actual_time'] != '0000-00-00 00:00:00'
                          ? $result['max_actual_time'] : '0000-00-00 00:00:00';

        // phase_costs_and_timing এ এই phase+project এর row 
        $checkSql = "SELECT id FROM phase_costs_and_timing WHERE phase_id = $phase_id AND project_id = $project_id";
        $existing = $db->query($checkSql)->fetch_assoc();

        if ($existing) {
            $updateSql = "UPDATE phase_costs_and_timing SET
                            allocated_cost = $avg_allocated,
                            actual_cost = $avg_actual,
                            expected_time = '$expected_time',
                            actual_time = '$actual_time',
                            completion_percent = $completion_percent
                          WHERE id = {$existing['id']}";
            $db->query($updateSql);
        } else {
            $insertSql = "INSERT INTO phase_costs_and_timing
                            (phase_id, project_id, allocated_cost, actual_cost, expected_time, actual_time, completion_percent)
                           VALUES
                            ($phase_id, $project_id, $avg_allocated, $avg_actual, '$expected_time', '$actual_time', $completion_percent)";
            $db->query($insertSql);
        }

        if ($db->error) {
            return $db->error;
        }

        //  project er budget_cost  sync kore (chain)
        require_once 'models/projectclass.php';
        Project::syncBudgetFromPhases($project_id);

        return true;
    }

    //pagination
    static public function getpageNo($_no_of_rows){
      global $db;
      $sql = "select count(id) as total from phases";
      $result = $db->query($sql);
      $row = $result->fetch_assoc();
      // return $row;

      return ceil($row['total']/$_no_of_rows);
    }



   
}
?>