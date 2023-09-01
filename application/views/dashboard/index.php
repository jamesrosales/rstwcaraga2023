
<html>
<head>
  <meta charset="utf-8">
  <title>QR Attendance</title>
  <script src="<?php echo base_url() ?>assets/dist/js/jsQR/jsQR.js"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.css">
  <script src="<?php echo base_url() ?>assets/dist/js/jquery.js"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">

  <style>

  body{
      background-color: #2a4b75;
      font-family: "Open Sans", sans-serif;
    }
  
    h1.hrmisLogo {
      display: inline-block;
      margin-left: 10px;
      font-weight: bolder;
      position: absolute;
      top: 30px;
      color: #2a4b75;
      font-size: 42px;
    }
    div.small {
        display: inline-table;
        position: absolute;
        top: 75px;
        color: #2a4b75;
        margin-left: 13px;
        font-weight: 500;
    }
    .logo {
      margin: 0 !important;
      padding: 15px;
    }

    .heading_color{
      color: #48b4c1;
    }
    .color_white{
      color: white;
    }
    .background_color_white{
      background-color: white;
    }

    .copyright{text-align:center;margin:0 auto 30px 0;padding:10px;color:#7a8ca5;font-size:13px}



  </style>
</head>
<body>
<div class="menu-toggler sidebar-toggler"></div>
<div class="logo"></div>
  
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding-bottom: 2%; ">
            <br><img style="height: 70px;" src="<?=base_url('assets/dist/img/dost8.png')?>" alt="" />
            <h1 class="hrmisLogo" style="color: #fff!important;">DOST VIII</h1>
            <div class="small" style="color: #fff!important;">Contactless Attendance System</div>
        </div>
    </div>

<div class="row">
  
    <div class="col-md-12">
        <center><div class="digital-clock heading_color"></div></center>
        <div style="background-color: white;padding: 10px" >
            
             <!-- <a class="btn btn-block btn-sm btn-info" style="height: 30px;color: white;" onclick="AddEmployeea()">Add Event</a> -->
            <div id="tbl_">
            <table class="table table-striped  table-hover" >
                <thead style="background-color: #e9ecef;">
                    <tr>
                        <th>No.</th>
                        <th>Event Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="EventRecords"></tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="footer">
            <div class="copyright"> 2020 © DOST VIII. </div>
        </div>
    </div>
</div>



 


<div class="modal" id="EditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="EditEvent">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group">      
                            <label>Event Name</label>
                            <input type="hidden" name="event_id" id="edit_event_id">
                            <input type="text" name="event_name" id="edit_event_name" class="form-control">
                        </div><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger danger_new_color one-edge-shadow ButtonBorderColor" data-dismiss="modal"><span class="fas fa-times font-size14"></span>&nbsp;Cancel</button>
                <button type="submit" class="btn btn-info one-edge-shadow ButtonBorderColor" id="EditEventSubmit"><span class="fas fa-edit font-size14"></span>&nbsp;Save changes</button>
                <button class="btn btn-info" id="EditEventLoad">Processing <span class="fa fa-cog fa-spin"></span></button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="ADDModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="AddEmployee">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group">      
                            <label>Event Name</label>
                            <input type="text" name="event_name" class="form-control">
                        </div><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger danger_new_color one-edge-shadow ButtonBorderColor" data-dismiss="modal"><span class="fas fa-times font-size14"></span>&nbsp;Cancel</button>
                <button type="submit" class="btn btn-info one-edge-shadow ButtonBorderColor" id="AddUserSubmit"><span class="fas fa-edit font-size14"></span>&nbsp;Save changes</button>
                <button class="btn btn-info" id="AddUserLoad">Processing <span class="fa fa-cog fa-spin"></span></button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>


<!-- 28026  -->
  <input type="hidden" id="url" value="<?php echo base_url();?>">


<script>

function AddEmployee(){
    $('#ADDModal').modal()
}

 $('#AddUserLoad').hide()
$(document).ready(function() {
    $('#AddEmployee').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Dashboard/AddEvent')?>",
            type: "POST",  
            data: form,
            beforeSend: function(){
                $('#AddUserLoad').show()
                $('#AddUserSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)
               
                $('#AddUserLoad').hide()
                $('#AddUserSubmit').show()

                if(json.success == true){
                    $('#AddEmployee')[0].reset()
                    $('#EditModal').modal('hide')
                    EventList()
                    alert('Successfully Added')
                }

                if (json.duplicate == true) {
                    alert('empNumber already exist')
                }
            }
        });
        
    });
});


EventList()
function EventList(){
    url = "<?=base_url()?>"
    $.ajax({
      url:  "<?=base_url('Dashboard/EventList')?>",
      type: "POST",
      success: function(data)
      {
        var json = $.parseJSON(data)
        var res = ''
        var num = 0;

        if (json.length == 0) {
            res +='<tr>'
                res +='<td colspan="5" style="text-align:center;">No records found</td>'
            res +='</tr>'
        }
        if (json.length != 0) {
            for (var i = 0; i < json.length; i++) {
            num++
            res +='<tr>'
                res +='<td>'+num+'</td>'
                res +='<td >'+json[i].event_name+'</td>'
                res +='<td>'
                     res +='<a class="btn btn-sm btn-info" href="'+url+'Dashboard/EventAttendance/'+json[i].event_id+'" style="color:white">View</a>&nbsp;'
                     // res +='<a class="btn btn-sm btn-info" onclick="EditEvent('+json[i].event_id+')" style="color:white">Edit</a>&nbsp;'
                     // res +='<a class="btn btn-sm btn-danger" onclick="DeleteEvent('+json[i].event_id+')" style="color:white">Delete</a>'
                res +='</td>'
            res +='</tr>'
            }
        }

        $('#EventRecords').html(res)
      }
     });
}

function EditEvent(event_id){
    
    $.ajax({
      url:  "<?=base_url('Dashboard/getEventData')?>",
      type: "POST",
      data: {event_id:event_id},
      success: function(data)
      {
        var json = $.parseJSON(data)

        $('#edit_event_name').val(json.event_name)
        $('#edit_event_id').val(json.event_id)
        $('#EditModal').modal()
      }
     });
}


$('#EditEventLoad').hide()
$(document).ready(function() {
    $('#EditEvent').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Dashboard/EditEvent')?>",
            type: "POST",  
            data: form,
            beforeSend: function(){
                $('#EditEventLoad').show()
                $('#EditEventSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)

                if(json.success == true){
                    $('#EditModal').modal('hide')
                    EventList()
                    alert('Successfully Updated')
                }

                if (json.duplicate == true) {
                    alert('Event already exist')
                }

                if (json.same_value == true) {
                    alert('No changes has been made')
                }

                
                
                $('#EditEventLoad').hide()
                $('#EditEventSubmit').show()
                
            }
        });
        
    });
});

function DeleteEvent(event_id){
    var result = confirm("Want to delete?");
    if (result) {
         $.ajax({  
            url: "<?=base_url('Dashboard/DeleteEvent')?>",
            type: "POST",  
            data: {event_id:event_id},
            beforeSend: function(){
                $('#EditEventLoad').show()
                $('#EditEventSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)

                if(json.success == true){
                    EventList()
                    alert('Successfully Deleted')
                }

                if (json.error == true) {
                    alert('Action Not allowed')
                }
                
                $('#EditEventLoad').hide()
                $('#EditEventSubmit').show()
                
            }
        });
    }
}




  </script>
</body>
</html>
