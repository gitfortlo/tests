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
$db_name = 'test';

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$loggedInUser = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        try {
            $stmt = $conn->prepare("UPDATE timesheets SET name_person = :name, work_date = :work_date, project = :task, description = :description, hours_worked = :hours, minutes_worked = :minutes WHERE ID = :id");
            
            $stmt->bindParam(':id', $_POST['ID']);
            $stmt->bindParam(':name', $_POST['name_person']);
            $stmt->bindParam(':work_date', $_POST['work_date']);
            $stmt->bindParam(':task', $_POST['project']);
            $stmt->bindParam(':description', $_POST['description']);
            $stmt->bindParam(':hours', $_POST['hours_worked']);
            $stmt->bindParam(':minutes', $_POST['minutes_worked']);
                
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
        <input type="hidden" name="ID" value="<?php echo $timesheet['ID']; ?>">
        <label>Name</label>
        <input type="text" name="name_person" value="<?php echo $timesheet['name_person']; ?>">
        <label>Date</label>
        <input type="date" name="work_date" value="<?php echo $timesheet['work_date']; ?>">
        <label>Task</label>
        <input type="text" name="project" value="<?php echo $timesheet['project']; ?>">
        <label>Description</label>
        <input type="text" name="description" value="<?php echo $timesheet['description']; ?>">
        <label>Hours</label>
        <input type="number" name="hours_worked" value="<?php echo $timesheet['hours_worked']; ?>">
        <label>Minutes</label>
        <input type="number" name="minutes_worked" value="<?php echo $timesheet['minutes_worked']; ?>">
        <button type="submit" id="update" name="update">Update</button>
        <br><hr><br>
    <?php endforeach; ?>
</form>

</body>
</html>
