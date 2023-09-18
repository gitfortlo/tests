<?php include('server copy.php')?>
<!DOCTYPE html>
<html>
<head>
  <title>IT Ticket Portal TLO</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>IT Ticket Portal TLO</h2>
  </div>
  <form method="post" action="tickreport.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="client_name" value="<?php echo $client_name; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Surname</label>
  	  <input type="text" name="client_surname" value="<?php echo $client_surname; ?>">
  	</div>
	<div class="input-group">
		<label>Email (your email)</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="dropdown">
		<label for="issue_reported">What is the issue you are facing?</label>
		<select name="issue_reported" id="issue_reported" style="width: 50%;">
			<option <?php echo $issue_reported; ?>>My PC is slow</option>
			<option <?php echo $issue_reported; ?>>The screen is flashing</option>
			<option <?php echo $issue_reported; ?>>I can not login to teams</option>
			<option <?php echo $issue_reported; ?>>Network is slow</option>
			<option <?php echo $issue_reported; ?>>OneDrive is not syncing</option>
			<option <?php echo $issue_reported; ?>>MS Teams is not openning</option>
			<option <?php echo $issue_reported; ?>>Computer is not charging</option>
		</select>
	</div>
    <div class="input-group" value=>
  	  <label>Description (Please be as descriptive as possible)</label>
  	  <textarea class="textarea" name="descript_of_issue" placeholder="describe the problem..." rows="2" cols="36" <?php echo $descript_of_issue?>></textarea>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="sub_ticket">Submit</button>
  	</div>
	<p>
		return to the home page <a href="index.php"> To Home </a>
	</p>
  </form>
</body>
</html>