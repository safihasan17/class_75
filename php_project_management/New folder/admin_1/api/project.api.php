<?php

function getProject($id)
{
    if ($id == 0) {
        $data = Project::readAll();
    } else {
        $data = Project::readAllFilter($id);
    }

    if ($data === false || $data === null) {
        http_response_code(500);
        echo json_encode(["error" => "Database query failed"]);
        return;
    }

    echo json_encode($data);
}

function getProjectById() {}
