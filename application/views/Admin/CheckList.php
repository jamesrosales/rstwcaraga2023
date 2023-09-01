<style>
    .hideme{
         display: none;
    }
</style>
<div class="container">
    <div class="row py-0">
        <div class="col-lg">
        <div class="card card-shadow">
            <div class="card-header">
                    <h5 class="card-title ">
                        <span class="pendingTxt"><?=$event->event_name?></span><br>
                          <small><span style="color: #1b4485;" id="ApprovedParticipants"><b>Approved Participants:</b> <?=$currentNumParticipants?></span> <br><span style="color: #1b4485;"><b>Maximum:</b> <?=$event->maximum?></span></small>
                    </h5>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-hover " id="TBL">
                        <thead class="table-blue">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Cluster</th>
                                <th>Role</th>
                                <th class="text-center">Approved</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $num = 0;
                                foreach ($EventParticipants as $var): 
                                $num++; 
                            ?>
                            <tr>
                                <td><?=$num?></td>
                                <?php if($var['usr_suffix']!='') { $suffix = $var['usr_suffix']; } else { $suffix = ''; } ?>
                                <td><?=$var['usr_lname']?> <?=$suffix; ?> <?=$var['usr_fname']; ?> <?=$var['usr_mname']; ?></td>
                                <td><?=$var['usr_gender']?></td>
                                <td><?=$var['usr_cluster']?></td>
                                <td><?=$var['role_name']?></td>    
                                <?php 
                                    $data_string = $var['event_approved_id'];
                                    $data_string = str_replace(' ', '', $data_string);
                                    $data_array = explode(',', $data_string);
                                 ?>
                                </td>
                                <td class="text-center"><input type="checkbox" 
                                    <?php if (in_array($event->event_id, $data_array)) { ?> checked <?php } ?> 
                                    class="form-check-input" onclick="update('<?php echo $var['usr_id'] ?>')" id="checkboxId<?=$var['usr_id']?>">
                                    <button class="btn btn-sm btn-primary newPrimary hideme" id="confLoad<?=$var['usr_id']?>"> <span class="fa fa-cog fa-spin"></span></button>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function update(usr_id){
       var checkbox = document.querySelector('#checkboxId' + usr_id);
        event_id = '<?=$event->event_id?>'
            if (checkbox.checked) {
                $.ajax({  
                    url: "<?=base_url('Admin/ApprovedBySession')?>",
                    type: "POST",  
                    data: {usr_id:usr_id, event_id:event_id},
                    beforeSend: function(){
                        $('#confLoad'+usr_id).show()
                        $('#checkboxId'+usr_id).hide()
                    },
                    success: function(data){  
                        var json = $.parseJSON(data)
                        
                        if (json.invalid == true) {
                            alert(json.erroM)
                            $( "#checkboxId"+usr_id ).prop( "checked", false );
                        }
                      
                        if (json.success == true) {
                            alert('Approved Successfully!')
                            $('#ApprovedParticipants').html('<b>Approved Participants:</b> '+ json.approvedParticipantsNum)
                        }
                        $('#confLoad'+usr_id).hide()
                        $('#checkboxId'+usr_id).show()
                    }
                });
            } else {
                $.ajax({  
                    url: "<?=base_url('Admin/UncheckedSession')?>",
                    type: "POST",  
                    data: {usr_id:usr_id, event_id:event_id},
                    beforeSend: function(){
                        $('#confLoad'+usr_id).show()
                        $('#checkboxId'+usr_id).hide()
                    },
                    success: function(data){  
                        var json = $.parseJSON(data)
                        
                        if (json.invalid == true) {
                            alert(json.erroM)
                            $( "#checkboxId"+usr_id ).prop( "checked", false );
                        }
                        
                      
                        if (json.success == true) {
                            alert('Disapproved Successfully!')
                            $('#ApprovedParticipants').html('<b>Approved Participants:</b> '+ json.approvedParticipantsNum)
                        }
                        $('#confLoad'+usr_id).hide()
                        $('#checkboxId'+usr_id).show()

                    }
                });
            }
    }

</script>