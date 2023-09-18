<?php include('server copy.php')?>
<!DOCTYPE html>
<html>
<head>
  <title>Technician Portal TLO</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Technician Portal TLO</h2>
  </div>
	
  <form method="post" action="tech_portal1.php">
  	<?php include('errors.php'); ?>
	<div class="input-group">
	  <label>Technician Name</label>
	  <input type="text" name="Technician_name" value="<?php echo $Technician_name; ?>">
	</div>
	<div class="text">
		<label>Issue ID:	</label>
		<input type="text" name="issue_id" value="<?php echo $issue_id; ?>">
	</div>
	<div class="text">
		<label>Client Email</label>
		<input type="text" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="dropdown">
		<label for="outcome">Outcome</label>
		<select name="outcome" id="outcome" style="width: 450px;">
			<option <?php echo $outcome; ?>>Successful</option>
			<option <?php echo $outcome; ?>>Pending</option>
		</select>
	</div>
	<div class="input-group" value=>
  	  <label>Steps To Completion</label>
  	  <textarea class="textarea" name="steps" placeholder="Steps To Completion..." rows="2" cols="36" <?php echo $steps; ?>></textarea>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="tech_sub">Submit</button>
  	</div>
  	<p>
  		Return to the home screen? <a href="index.php">To Home</a>
  	</p>
  </form>
</body>
</html>