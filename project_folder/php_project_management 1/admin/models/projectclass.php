<?php

class Project
{
    public $id;
    public $title;
    public $client_id;
    public $project_category_id;
    public $user_id;
    public $expected_starting_time;
    public $expected_ending_time;
    public $actual_starting_time;
    public $actual_ending_time;
    // budget_cost and actual_cost are auto-calculated from phases — not set manually


    public function __construct(
        $_id,
        $_title,
        $_client_id,
        $_project_category_id,
        $_user_id,
        $_expected_starting_time,
        $_expected_ending_time,
        $_actual_starting_time,
        $_actual_ending_time
    ) {
        $this->id = $_id;
        $this->title = $_title;
        $this->client_id = $_client_id;
        $this->project_category_id = $_project_category_id;
        $this->user_id = $_user_id;
        $this->expected_starting_time = $_expected_starting_time;
        $this->expected_ending_time = $_expected_ending_time;
        $this->actual_starting_time = $_actual_starting_time;
        $this->actual_ending_time = $_actual_ending_time;
    }

    public function create()
    {
        global $db;

        $sql = "INSERT INTO projects 
                (title, client_id, project_category_id, user_id, expected_starting_time, expected_ending_time, actual_starting_time, actual_ending_time, actual_cost, budget_cost)
                VALUES (
                    '$this->title', $this->client_id, $this->project_category_id, $this->user_id,
                    '$this->expected_starting_time', '$this->expected_ending_time',
                    '$this->actual_starting_time', '$this->actual_ending_time',
                    0, 0
                )";

        $db->query($sql);

        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }



    public function update()
    {
        global $db;

        $sql = "UPDATE projects SET 
                    title = '$this->title',
                    client_id = $this->client_id,
                    project_category_id = $this->project_category_id,
                    user_id = $this->user_id,
                    expected_starting_time = '$this->expected_starting_time',
                    expected_ending_time = '$this->expected_ending_time',
                    actual_starting_time = '$this->actual_starting_time',
                    actual_ending_time = '$this->actual_ending_time'
                WHERE id = $this->id";

        if ($db->query($sql)) {
            return true;
        } else {
            return $db->error;
        }
    }

    public static function readAll()
    {
        global $db;
        $sql = "SELECT p.id, p.title, c.name AS client_name, pc.name AS category_name,        
       u.name AS user_name,  p.expected_starting_time, p.expected_ending_time,  p.actual_starting_time, p.actual_ending_time, p.actual_cost, p.budget_cost
        FROM projects as p, clients as c, users as u, project_categories as pc
        where p.client_id = c.id and p.project_category_id = pc.id and p.user_id = u.id  ";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function readById($_id)
    {
        global $db;
        $id = (int)$_id;
        $sql = "SELECT id, title, client_id, project_category_id, user_id, 
                       expected_starting_time, expected_ending_time, 
                       actual_starting_time, actual_ending_time, actual_cost, budget_cost
                FROM projects WHERE id = $id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    public static function delete($_id)
    {
        global $db;
        $id = (int)$_id;
        $db->query("DELETE FROM projects WHERE id = $id");
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }


    public static function updateStatus($_id, $_status)
    {
        global $db;
        $id = (int)$_id;
        $status = $db->real_escape_string($_status);
        $db->query("UPDATE projects SET status = '$status' WHERE id = $id");
        if ($db->error) {
            return $db->error;
        } else {
            return true;
        }
    }


    static public function getProjectDetails($id)
    {
        global $db;

        // Basic Info
        $sql1 = "SELECT proj.*, cl.name as client_name, cl.organization, cl.contact_no,
        pc.name as category_name, u.name as manager_name
        FROM projects as proj, clients as cl, project_categories as pc, users as u
        WHERE proj.client_id = cl.id
        AND proj.project_category_id = pc.id
        AND proj.user_id = u.id
        AND proj.id = $id";
        $info = $db->query($sql1)->fetch_assoc();

        // Phase-wise breakdown with dynamic time (in days)
        $sql2 = "SELECT ph.title as phase_title, pct.allocated_cost, pct.actual_cost,
        pct.expected_time, pct.actual_time
        FROM phase_costs_and_timing as pct, phases as ph
        WHERE pct.phase_id = ph.id AND pct.project_id = $id";
        $phases = $db->query($sql2)->fetch_all(MYSQLI_ASSOC);

        // Dynamic totals from phases
        $total_budget  = array_sum(array_column($phases, 'allocated_cost'));
        $total_actual  = array_sum(array_column($phases, 'actual_cost'));
        $total_exp_time = array_sum(array_column($phases, 'expected_time'));
        $total_act_time = array_sum(array_column($phases, 'actual_time'));

        // Team & Members
        $sql3 = "SELECT t.name as team_name, tm.name as member_name, tr.name as role_name
        FROM teams as t, project_teams as pt, team_members as tm, team_roles as tr
        WHERE t.id = pt.team_id
        AND pt.team_member_id = tm.id
        AND pt.team_role_id = tr.id
        AND t.project_id = $id";
        $team = $db->query($sql3)->fetch_all(MYSQLI_ASSOC);

        // Tasks
        $sql4 = "SELECT tk.title as task_title, ph.title as phase_title, t.name as team_name
        FROM tasks as tk, phases as ph, teams as t
        WHERE tk.phase_id = ph.id
        AND tk.assign_to_team_id = t.id
        AND tk.project_id = $id";
        $tasks = $db->query($sql4)->fetch_all(MYSQLI_ASSOC);

        return [
            'info'           => $info,
            'phases'         => $phases,
            'team'           => $team,
            'tasks'          => $tasks,
            'total_budget'   => $total_budget,
            'total_actual'   => $total_actual,
            'total_exp_time' => $total_exp_time,
            'total_act_time' => $total_act_time,
        ];
    }
}
