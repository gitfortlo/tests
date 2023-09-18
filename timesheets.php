<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

<head>
  <script src="min.js"></script>
  <script src="min.js"></script>
  <script src="min.css"></script>  
  <script src="min.js"></script>
  <link rel="stylesheet" href="min.css"/>
      <link rel="stylesheet" href="min.css"/>
    <script src="min.js"></script>
    <script src="min.js"></script>
    <script>
      $('.ui.dropdown')
  .dropdown()
;

$(document).ready(function() {
  $(".js-example-basic-single").select2();
});



webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
$.webshims.formcfg = {
en: {
    dFormat: '-',
    dateSigns: '-',
    patterns: {
        d: "yy-mm-dd"
    }
}
};

var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;       
document.getElementById("theDate").value = today;



    </script>
  
</head>

  <div>
    <p class="maintitle">Monthly Timesheet</p>
  </div>

<section class="timesheet-navigation">
    <div class="nav">
      <div class="container-fluid ">
       <div class="tabbable">
        <ul class="nav nav-tabs" data-tabs="tabs" id="myTab">
        <th class="active"><a data-toggle="tab" href="#incoming">Current</a></th>
        <th><a data-toggle="tab" href="#sentmsg">Previous</a></th>
        <th><a data-toggle="tab" href="#sentmsg">Not Sent</a></th>
        <th><a data-toggle="tab" href="#sentmsg">Wait for Accept</a></th>
        <th><a data-toggle="tab" href="#sentmsg">Accepted</a></th>
        <th><a data-toggle="tab" href="#sentmsg">Rejected</a></th>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="incoming">
          
</section>


<section class="timesheet-buttons">

  <input type="date" id="theDate">
  
  <div class="today-timesheet">
    <button type="button" class="newmsgb">Today</button>
    <button type="button" class="add-task-timesheet" data-toggle="modal" data-target="#addtask">Add New Task</button>
  </div>
</section>

<section style="margin-top: -40px">
  
  <p class="picked-day">2016-12-30</p>


  
    
</section>

<section>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12 tab-title">
       <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-1">
            <div class="statustitle">Project</div>
           </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
             <div class="projectnametitle">Task</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="completiontitle">Date</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Start Date/End Date</div>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="detailstitle">Duration</div>
            </div>
             <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Description</div>
            </div>
             <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="tsdelete-row"></div>
            </div>
          </div>
        </div>
      </div>
    </div>  
</section>


<section>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="row timesheet-task-row">
          <div class="col-md-2 col-sm-2 col-xs-1">
            <div class="statustitle">Project 1</div>
           </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
             <div class="projectnametitle">Task 1</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="completiontitle">2016-12-12</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">12:00/13:00</div>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="detailstitle">1 Hr.</div>
            </div>
             <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Really hard work.</div>
            </div>
             <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="tsdelete-row">x</div>
            </div>
          </div>
        </div>
      </div>
    </div>  
</section>


<!-- Modal -->
<div id="addtask" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content timesheet">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Task</h4>
      </div>
      <div class="modal-body">
        
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <p>Project</p>
                </div>
                <div class="col-md-9">
                  
                <select class="js-example-basic-single">
                  <option>Project1</option>
                  <option>Project2</option>
                  <option>Project3</option>
                  <option>Project4</option>
                  <option>Project5</option>
                </select>
                  
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Task</p>
                </div>
                <div class="col-md-9">
                  
                <select class="js-example-basic-single">
                  <option>Task1</option>
                  <option>Task2</option>
                  <option>Task3</option>
                  <option>Task4</option>
                  <option>Task5</option>
                </select>
                  
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Date</p>
                </div>
                <div class="col-md-9">
                  <input type="date">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Start Time</p>
                </div>
                <div class="col-md-9">
                  <input type="time" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>End Time</p>
                </div>
                <div class="col-md-9">
                  <input type="time" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Description</p>
                </div>
                <div class="col-md-9">
                  <input type="text" class="timesheet-description"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                   <div clas="actionbutton">
     <p class="button-container"><button class="user-aciton">Add Task</button></p>
   </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
