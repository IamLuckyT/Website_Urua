<?php
// Form data processing script
$name = $_POST["name"];
$message = $_POST["message"];
$priority = filter_input(INPUT_POST, "priority", FILTER_VALIDATE_INT);
$type = filter_input(INPUT_POST, "type", FILTER_VALIDATE_INT);
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

if (! $terms){
    die("Terms must be accepted.");
} 

// Database connection
$host = "localhost";
$dbname = "messages_db";
$user = "root";
$password = "";

// Create connection
$conn = mysqli_connect(hostname: $host, 
               username: $user,
               password: $password,
               database: $dbname);

// Check connection
if (mysqli_connect_errno()){
    die("Connection error: " . mysqli_connect_error());
}

//echo "Connection successful.";

// Prepare the SQL statement for execution
$sql = "INSERT INTO messages (name, body, priority, type) VALUES (?, ?, ?, ?)";

// Initialize a statement
$stmt = mysqli_stmt_init($conn);

// Prepare the statement
if (mysqli_stmt_prepare($stmt, $sql)){
    // Bind parameters to the SQL query
    mysqli_stmt_bind_param($stmt, "ssii", $name, $message, $priority, $type);
    
    // Execute the statement
    if (mysqli_stmt_execute($stmt)){
        echo "Message saved successfully.";
    } else {
        echo "Error executing query: " . mysqli_stmt_error($stmt);
    }
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}
?>