<?php

// Specify the IP address and port of the CBC machine
$ip = '192.168.0.100';
$port = 1234;

// Create a socket connection to the CBC machine
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "Error: socket_create() failed.\n";
    exit;
}

// Connect to the CBC machine
$result = socket_connect($socket, $ip, $port);
if ($result === false) {
    echo "Error: socket_connect() failed.\n";
    exit;
}

// Send a command to the CBC machine to start a CBC test
$command = "START_CBC_TEST";
socket_write($socket, $command, strlen($command));

// Read the response from the CBC machine
$response = socket_read($socket, 1024);
echo "Response from CBC machine: $response\n";

// Keep listening for incoming data on the socket connection until the CBC machine sends the test results
while (true) {
    // Read incoming data from the socket
    $data = socket_read($socket, 1024, PHP_NORMAL_READ);
    if ($data === false) {
        echo "Error: socket_read() failed.\n";
        exit;
    }
    
    // Check if the incoming data contains the CBC test results
    if (strpos($data, "CBC_RESULTS") !== false) {
        // Parse the CBC test results from the incoming data
        $results = parse_cbc_results($data);
        
        // Print the CBC test results
        echo "CBC test results:\n";
        echo "WBC count: " . $results['WBC'] . "\n";
        echo "RBC count: " . $results['RBC'] . "\n";
        echo "Hemoglobin: " . $results['Hb'] . "\n";
        echo "Hematocrit: " . $results['Hct'] . "\n";
        
        // Exit the loop and close the socket connection
        break;
    }
}

// Close the socket connection
socket_close($socket);

// Function to parse the CBC test results from the incoming data
function parse_cbc_results($data) {
    $parts = explode(",", $data);
    $results = array();
    
    foreach ($parts as $part) {
        $pair = explode("=", $part);
        $results[$pair[0]] = $pair[1];
    }
    
    return $results;
}

?>
