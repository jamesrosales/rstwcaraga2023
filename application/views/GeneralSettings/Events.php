<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSTW 2023</title>
    <link rel="icon" type="image/ico" href="<?php echo base_url('assets/Images/logo.png');?>" />

   
    
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>" >
    <style>
        /*http://localhost/rstw2022/assets/Images/bg_blue.jpg*/
        #content {
            background: url(<?php echo base_url("assets/Images/bg_blue.jpg"); ?>);
            /*background-size: 100% auto;*/
            /*background-position: center; background-attachment: fixed; */
            /*max-height:100%;*/
            /*height: 1000px;*/
            height: 1000px;
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
                      <h5 class="card-title">Event List <a onclick="AddEvent()"><i class="fas fas fa-plus text-md text-info cursor float-right">&nbsp;</i></a></h5>
                      
                  </div>
                  <div class="card-body p-0">
                  <div class="card-body">
                      <div id="EventsRecords"></div>
                  </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  </div>
</div>

<div class="modal" id="EditModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="EditEvent">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group">      
                            <label>Event Name</label>
                            <input type="hidden" name="id" id="edit_event_id">
                            <input type="text" name="event_name" id="edit_event_name" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Start Date</label>
                            <input type="datetime-local" id="edit_date_start" name="date_start" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>End Date</label>
                            <input type="datetime-local" id="edit_date_finished" name="date_finished" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Link</label>
                            <input type="text" name="link" id="edit_link" class="form-control">
                        </div><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger danger_new_color one-edge-shadow ButtonBorderColor" data-dismiss="modal"><span class="fas fa-times font-size14"></span>&nbsp;Cancel</button>
                <button type="submit" class="btn btn-info one-edge-shadow ButtonBorderColor" id="EditEventSubmit"><span class="fas fa-edit font-size14"></span>&nbsp;Save changes</button>
                <button class="btn btn-info" id="EditEventLoad">Processing <span class="fa fa-cog fa-spin"></span></button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="ADDModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="AddEvent">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group">      
                            <label>Event Name</label>
                            <input type="text" name="event_name" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Start Date</label>
                            <input type="datetime-local" name="date_start" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>End Date</label>
                            <input type="datetime-local" name="date_finished" class="form-control">
                        </div><br>
                        <div class="group">      
                            <label>Link</label>
                            <input type="text" name="link" class="form-control">
                        </div><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger danger_new_color one-edge-shadow ButtonBorderColor" data-dismiss="modal"><span class="fas fa-times font-size14"></span>&nbsp;Cancel</button>
                <button type="submit" class="btn btn-info one-edge-shadow ButtonBorderColor" id="AddUserSubmit"><span class="fas fa-edit font-size14"></span>&nbsp;Save changes</button>
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

function EditEvent(id){
    
    $.ajax({
      url:  "<?=base_url('Settings/getEventData')?>",
      type: "POST",
      data: {id:id},
      success: function(data)
      {
        var json = $.parseJSON(data)

        $('#edit_event_name').val(json.event_name)
        $('#edit_event_id').val(json.id)
        $('#edit_date_start').val(json.date_start)
        $('#edit_date_finished').val(json.date_finished)
        $('#edit_link').val(json.link)
        $('#EditModal').modal()
      }
     });
}

$('#AddUserLoad').hide()
$(document).ready(function() {
    $('#AddEvent').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Settings/AddEvent')?>",
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
                    EventsRecords()
                    alert('Successfully Added')
                }

                if (json.duplicate == true) {
                    alert('Event already exist')
                }
            }
        });
        
    });
});


$('#EditEventLoad').hide()
$(document).ready(function() {
    $('#EditEvent').on('submit', function(event) {
        event.preventDefault();
        var form = $(this).serialize();
        $.ajax({  
            url: "<?=base_url('Settings/EditEvent')?>",
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
                    EventsRecords()
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

EventsRecords()
function EventsRecords(){
  $.ajax({  
      url: "<?=base_url('Settings/EventsRecords')?>",
      type: "POST",  
      success: function(data){  
        var json = $.parseJSON(data)
        // console.log(json)
        var res = ''
        res +='<table class="table table-striped" id="tbl_records">'
          res +='<thead>'
            res +='<tr>'
              res +='<th scope="col">Start Date</th>'
              res +='<th scope="col">End Date</th>'
              res +='<th scope="col">Event/Activity</th>'
              res +='<th scope="col">Links</th>'
              res +='<th scope="col"></th>'
            res +='</tr>'
          res +='</thead>'

          res +='<tbody>'
          for (var i = 0; i < json.length; i++) {
            res +='<tr>'
              res +='<td style="font-size:13px;">'+json[i].date_start+'</td>'
              res +='<td style="font-size:13px;">'+json[i].date_finished+'</td>'
              res +='<td style="font-size:13px;">'+json[i].event_name+'</td>'
              res +='<td style="font-size:13px;"><a href="'+json[i].link+'">'+json[i].link+'</a></td>'
              res +='<td style="font-size:13px;width:10%">'
                res +='<a class="btn btn-sm btn-info" onclick="EditEvent('+json[i].id+')" style="color:white"><i class="fas fa-edit"></i></a>&nbsp;'
                res +='<a class="btn btn-sm btn-danger" onclick="DeleteEvent('+json[i].id+')" style="color:white"><i class="fas fa-trash"></i></a>'
              res +='</td>'
            res +='</tr>'
          }
          res +='</tbody>'
          res +='</table>'
          $('#EventsRecords').html(res)
            $('#tbl_records').DataTable( {
                "ordering": false
            })
      }
  });
}

function DeleteEvent(id){
    var result = confirm("Want to delete?");
    if (result) {
         $.ajax({  
            url: "<?=base_url('Settings/DeleteEvent')?>",
            type: "POST",  
            data: {id:id},
            beforeSend: function(){
                $('#EditEventLoad').show()
                $('#EditEventSubmit').hide()
            },  
            success: function(data){  
                var json = $.parseJSON(data)

                if(json.success == true){
                    EventsRecords()
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