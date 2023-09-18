<?php
error_reporting(E_ERROR | E_PARSE);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection details
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'timesheets';

    try {
        // Connect to the database
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if all necessary data is set
        if (isset($_POST['name'], $_POST['task'], $_POST['description'], $_POST['work_date'], $_POST['hours'], $_POST['minutes'])) {
            
            // Loop through each submitted row
            foreach ($_POST['name'] as $key => $name) {
                $tasks = $_POST['task'][$key];
                $description = $_POST['description'][$key];  // New Description Variable
                $work_date = $_POST['work_date'][$key];
                $hours = $_POST['hours'][$key];
                $minutes = $_POST['minutes'][$key];

                // Prepare SQL statement
                $stmt = $conn->prepare("INSERT INTO timesheets (name_person, work_date, project, description, hours_worked, minutes_worked) VALUES (:name, :work_date, :task, :description, :hours, :minutes)");

                // Bind parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':task', $tasks);
                $stmt->bindParam(':description', $description);  // Binding the New Description Variable
                $stmt->bindParam(':work_date', $work_date);
                $stmt->bindParam(':hours', $hours);
                $stmt->bindParam(':minutes', $minutes);

                // Execute the statement
                $stmt->execute();
            }
        } else {
            echo "Error: Missing POST data.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
