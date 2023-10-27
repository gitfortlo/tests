<?php include("test_server_sheets.php");?>
<?php session_start();?>
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
    <form method="POST" action="test_timesheets.php">
    <label for="work_date">Work Date for the following entries:</label>
    <input type="date" name="work_date" required>
    <br><br>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Project name</th>
                    <th>Description</th>
                    <th>Time Worked</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="name[]" readonly value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"  <?php echo $name;?>></td>
                    <td>
                        <select name="task[]" style="width: 150px;"  required <?php echo $tasks?>>
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
                    <td><input type="textarea" name="description[]"  placeholder="Description" required <?php echo $description;?>></td>
                    <td>
                        <input type="number" name="hours[]" min="0" max="16" size="8" <?php echo $hours;?>> hours
                        <input type="number" name="minutes[]" min="0" max="60" size="8" required <?php echo $minutes;?>> mins
                    </td>
                    <td><button type="button" onclick="addRow()">Add Row</button></td>
                </tr>
            </tbody>
        </table>
        <button id="addRowButton" type="button" onclick="addRow()">Add Row</button>
        <input type="submit" name="Submit_Timesheet" value="Submit_Timesheet">
    </form>

    <script>
        function addRow() {
            const tableBody = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" name="name[]" readonly value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" <?php echo $name;?>></td>
                <td>
                    <select name="task[]" style='width: 150px' required>
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
                            <option value="Heleniums MKT4">Heleniums MKT4</option>
                            <option value="Heliconias BA4">Heliconias BA4</option>
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
                            <option value="Santiagos Sys Dev4">Santiagos Sys Dev4</option>
                            <option value="Santorinis Sys Supp 5">Santorinis Sys Supp 5</option>
                            <option value="Sardinians Tech Supp 4">Sardinians Tech Supp 4</option>
                            <option value="Senna GM4">Senna GM4</option>
                            <option value="Seychelles IT3">Seychelles IT3</option>
                            <option value="Short Courses 2023">Short Courses 2023</option>
                            <option value="Snowdrops NVC4">Snowdrops NVC4</option>
                            <option value="Starflowers Bookkeeping 3">Starflowers Bookkeeping 3</option>
                            <option value="Sunflowers">Sunflowers</option>
                            <option value="Supergroup BA4">Supergroup BA4</option>
                            <option value="Supergroup BBKl3">Supergroup BBKl3</option>
                            <option value="Supergroup Office Administration L5">Supergroup Office Administration L5</option>
                            <option value="Supergrp Office Administration NQF Level 5">Supergrp Office Administration NQF Level 5</option>
                            <option value="SuperGrp BBKL3">SuperGrp BBKL3</option>
                            <option value="Super Grp Technical Accounting NQF Level 5">Super Grp Technical Accounting NQF Level 5</option>
                            <option value="SuperGroup CC2">SuperGroup CC2</option>
                            <option value="Supergroup CC4">Supergroup CC4</option>
                            <option value="SuperGroup GM4">SuperGroup GM4</option>
                            <option value="SuperGroup GM5">SuperGroup GM5</option>
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
                            <option value="SynergERP Cat. B Bus. Con. '23">SynergERP Cat. B Bus. Con. '23</option>
                            <option value="SynergERP PM5 Group 3">SynergERP PM5 Group 3</option>
                            <option value="Synergy Bookkeeping 4">Synergy Bookkeeping 4</option>
                            <option value="Synergy ICT Internship">Synergy ICT Internship</option>
                            <option value="Talksure GM5 2023">Talksure GM5 2023</option>
                            <option value="Talksure Skills Programme">Talksure Skills Programme</option>
                            <option value="Tarsus Contact Centre 4 2022">Tarsus Contact Centre 4 2022</option>
                            <option value="Tarsus BA 4">Tarsus BA 4</option>
                            <option value="Tarsus PM4 2022">Tarsus PM4 2022</option>
                            <option value="Tarsus NVC 4 2022">Tarsus NVC 4 2022</option>
                            <option value="Tarsus Sys Dev 5 2022">Tarsus Sys Dev 5 2022</option>
                            <option value="Tarsus Generic Management (Strategic) NQF Level 6 FY 23/24">Tarsus Generic Management (Strategic) NQF Level 6 FY 23/24</option>
                            <option value="Tarsus Generic Management (Strategic) NQF Level 5 FY 23/24">Tarsus Generic Management (Strategic) NQF Level 5 FY 23/24</option>
                            <option value="Tasmanias IT3">Tasmanias IT3</option>
                            <option value="Tiger Flowers PM4">Tiger Flowers PM4</option>
                            <option value="Trumpets GM4">Trumpets GM4</option>
                            <option value="Valerians NVC4">Valerians NVC4</option>
                            <option value="Veronicas GM4">Veronicas GM4</option>
                            <option value="Zaharas GM5">Zaharas GM5</option>
                    </select>
                </td>
                <td><input type="textarea" name="description[]" placeholder="Description" <?php echo $description;?>></td>
                <td>
                    <input type="number" name="hours[]" min='0' max="16 size="8" required <?php echo $hours;?>>hours
                    <input type="number" name="minutes[]" min='0' max="60" size="8" required <?php echo $minutes;?>>mins
                </td>
                <td><button type="button" onclick="removeRow(this)">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
        }

        function removeRow(button) {
            const row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
</body>
</html>
