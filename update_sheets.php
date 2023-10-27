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
        <select name="project" style="width: 125px;" value="<?php echo $timesheet['project']; ?>">
            <option value="Historic Projects">Historic Projects</option>
            <option value="Recruitment">Recruitment</option>
            <option value="Hosting">Hosting</option>
            <option value="TLO Internal">TLO Internal</option>
            <option value="TLO Admin">TLO Admin</option>
            <option value="Reception">Reception</option>
            <option value="Larkspurs BA4">Larkspurs BA4</option>
            <option value="Aloes PM4">Aloes PM4</option>
            <option value="Foxgloves PM4">Foxgloves PM4</option>
            <option value="Anthuriums GM5">Anthuriums GM5</option>
            <option value="ASMS Internships Tier 1">ASMS Internships Tier 1</option>
            <option value="ASMS Internships Tier 2">ASMS Internships Tier 2</option>
            <option value="ASMS Internships Tier 3">ASMS Internships Tier 3</option>
            <option value="Axiz Tier 1 & Tier 2 2022">Axiz Tier 1 & Tier 2 2022</option>
            <option value="Axiz Tier 2 FY 23/24">Axiz Tier 2 FY 23/24</option>
            <option value="Axiz Tier 3 FY 23/24">Axiz Tier 3 FY 23/24</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bali IT3">Bali IT3</option>
            <option value="Barbados Tech Support 4">Barbados Tech Support 4</option>
            <option value="Begonias BA3">Begonias BA3</option>
            <option value="Bellflowers GM5">Bellflowers GM5</option>
            <option value="Bitcoins">Bitcoins</option>
            <option value="Bronze Stars">Bronze Stars</option>
            <option value="BT PM 5">BT PM 5</option>
            <option value="Buhler GENERAL MANAGEMENT NQF 5 FY 23/24">Buhler GENERAL MANAGEMENT NQF 5 FY 23/24</option>
            <option value="BT Systems Dev 4">BT Systems Dev 4</option>
            <option value="Business Short Courses - 2024">Business Short Courses - 2024</option>
            <option value="Calatheas GM4">Calatheas GM4</option>
            <option value="Calanthe BA4">Calanthe BA4</option>
            <option value="Caribbeans Sys Dev4">Caribbeans Sys Dev4</option>
            <option value="Carnations">Carnations</option>
            <option value="Cassias M4">Cassias M4</option>
            <option value="Cattleyas M4">Cattleyas M4</option>
            <option value="Coral Bells GM4">Coral Bells GM4</option>
            <option value="Cosmos GM4">Cosmos GM4</option>
            <option value="Cubans System Support 5">Cubans System Support 5</option>
            <option value="Cybernetics">Cybernetics</option>
            <option value="Daphnes GM5">Daphnes GM5</option>
            <option value="Datanators">Datanators</option>
            <option value="Delphiniums PM4">Delphiniums PM4</option>
            <option value="Dwyka IT3 2023">Dwyka IT3 2023</option>
            <option value="Ferns BA4">Ferns BA4</option>
            <option value="Florentinas GM4">Florentinas GM4</option>
            <option value="BT Systems Dev 4">BT Systems Dev 4</option>
            <option value="Fresias PM4">Fresias PM4</option>
            <option value="Gardenias GM4">Gardenias GM4</option>
            <option value="Gazanias">Gazanias</option>
            <option value="Hashimas Tech Support 4">Hashimas Tech Support 4</option>
            <option value="Hawaiians Tech Support 4">Hawaiians Tech Support 4</option>
            <option value="Hazels BA4">Hazels BA4</option>
            <option value="Heliconias BA4">Heliconias BA4</option>
            <option value="Heleniums MKT4">Heleniums MKT4</option>
            <option value="Hollies NVC4">Hollies NVC4</option>
            <option value="IT Short Courses 2023">IT Short Courses 2023</option>
            <option value="Lupins BA4">Lupins BA4</option>
            <option value="Larkspurs BA4">Larkspurs BA4</option>
            <option value="Maltas Sys Dev 5">Maltas Sys Dev 5</option>
            <option value="MAN Personal Mastery">MAN Personal Mastery</option>
            <option value="Mix Telematics GM5">Mix Telematics GM5</option>
            <option value="Mix Telematics KZN GM4">Mix Telematics KZN GM4</option>
            <option value="MiX Telematics PM5 2022">MiX Telematics PM5 2022</option>
            <option value="MiX Telematics PM5 2023">MiX Telematics PM5 2023</option>
            <option value="ODETDP">ODETDP</option>
            <option value="Oleanders GM4">Oleanders GM4</option>
            <option value="Orchids">Orchids</option>
            <option value="Periwinkles BA4">Periwinkles BA4</option>
            <option value="Petunias BA4">Petunias BA4</option>
            <option value="Pinnacle BA 4 2023/2024 ">Pinnacle BA 4 2023/2024 </option>
            <option value="Plumbago BKK3">Plumbago BKK3</option>
            <option value="Plumerias BKK4">Plumerias BKK4</option>
            <option value="Puerto Rico IT3">Puerto Rico IT3</option>
            <option value="Puerto Rico IT3">Puerto Rico IT3</option>
            <option value="Salvias GM4">Salvias GM4</option>
            <option value="Santorinis Sys Supp 5">Santorinis Sys Supp 5</option>
            <option value="Santiagos Sys Dev4">Santiagos Sys Dev4</option>
            <option value="Sardinians Tech Supp 4">Sardinians Tech Supp 4</option>
            <option value="Senna GM4">Senna GM4</option>
            <option value="Seychelles IT3">Seychelles IT3</option>
            <option value="Short Courses 2023">Short Courses 2023</option>
            <option value="Snowdrops NVC4">Snowdrops NVC4</option>
            <option value="Starflowers Bookkeeping 3">Starflowers Bookkeeping 3</option>
            <option value="Sunflowers">Sunflowers</option>
            <option value="Supergroup BA4">Supergroup BA4</option>
            <option value="SuperGroup W&R OPERATIONS NQF Level 3 FY 23/24">SuperGroup W&R OPERATIONS NQF Level 3 FY 23/24</option>
            <option value="SuperGroup LEADERSHIP DEVELOPMENT NQF4 FY 23/24">SuperGroup LEADERSHIP DEVELOPMENT NQF4 FY 23/24</option>
            <option value="SuperGroup GM4 PLANNING & SCHEDULING AND INVENTORY FY 23/24">SuperGroup GM4 PLANNING & SCHEDULING AND INVENTORY FY 23/24</option>
            <option value="SuperGroup GENERIC MANAGEMENT NQF3 FY 23/24">SuperGroup GENERIC MANAGEMENT NQF3 FY 23/24</option>
            <option value="SuperGroup CUSTOMER MANAGEMENT NQF5 FY 23/24">SuperGroup CUSTOMER MANAGEMENT NQF5 FY 23/24</option>
            <option value="SuperGroup GENERAL MANAGEMENT NQF 5 Group 1 FY 23/24">SuperGroup GENERAL MANAGEMENT NQF 5 Group 1 FY 23/24</option>
            <option value="SuperGroup GENERAL MANAGEMENT NQF 5 Group 2 FY 23/24">SuperGroup GENERAL MANAGEMENT NQF 5 Group 2 FY 23/24</option>
            <option value="SuperGroup BUSINESS ADMINISTRATION NQF4 FY 23/24">SuperGroup BUSINESS ADMINISTRATION NQF4 FY 23/24</option>
            <option value="SuperGroup CONTACT CENTRE SUPPORT NQF 4 FY 23/24">SuperGroup CONTACT CENTRE SUPPORT NQF 4 FY 23/24</option>
            <option value="SuperGroup Contact Centre Operations NQF Level 4 Unemployed FY 23/24">SuperGroup Contact Centre Operations NQF Level 4 Unemployed FY 23/24</option>
            <option value="SuperGroup CC2">SuperGroup CC2</option>
            <option value="Supergrp Office Administration NQF Level 5">Supergrp Office Administration NQF Level 5</option>
            <option value="SuperGrp BBKL3">SuperGrp BBKL3</option>
            <option value="Super Grp Technical Accounting NQF Level 5">Super Grp Technical Accounting NQF Level 5</option>
            <option value="Supergroup CC4">Supergroup CC4</option>
            <option value="SuperGroup GM4">SuperGroup GM4</option>
            <option value="SuperGroup GM5">SuperGroup GM5</option>
            <option value="SynergERP Cat. B Bus. Con. '23">SynergERP Cat. B Bus. Con. '23</option>
            <option value="SynergERP PM5 Group 3">SynergERP PM5 Group 3</option>
            <option value="Synergy Bookkeeping 4">Synergy Bookkeeping 4</option>
            <option value="Synergy ICT Internship">Synergy ICT Internship</option>
            <option value="Talksure GM5 2023">Talksure GM5 2023</option>
            <option value="Talksure Skills Programme">Talksure Skills Programme</option>
            <option value="Tarsus Contact Centre 4 2022">Tarsus Contact Centre 4 2022</option>
            <option value="Tarsus BA 4">Tarsus BA 4</option>
            <option value="Tarsus Generic Management (Strategic) NQF Level 4 FY 23/24">Tarsus Generic Management (Strategic) NQF Level 4 FY 23/24</option>
            <option value="Tarsus Generic Management (Strategic) NQF Level 6 FY 23/24">Tarsus Generic Management (Strategic) NQF Level 6 FY 23/24</option>
            <option value="Tarsus Generic Management (Strategic) NQF Level 5 FY 23/24">Tarsus Generic Management (Strategic) NQF Level 5 FY 23/24</option>
            <option value="Tarsus PM4 2022">Tarsus PM4 2022</option>
            <option value="Tarsus NVC 4 2022">Tarsus NVC 4 2022</option>
            <option value="Tarsus Sys Dev 5 2022">Tarsus Sys Dev 5 2022</option>
            <option value="Tasmanias IT3">Tasmanias IT3</option>
            <option value="Tiger Flowers PM4">Tiger Flowers PM4</option>
            <option value="Trumpets GM4">Trumpets GM4</option>
            <option value="Valerians NVC4">Valerians NVC4</option>
            <option value="Veronicas GM4">Veronicas GM4</option>
            <option value="Zaharas GM5">Zaharas GM5</option>
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
