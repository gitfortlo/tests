<?php
session_start();
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail -> isSMTP();
$mail -> Host = "smtp.gmail.com";
$mail -> SMTPAuth = true;
$mail -> Username = "thelearningorganisationza@gmail.com";
$mail -> Password = "aqbdctslhedluhkv";
$mail -> Port = 465;
$mail -> SMTPSecure = "ssl";

// initializing variables
$curtime = "";
$username = "";
$email    = "";
//$clientid = "";
$issue_id = "";
$client_name = "";
$client_surname = "";
$issue_reported = "";
$descript_of_issue = "";
$date_time_of_issue = "";
//$Technicianid = "";
$Technician_name = "";
$outcome = "";
$steps = "";
$date_time_of_completion = "";
$errors = array(); 
$status = "";
$issue_button = "";
$name = "";
$date = "";
$project = "";
$hours = "";
$minutes = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'issue_reports');
$user_db = mysqli_connect('localhost', 'root', '', 'project');
$timesheet_db = mysqli_connect('localhost', 'root', '', 'timesheets');

// REGISTER USER
if (isset($_POST['reg_user'])){
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($user_db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($user_db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}}

// IT ticket report form
if (isset($_POST['sub_ticket'])) {
  // receive all input values from the form
  //$clientid = mysqli_real_escape_string($db, $_POST['clientid']);
  $client_name = mysqli_real_escape_string($db, $_POST['client_name']);
  $client_surname = mysqli_real_escape_string($db, $_POST['client_surname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $issue_reported = mysqli_real_escape_string($db, $_POST['issue_reported']);
  $descript_of_issue = mysqli_real_escape_string($db, $_POST['descript_of_issue']);
  //$date_time_of_issue; $curtime = mysqli_real_escape_string($db, $_POST['date_time_of_issue']);
  //$curtime = mysqli_real_escape_string($db, $_POST[]);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  //if (empty($clientid)) { array_push($errors, "ID is required"); }
  if (empty($client_name)) { array_push($errors, "Name is required"); }
  if (empty($client_surname)) { array_push($errors, "Surname is required"); }
  if (empty($email)) { array_push($errors, "E-mail is required"); }
  if (empty($issue_reported)) { array_push($errors, "Issue is required"); }
  if (empty($descript_of_issue)) { array_push($errors, "Description is required"); }
  if (strlen($descript_of_issue) == 0 | strlen($descript_of_issue) == 5) {
	array_push($errors, "Description not descriptive");
  }
 if (count($errors) == 0){
   $put_into = "INSERT INTO issue_reports (issue_id, Client_name, Client_surname, client_email, Issue_reported, descript_of_issue, Date_time_of_issue)
    VALUES(0, '$client_name', '$client_surname', '$email', '$issue_reported', '$descript_of_issue', NOW())";
    mysqli_query($db, $put_into);
    $mail -> setFrom("thelearningorganisationza@gmail.com", "TLO - Tech Support");
    $mail -> addAddress("thelearningorganisationza@gmail.com", "IT - Storm Jamie Paiva");
    $mail -> addAddress("sbonelo.ndlovu@tlo.co.za", "IT - Sbonelo Ndlovu");
    $mail -> addAddress("etienne@tlo.co.za", "IT - Etienne Myburgh");
    $mail -> addAddress("$email", "$client_name $client_surname");
    $mail -> isHTML(true);
    $mail -> Subject = "A New Ticket Has Been Logged";
    $mail -> Body = "<h4>A new ticket from $client_name has been logged</h4>
          <b> Your ticket has been sent to the IT Department and a technician will be with you shortly</b>
          <br>
          <p> Name and Surname = $client_name $client_surname </p>
          <p> Issue Reported = $issue_reported</p>
          <p> Description Of Problem = '$descript_of_issue'</p>
          <br>
          <p> This message was sent with PHPMailer, the PHP SMTP server</p>";

  if (!$mail -> send()){
    echo "an error has been encountered whilst sending this email: {$mail -> ErrorInfo}";
  }else {
    echo "Message has been sent to the IT department and to yourself";
  }
  $mail -> smtpClose();
  
  header("Location: https://192.168.0.107/tests/index.php");
}}


// IT ticket report form
if (isset($_POST['tech_sub'])) {
  // receive all input values from the form
  $Technician_name = mysqli_real_escape_string($db, $_POST['Technician_name']);
  $issue_id = mysqli_real_escape_string($db, $_POST['issue_id']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $outcome = mysqli_real_escape_string($db, $_POST['outcome']);
  $steps = mysqli_real_escape_string($db, $_POST['steps']);
  //$date_time_of_completion = mysqli_real_escape_string($db, $_POST['date_time_of_completion']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Technician_name)) { array_push($errors, "Your Name is required"); }
  //if (empty($issue_id)) {array_push($errors, "Please insert the issue number");}
  //if (empty($date_time_of_completion)) { array_push($errors, "date and time of completion is required"); }
  if (empty($steps)) { array_push($errors, "Steps to completion is required"); }
  if (strlen($steps) == 0 | strlen($steps) == 5) {
	array_push($errors, "Steps not descriptive");
  }
  if (count($errors) == 0){
    $update_ticket = "UPDATE issue_reports SET technician_name='$Technician_name', steps='$steps', outcome='$outcome', date_time_completed=NOW()
  where  issue_id=$issue_id";
  $getname = "SELECT Client_name FROM issue_reports WHERE issue_id='$issue_id'";
  $query = mysqli_query($db, $getname);
  $result = mysqli_fetch_assoc($query);
  $client_name = $result['Client_name'];
  mysqli_query($db, $update_ticket);
  $mail -> setFrom("thelearningorganisationza@gmail.com", "IT - Storm Jameie Paiva");
  $mail -> addAddress("thelearningorganisationza@gmail.com", "$client_name");
  $mail -> addAddress("$email", "");
  $mail -> isHTML(true);
  $mail -> Subject = "Your ticket has been resolved";
  $mail -> Body = "<h4>$client_name, your ticket has been resolved by $Technician_name</h4>
        <b>Your ticket has been resolved</b>
        <p>Issue ID: $issue_id</p>
        <p>The outcome was: $outcome</p>
        <p>Steps to outcome/completion:</p>
        <p>$steps</p>
        <p>If you have any issues:</p>
        <p>Contact 'IT email to be made'</p>";
  if (!$mail -> send()){
    echo "an error has been encountered whilst sending this email: {$mail -> ErrorInfo}";
  }else {
    echo "Message has been sent to the client";
  }
  $mail -> smtpClose();
  }
  
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($user_db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>