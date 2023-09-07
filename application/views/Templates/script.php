<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Caraga RSTW 2023</title>
          
      <link rel="icon" type="image/ico" href="<?php echo base_url('assets/img/logo.png');?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
         <link hreg="<?=base_url('assets/dist/plugins/fontawesome/css/all.css')?>">
      <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>">
      <link rel="stylesheet" href="<?=base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">

      <script src="<?php echo base_url('assets/dist/js/jquery.js') ?>"></script>
      <script src="<?=base_url('assets/dist/js/jquery.qrcode.min.js')?>"></script>
      <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"></script>
      <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
      <script src="<?=base_url('assets/plugins/fontawesome/js/all.js')?>"></script>
      <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datepicker/mc-calendar.min.css">
      <script src="<?php echo base_url();?>assets/plugins/datepicker/mc-calendar.min.js"></script>
</head>
  
    <style>
        /*http://localhost/rstw2022/assets/img/bg_blue.jpg*/
       /* #content {
            background: url(<?php echo base_url("assets/img/Website4.jpg"); ?>);
          
            height: 1000px;
            background-position: center center;

              background-repeat: no-repeat;

              background-attachment: fixed;
              
              background-size: cover;
        }*/

       *{
      margin: 0;
      padding:  0;
}
.navbar-style{
      box-shadow: 0 5px 10px #efefef;
}
.logo{
      height: 50px;
      padding: 2px 10px;

}
.registration{
      background-color: #3795e4;
      padding: 50px 0 50px;
}

.warning{
      color: #fa0000;
}

.dost_logo{
      height: 40px;
      padding: 2px 10px;
}

.webinar_logo{
    height: 19px;
    padding: 1px 3px;
    margin-bottom: 2px;
}


.b_content{
      position:  relative;
    background: url('<?php echo base_url("assets/Images/back_ground.jpg"); ?>');
      min-height: 100vh;
      background-size: cover;
      background-position: center;
}

.banner_2{
    position:  relative;
    /*background: url('<?php echo base_url("assets/Images/back_final.jpg"); ?>');*/
    min-height: 93vh;
    background-size: cover;
    background-position: center;
    padding:  80px 0 0px;
}
.mapa{
    max-width: 100%;
    width: 500px;
    background-image: url(<?php echo base_url("assets/Images/mapaa.png"); ?>);
    background-repeat: no-repeat;
    min-height: 10vh;
}
.video_rd{
    width:1000px;
}
.b_content{
    position: relative;
    min-height: 100vh;
    background-size: cover;
    background-position: center;
    padding-top: 100px;
}

#YesSignOut{
    background-color: #e05260;
    color: #ffffff;
}
#YesSignOut:hover{
    background-color: #dc3545;
    color: #ffffff;
}
svg{
    margin-top: 10px;
}
#PH-BIL{
    fill: #009ada;
    stroke-width: 0.15;

}
#PH-BIL:hover{
    fill: #3f81f3;
    stroke: #009ada;
    stroke-width: 0.50;
}   

#PH-LEY{
    fill: #ffffff;
    stroke-width: 0.15;
}

#PH-LEY:hover{
    fill: #e6e1e1;
    stroke: #ffffff;
    stroke-width: 0.70;
}
#PH-SLE{
    fill: #009ada;
    stroke-width: 0.15;

}
#PH-SLE:hover{
    fill: #3f81f3;
    stroke: #009ada;
    stroke-width: 0.50;
}
#PH-NSA{
    fill: #9ed5ef;
    stroke-width: 0.15;

}
#PH-NSA:hover{
    fill: #89aab9;
    stroke: #9ed5ef;
    stroke-width: 0.35;
}
#PH-WSA{
    fill: #009ada;
    stroke-width: 0.15;

}
#PH-WSA:hover{
    fill: #3f81f3;
    stroke: #009ada;
    stroke-width: 0.35;
}
#PH-EAS{
    fill: #ffffff;
    stroke-width: 0.15;

}
#PH-EAS:hover{
    fill: #e6e1e1;
    stroke: #ffffff;
    stroke-width: 0.35;
}


#PH-REG{
    fill: #009ada;
    stroke-width: 0.15;

}
#PH-REG:hover{
    fill: #3f81f3;
    stroke: #009ada;
    stroke-width: 0.50;
}

.input_textarea{
    border: 0px;
    border-bottom: 2px solid #e89822;
    border-radius: 2px;
    background-color: #fff;
    font-weight: bolder;
    color: #1b4485;
    width: 100%; 
    min-height: 90%;
}
.input_textarea:hover, .input_textarea:active {
    border: none;
    border-bottom: 2px solid #1b4485;
}

.input_textarea::placeholder{
    color: #1b4485;
    font-weight: normal;
}

.form-control:valid {
/*    text-transform: uppercase;*/
}

.form-control:focus {
      border-color: inherit;
      -webkit-box-shadow: none;
      box-shadow: none;
    }
 .btn-orange{
        color: #fff;
        background-color: #1b4485;
        border-radius: 30px;
    }
    .btn-orange:hover{
        color: #f6ede7;
        background-color: #f9a356;
        border-radius: 30px;
    }
    .btn-blue, .btn-blue-01{
        color: #fff;
        background-color: #f9a356;
        border-top-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
    .btn-blue:hover{
        color: #f6ede7;
        background-color: #1b4485;
        border-top-right-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .btn-blue-01:hover{
        color: #f6ede7;
        background-color: #1b4485;
        border-top-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    #Button_Register, #Button_SignIn{
        color: #f9a356;
    }
    #Button_Register:hover{
        color: #1b4485;
        cursor:pointer;
    }
    #Button_SignIn:hover{
        color: #1b4485;
        cursor:pointer;
    }
    .error{
        color: #992000;
        font-size: 10px;
    }

.input_text{
    border: 0px;
    border-bottom: 2px solid #fa920f;
    border-radius: 2px;
   margin-top: 10px;
    font-weight: bolder;
    color: #1b4485;
    width: 100%; 
    max-height: 90%;
}
.input_text:hover, .input_text:active {
    border: none;
    border-bottom: 2px solid #1b4485;
}

.input_text::placeholder{
    color: #1b4485;
    font-weight: normal;
}

.form-group{
    margin-bottom:5px;
}


    </style>
