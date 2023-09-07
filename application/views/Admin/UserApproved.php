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
            <h5 class="card-title approvedTxt" style="color:#003366";>
                    Approved Registrants
                </h5>
            </div>
            <div class="card-body table-responsive">
                <div id="ApprovedParticipants"></div>    
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
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
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditParticipantForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
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
    $("#ApprovedForm :input").prop("disabled", true);
});

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

                event_approved_id = json.event_approved_id.split(",")
                $('.event_approved_id').val(event_approved_id).trigger('change');

                $('#view').modal()
                
               
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

                event_approved_id = json.event_approved_id.split(",")
                $('.event_approved_id').val(event_approved_id).trigger('change');

                $('#EditParticipantForm').modal()
               
            }
        });

    }


    ApprovedParticipants()

    function ApprovedParticipants(){
        $.ajax({  
            url: "<?=base_url('Admin/ApprovedParticipants')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''

                res +='<table class="table table-hover " id="TBL">'
                res +='<thead>'
                    res +='<tr class="heading">'
                        res +='<th >Name</th>'
                        // res +='<th>Age</th>'
                        // res +='<th>Mobile #</th>'
                        // res +='<th>Email</th>'
                        res +='<th>Gender</th>'
                        res +='<th>Cluster</th>'
                        res +='<th>Role</th>'
                        res +='<th>Event</th>'
                        res +='<th>Approved Event</th>'
                        res +='<th>Count</th>'
                        res +='<th class="text-center">Action</th>'
                    res +='</tr>'
                res +='</thead>'
                res +='<tbody style="font-size:13px;">'
                for (var i = 0; i < json.length; i++) {
                    var dob = new Date(json[i].birth_date);
                    var month_diff = Date.now() - dob.getTime();
                    var age_dt = new Date(month_diff); 
                    var year = age_dt.getUTCFullYear();
                    var age = Math.abs(year - 1970);

                    res +='<tr id="participant'+json[i].usr_id+'">'
                        if(json[i].usr_suffix!='') { suffix = json[i].usr_suffix; } else { suffix = ''; }
                        res +='<td class="cursor"><a class="highlight" href="<?=base_url('Admin/IDPrintingSoloBlank/?id=')?>'+json[i].usr_id+'">'+json[i].usr_lname+', '+suffix+' '+json[i].usr_fname+' '+json[i].usr_mname+'.</td>'
                        // res +='<td ">'+age+'</td>'
                        // res +='<td ">'+json[i].usr_contact+'</td>'
                        // res +='<td ">'+json[i].usr_email+'</td>'
                        res +='<td ">'+json[i].usr_gender+'</td>'
                        res +='<td ">'+json[i].usr_cluster+'</td>'
                        res +='<td ">'+json[i].role_name+'</td>'
                        res +='<td style="font-size:10px;">'+json[i].event_name+'</td>'
                        res +='<td style="font-size:10px;">'+json[i].event_approved_name+'</td>'
                        res +='<td style="text-align:center;"><span id="number_of_email'+json[i].usr_id+'">'+json[i].number_of_email+'</span></td>'
                        res +='<td style="text-align:center;"  width="15%" class="cursor">'
                            res +='<button class="btn btn-sm btn-warning newWarning" onclick="ApproveForm('+json[i].usr_id+')">View</button>&nbsp;'
                            res +='<button class="btn btn-sm btn-primary newPrimary newPrimary" onclick="EditParticipantForm('+json[i].usr_id+')">Update</button><br>'
                            res +='<button class="btn btn-sm btn-primary newPrimary newPrimary" id="confsubmit'+json[i].usr_id+'" onclick="ConfirmationEmail('+json[i].usr_id+',1)">Confirmation</button>'
                            res +='<button class="btn btn-sm btn-primary newPrimary hideme" id="confLoad'+json[i].usr_id+'"> <span class="fa fa-cog fa-spin"></span></button>'
                            res +='<button class="btn btn-sm btn-primary newPrimary newPrimary" id="confsubmit2'+json[i].usr_id+'" onclick="ConfirmationEmail('+json[i].usr_id+',2)">Re-Confirmation</button>'
                        res +='</td>'
                    res +='</tr>'


                }
                res +='</tbody>'
                res +='</table>'
                $('#ApprovedParticipants').html(res)
                $('#TBL').DataTable({
                    "ordering": false
                });
                $('.hideme').hide()
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
                        ApprovedParticipants()
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

    function ConfirmationEmail(usr_id,email_status){
        $('#confLoad'+usr_id).show()
        let text = "";
        if (email_status == 1) {
            $('#confsubmit'+usr_id).hide()
             text = "Send email notification?";
        }else{
            $('#confsubmit2'+usr_id).hide()
             text = "Send re-confimation email notification?";
        }

        if (confirm(text) == true) {
            if(confirm){
                $.ajax({  
                    url: "<?=base_url('Admin/ConfirmationEmail')?>",
                    type: "POST",  
                    data: {usr_id: usr_id, email_status: email_status},
                    success: function(data){  
                        var json = $.parseJSON(data)
                        var res = ''
                        // $('#number_of_email'+json.usr_id).remove()

                        if (json.success == true) {
                            alert('Success!')
                            $('#number_of_email'+json.usr_id).html(json.number_of_email)
                        }
                        if (json.error == true) {
                            alert(json.error_messages)
                        }
                        $('#confLoad'+usr_id).hide()
                        if (email_status == 1) {
                            $('#confsubmit'+usr_id).show()
                        }else{
                            $('#confsubmit2'+usr_id).show()
                        }
                    }
                });
            }
        } else {
            $('#confLoad'+usr_id).hide()
            if (email_status == 1) {
                $('#confsubmit'+usr_id).show()
            }else{
                $('#confsubmit2'+usr_id).show()
            }    
        }
        
    }
</script>