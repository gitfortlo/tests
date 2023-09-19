<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

error_reporting(E_ERROR | E_PARSE);
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'timesheets';

$loggedInUser = $_SESSION['username'];

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
        $stmt = $conn->prepare("UPDATE timesheets SET project = :task, description = :description, hours_worked = :hours, minutes_worked = :minutes WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':task', $_POST['task']);
        $stmt->bindParam(':description', $_POST['description']);
        $stmt->bindParam(':hours', $_POST['hours']);
        $stmt->bindParam(':minutes', $_POST['minutes']);
        $stmt->execute();
    } elseif (isset($_POST['work_date'])) {
        $selectedDate = $_POST['work_date'];
        $stmt = $conn->prepare("SELECT * FROM timesheets WHERE name_person = :loggedInUser AND work_date = :work_date");
        $stmt->bindParam(':loggedInUser', $loggedInUser);
        $stmt->bindParam(':work_date', $selectedDate);
        $stmt->execute();
        $existing_timesheets = $stmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Timesheet Portal</title>
</head>
<body>

<!-- Timesheet Submission Form -->
<h2>Submit Timesheet</h2>
<!-- Your previous form here... -->
<!-- ... -->

<!-- Update Timesheet -->
<h2>Update Timesheet</h2>
<form method="POST">
    <label>Select Date:</label>
    <input type="date" name="work_date">
    <button type="submit">Fetch Timesheets</button>
</form>

<?php if (isset($existing_timesheets) && count($existing_timesheets) > 0): ?>
    <form method="POST">
        <?php foreach ($existing_timesheets as $timesheet): ?>
            <input type="hidden" name="id" value="<?php echo $timesheet['id']; ?>">
            <label>Name: </label><?php echo $timesheet['name_person']; ?>
            <label>Date: </label><?php echo $timesheet['work_date']; ?>
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
<?php endif; ?>

</body>
</html>
