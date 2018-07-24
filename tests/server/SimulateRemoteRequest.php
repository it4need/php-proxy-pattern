<?php

sleep(2); // simulate extensive calculations...
ResponseAsJson(['id' => 'B_93756', 'score' => 81.9, 'owner' => 'server_b']);

function ResponseAsJson($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
