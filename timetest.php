<?php include("server copy.php");?>

<!DOCTYPE html>
<html>
<head>
    <title>Timesheets Web Interface</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        #addRowButton {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <?php include("errors.php");?>
    <form method="POST" action="timetest.php">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Task</th>
                    <th>Date</th>
                    <th>Hours Worked</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="name[0]" required <?php echo $name;?>></td>
                    <td>
                        <select name="task[0]" required <?php echo $project;?>>
                            <option value="Task 1">Task 1</option>
                            <option value="Task 2">Task 2</option>
                            <option value="Task 3">Task 3</option>
                        </select>
                    </td>
                    <td><input type="datetime-local" name="date[0]" required <?php echo $date;?>></td>
                    <td>
                        <input type="number" name="hours[0]" required <?php echo $hours;?>> hours
                        <input type="number" name="minutes[0]" required <?php echo $minutes;?>> minutes
                    </td>
                    <td><button type="button" onclick="addRow()">Add Row</button></td>
                </tr>
            </tbody>
        </table>
        
        <button id="addRowButton" type="button" onclick="addRow()">Add Row</button>
        <input type="submit" name="sub_timesheet1" value="Submit Timesheet">
    </form>

    <script>
        let rowCount = 1; // Initialize row count

        function addRow() {
            const tableBody = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" name="name[${rowCount}]" required <?php echo $name;?>></td>
                <td>
                    <select name="task[${rowCount}]" required <?php echo $project;?>>
                        <option value="Task 1">Task 1</option>
                        <option value="Task 2">Task 2</option>
                        <option value="Task 3">Task 3</option>
                    </select>
                </td>
                <td><input type="datetime-local" name="date[${rowCount}]" required <?php echo $date;?>></td>
                <td>
                    <input type="number" name="hours[${rowCount}]" required <?php echo $hours;?>> hours
                    <input type="number" name="minutes[${rowCount}]" required <?php echo $minutes;?>> minutes
                </td>
                <td><button type="button" onclick="removeRow(this)">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
            rowCount++; // Increment row count
        }

        function removeRow(button) {
            const row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
</body>
</html>
