<?php

require __DIR__ . '/../vendor/autoload.php';


// Execute the command and store the process ID
$output = array();
exec('php -S ' . getenv('TEST_HTTP_HOST') . ' -t ./server > /dev/null 2>&1 & echo $!', $output);
$pid = (int)$output[0];
echo "Starting Webserver for testing purposes!";

// Kill the web server when the process ends
register_shutdown_function(function () use ($pid) {
    exec('kill ' . $pid);
});