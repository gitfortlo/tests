<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

error_reporting(E_ERROR | E_PARSE);

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'timesheets';

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$loggedInUser = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        try {
            $stmt = $conn->prepare("UPDATE timesheets SET name_person = :name, work_date = :work_date, project = :task, description = :description, hours_worked = :hours, minutes_worked = :minutes");
            
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':work_date', $_POST['work_date']);
            $stmt->bindParam(':task', $_POST['task']);
            $stmt->bindParam(':description', $_POST['description']);
            $stmt->bindParam(':hours', $_POST['hours']);
            $stmt->bindParam(':minutes', $_POST['minutes']);
            
            $stmt->execute();
            echo "Record updated successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$filter_sql = "SELECT * FROM timesheets WHERE name_person = :loggedInUser";

$stmt = $conn->prepare($filter_sql);
$stmt->bindParam(':loggedInUser', $loggedInUser);
$stmt->execute();

$timesheets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<body>

<!-- Update Form -->
<form method="POST">
    <?php foreach ($timesheets as $timesheet): ?>
        <input type="hidden" name="id" value="<?php echo $timesheet['id']; ?>">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $timesheet['name_person']; ?>">
        <label>Date</label>
        <input type="date" name="work_date" value="<?php echo $timesheet['work_date']; ?>">
        <label>Task</label>
        <input type="text" name="task" value="<?php echo $timesheet['project']; ?>">
        <label>Description</label>
        <input type="text" name="description" value="<?php echo $timesheet['description']; ?>">
        <label>Hours</label>
        <input type="number" name="hours" value="<?php echo $timesheet['hours_worked']; ?>">
        <label>Minutes</label>
        <input type="number" name="minutes" value="<?php echo $timesheet['minutes_worked']; ?>">
        <button type="submit" name="update">Update</button>
        <br>
    <?php endforeach; ?>
</form>

</body>
</html>
