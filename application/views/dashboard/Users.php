
<html>
<head>
  <meta charset="utf-8">
  <title>Attendance System</title>
  <link rel="icon" type="image/ico" href="<?php echo base_url('assets/img/logo.png');?>" />
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
            <h1 class="hrmisLogo" style="color: #fff!important;">DOST Caraga</h1>
            <div class="small" style="color: #fff!important;">Contactless Attendance System</div>
        </div>
    </div>

<div class="row">
  
    <div class="col-md-12">
        <center><div class="digital-clock heading_color"></div></center>
        <div style="background-color: white;padding: 10px" >
            
             <a class="btn btn-block btn-sm btn-info" style="height: 30px;color: white;" onclick="AddEmployee()">Add Employee</a>
            <div id="tbl_">
            <table class="table table-striped  table-hover" >
                <thead style="background-color: #e9ecef;">
                    <tr>
                        <th>No.</th>
                        <th>empNumber</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table_body"></tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="footer">
            <div class="copyright"> 2023 © DOST Caraga </div>
        </div>
    </div>
</div>



 


<div class="modal" id="EditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="EditUser">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="group">      
                            <label>empNumber</label>
                            <input type="text" name="empNumber" id="edit_empNumber" class="form-control">
                        </div><br>
                         <div class="group">      
                            <label>First Name</label>
                            <input type="hidden" name="empID" id="edit_empID" class="form-control">
                            <input type="text" name="usr_fname" id="edit_usr_fname" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Middle Name</label>
                            <input type="text" name="usr_mname" id="edit_usr_mname" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Last Name</label>
                            <input type="text" name="usr_mname" id="edit_lname" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Suffix </label>
                            <input type="text" name="suffix" id="edit_suffix" class="form-control">
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="group">      
                            <label>Salutation</label>
                            <input type="text" name="salutation" id="edit_salutation" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Sex</label>
                            <select name="sex" id="edit_sex" class="form-control">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div><br>
                        <div class="group">      
                            <label>Civil Status</label>
                            <input type="text" name="civilStatus" id="edit_civilStatus" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>User Status </label>
                             <select name="status" id="edit_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger danger_new_color one-edge-shadow ButtonBorderColor" data-dismiss="modal"><span class="fas fa-times font-size14"></span>&nbsp;Cancel</button>
                <button type="submit" class="btn btn-info one-edge-shadow ButtonBorderColor" id="UpdateUserSubmit"><span class="fas fa-edit font-size14"></span>&nbsp;Save changes</button>
                <button class="btn btn-info" id="UpdateUserLoad">Processing <span class="fa fa-cog fa-spin"></span></button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="ADDModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="AddEmployee">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="group">      
                            <label>empNumber</label>
                            <input type="text" name="empNumber"  required class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>First Name</label>
                            <input type="text" name="usr_fname" required  class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Middle Name</label>
                            <input type="text" name="usr_mname" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Last Name</label>
                            <input type="text" name="usr_mname" required  class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Suffix </label>
                            <input type="text" name="suffix" class="form-control">
                        </div><br>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="group">      
                            <label>Salutation</label>
                            <input type="text" name="salutation" class="form-control">
                        </div><br>
                        
                        <div class="group">      
                            <label>Sex</label>
                            <select name="sex" id="edit_sex" class="form-control">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div><br>
                        <div class="group">      
                            <label>Civil Status</label>
                            <input type="text" name="civilStatus" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>User Status </label>
                             <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

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
            url: "<?=base_url('Dashboard/AddUser')?>",
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
                    EmployeeRecords()
                    alert('Successfully Added')
                }

                if (json.duplicate == true) {
                    alert('empNumber already exist')
                }
            }
        });
        
    });
});


EmployeeRecords()
function EmployeeRecords(){
    $.ajax({
      url:  "<?=base_url('Dashboard/EmployeeRecords')?>",
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
                res +='<td >'+json[i].empNumber+'</td>'
                res +='<td>'+json[i].usr_mname+', '+json[i].usr_fname+' '+json[i].usr_mname[0]+' </td>'
                res +='<td>'
                if (json[i].status == 1) {
                    res +='<span class="badge badge-info">Active</span>'
                }else{
                    res +='<span class="badge badge-warning">Inactive</span>'
                }
                res +='</td>'
                res +='<td>'
                     res +='<a class="btn btn-sm btn-info" onclick="editUser('+json[i].empID+')" style="color:white">Edit</a>&nbsp;'
                     res +='<a class="btn btn-sm btn-danger" onclick="DeleteUser('+json[i].empID+')" style="color:white">Delete</a>'
                res +='</td>'
            res +='</tr>'
            }
        }

        $('#table_body').html(res)
      }
     });
}

function editUser(empID){
    
    $.ajax({
      url:  "<?=base_url('Dashboard/editUserData')?>",
      type: "POST",
      data: {empID:empID},
      success: function(data)
      {
        var json = $.parseJSON(data)

        $('#edit_empNumber').val(json.empNumber)
        $('#edit_empID').val(json.empID)
        $('#edit_usr_fname').val(json.usr_fname)
        $('#edit_usr_mname').val(json.usr_mname)
        $('#edit_lname').val(json.usr_mname)
        $('#edit_suffix').val(json.suffix)
        $('#edit_salutation').val(json.nameExtension)
        $("#edit_sex option[value="+json.sex+"]").prop('selected', true);
        $('#edit_civilStatus').val(json.civilStatus)
        $("#edit_status option[value="+json.status+"]").prop('selected', true);

        $('#EditModal').modal()
      }
     });
}


$('#UpdateUserLoad').hide()
$(document).ready(function() {
    $('#EditUser').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Dashboard/EditUser')?>",
            type: "POST",  
            data: form,
            beforeSend: function(){
                $('#UpdateUserLoad').show()
                $('#UpdateUserSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)

                if(json.success == true){
                    $('#EditModal').modal('hide')
                    EmployeeRecords()
                    alert('Successfully Updated')
                }

                if (json.duplicate == true) {
                    alert('empNumber already exist')
                }
                
                $('#UpdateUserLoad').hide()
                $('#UpdateUserSubmit').show()
                
            }
        });
        
    });
});

function DeleteUser(empID){
    var result = confirm("Want to delete?");
    if (result) {
         $.ajax({  
            url: "<?=base_url('Dashboard/DeleteUser')?>",
            type: "POST",  
            data: {empID:empID},
            beforeSend: function(){
                $('#UpdateUserLoad').show()
                $('#UpdateUserSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)

                if(json.success == true){
                    EmployeeRecords()
                    alert('Successfully Deleted')
                }

                if (json.error == true) {
                    alert('Action Not allowed')
                }
                
                $('#UpdateUserLoad').hide()
                $('#UpdateUserSubmit').show()
                
            }
        });
    }
}




  </script>
</body>
</html>
