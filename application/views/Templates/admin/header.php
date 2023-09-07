<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>RSTW 2023</title>
          
      <link rel="icon" type="image/ico" href="<?php echo base_url('assets/img/logo.png');?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
         <link hreg="<?=base_url('assets/dist/plugins/fontawesome/css/all.css')?>">
      <link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>">
      <link hreg="<?=base_url('assets/dist/plugins/chart/Chart.css')?>">
      <link href="<?=base_url('assets/plugins/datatable/media/css/jquery.dataTables.css')?>" rel="stylesheet">
      <link rel="stylesheet" href="<?=base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">

      <script src="<?php echo base_url('assets/dist/js/jquery.js') ?>"></script>
      <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"></script>
      <script src="<?php echo base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
      <script src="<?=base_url('assets/plugins/fontawesome/js/all.js')?>"></script>
      <script src="<?=base_url('assets/plugins/chart/Chart.js')?>" ></script>
      <script src="<?=base_url('assets/plugins/datatable/media/js/jquery.dataTables.js')?>"></script>
      <script src="<?php echo base_url();?>assets/plugins/moment/moment.min.js"></script>
        
</head>
<style>
  .navbar{

background: linear-gradient(108.5deg, #002e63, #318ce7 68%);
/*background: linear-gradient(108.5deg, #e74536d1, #ffb511d1 68%);*/

  }
  .nav-link{
    font-size: 24px !important;
    color: white !important;
/*    color: #354093 !important;*/
/* color: #e8642b !important;*/
  }
  .nav-link .active{
    font-size: 24px !important;
    color: #e8642b !important;
  }

  .cursor{
    cursor: pointer;
  }
  @media screen and (min-width: 1200px) {
    .container{
      max-width: 1400px !important;
    }
  }
 .input_textarea{
      margin-top: 2px;
      font-size: 19px;    
      border-bottom: 2px solid #3ddaf4 ;
 }
 .select2{
      font-size: 19px;    
      border-bottom: 2px solid #3ddaf4 ;
 }

 .select2-container--default .select2-selection--multiple .select2-selection__choice{
      font-size: 10px;
  }
   .select2-container--default.select2-container--focus .select2-selection--multiple{
      border: 0px !important;
      border-bottom: 2px solid #3ddaf4 !important;
  }
   .select2-container .select2-selection--multiple{
      border: 0px !important;
      border-bottom: 2px solid #3ddaf4 !important;
  }
  .pendingTxt{
    color: #e8642b;
  }
  .orangeTxt{
    color: #e8642b;
  }
  .card-shadow{
     box-shadow: 0 2px 2px #8d4b0b;
  }
  .breadcrumb{
    background-color: #fff !important;
/*    float:right;*/
  }
  .newPrimary{
    background-color: #1b4485 !important;
  }
  .newWarning{
    background-color: #ef961b !important;
    color: #fff;
  }

  .highlight{
    color: #1b4485;
    font-weight: 500;
  }

 .align-center{
    text-align: center;
 }
 .heading{
    background-color: #1b4485;
    color: #ffffff;
 }
 .white{
  color: #ffffff;
 }

 .notification {
 /* background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;*/
  position: relative;
  display: inline-block;
/*  border-radius: 2px;*/
}

.notification .badge-icon {
  position: absolute;
  top: -10px;
  right: 20px;
  padding: 3px 4px;
  border-radius: 20%;
  background: #e75414;
    color: white;
}
</style>

<?php 
  $count = $this->Admin_model->PendingParticipantsCount();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 0.5px solid grey;">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="<?=base_url('assets/img/dashboardpnhrslogo1.png')?>" height="60px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
      </ul>
      <ul class="navbar-nav mr-auto" >
                <li class="nav-item active">
          <a class="nav-link" href="<?=base_url('Admin')?>"> DASHBOARD &nbsp;&nbsp;&nbsp;&nbsp; <span class="sr-only">(current)</span></a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link notification" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           PARTICIPANTS
           <?php if($count != 0){ ?>
           <small><span class="badge badge-sm badge-light badge-icon" style="top: 0px; font-size: 12px;"><?=$count?></span></small>
           <?php } ?>
           &nbsp;&nbsp;&nbsp;&nbsp;
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?=base_url('Admin/UserPending')?>">Pending</a>
            <a class="dropdown-item" href="<?=base_url('Admin/UserApproved')?>">Approved</a>
            <a class="dropdown-item" href="<?=base_url('Admin/UserOnsite')?>">Onsite</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item"><b>Printing IDs</b></a>
            <div class="dropdown-divider"></div>  
            <a class="dropdown-item" href="<?=base_url('Admin/IDPrinting/?cluster=Luzon')?>">Luzon</a>
            <a class="dropdown-item" href="<?=base_url('Admin/IDPrinting/?cluster=Visayas')?>">Visayas</a>
            <a class="dropdown-item" href="<?=base_url('Admin/IDPrinting/?cluster=Mindanao')?>">Mindanao</a>
          </div>
        </li>
         <li class="nav-item ">
          <a class="nav-link " href="<?=base_url('Admin/Events')?>">ADD EVENTS</a>
        </li> 
        <li class="nav-item ">
          <a class="nav-link " href="<?=base_url('Dashboard/')?>">ATTENDANCE</a>
        </li> 
            </ul>
        <ul class="navbar-nav " >
            <li class="nav-item ">
          <a class="navbar-brand" href="#"><img src="<?=base_url('assets/img/pnhrslogoright1.png')?>" height="60px;" ></a>
          </li>
        </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
<nav aria-label="breadcrumb" class="">
  
  <ol class="breadcrumb" >
    <div class="container" >
   <!--     <li class="breadcrumb-item active" aria-current="page">HOME</li>
       <li class="breadcrumb-item active" aria-current="page">Administrator</li> -->
      <div  style="float:right;">
        <li class="breadcrumb-item active"  aria-current="page">Administrator</li>
        <li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url('Admin/AdminLogout')?>" style="color:black;"> Logout</a></li>
      </div>    
    </div>
  </ol>
  
</nav>