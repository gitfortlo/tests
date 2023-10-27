<?php
session_start();

// Redirect to the login page if not logged in
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

// Define the list of projects
$projectList = [
    "Historic Projects", "Recruitment", "Hosting", "TLO Internal", "TLO Admin",
    "Reception", "Larkspurs BA4", "Aloes PM4", "Foxgloves PM4", "Anthuriums GM5",
    "ASMS Internships Tier 1", "ASMS Internships Tier 2", "ASMS Internships Tier 3",
    "Axiz Tier 1 & Tier 2 2022", "Axiz Tier 2 FY 23/24", "Axiz Tier 3 FY 23/24",
    "Bahamas", "Bali IT3", "Barbados Tech Support 4", "Begonias BA3", "Bellflowers GM5",
    "Bitcoins", "Bronze Stars", "BT PM 5", "Buhler GENERAL MANAGEMENT NQF 5 FY 23/24",
    "BT Systems Dev 4", "Business Short Courses - 2024", "Calatheas GM4", "Calanthe BA4",
    "Caribbeans Sys Dev4", "Carnations", "Cassias M4", "Cattleyas M4", "Coral Bells GM4",
    "Cosmos GM4", "Cubans System Support 5", "Cybernetics", "Daphnes GM5", "Datanators",
    "Delphiniums PM4", "Dwyka IT3 2023", "Ferns BA4", "Florentinas GM4", "BT Systems Dev 4",
    "Fresias PM4", "Gardenias GM4", "Gazanias", "Hashimas Tech Support 4", "Hawaiians Tech Support 4",
    "Hazels BA4", "Heliconias BA4", "Heleniums MKT4", "Hollies NVC4", "IT Short Courses 2023",
    "Lupins BA4", "Larkspurs BA4", "Maltas Sys Dev 5", "MAN Personal Mastery", "Mix Telematics GM5",
    "Mix Telematics KZN GM4", "MiX Telematics PM5 2022", "MiX Telematics PM5 2023", "ODETDP",
    "Oleanders GM4", "Orchids", "Periwinkles BA4", "Petunias BA4", "Pinnacle BA 4 2023/2024",
    "Plumbago BKK3", "Plumerias BKK4", "Puerto Rico IT3", "Puerto Rico IT3", "Salvias GM4",
    "Santorinis Sys Supp 5", "Santiagos Sys Dev4", "Sardinians Tech Supp 4", "Senna GM4",
    "Seychelles IT3", "Short Courses 2023", "Snowdrops NVC4", "Starflowers Bookkeeping 3", "Sunflowers",
    "Supergroup BA4", "SuperGroup W&R OPERATIONS NQF Level 3 FY 23/24", "SuperGroup LEADERSHIP DEVELOPMENT NQF4 FY 23/24",
    "SuperGroup GM4 PLANNING & SCHEDULING AND INVENTORY FY 23/24", "SuperGroup GENERIC MANAGEMENT NQF3 FY 23/24",
    "SuperGroup CUSTOMER MANAGEMENT NQF5 FY 23/24", "SuperGroup GENERAL MANAGEMENT NQF 5 Group 1 FY 23/24",
    "SuperGroup GENERAL MANAGEMENT NQF 5 Group 2 FY 23/24", "SuperGroup BUSINESS ADMINISTRATION NQF4 FY 23/24",
    "SuperGroup CONTACT CENTRE SUPPORT NQF 4 FY 23/24", "SuperGroup Contact Centre Operations NQF Level 4 Unemployed FY 23/24",
    "SuperGroup CC2", "Supergrp Office Administration NQF Level 5", "SuperGrp BBKL3", "Super Grp Technical Accounting NQF Level 5",
    "Supergroup CC4", "SuperGroup GM4", "SuperGroup GM5", "SynergERP Cat. B Bus. Con. '23", "SynergERP PM5 Group 3",
    "Synergy Bookkeeping 4", "Synergy ICT Internship", "Talksure GM5 2023", "Talksure Skills Programme",
    "Tarsus Contact Centre 4 2022", "Tarsus BA 4", "Tarsus Generic Management (Strategic) NQF Level 4 FY 23/24",
    "Tarsus Generic Management (Strategic) NQF Level 6 FY 23/24", "Tarsus Generic Management (Strategic) NQF Level 5 FY 23/24",
    "Tarsus PM4 2022", "Tarsus NVC 4 2022", "Tarsus Sys Dev 5 2022", "Tasmanias IT3", "Tiger Flowers PM4", "Trumpets GM4",
    "Valerians NVC4", "Veronicas GM4", "Zaharas GM5"
];

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
        <label>Project</label>
        <select name="project">
            <?php foreach ($projectList as $project): ?>
                <option style="width: 125px ;" value="<?php echo $project; ?>"><?php echo $project; ?></option>
            <?php endforeach; ?>
        </select>
        <label>Description</label>
        <input type="text" name="description" value="<?php echo $timesheet['description']; ?>">
        <label>Hours</label>
        <input type="number" name="hours_worked" value="<?php echo $timesheet['hours_worked']; ?>">
        <label>Minutes</label>
        <input type="number" name="minutes_worked" value="<?php echo $timesheet['minutes_worked']; ?>">
        <button type="submit" name="update">Update</button>
        <br><hr><br>
    <?php endforeach; ?>
</form>

</body>
</html>