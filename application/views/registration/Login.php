<style>
    
        #content {
            /* Fpr the background */
            background: url(<?php echo base_url("assets/img/bgbg.jpg"); ?>);
            height: 1000px;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: cover;
            margin: 0;
            padding:  0;
            padding-top: 3%;
            padding-bottom: 7%;  
        }

        img.show_img, img.banner_bot{
            display: none;
        }

        @media only screen and (max-width: 600px) {
            img.right {
                display: none;
              }
            #content{
                min-width:660px;
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
           .input_text{
                width: 80%;
                margin-top: 20px;
                margin-left: 30px;
                font-size: 19px;
                color: #1b4485;
           }
           .remember{
                padding-left: 60px;
           }
           .forgot{
                margin: 0px;
                padding-top: 0px;
                padding-left: 60px;
           }
           .button{
                padding-right: 100px;
                padding-left: 50px;
                margin-top: 20px;
                color: #1b4485;
           }
           .img_bot{
                margin-top: 20px;
           }
           .text_mobile{
                font-size: 18px !important;
           }
           img.banner_bot{
                display: inline;
           }
           h4{
                font-size: 37px !important;
           }
           h6{
                font-size: 25px !important;
           }

        }

        @media only screen   
            and (min-width : 768px)   
            and (max-width : 1024px)  
            { 
                .img_bot{
                    margin-top: 0px !important;
                }
            } 

        .Left {     
            max-height: 650px;
            background-color: #fff;
            padding-left:50px; 
            margin-left: 0px;
            margin-right: 0px;
            border-bottom-right-radius: 20px;
            border-top-right-radius: 20px;
            color: #1b4485;
        }
        #register{
            margin: 0;
            padding:  0;
            width:800px;
        }
</style>


<div id="content">
    <div class="container" style="box-shadow: 0 3px 6px #1b4485; border-radius: 20px;">
        <div class="row">
            <div class="col-sm-5" style="padding: 0px;">
            <!-- Mao ni ang picture para sa 16th pnhrs -->
                <img src="<?php echo base_url('assets/img/WebsiteFront.jpg'); ?>" style="max-height: 650px;border-top-left-radius: 20px;border-bottom-left-radius: 20px;" class="right">
            </div>
            <div class="col-sm-7 Left">
                <div class="row">
                    <div class="col-sm-12" style="background-color: #fff; border-top-right-radius: 20px; ">
                    <!-- Tribal Design -->
                        <img src="<?php echo base_url('assets/img/mTribal.png'); ?>" style="overflow: hidden ;height: 65px;margin-left: -50px;border-top-right-radius: 20px;">
                    </div>
                    <div class="col-sm-12 info">
                        <br>
                        <h4> 
                        <b>2023 REGIONAL <span style="color:#ffbf00">SCIENCE</span>, <span style="color:#00ced1">TECHNOLOGY</span> AND <span style="color:#00cc99">INNOVATION</span>  WEEK CELEBRATION

                        </b></h4>
                        <h6 style="color:#1b4485;">DOST CARAGA</h6>
                        <hr>
                        <p class="text_mobile" style="font-size:13px;text-align: justify;margin-right: 50px; color: #1b4485;">The Caraga RSTW is an annual celebration that aims to highlight the significant contributions of science, technology, and innovation to the region’s continuous development; showcase the latest technologies and R&D outputs of local researchers and innovators; and recognize the efforts and initiatives of the department’s STI stakeholders.</p>
                        <p style="font-size:13px;text-align: justify;margin-right: 50px; color: #1b4485;">For more details, please login using your email.</p>
                    
                    </div>
                    <form id="Login"> 
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-7">
                                <!-- <h4 style="color:#1b4485;">Sign In</h4> -->
                                <hr>
                                <input type="email" class="form-control input_text" name="usr_email" placeholder="Email Address" required style="text-transform: none;">
                            </div>
                        </div>
                    </div>
                   <!--  <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-7 email_pass">
                                <input type="password" class="form-control input_text " name="usr_email" placeholder="Password" required style="text-transform: none;">
                                
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-12">
                        <div class="row">
                            <br>
                           <!--  <div class="col-sm-3"></div>
                            <div class="col-sm-3 remember">
                                <br>
                                <label class="form-check-label" for="gridCheck" >
                                    <input class="form-check-input" type="checkbox" required id="gridCheck">Remember Me
                                </label>
                            </div>
                            <div class="col-sm-6 forgot"> 
                                <br>
                                <p style="font-size:15px;margin-right: 50px; color: #1b4485;">Forgot Password?</p>  
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-7 button">
                                <input type="submit" name="signup" class="btn btn-block btn-orange" value="Submit">
                                <center>
                                    <!-- <p style="font-size:15px; color: #1b4485;">New Here?</p>  -->No Account Yet?
                                    <a href="<?php echo base_url(''); ?>" class="btn btn-sm" style="margin-top:0px;color: #fa920f;font-weight: bolder;"> Register</a>
                                </center>
                                
                            </div>
                            <div class="col-sm-2">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 img_bot" style="background-color: #fff; border-bottom-right-radius: 20px;margin-top: 85px; padding-right:0px;">
                    <!-- Tribal Design -->
                        <img src="<?php echo base_url('assets/img/oTribal.png'); ?>" style="height: 65px; margin-left: -51px; margin-top: 1px; border-bottom-right-radius: 20px;">
                        <!-- <img src="<?php echo base_url('assets/img/Website Picture 4.jpg'); ?>" style="height: 155px;margin-left: -50px; border-bottom-right-radius: 20px;" class="banner_bot"> -->
                    </div>
                    </form>
                </div>
            </div> 
            <!-- <div class="col-sm-1" style="background-color: #fff; border-top-right-radius: 20px;border-bottom-right-radius: 20px;">
                <img src="<?php echo base_url('assets/img/Tribal.png'); ?>" style="height: 650px;margin-left: 19px;border-top-right-radius: 20px;border-bottom-right-radius: 20px;">
            </div> -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#Login').on('submit', function(event) {
            event.preventDefault();
            var form = $(this).serialize();
            $.ajax({  
                url: "<?=base_url('Registration/Login')?>",
                type: "POST",  
                data: form,
                success: function(data){  
                    var json = $.parseJSON(data)
                    
                    if (json.invalid == true) {
                        alert('Email address does not exist.')
                    }
                    
                    if (json.success == true) {
                        location.href="<?=base_url('Registration/Profile/')?>"+json.usr_id+""
                    }
                    // $('#UpdateInfo')[0].reset()
                }
            });
        });
    });

</script>