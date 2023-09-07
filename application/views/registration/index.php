<style type="text/css">
    #content {
        /* for the background nga image */
            background: url(<?php echo base_url("assets/img/bgbg.jpg"); ?>);
            height: 969px;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: cover;
            margin: 0;
            padding:  0;
            padding-top: 3%;
            padding-bottom: 7%;  
        }

img.mobile-tribal, img.show_img{
            display: none;
        }
        @media only screen   
            and (min-width: 1030px)   
            and (max-width: 1080px)  
            { 
                img.show_img{
                    margin-top: 0px !important;
                }
            } 
        @media only screen and (max-width: 600px) {
            img.mobile-down, img.right {
                display: none;
              }
            #content{
                min-width:640px;
                height: 600px;
            }
            .right {     
                min-height: 660px;
                width: 660px;
                margin-top: -40px;
           }
           img.show_img{
                display: inline;
                margin-top: -40px;
                max-height: 295px;
                border-top-left-radius: 20px;
                border-bottom-left-radius: 20px;
           }
            .Left{
                min-height: 860px;
                width: 662px;
           }
           .info{
                padding: 30px;
                font-size: 15px;
           }
           .input_textarea{
                width: 80%;
                margin-top: 2px;
                margin-left: 30px;
                font-size: 19px;    
                border-bottom: .2em solid #1b4485;
           }
           .select2{
                margin-top: 2px;
                margin-left: 30px;
                margin-right: -80px;
                font-size: 19px;    
                border-bottom: .2em solid #1b4485;
                width: 80%;
                color: #e48600;
           }
           .remember{
                padding-left: 60px;
                border-bottom: .2em solid #1b4485;
           }
           .forgot{
                margin: 0px;
                padding-top: 0px;
                padding-left: 60px;
           }
           .btn{
                padding:15px;
                margin-top: 20px;
                
           }
           .img_bot{
                margin-top: 20px;
           }
           .text_mobile{
                font-size: 18px !important;
                border-bottom: .2em solid #1b4485;
           }
           img.mobile-tribal{
                display: inline;
                height: 80px;
                margin-top: 10px;
                min-width: 705px;
                border-radius: 0px;
           }
           h4{
                font-size: 37px !important;
           }
           h6{
                font-size: 25px !important;
           }
           .condition{
                margin-top: 20px !important;
                margin-right: 10px;
           }
           .text_condition{
                margin-top: 20px !important;
                font-size: 15px;
                text-align: justify;
                margin-right: 50px;
           }
           .birthdate{
                margin-left: 30px !important;
           }
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
        #register{
            margin: 0;
            padding:  0;
            width:800px;
        }
        .select2{
            border: 0px;
            border-bottom: .2em solid #e48600;
            border-radius: 2px;
            background-color: #fff;
            font-weight: bolder;
            color: #e48600;
            max-width: 100%; 
            max-height: 90%;
        }
        .select2:hover, .select2:active {
            border: none;
            border-bottom: 2px solid #e48600;
        }
        .select2-data-placeholder{
            color: #e48600;
            font-weight: bolder;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            font-size: 10px;
            color: #1b4485;
            font-weight: normal;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple{
            border: 0px !important;
            border-bottom: 0px solid #e48600 !important;
        }
         .select2-container .select2-selection--multiple{
            border: 0px !important;
            border-bottom: 1px solid #e48600 !important;
        }
        .button-container {
            display: flex;
            justify-content: center; /* Horizontally center the buttons */
        }

        .button-container input[type="submit"] {
            margin: 0 10px; /* Add some margin between the buttons */
        }
</style>

  <div id="content">
    <div class="container" style="box-shadow: 0 3px 6px #1b4485; border-radius: 20px;">
       
        <div class="row">
             <!-- <form id="Register"> -->
            <div class="col-sm-5" style="padding: 0px;">
                <img src="<?php echo base_url('assets/img/WebsiteFront.jpg'); ?>" style="height: 650px;border-top-left-radius: 20px;border-bottom-left-radius: 20px;" class="right">
            </div>
            <div class="col-sm-6 Left">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-8">
                                <h3 style="color:#1b4485;">Registration</h3>
                                <hr>
                            </div>
                            <div class="col-sm-4">
                                <h6>Note</h6>
                                <p style="font-size:12px"><i>Ignore this if you're already registered.</i></p>
                                <!-- <a href="<?php echo base_url('Registration/Profile'); ?>" class="btn btn-sm" style="margin-top:0px;color:#000">Prof</a> -->
                            </div>
                        </div>
                    </div>
                
                <?php 
                    // $validation = $this->uri->segment(2);
                    $validation = 1;
                    if (empty($validation) || $validation == "") {
                ?>        

                <div class="col-sm-12">
                    <div class="row">
                        <?php // echo  $this->uri->segment(2); ?>
                        <div class="col-sm-12 " style="text-align: justify;">
                            <p>Dear <b>Registrants,</b></p><br>
                            <p><b>Registration is now closed.</b> Thank you for your overwhelming response and interest in our event. We look forward to seeing those who have secured their spots at the event.</p><br>
                           
                            <center>
                                <a href="<?php echo base_url('Registration/SignIn'); ?>" class="btn btn-block btn-orange" style="margin-top:200px;">Login</a>
                            </center>
                        </div>
                    </div>
                </div>
                 <?php }else{ ?>
                <form id="Register">
                <div class="col-sm-12">
                    <p style="font-size:12px">Fill out the necessary information.</p>
                    <div class="form-row">
                    <div class="form-group col-sm-4">                      
                      <input type="text" name="usr_lname" class="form-control input_textarea" required placeholder="Last Name">                   
                    </div>
                    <div class="form-group col-sm-4">
                      <input type="text" name="usr_fname" class="form-control input_textarea" required  placeholder="First Name">                     
                    </div>
                    <div class="form-group col-sm-2">
                      <input type="text" name="usr_mname" class="form-control input_textarea" placeholder="MI">
                    </div>
                    <div class="form-group col-sm-2">
                      <input type="text" name="usr_suffix" class="form-control input_textarea"  placeholder="Suffix">
                    </div>
                  </div>
                </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label style="margin-top:5px;font-size:17px;color: #1b4485;" class="birthdate">Birthdate</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="date" name="birth_date" id="birth_date" class="form-control input_textarea" required placeholder="Date" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <select class=" btn input_textarea" placeholder="Choose Privilege" name="usr_gender" >
                            <option selected disabled>Sex</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <input type="text" class="form-control input_textarea" name="usr_contact" required placeholder="Mobile No." >
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control input_textarea" name="usr_occupation" required placeholder="Occupation or Position" >
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control input_textarea" name="usr_institution" required placeholder="Agency or Institution" >
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <input type="email" class="form-control input_textarea" name="usr_email" placeholder="Email Address" required style="text-transform: none;">
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="text" class="form-control input_textarea" name="usr_municipality" required placeholder="Address" >
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <select required class="btn input_textarea" name="usr_sector" id="usr_sector" placeholder="Sector"  >
                            <option selected disabled>Sector</option>
                            <option>Academe</option>
                            <option>Association</option>
                            <option>Cooperative</option>
                            <option>National Government Agencies</option>
                            <option>Local Government Unit</option>
                            <option>Non-Governmental Organization</option>
                            <option>Overseas Filipino Worker</option>
                            <option>Private Sector</option>
                            <option>Student</option>
                            <option>Senior Citizen</option>
                            <option>Persons With Disabilities</option>
                            <option>Hospital</option>
                            <option>DOST Agencies</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <select required class="btn input_textarea" name="usr_role" id="usr_role" placeholder="Role">
                            <option selected disabled>Role of Participation</option>
                            <?php foreach ($roles as $var) { ?>    
                                 <option value="<?=$var['role_id']?>"><?=$var['role_name']?></option>
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
                        <select required class="btn input_textarea" name="usr_cluster" id="usr_sector" placeholder="Sector">
                            <option selected disabled>Regional Cluster</option>
                            <option value="Luzon">Luzon</option>
                            <option value="Visayas">Visayas</option>
                            <option value="Mindanao">Mindanao</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                       
                        <select required class="btn input_textarea select2" multiple="multiple" data-placeholder="Select Events" name="event_name[]" >
                            <?php foreach ($events as $var) { ?>     
                            <option value="<?=$var['event_id']?>"><?=$var['event_name']?></option>                  
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                  <!--   <div class="col-sm-1">
                        <label class="form-check-label justify" for="gridCheck" ></label>   
                    </div> -->
                    
                    <div class="col-sm-12" style="text-align: justify; font-size: 8px;">
                        <label class="form-check-label text_condition" for="gridCheck" >
                            <input class="form-check-input condition" type="checkbox" required id="gridCheck">By filling-out this form, you agree with the Data Privacy Policy of the Department of Science and Technology Caraga Regional Office and the National Privacy Commission (NPC). Both personal and non-personal information may be collected from you for using this form. Rest assured that these data shall be kept safe and secured, and will not be shared with anyone except to designated personnel who will process the needed information only for facilitating smooth participation and distribution of materials for such event. The collective information derived from this event will be useful for the improvement of implementing similar activities in the future.
                        </label>
            
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-2">
                        
                    </div>
                    <div class="col-sm-8">
                        <br>
                        <div class="button-container">
                        <input type="submit" name="signup" class="btn btn-block btn-orange" value="Register Data">
                        <input type="submit" name="signup" class="btn btn-block btn-orange" value="User Login" onclick="redirectToSignIn()">
                        <input type="submit" name="signup" class="btn btn-block btn-orange" value="Admin Login" onclick="redirectToSignInAdmin()">
                    </div>
                        <script>
                            function redirectToSignIn() {
                            // Redirect to the desired URL when the button is clicked
                            window.location.href = "<?php echo base_url('Registration/SignIn'); ?>";
                            }
                        </script>
                        <script>
                            function redirectToSignInAdmin() {
                            // Redirect to the desired URL when the button is clicked
                            window.location.href = "<?php echo base_url('Admin'); ?>";
                            }
                        </script>
                    </div>
                    <div class="col-sm-2">
                        
                    </div>
                </div>
            </div>
            </form>
            <?php } ?>
                </div>
            </div> 
            <div class="col-sm-1" style="background-color: #fff; border-top-right-radius: 20px;border-bottom-right-radius: 20px;">
                
                

                <img src="<?php echo base_url('assets/img/1Tribal.png'); ?>" style="height: 650px;margin-left: 19px;border-top-right-radius: 20px;border-bottom-right-radius: 20px;" class="mobile-down">
            </div>
         

        </div>
    </div>
</div>

<script>
// const picker = MCDatepicker.create({
//     el: '#birth_date'
// });
$(document).ready(function() {
  $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

$(document).ready(function() {
    $('#Register').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Registration/addUser')?>",
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
                    alert('Registered Successfully!')
                    // location.href="<?=base_url('Registration/Profile/')?>"+json.usr_id+""
                    location.href="<?=base_url('Registration/Onsite')?>"
                }

                if (json.same_value == true) {
                    alert('No changes has been made.')
                }
                
            }
        });
    });
});

$('#sectors').on('change', function(){
    if( this.value === "others"){
        $('#other_sector').css('display','block');
        $('#other_sector input').prop('required', true)
    }else{
        $('#other_sector').css('display','none');
        $('#other_sector input').prop('required', false)
    }
})

</script>