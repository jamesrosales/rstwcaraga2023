 <script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
   

<style type="text/css">
    #content {
/*            background: url(<?php echo base_url("assets/img/Website_Background.jpg"); ?>);*/
            min-height: 969px;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: cover;
            margin: 0;
            padding:  0;
            padding-top: 1%;
            padding-bottom: 6%;  
            color: #144a88;
        }

img.mobile-tribal, img.image_16th{
            display: none;
        }

        @media only screen and (max-width: 600px) {
            #content{
                min-width:640px;
                max-height: 1709px;
                font-size: 12px;
            }

            .right {
                max-height: 600px !important;
                position: center;
            }

            img.image_header {
                display: none;
            }

            img.image_16th {
                display: block;
                width: 300px;
            }
            .navbar {
                width:630px;
            }
            .container-fluid {
                width: 630px;
            }
            .profile {
                margin-top: 15px;
            }
            .badge {
                margin-bottom: 20px;
            }
            .btn-orange{
                margin-top: 20px;
            }
            .list_of{
                margin-top: 30px;
            }
            .image_modal{
                max-height:48px !important;
            }
        }

        .image_modal{
            margin-left: -30px;
            margin-top: -11px;
            margin-bottom: 10px;
        }

        .condition{
                margin-top: 10px !important;
                margin-right: 10px;

           }
        .Left {
            background-color: #fff;
            padding:50px; 
            margin-left: 0px;
            margin-right: 0px;
            padding-right: 0px;
            padding-bottom: 0px;
        }
        
        h2, h3, h4, h5, p{
            margin-bottom: 25px !important;
            padding: 0px;
        }
        .foot {
            color: #fff;
            margin-bottom: 0px !important;
            padding: 0px;
            font-size: 11px;
        }
        .left_info{
            margin-left: 40px;
        }
        .badge-warning, .badge-success{
            color:#FFF !important;
            font-size: 15px;
            padding-left: 20px;
            padding-right: 20px;
            font-weight: bold !important;
        }
        .navbar-dark{
            max-height: 550px !important;
            background: url(<?php echo base_url("assets/img/Website Header.jpg"); ?>);
        }
        .center {
          display: block;
          margin-left: auto;
          margin-right: auto;
        }
        .bg-primary{
            background-color: #144a88 !important;
        }
        .modal-body{
            padding: 30px !important;
            padding-top: 10px !important;
        }
        .please{
            text-align: left;
            margin-bottom: 20px !important;
            font-size: 10px;
        }
        .modal-header{
            background-color: #144a88;
            color: #fff;
        }
        #EventRecords{
            max-height: 200px;
            min-height: 200px;
            overflow: auto;
        }
        #QrCodeOutput{
            /*margin-top: 50px;*/
             /*width: 500px;*/
             background-color: #fff;
             text-align: center;
/*             padding: 10px;*/
             padding-top: 10px;
             padding-bottom: 10px;

        }
        #QrCodeOutput canvas{
            width: 90%;
        }

</style>
<script src="<?=base_url('assets/dist/js/html2canvas.js')?>"></script>
<nav class="navbar navbar-expand-sm navbar-dark bg-primary justify-content-center">
  <div class="container">
    <a class="navbar-brand" href="#">
        <img src="<?php echo base_url('assets/img/16th.png'); ?>" style="max-height: 85px;max-width: none;" class="image_16th">
        <img src="<?php echo base_url('assets/img/WH.jpg'); ?>" style="max-height: 85px;max-width: none;" class="image_header">  
    </a>
  </div>
