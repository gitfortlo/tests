<?php
error_reporting(E_ERROR | E_PARSE);

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'timesheets';

// Database Connection
$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        try {
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

// Fetch Existing Entries for Display
$stmt = $conn->prepare("SELECT * FROM timesheets");
$stmt->execute();
$timesheets = $stmt->fetchAll();
?>

<!-- HTML to display existing timesheet entries in editable form -->
<!DOCTYPE html>
<html>
<body>
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
        <?php endforeach; ?>
    </form>
</body>
</html>
