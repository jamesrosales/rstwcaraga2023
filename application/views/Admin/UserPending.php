
<div class="container">
    <div class="row py-0">
        <div class="col-lg">
        <div class="card card-shadow">
            <div class="card-header">
                <h5 class="card-title pendingTxt" style="color:#003366";>
                    Pending Registrants
                </h5>
            </div>
            <div class="card-body">
                <div id="PendingParticipants"></div>    
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header heading">
        <h5 class="modal-title" id="exampleModalLabel">Participant Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div class="container">
                <form id="ApprovedForm">
                <?php $this->load->view('Templates/admin/updateParticipantsForm'); ?>
                </form>
            </div>
        </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary newPrimary" id="ApprovedSubmit" onclick="ApproveParticipant()">Approve</button>
        <button class="btn btn-primary newPrimary" id="ApproveEventLoad">Processing <span class="fa fa-cog fa-spin"></span></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditParticipantForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header heading">
        <h5 class="modal-title" id="exampleModalLabel">Participant Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <form id="EditParticipant">
        <div class="modal-body">
            <div class="container">
               
                <?php $this->load->view('Templates/admin/updateParticipantsForm'); ?>
                
            </div>
        </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary newPrimary">Save Changes</button>
      </div>
      </form>
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

    // ApprovedForm
    // $("#ApprovedForm :input").prop("disabled", true);
});
    $('#ApproveEventLoad').hide()
    function ApproveParticipant(){
        usr_id = $('.usr_id_update').val()
        event_approved_id = $('.event_approved_id').val()

        $.ajax({  
            url: "<?=base_url('Admin/ApproveParticipant')?>",
            type: "POST",  
            data: {usr_id: usr_id, event_approved_id: event_approved_id},
            beforeSend: function(){
                $('#ApproveEventLoad').show()
                $('#ApprovedSubmit').hide()
            }, 
            success: function(data){  
                // var json = $.parseJSON(data)
                // var res = ''
                $('#participant'+usr_id).remove()
                $('#approveModal').modal('hide')
                alert('Approved Successfully')
                $('#ApproveEventLoad').hide()
                $('#ApprovedSubmit').show()
            }
        });
    }

    function ApproveForm(usr_id){
 
        $.ajax({  
            url: "<?=base_url('Admin/getParticipantData')?>",
            type: "POST",  
            data: {usr_id, usr_id},
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''

                $('.usr_id_update').val(json.usr_id)
                $('.usr_lname').val(json.usr_lname)
                $('.usr_fname').val(json.usr_fname)
                $('.usr_mname').val(json.usr_mname)
                $('.usr_suffix').val(json.usr_suffix)
                $('.birth_date').val(json.birth_date)
                $('.usr_gender').val(json.usr_gender)
                $('.usr_contact').val(json.usr_contact)
                $('.usr_occupation').val(json.usr_occupation)
                $('.usr_institution').val(json.usr_institution)
                $('.usr_email').val(json.usr_email)
                $('.usr_municipality').val(json.usr_municipality)
                $('.usr_sector').val(json.usr_sector)
                $('.usr_role').val(json.usr_role)
                $('.usr_cluster').val(json.usr_cluster)

                value = json.event_id.split(",")
               
                $('.event_name').val(value).trigger('change');
                $('.event_approved_id').val(value).trigger('change');

                $('#approveModal').modal()
                
               
            }
        });

    }

     function EditParticipantForm(usr_id){
        $.ajax({  
            url: "<?=base_url('Admin/getParticipantData')?>",
            type: "POST",  
            data: {usr_id, usr_id},
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''

                $('.usr_id_update').val(json.usr_id)
                $('.usr_lname').val(json.usr_lname)
                $('.usr_fname').val(json.usr_fname)
                $('.usr_mname').val(json.usr_mname)
                $('.usr_suffix').val(json.usr_suffix)
                $('.birth_date').val(json.birth_date)
                $('.usr_gender').val(json.usr_gender)
                $('.usr_contact').val(json.usr_contact)
                $('.usr_occupation').val(json.usr_occupation)
                $('.usr_institution').val(json.usr_institution)
                $('.usr_email').val(json.usr_email)
                $('.usr_municipality').val(json.usr_municipality)
                $('.usr_sector').val(json.usr_sector)
                $('.usr_role').val(json.usr_role)
                $('.usr_cluster').val(json.usr_cluster)
                console.log(json.usr_cluster)
                value = json.event_id.split(",")
               
                $('.event_name').val(value).trigger('change');
                $('.event_approved_id').val(value).trigger('change');

                $('#EditParticipantForm').modal()
               
            }
        });

    }

    PendingParticipants()
    function PendingParticipants(){
        $.ajax({  
            url: "<?=base_url('Admin/PendingParticipants')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''

                res +='<table class="table table-hover " id="TBL">'
                res +='<thead class="table-blue">'
                    res +='<tr class="heading">'
                        res +='<th>Name</th>'
                        res +='<th>Age</th>'
                        res +='<th>Mobile #</th>'
                        res +='<th>Email</th>'
                        res +='<th>Position</th>'
                        res +='<th>Cluster</th>'
                        res +='<th>Role</th>'
                        res +='<th> </th>'
                        res +='<th>Event</th>'
                        res +='<th class="text-center">Action</th>'
                    res +='</tr>'
                res +='</thead>'
                res +='<tbody style="font-size:13px;">'
                for (var i = 0; i < json.length; i++) {
                    res +='<tr id="participant'+json[i].usr_id+'">'
                        var dob = new Date(json[i].birth_date);
                        var month_diff = Date.now() - dob.getTime();
                        var age_dt = new Date(month_diff); 
                        var year = age_dt.getUTCFullYear();
                        var age = Math.abs(year - 1970);

                        if(json[i].usr_suffix!='') { suffix = json[i].usr_suffix; } else { suffix = ''; }
                        res +='<td class="highlight">'+json[i].usr_lname+', '+suffix+' '+json[i].usr_fname+' '+json[i].usr_mname+'.</td>'
                        res +='<td >'+age+'</td>'
                        res +='<td>'+json[i].usr_contact+'</td>'
                        res +='<td>'+json[i].usr_email+'</td>'
                        res +='<td>'+json[i].usr_occupation+'</td>'
                        res +='<td>'+json[i].usr_cluster+'</td>'
                        res +='<td>'+json[i].role_name+'</td>'
                        if(json[i].move_to_pending_status == 1) { MTP = 'MTP' } else { MTP = ''; }
                        res +='<td tyle="text-align:center;">'+MTP+'</td>'
                        res +='<td style="font-size:10px;">'+json[i].event_name+'</td>'
                        res +='<td style="text-align:center;"  width="15%" class="cursor">'
                            res +='<button  class="btn btn-sm btn-warning newWarning" onclick="ApproveForm('+json[i].usr_id+')">Approve</button>&nbsp;'
                            // res +='<i class="fa-solid fa-eye"></i>&nbsp;'
                            res +='<button class="btn btn-sm btn-primary newPrimary" onclick="EditParticipantForm('+json[i].usr_id+')">Update</i>'
                        res +='</td>'
                    res +='</tr>'


                }
                res +='</tbody>'
                res +='</table>'
                $('#PendingParticipants').html(res)
                $('#TBL').DataTable({
                    "ordering": false
                });
            }
        });
    }

    $(document).ready(function() {
        $('#EditParticipant').on('submit', function(event) {
            event.preventDefault();
            var form = $(this).serialize();
            $.ajax({  
                url: "<?=base_url('Admin/UpdateInfoParticipant')?>",
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
                        PendingParticipants()
                        alert('Saved Successfully!')
                    }

                    if (json.same_value == true) {
                        alert('No changes has been made.')
                    }

                    
                    // $('#UpdateInfo')[0].reset()
                }
            });
        });
    });


</script>