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
$mail -> Host = "smtp.gmail.com";
$mail -> Username = "joelpaiva112233@gmail.com";
$mail -> Password = "lfdwdrmqxdtqvmdn";
$mail -> Port = 465;
$mail -> SMTPSecure = "ssl";

// initializing variables
$username = "";
$email    = "";
$clientid = "";
$client_name = "";
$client_surname = "";
$issue_reported = "";
$descript_of_issue = "";
$date_time_of_issue = "";
$Technicianid = "";
$Technician_name = "";
$outcome = "";
$steps = "";
$date_time_of_completion = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'issue_reports');

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
  }}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
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
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
}


// IT ticket report form
if (isset($_POST['sub_ticket'])) {
  // receive all input values from the form
  $clientid = mysqli_real_escape_string($db, $_POST['clientid']);
  $client_name = mysqli_real_escape_string($db, $_POST['client_name']);
  $client_surname = mysqli_real_escape_string($db, $_POST['client_surname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $issue_reported = mysqli_real_escape_string($db, $_POST['issue_reported']);
  $descript_of_issue = mysqli_real_escape_string($db, $_POST['descript_of_issue']);
  $date_time_of_issue = mysqli_real_escape_string($db, $_POST['date_time_of_issue']);
  $curtime = mysqli_real_escape_string($db, $_POST['curtime']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($clientid)) { array_push($errors, "ID is required"); }
  if (empty($client_name)) { array_push($errors, "Name is required"); }
  if (empty($client_surname)) { array_push($errors, "Surname is required"); }
  if (empty($issue_reported)) { array_push($errors, "Issue is required"); }
  if (empty($descript_of_issue)) { array_push($errors, "Description is required"); }
  if (empty($date_time_of_issue)) { array_push($errors, "Date and Time of issue is required"); }
  if (strlen($descript_of_issue) == 0 | strlen($descript_of_issue) == 5) {
	array_push($errors, "Description not descriptive");
  }
 if (count($errors) === 0){
  $put_into = "INSERT INTO issue_reports (Client_ID, Client_name, Client_surname, Issue_reported, descript_of_issue, Date_time_of_issue)
   VALUES('$clientid', '$client_name', '$client_surname', '$issue_reported', '$descript_of_issue', '$date_time_of_issue')";
   mysqli_query($db, $put_into);
  $mail -> setFrom("joelpaiva112233@gmail.com", "Storm Jamie Paiva");
  $mail -> addAddress("joelpaiva112233@gmail.com", "IT - Storm Jamie Paiva");
  $mail -> isHTML(true);
  $mail -> Subject = "phpmailer smtp test";
  $mail -> Body = "<h4> this is an automatic phpmailer smtp test mail </h4>
          <b> phpmailer is working fine </b>
          <p> name and surname = $client_name $client_surname </p>
          <p> issue reported = $issue_reported</p>
          <p> description of problem = '$descript_of_issue'</p>
          <p> date/time of issue = $date_time_of_issue</p>";
  $mail -> send();
  
  if (!$mail -> send()){
    echo "an error has been encountered whilst sending this email: {$mail -> ErrorInfo}";
  }else{
    echo "Message has been sent";
  }
  $mail -> smtpClose();
}}

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
  	$results = mysqli_query($db, $query);
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