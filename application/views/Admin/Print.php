<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script src="<?php echo base_url('assets/dist/js/jquery.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"></script>      
<style>
	 @media screen and (min-width: 1200px) {
    .container{
      max-width: 1400px !important;
    }
  }
  .orangeTxt{
    color: #e8642b;
  }
</style>
<div class="container">
    <div class="row py-4">
        <div class="col-lg">
        <div class="card card-shadow">
            <div class="card-header">
                <h5 class="card-title pendingTxt">
                    <!-- PENDING Participants -->
                    <?=$event->event_name?><br>
                    <small>Status: <span class="orangeTxt"><?=$displayStatus?></span></small>
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
				  <thead>
				    <tr>
				    	<th>#</th>
				       	<th>Name</th>
                    	<th>Gender</th>
                    	<th>Cluster</th>
                    	<th>Role</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$num = 0;
				  	foreach ($EventParticipants as $var) { 
				  	$num++;	
				  	?>
				    <tr>
				      <th scope="row"><?=$num?></th>
				      <?php if($var['usr_suffix']!='') { $suffix = $var['usr_suffix']; } else { $suffix = ''; } ?>
				      <td><?=$var['usr_lname']?> <?=$suffix; ?> <?=$var['usr_fname']; ?> <?=$var['usr_mname']; ?></td>
				      <td><?=$var['usr_gender']?></td>
				      <td><?=$var['usr_cluster']?></td>
				      <td><?=$var['role_name']?></td>
				    </tr>
				   	<?php } ?>
				  </tbody>
				</table>
            </div>
        </div>
    </div>
	</div>
</div>

<script>
	window.print();
</script>