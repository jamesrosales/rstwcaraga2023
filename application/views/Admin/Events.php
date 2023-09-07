
<div class="container">
    <div class="row py-0">
        <div class="col-lg">
        <div class="card card-shadow">
            <div class="card-header">
                    <h5 class="card-title pendingTxt">
                        Events/Sessions 
                        <button style="float: right;" class="btn btn-primary newPrimary" onclick="AddEvent()">Add Event</button> 
                    </h5>
            </div>
            <div class="card-body ">
                    <div id="EventRecords"></div>    
            </div>
        </div>
    </div>
</div>

<div class="modal" id="EditModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header heading">
                <h4 class="modal-title">Info</h4>
                <button type="button" class="close white" data-dismiss="modal">&times;</button>
            </div>
            <form id="EditEvent">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group">      
                            <label>Event Name</label>
                            <input type="hidden" name="event_id" id="edit_event_id">
                            <input type="text" name="event_name" id="edit_event_name" class="form-control">
                        </div><br>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="group">      
                            <label>Date</label>
                            <input type="date" name="event_date" id="edit_event_date" class="form-control">
                        </div><br>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="group">      
                            <label>Maximum</label>
                            <input type="number" name="maximum" id="edit_maximum" class="form-control">
                        </div><br>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger danger_new_color one-edge-shadow ButtonBorderColor" data-dismiss="modal"><span class="fas fa-times font-size14"></span>&nbsp;Cancel</button>
                <button type="submit" class="btn btn-primary newPrimary one-edge-shadow ButtonBorderColor" id="EditEventSubmit"><span class="fas fa-edit font-size14"></span>&nbsp;Save changes</button>
                <button class="btn btn-primary newPrimary" id="EditEventLoad">Processing <span class="fa fa-cog fa-spin"></span></button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="ADDModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header heading">
                <h4 class="modal-title">Info</h4>
                <button type="button" class="close white" data-dismiss="modal">&times;</button>
            </div>
            <form id="AddEvent">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group">      
                            <label>Event Name</label>
                            <input type="text" name="event_name" class="form-control">
                        </div><br>
                    </div>
                    <div class="col-md-6">
                        <div class="group">      
                            <label>Date</label>
                            <input type="date" name="event_date" id="edit_event_date" class="form-control">
                        </div><br>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="group">      
                            <label>Maximum</label>
                            <input type="number" name="maximum" id="edit_maximum" class="form-control">
                        </div><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger danger_new_color one-edge-shadow ButtonBorderColor" data-dismiss="modal"><span class="fas fa-times font-size14"></span>&nbsp;Cancel</button>
                <button type="submit" class="btn btn-primary newPrimary one-edge-shadow ButtonBorderColor" id="AddUserSubmit"><span class="fas fa-edit font-size14"></span>&nbsp;Save changes</button>
                <button class="btn btn-info" id="AddUserLoad">Processing <span class="fa fa-cog fa-spin"></span></button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
function AddEvent(){
    $('#ADDModal').modal()
}

 $('#AddUserLoad').hide()
$(document).ready(function() {
    $('#AddEvent').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Dashboard/AddEvent')?>",
            type: "POST",  
            data: form,
            beforeSend: function(){
                $('#AddUserLoad').show()
                $('#AddUserSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)
               
                $('#AddUserLoad').hide()
                $('#AddUserSubmit').show()

                if(json.success == true){
                    $('#AddEvent')[0].reset()
                    $('#EditModal').modal('hide')
                    EventList()
                    alert('Successfully Added')
                }

                if (json.duplicate == true) {
                    alert('empNumber already exist')
                }
            }
        });
        
    });
});


EventList()
function EventList(){
    url = "<?=base_url()?>"
    $.ajax({
      url:  "<?=base_url('Dashboard/EventList')?>",
      type: "POST",
      success: function(data)
      {
        var json = $.parseJSON(data)
        var res = ''
        var num = 0;
        res +='<table class="table table-hover" id="EventsTBL">'
            res +='<thead>'
            res +='<tr class="heading">'
                res +='<th>No.</th>'
                res +='<th>Event Name</th>'
                res +='<th>Date</th>'
                res +='<th>Maximum</th>'
                res +='<th>Action</th>'
            res +='</tr>'
            res +='</thead>'
            res +='<tbody>'
            for (var i = 0; i < json.length; i++) {
            num++
            res +='<tr>'
                res +='<td>'+num+'</td>'
                res +='<td class="highlight">'+json[i].event_name+'</td>'
                res +='<td width="10%">'+json[i].event_date+'</td>'
                res +='<td class="align-center">'+json[i].maximum+'</td>'
                res +='<td  width="10%" >'
                    res +='<a class="btn btn-sm btn-warning newWarning" href="'+url+'Dashboard/EventAttendance/'+json[i].event_id+'" style="color:white">View</a>&nbsp;'
                    res +='<a class="btn btn-sm btn-primary newPrimary" onclick="EditEvent('+json[i].event_id+')" style="color:white">Edit</a>&nbsp;'
                     // res +='<a class="btn btn-sm btn-danger" onclick="DeleteEvent('+json[i].event_id+')" style="color:white">Delete</a>'
                res +='</td>'
            res +='</tr>'
            }
            res +='<tbody>'    
        res +='</table>'
        $('#EventRecords').html(res)
         $('#EventsTBL').DataTable({
                "ordering": false
            });
      }
     });
}

function EditEvent(event_id){
    
    $.ajax({
      url:  "<?=base_url('Dashboard/getEventData')?>",
      type: "POST",
      data: {event_id:event_id},
      success: function(data)
      {
        var json = $.parseJSON(data)

        $('#edit_event_name').val(json.event_name)
        $('#edit_event_id').val(json.event_id)
        $('#edit_event_date').val(json.event_date)
        $('#edit_maximum').val(json.maximum)
        $('#EditModal').modal()
      }
     });
}


$('#EditEventLoad').hide()
$(document).ready(function() {
    $('#EditEvent').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Dashboard/EditEvent')?>",
            type: "POST",  
            data: form,
            beforeSend: function(){
                $('#EditEventLoad').show()
                $('#EditEventSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)

                if(json.success == true){
                    $('#EditModal').modal('hide')
                    EventList()
                    alert('Successfully Updated')
                }

                if (json.duplicate == true) {
                    alert('Event already exist')
                }

                if (json.same_value == true) {
                    alert('No changes has been made')
                }

                
                
                $('#EditEventLoad').hide()
                $('#EditEventSubmit').show()
                
            }
        });
        
    });
});

function DeleteEvent(event_id){
    var result = confirm("Want to delete?");
    if (result) {
         $.ajax({  
            url: "<?=base_url('Dashboard/DeleteEvent')?>",
            type: "POST",  
            data: {event_id:event_id},
            beforeSend: function(){
                $('#EditEventLoad').show()
                $('#EditEventSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)

                if(json.success == true){
                    EventList()
                    alert('Successfully Deleted')
                }

                if (json.error == true) {
                    alert('Action Not allowed')
                }
                
                $('#EditEventLoad').hide()
                $('#EditEventSubmit').show()
                
            }
        });
    }
}




</script>