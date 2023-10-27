<?php
error_reporting(E_ERROR | E_PARSE);

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'timesheets';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST['update'])) { // Check if the intention is to update
            $stmt = $conn->prepare("UPDATE timesheets SET name_person = :name, work_date = :work_date, project = :task, description = :description, hours_worked = :hours, minutes_worked = :minutes WHERE id = :id");
            
            $stmt->bindParam(':id', $_POST['id']);
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':work_date', $_POST['work_date']);
            $stmt->bindParam(':task', $_POST['task']);
            $stmt->bindParam(':description', $_POST['description']);
            $stmt->bindParam(':hours', $_POST['hours']);
            $stmt->bindParam(':minutes', $_POST['minutes']);
            
            $stmt->execute();
            echo "Record updated successfully";

        } elseif (isset($_POST['name'], $_POST['task'], $_POST['description'], $_POST['hours'], $_POST['minutes'])) {

            $stmt = $conn->prepare("INSERT INTO timesheets (name_person, work_date, project, description, hours_worked, minutes_worked) VALUES (:name, :work_date, :task, :description, :hours, :minutes)");

            foreach ($_POST['name'] as $key => $name) {
                $work_date = filter_var($_POST['work_date'][$key], FILTER_SANITIZE_STRING);
                $task = filter_var($_POST['task'][$key], FILTER_SANITIZE_STRING);
                $description = filter_var($_POST['description'][$key], FILTER_SANITIZE_STRING);
                $hours = filter_var($_POST['hours'][$key], FILTER_SANITIZE_NUMBER_INT);
                $minutes = filter_var($_POST['minutes'][$key], FILTER_SANITIZE_NUMBER_INT);

                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':task', $task);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':work_date', $work_date);
                $stmt->bindParam(':hours', $hours);
                $stmt->bindParam(':minutes', $minutes);

                $stmt->execute();
            }

        } else {
            echo "Error: Missing POST data.";
        }

    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
