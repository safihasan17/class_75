<?php

class Tasks
{
    public $id;
    public $project_id;
    public $phase_id;
    public $title;
    public $assign_to_team_id;
    public $allocated_cost;
    public $actual_cost;
    public $actual_time;
    public $expected_time;


    public function __construct($_id, $_project_id, $_phase_id, $_title, $_assign_to_team_id, $_allocated_cost, $_actual_cost, $_actual_time, $_expected_time)
    {
        $this->id = $_id;
        $this->project_id = $_project_id;
        $this->phase_id = $_phase_id;
        $this->title = $_title;
        $this->assign_to_team_id = $_assign_to_team_id;
        $this->allocated_cost = $_allocated_cost;
        $this->actual_cost = $_actual_cost;
        $this->actual_time = $_actual_time;
        $this->expected_time = $_expected_time;
    }


    public function create(){
        global $db;

        $allocated_cost = $this->allocated_cost !== null && $this->allocated_cost !== '' ? $this->allocated_cost : 0;
        $actual_cost    = $this->actual_cost    !== null && $this->actual_cost    !== '' ? $this->actual_cost    : 0;
        $expected_time  = !empty($this->expected_time) ? $this->expected_time : '0000-00-00 00:00:00';
        $actual_time    = !empty($this->actual_time)   ? $this->actual_time   : '0000-00-00 00:00:00';

        $sql = "INSERT INTO tasks(project_id, phase_id, title, assign_to_team_id, allocated_cost, actual_cost, actual_time, expected_time)
        values($this->project_id, $this->phase_id, '$this->title', $this->assign_to_team_id, $allocated_cost, $actual_cost, '$actual_time', '$expected_time')";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }

        // ✅ Task save হলে এই phase এর allocated/actual cost আর time, tasks থেকে sync করো
        require_once 'models/phasesclass.php';
        Phases::syncFromTasks($this->phase_id, $this->project_id);

        return true;
    }

    public function update(){
        global $db;

        $allocated_cost = $this->allocated_cost !== null && $this->allocated_cost !== '' ? $this->allocated_cost : 0;
        $actual_cost    = $this->actual_cost    !== null && $this->actual_cost    !== '' ? $this->actual_cost    : 0;
        $expected_time  = !empty($this->expected_time) ? $this->expected_time : '0000-00-00 00:00:00';
        $actual_time    = !empty($this->actual_time)   ? $this->actual_time   : '0000-00-00 00:00:00';

        // পুরনো phase_id জেনে রাখো, কারণ task অন্য phase এ move হতে পারে — দুই phase ই sync করতে হবে
        $old = self::readById($this->id);
        $old_phase_id   = $old ? $old['phase_id']   : $this->phase_id;
        $old_project_id = $old ? $old['project_id'] : $this->project_id;

        $sql = "UPDATE tasks SET
                project_id = $this->project_id,
                phase_id = $this->phase_id,
                title = '$this->title',
                assign_to_team_id = $this->assign_to_team_id,
                allocated_cost = $allocated_cost,
                actual_cost = $actual_cost,
                actual_time = '$actual_time',
                expected_time = '$expected_time'
                WHERE id = $this->id";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }

        // ✅ নতুন phase sync করো
        require_once 'models/phasesclass.php';
        Phases::syncFromTasks($this->phase_id, $this->project_id);

        // ✅ যদি task পুরনো phase থেকে নতুন phase এ move করা হয়, পুরনো phase ও re-sync করো
        if ($old_phase_id != $this->phase_id || $old_project_id != $this->project_id) {
            Phases::syncFromTasks($old_phase_id, $old_project_id);
        }

        return true;
    }

    static public function readALL(){
        global $db;
        $sql = "SELECT tk.id, p.title as project_title, ph.title as phase_title ,tk.title , t.name as team_name,
        tk.allocated_cost, tk.actual_cost, tk.expected_time, tk.actual_time,
        CASE
            WHEN tk.allocated_cost = 0 OR tk.allocated_cost IS NULL THEN 0
            ELSE LEAST(ROUND((tk.actual_cost / tk.allocated_cost) * 100, 1), 100)
        END AS task_percent
        FROM tasks as tk, projects as p, phases as ph, teams as t
        WHERE tk.project_id = p.id
        AND tk.phase_id = ph.id
        AND tk.assign_to_team_id = t.id";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function readById($_id){
        global $db;
        $sql = "SELECT id, project_id, phase_id, title, assign_to_team_id, allocated_cost, actual_cost, actual_time, expected_time FROM tasks WHERE id = $_id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    static public function readByPhase($_phase_id, $_project_id){
        global $db;
        $phase_id = (int)$_phase_id;
        $project_id = (int)$_project_id;
        $sql = "SELECT id, title, allocated_cost, actual_cost, actual_time, expected_time
                FROM tasks WHERE phase_id = $phase_id AND project_id = $project_id";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static public function delete($_id){
        global $db;

        // ডিলিট এর আগে phase_id/project_id নিয়ে রাখো, sync করার জন্য
        $row = self::readById($_id);
        $phase_id   = $row ? $row['phase_id']   : null;
        $project_id = $row ? $row['project_id'] : null;

        $db->query("DELETE FROM tasks WHERE id = $_id");
        if($db->error){
            return $db->error;
        }

        // ✅ Task delete হলেও phase কে re-sync করো (বাকি task গুলোর average দিয়ে)
        if ($phase_id && $project_id) {
            require_once 'models/phasesclass.php';
            Phases::syncFromTasks($phase_id, $project_id);
        }

        return true;
    }
}
?>