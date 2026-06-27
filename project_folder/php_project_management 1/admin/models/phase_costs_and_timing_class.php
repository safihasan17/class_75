<?php

class PhaseCostsandTiming
{
    public $id;
    public $phase_id;
    public $project_id;
    public $allocated_cost;
    public $actual_cost;
    public $actual_time;      // integer: days
    public $expected_time;    // integer: days


    public function __construct($_id, $_phase_id, $_project_id, $_allocated_cost, $_actual_cost, $_actual_time, $_expected_time)
    {
        $this->id = $_id;
        $this->phase_id = $_phase_id;
        $this->project_id = $_project_id;
        $this->allocated_cost = $_allocated_cost;
        $this->actual_cost = $_actual_cost;
        $this->actual_time = $_actual_time;
        $this->expected_time = $_expected_time;
    }


    public function create(){
        global $db;
        $sql = "INSERT INTO phase_costs_and_timing(phase_id, project_id, allocated_cost, actual_cost, actual_time, expected_time)
        values($this->phase_id, $this->project_id, $this->allocated_cost, $this->actual_cost, $this->actual_time, $this->expected_time)";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            // Sync project budget & actual cost from phases
            self::syncProjectCosts($this->project_id);
            return true;
        }
    }

    public function update(){
        global $db;
        $sql = "UPDATE phase_costs_and_timing SET phase_id = $this->phase_id, project_id = $this->project_id, allocated_cost = $this->allocated_cost, actual_cost = $this->actual_cost, actual_time = $this->actual_time, expected_time = $this->expected_time WHERE id = $this->id";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            // Sync project budget & actual cost from phases
            self::syncProjectCosts($this->project_id);
            return true;
        }
    }

    static public function readALL(){
        global $db;
        $sql = "SELECT pct.id, p.title as project_title, ph.title as phase_title, pct.allocated_cost, pct.actual_cost, pct.actual_time, pct.expected_time
        FROM phase_costs_and_timing as pct, projects as p, phases as ph
        WHERE pct.project_id = p.id
        AND pct.phase_id = ph.id";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readById($_id){
        global $db;
        $sql = "SELECT id, phase_id, project_id, allocated_cost, actual_cost, actual_time, expected_time FROM phase_costs_and_timing WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    static public function delete($_id){
        global $db;
        // Get project_id before deleting so we can sync afterward
        $row = self::readById($_id);
        $project_id = $row ? $row['project_id'] : null;

        $db->query("DELETE FROM phase_costs_and_timing WHERE id = $_id");
        if($db->error){
            return $db->error;
        }else{
            if($project_id) self::syncProjectCosts($project_id);
            return true;
        }
    }

    /**
     * Recalculate and update project's budget_cost (sum of allocated_cost)
     * and actual_cost (sum of actual_cost) from its phases.
     */
    static public function syncProjectCosts($project_id){
        global $db;
        $pid = (int)$project_id;
        $sql = "UPDATE projects SET
                    budget_cost = (SELECT COALESCE(SUM(allocated_cost),0) FROM phase_costs_and_timing WHERE project_id = $pid),
                    actual_cost = (SELECT COALESCE(SUM(actual_cost),0) FROM phase_costs_and_timing WHERE project_id = $pid)
                WHERE id = $pid";
        $db->query($sql);
    }
}
?>