</nav>
<!-- <img src="<?php echo base_url('assets/img/Website Header.jpg'); ?>" style="max-height: 130px;" class="right"> -->
  <div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">  
            </div>
            
            <div class="col-sm-15" style="box-shadow: 0 2px 12px #8d4b0b;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">  
                            <div class="col-sm-3">
                                <?php if($data->approval_status == 1){ ?>
                                <div style="margin-left:30px;">
                                <div id="QrCodeOutput"></div>
                                </div>
                                <?php } else{ ?>
                                <img src="<?php echo base_url('assets/img/pending.png'); ?>" style="max-height: 300px;" class="right">
                                <br>
                                <?php } ?>
                            </div>
                            <div class="col-sm-8">
                                <div class="col-sm-12">
                                    
                                    <br>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <h3 id="usr_name_view"></h3>
                                            <h6 id="usr_institution_view" style="color:#e8642b;"></h6>
                                            <h6 id="usr_occupation_view"></h6>
                                            <br>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6 >APPLICATION STATUS</h6>
                                            <?php if($data->approval_status == 1){ ?>
                                            <h3 class="bagde"><span class="badge badge-success">APPROVED</span></h3>
                                            <?php } else { ?>
                                            <h3 class="bagde"><span class="badge badge-warning">PENDING</span></h3>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h6 id="usr_cluster_view"></h6>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6 id="usr_sector_view"></h6>
                                        </div>
                                        <div class="col-sm-4">
                                            <h6 id="usr_email_view"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3 left_info">
                                <center>
                                    <button class="btn btn-block btn-orange" <?php if($data->approval_status != 1){ ?> disabled <?php } ?> style="margin-left: -30px;" onclick="DownloadQRCode()">Download QR Code</button>
                                    <!-- <input type="submit" name="signup" class="btn btn-block btn-orange" value="Download QR Code" style="margin-left: -30px;"> -->
                                </center>
                                <br>
                                <h6 id="usr_birth_date_view"></h6>
                                <h6 id="usr_gender_view"></h6>
                                <h6 id="usr_contact_view"></h6>
                                <h6 id="usr_municipality_view"></h6>
                                
                                <center>
                                    <button type="button" class="btn btn-block btn-orange" data-toggle="modal" data-target="#myModal" style="margin-left: -30px;">Update Profile</button>
                                    <a href="<?php echo base_url('Registration/Logout'); ?>" class="btn btn-block btn-primary" style="margin-left: -30px;"> Logout</a>
                                    
                                    <div class="modal fade" id="myModal">
                                      <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">

                                          <!-- Modal Header -->
                                          <div class="modal-header">

                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>

                                          <!-- Modal body -->
                                          <div class="modal-body">
                                            <img src="<?php echo base_url('assets/img/WH.jpg'); ?>" style="max-height: 62px;max-width: none;" class="image_modal"> 
                                            <label class="please">Please fill in the necessary information </label>
                                            <form id="UpdateInfo">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" name="usr_lname" value="<?=$data->usr_lname;?>" class="form-control input_textarea" required placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="hidden" name="usr_id" class="form-control input_textarea" value="<?=$data->usr_id;?>">      
                                                            <input type="text" name="usr_fname" value="<?=$data->usr_fname;?>" class="form-control input_textarea" required  placeholder="First Name">
                                                        </div>  
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <input type="text" name="usr_mname" value="<?=$data->usr_mname;?>" class="form-control input_textarea" placeholder="MI">
                                                        </div>  
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <input type="text" name="usr_suffix"  value="<?=$data->usr_suffix;?>" class="form-control input_textarea"  placeholder="Suffix">
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="form-group col-sm-5">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label style="margin-top:5px;font-size:17px;color: #1b4485;" class="birthdate">Birthdate</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="date" name="birth_date" value="<?=$data->birth_date;?>" class="form-control input_textarea" placeholder="Date" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <select class=" btn input_textarea" placeholder="Choose Privilege" name="usr_gender" >
                                                            <option selected disabled>Gender</option>
                                                            <option <?php if($data->usr_gender == 'Male'){ ?> selected <?php } ?>>Male</option>
                                                            <option <?php if($data->usr_gender == 'Female'){ ?> selected <?php } ?>>Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-4">
                                                        <input type="text" class="form-control input_textarea" name="usr_contact" value="<?=$data->usr_contact;?>" required placeholder="Mobile Number" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" class="form-control input_textarea" name="usr_occupation" value="<?=$data->usr_occupation;?>" required placeholder="Occupation/Position" >
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" class="form-control input_textarea" name="usr_institution" value="<?=$data->usr_institution;?>" required placeholder="Name of Firm/Institution" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <input type="email" class="form-control input_textarea" name="usr_email" value="<?=$data->usr_email;?>" placeholder="Email Address" required style="text-transform: none;">
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" class="form-control input_textarea" name="usr_municipality" value="<?=$data->usr_municipality;?>" required placeholder="Address" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <select required class="btn input_textarea" name="usr_sector" id="usr_sector" placeholder="Sector"  >
                                                            <option <?php if($data->usr_sector == 'Academe'){ ?> selected <?php } ?>>Academe</option>
                                                            <option <?php if($data->usr_sector == 'Association'){ ?> selected <?php } ?>>Association</option>
                                                            <option <?php if($data->usr_sector == 'Cooperative'){ ?> selected <?php } ?>>Cooperative</option>
                                                            <option <?php if($data->usr_sector == 'National Government Agencies'){ ?> selected <?php } ?>>National Government Agencies</option>
                                                            <option <?php if($data->usr_sector == 'Local Government Unit'){ ?> selected <?php } ?>>Local Government Unit</option>
                                                            <option <?php if($data->usr_sector == 'Non-Governmental Organization'){ ?> selected <?php } ?>>Non-Governmental Organization</option>
                                                            <option <?php if($data->usr_sector == 'Overseas Filipino Worker'){ ?> selected <?php } ?>>Overseas Filipino Worker</option>
                                                            <option <?php if($data->usr_sector == 'Private Sector'){ ?> selected <?php } ?>>Private Sector</option>
                                                            <option <?php if($data->usr_sector == 'Student'){ ?> selected <?php } ?>>Student</option>
                                                            <option <?php if($data->usr_sector == 'Senior Citizen'){ ?> selected <?php } ?>>Senior Citizen</option>
                                                            <option <?php if($data->usr_sector == 'Persons with Disabilities'){ ?> selected <?php } ?>>Persons with Disabilities</option>
                                                            <option <?php if($data->usr_sector == 'Hospital'){ ?> selected <?php } ?>>Hospital</option>
                                                            <option <?php if($data->usr_sector == 'DOST Agencies'){ ?> selected <?php } ?>>DOST Agencies</option>
                                                            <option <?php if($data->usr_sector == 'Others'){ ?> selected <?php } ?>>Others</option>
                                                            <!-- <option value="others">Others, please specify:</option> -->
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <select required class="btn input_textarea" name="usr_role" id="usr_role" placeholder="Role">
                                                            <?php foreach ($roles as $var) { ?>    
                                                                 <option value="<?=$var['role_id']?>" <?php if($var['role_id'] == $data->usr_role){ ?> selected <?php } ?>><?=$var['role_name']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <!-- <select required class="btn input_textarea"  placeholder="Choose Privilege" name="participation_status"  >
                                                            <option selected disabled>Attendance Option</option>
                                                            <option value="1">Physically Attending</option>
                                                            <option value="0">Virtually Attending</option>
                                                        </select>  -->
                                                    </div>
                                                </div>
                                                <!-- <div class="row" id="other_sector" style="display:none">
                                                    <input type="text" name="usr_sector_other" id="" class="input_textarea form-control" >
                                                </div> -->
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <select required class="btn input_textarea" name="usr_cluster" id="usr_cluster" placeholder="Regional Cluster">
                                                            <option selected disabled>Regional Cluster</option>
                                                            <option <?php if($data->usr_cluster == 'Luzon'){ ?> selected <?php } ?> value="Luzon">Luzon</option>
                                                            <option <?php if($data->usr_cluster == 'Visayas'){ ?> selected <?php } ?> value="Visayas">Visayas</option>
                                                            <option <?php if($data->usr_cluster == 'Mindanao'){ ?> selected <?php } ?> value="Mindanao">Mindanao</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                       
                                                        <select required class="select2 btn input_textarea" multiple="multiple" data-placeholder="Select a Events" name="event_name[]" >
                                                            <?php  $myArray = explode(',', $data->event_id); ?>
                                                            <?php foreach ($events as $var) { ?>       
                                                            <?php if (in_array($var['event_id'], $myArray)){ ?>
                                                                <option value="<?=$var['event_id']?>" selected><?=$var['event_name']?></option>           
                                                            <?php }else{ ?>
                                                                <option value="<?=$var['event_id']?>"><?=$var['event_name']?></option>
                                                            <?php } ?>       
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>

                                          <!-- Modal footer -->
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" >Save Changes</button> 
                                          </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- <input type="submit" name="signup" class="btn btn-success" value="Update Profile" style="margin-left: -30px;"> -->
                                </center>
                            </div>
                            <div class="col-sm-8">
                                <h5 class="list_of">List of Events</h5>
                                <br>
                                <div class="list-group">
                                        <div id="EventRecords">
                                        
                                        </div>
                                    
                                  <!-- <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h6 class="sm-1">Pre-Conference</h6>
                                      <small>3 days Left</small>
                                    </div>
                                    <p class="sm-1">Talakayang Health Research and Technology (HeaRT) Beat</p>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h6 class="sm-1">Main Conference</h6>
                                      <small>3 days Left</small>
                                    </div>
                                    <p class="sm-1">Plenary Session 1: Strategic Health Research Directions</p>
                                  </a>
                                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h6 class="sm-1">Main Conference</h6>
                                      <small>3 days Left</small>
                                    </div>
                                    <p class="sm-1">Plenary Session 1: Strategic Health Research Directions</p>
                                  </a> -->
                                  <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
  $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

qrcode = '<?=$data->qrcode;?>'
jQuery('#QrCodeOutput').qrcode(qrcode);

$(document).ready(function() {
    $('#UpdateInfo').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Registration/UpdateInfo')?>",
            type: "POST",  
            data: form,
            success: function(data){  
                var json = $.parseJSON(data)
                
                if (json.invalid == true) {
                    alert('Name Already exist.')
                }
                
                if (json.invalid_email == true) {
                    alert('Email already exists.')
                }

                if (json.success == true) {
                    alert('Saved Successfully!')
                    getProfile()
                    $('#myModal').modal('toggle');
                }

                if (json.same_value == true) {
                    alert('No changes has been made.')
                }

                
                // $('#UpdateInfo')[0].reset()
            }
        });
    });
});
getProfile()
function getProfile(){
    usr_id = "<?=$data->usr_id;?>"
    $.ajax({  
        url: "<?=base_url('Registration/getProfile')?>",
        type: "POST",  
        data: {usr_id:usr_id},
        success: function(data){  
            var json = $.parseJSON(data)

            if(json.user_data.usr_suffix!='') { suffix = ', '+ json.user_data.usr_suffix; } else { suffix = ''; }
            name = json.user_data.usr_fname+' '+json.user_data.usr_mname+'. '+json.user_data.usr_lname+''+suffix
            $('#usr_name_view').html('<b>'+name+'</b>')
            $('#usr_institution_view').html('<b>'+json.user_data.usr_institution+'<b>')
            $('#usr_occupation_view').html(json.user_data.usr_occupation)
            $('#usr_birth_date_view').html(json.user_data.birth_date)
            $('#usr_gender_view').html(json.user_data.usr_gender)
            $('#usr_contact_view').html(json.user_data.usr_contact)
            $('#usr_municipality_view').html(json.user_data.usr_municipality)
            $('#usr_cluster_view').html(json.user_data.usr_cluster+' Cluster')
            $('#usr_sector_view').html(json.user_data.usr_sector)
            $('#usr_email_view').html(json.user_data.usr_email)

            var res = ''
            res +='<table class="table table-striped">'
            for (var i = 0; i < json.events.length; i++) {
                var eventdate = moment(json.events[i].event_date);
                var todaysdate = moment();
                days = eventdate.diff(todaysdate, 'days')
                res +='<tr>'
                    res +='<th>'
                        res +='<a href="#" class="list-group-item-action ">'
                            res +='<div >'
                                res +='<h6 class="sm-1">'+json.events[i].event_name+'</h6>'
                                // res +='<small>3 days Left</small>'
                        res +='</div>'
                        // res +='<p class="sm-1">Talakayang Health Research and Technology (HeaRT) Beat</p>'
                        res +='</a>'
                        res +='</th>'
                    res +='<th><small>'+days+' days Left</small</th>'
                res +='<tr>'
            }
            res +='</table>'
            $('#EventRecords').html(res)
        }
    });
}

$('#sectors').on('change', function(){
    if( this.value === "others"){
        $('#other_sector').css('display','block');
        $('#other_sector input').prop('required', true)
    }else{
        $('#other_sector').css('display','none');
        $('#other_sector input').prop('required', false)
    }
})

 function DownloadQRCode() {
         html2canvas(document.getElementById("QrCodeOutput")).then(function(canvas) {
            document.body.appendChild(canvas);

            const image = canvas.toDataURL("image/png", 1.0);
            const link = document.createElement("a");

            link.download = "PNHRS2023 QR Code.png";
            link.href = image;
            link.click();
      });
     }

</script>