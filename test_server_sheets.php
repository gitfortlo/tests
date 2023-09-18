<?php
error_reporting(E_ERROR | E_PARSE);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'timesheets';
    
    $work_date = isset($_POST['work_date'][0]) ? filter_var($_POST['work_date'][0], FILTER_SANITIZE_STRING) : null;
    
    if ($work_date === null) {
        echo "Error: Missing work date.";
        exit();
    }

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['name'], $_POST['task'], $_POST['description'], $_POST['hours'], $_POST['minutes'])) {
            $stmt = $conn->prepare("INSERT INTO timesheets (name_person, work_date, project, description, hours_worked, minutes_worked) VALUES (:name, :work_date, :task, :description, :hours, :minutes)");

            foreach ($_POST['name'] as $key => $name) {
                $work_date = filter_var($_POST['work_date'], FILTER_SANITIZE_STRING);
                $tasks = filter_var($_POST['task'][$key], FILTER_SANITIZE_STRING);
                $description = filter_var($_POST['description'][$key], FILTER_SANITIZE_STRING);
                $hours = filter_var($_POST['hours'][$key], FILTER_SANITIZE_NUMBER_INT);
                $minutes = filter_var($_POST['minutes'][$key], FILTER_SANITIZE_NUMBER_INT);

                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':task', $tasks);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':work_date', $work_date);
                $stmt->bindParam(':hours', $hours);
                $stmt->bindParam(':minutes', $minutes);

                $stmt->execute();
            }

            $conn = null;
        } else {
            echo "Error: Missing POST data.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
