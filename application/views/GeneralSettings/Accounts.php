<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caraga RSTW 2023</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url('assets/Images/logo.png');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>" >
    <style>
        /*http://localhost/rstw2022/assets/Images/bg_blue.jpg*/
        #content {
            background: url(<?php echo base_url("assets/Images/bg_blue.jpg"); ?>);
            /*background-size: 100% auto;*/
            /*background-position: center; background-attachment: fixed; */
            /*max-height:100%;*/
            height: 2000px;
/*            height: 100%;*/
            background-position: center center;

              background-repeat: no-repeat;

              background-attachment: fixed;
              
              background-size: cover;

        }
    </style>
</head>

<div id="content">
  <div class="container "><br><br><br>
    <section class="content">
      <div class="row">
          <div class="col-md-12">
              <div class="card bg-dark_custom card-outline one-edge-shadow borderColor_">
                  <div class="card-header">
                      <p class="card-title">User Accounts</p>
                      <!-- <a onclick="AddGroupModal()"><i class="fas fas fa-plus text-md text-info cursor float-right">&nbsp;</i></a> -->
                  </div>
                  <div class="card-body p-0">
                  <div class="card-body">
                      <div id="accounts" class="table-responsive"></div>
                  </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  </div>
</div>
<script>

Accounts()
function Accounts(){
  $.ajax({  
      url: "<?=base_url('Settings/AccountsRecords')?>",
      type: "POST",  
      success: function(data){  
        var json = $.parseJSON(data)
        // console.log(json)
        var res = ''
        res +='<table class="table table-striped" id="accounts_Tbl">'
          res +='<thead>'
            res +='<tr>'
              res +='<th scope="col" style="font-size:13px;">Name</th>'
              res +='<th scope="col" style="font-size:13px;">Birth Date</th>'
              res +='<th scope="col" style="font-size:13px;">Gender</th>'
              res +='<th scope="col" style="font-size:13px;">Municipality</th>'
              res +='<th scope="col" style="font-size:13px;">Occupation</th>'
              res +='<th scope="col" style="font-size:13px;">Insititution</th>'
              res +='<th scope="col" style="font-size:13px;">Email Address</th>'
              res +='<th scope="col" style="font-size:13px;">Contact</th>'
              res +='<th scope="col" style="font-size:13px;">Sector</th>'
              res +='<th scope="col" style="font-size:13px;">Status</th>'
            res +='</tr>'
          res +='</thead>'

          res +='<tbody>'
          for (var i = 0; i < json.length; i++) {
            res +='<tr>'
              res +='<td style="font-size:13px;">'+json[i].usr_lname+', '+json[i].usr_fname+' '+json[i].usr_mname+'</td>'
              res +='<td style="font-size:13px;">'+json[i].birth_date+'</td>'
              res +='<td style="font-size:13px;">'+json[i].usr_gender+'</td>'
              res +='<td style="font-size:13px;">'+json[i].usr_municipality+'</td>'
              res +='<td style="font-size:13px;">'+json[i].usr_occupation+'</td>'
              res +='<td style="font-size:13px;">'+json[i].usr_institution+'</td>'
              
              res +='<td style="font-size:13px;">'+json[i].usr_email+'</td>'
              res +='<td style="font-size:13px;">'+json[i].usr_contact+'</td>'
              res +='<td style="font-size:13px;">'
              if (json[i].usr_sector != 'others') {
                res +=json[i].usr_sector
              }else{
                res +=json[i].usr_sector_other
              }
              res +=''
              res +='</td>'
              res +='<td style="font-size:13px;">'
              if (json[i].participation_status == 1) {
                res +='Physically Attending'
              }else if (json[i].participation_status == 0){
                res +='Virtually Attending'
              }else{
                res +='TBD'
              }
              res +=''
              res +='</td>'
            res +='</tr>'
          }
          res +='</tbody>'
          res +='</table>'
          $('#accounts').html(res)
          $('#accounts_Tbl').DataTable( {
                "ordering": false
            })
      }
  });
}

</script>
