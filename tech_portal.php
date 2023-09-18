<?php
include('server copy.php');
$query = "SELECT issue_id, Client_name, Client_surname, Client_email, Issue_reported, descript_of_issue, date_time_of_issue, 
Technician_name, steps, outcome, date_time_completed, stat FROM issue_reports";
$result = mysqli_query($db,$query);
?>
<div>
    <table id="issue_reports" border="10" cellspacing="1" cellpadding="0">
  <tr>
    <th>Issue ID</th>
    <th>Client Name</th>
    <th>Client Surname</th>
    <th>Email</th>
    <th>Issue reported</th>
    <th>Description of Issue</th>
    <th>Date/time of Issue</th>
    <th>Technician Name</th>
    <th>Outcome</th>
    <th>Steps</th>
    <th>Date/time completed</th>
    <th>Status</th>
  </tr>
<?php
if ($result->num_rows > 0) {
  $sn=1;
  while($data = $result->fetch_assoc()) {
 ?>
 
 <tr id="issue_reports">
   <td><?php echo $data['issue_id']; ?> </td>
   <td><?php echo $data['Client_name']; ?> </td>
   <td><?php echo $data['Client_surname']; ?> </td>
   <td><?php echo $data['Client_email']; ?> </td>
   <td><?php echo $data['Issue_reported']; ?> </td>
   <td><?php echo $data['descript_of_issue']; ?> </td>
   <td><?php echo $data['date_time_of_issue']; ?> </td>
   <td><?php echo $data['Technician_name']; ?> </td>
   <td><?php echo $data['outcome']; ?> </td>
   <td><?php echo $data['steps']; ?> </td>
   <td><?php echo $data['date_time_completed']; ?> </td>
   <td><?php echo $data['stat'];?> <button id="issue_button"> free </button>
  <button id="issue_button">taken</button> </td>
 <tr>
 <?php
  $sn++;}} else { ?>
    <tr>
     <td colspan="8">No data found</td>
    </tr>

 <?php } ?>
  </table>
 </div>
 <script src="test.js" ></script>