
<html>
<head>
  <?php $this->load->view('dashboard/mynavbar'); ?>
  <style>

  body{
/*      background-color: #2a4b75;*/
      font-family: "Open Sans", sans-serif;
      background: url('../../assets/img/Session-Backdrop.png');
  background-position: center center;

  background-repeat: no-repeat;

  background-attachment: fixed;
  
  background-size: cover;
    }
  
    h1.hrmisLogo {
      display: inline-block;
      margin-left: 10px;
      font-weight: bolder;
      position: absolute;
      top: 21px;
/*      color: #144a88;*/
      font-size: 42px;
    }
    div.small {
        display: inline-table;
        position: absolute;
        top: 70px;
        color: #144a88;
        margin-left: 13px;
        font-weight: 1000;
    }
    .logo {
      margin: 0 !important;
      padding: 10px;
    }

    .heading_color{
      color: #e8652b;
    }
    .color_white{
      color: white;
    }
    .background_color_white{
      background-color: white;
    }

    .copyright{text-align:center;margin:0 auto 30px 0;padding:10px;color:#144a88;font-size:13px}



    @media (max-width: 2000px) {
      .container {
        
        max-width: 1700px;
      }
    }

    @media (max-width: 1900px) {
      .container {
        max-width: 1600px;
      }
    }

    @media (max-width: 1800px) {
      .container {
        max-width: 1400px;
      }
    }

    @media (max-width: 1700px) {
      .container {
        width: 1300px;
      }
    }


    @media (max-width: 1400px) {
      .container {
       width: 1700px;
      }
    }
    
    #tbl_{
      max-height: 525px;
      overflow: scroll;
    }

    .modal-header{
        background-color: #1b4485;
    /*    color: #ffffff;*/
    }

    .btn-primary{
        background-color: #144a88;
    }
    .tr{
        color: #fff
    }
    thead{
        background-color: #e8652b;
    }
  </style>
</head>
<body>
<div class="menu-toggler sidebar-toggler"></div>
<div class="logo"></div>
  
<div class="container">
    <!-- <div class="row">
        <div class="col-md-12" style="padding-bottom: 2%; ">
            <br><img style="height: 70px;" src="<?=base_url('assets/dist/img/dost8.png')?>" alt="" />
            <h1 class="hrmisLogo" style="color: #fff!important;">DOST VIII</h1>
            <div class="small" style="color: #fff!important;">Contactless Attendance System</div>
        </div>
    </div> -->
<?php $this->load->view('dashboard/template'); ?>
<center style="color:#144a88;"><h4><?=$tbl_events->event_name?></h4></center>

<div class="row" >
    <div class="col-md-6">
       <center><div class="heading_color"><h3>Camera</h3></div></center>
          <div id="loadingMessage" class="color_white">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
          <br>
          <canvas id="canvas" hidden style="width: 100%;height: 600px;" class="shadow-lg  rounded"></canvas>
          <div id="output" hidden>
              <div id="outputMessage" style="color:white;">No QR code detected.</div>
              <div hidden style="color:white;"><b>Data:</b> <span id="outputData"></span></div>
          </div>
    </div>
    <div class="col-md-6" >
        <center><div class="digital-clock heading_color"></div></center>
        <div style="background-color: white;padding: 10px" class="shadow-lg p-3 mb-5 bg-white rounded">
            <form class="form-inline" id="SearchEmployee">
                <div class="form-group mb-2">
                   <select class="form-control form-control-sm" name="qrcode" data-size="6">
                        <option value="">Select Name</option>
                        <?php foreach ($usr_table as $var) { ?>  
                        <option value="<?=$var['qrcode']?>"><?=$var['usr_lname']?>, <?=$var['usr_fname']?> <?=$var['usr_mname']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input class="form-control  form-control-sm" name="date" type="date"  id="date_">
                </div>
                <div class="mb-2">
                    <input type="submit" class="btn btn-block btn-sm btn-primary" style="height: 30px;" value="Search">
                </div>&nbsp;
                <div class="mb-2">
                    <a class="btn btn-block btn-sm btn-primary" style="height: 30px;color: white;" onclick="EmployeeRecordsAttendance()">Refresh</a>
                </div>&nbsp;
                <div class="mb-2">
                    <a class="btn btn-block btn-sm btn-primary" style="height: 30px;color: white;" onclick="GenerateReport()">GenerateReport</a>
                </div>&nbsp;
                 <div class="mb-2">
                    <a class="btn btn-block btn-sm btn-primary" style="height: 30px;color: white;" onclick="AddInModal()">Add</a>
                </div>&nbsp;
              <!--  
                <div class="mb-2">
                    <a class="btn btn-block btn-sm btn-info" style="height: 30px;color: white;" onclick="LoadSync()">Sync</a>
                </div>&nbsp;
                <div class="mb-2">
                    <a class="btn btn-block btn-sm btn-info" style="height: 30px;color: white;" onclick="LoadSyncAll()">Sync All</a>
                </div> -->
            </form>

            <div id="tbl_"  style="">
            <table class="table table-striped  table-hover" >
                <thead >
                    <tr class="tr">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody id="table_body"></tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="footer">
            <div class="copyright"> 2020 © DOST VIII. </div>
        </div>
    </div>
</div>



 


<div class="modal" id="myModal">
    <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Information</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <div id="modal_text"></div>
                  <div id="photo"></div>
                  <img id="my_image" width="450">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
        </div>
    </div>
</div>

<div class="modal" id="AddInModal">
    <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <div id="UserTbl"></div>
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
        </div>
    </div>
</div>

<div class="modal" id="WarningModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" ></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <h2 style="color: #ef961b; text-align:center;">Action Not Allowed</h2>  
                  <div id="ErrorMessage"></div>
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
        </div>
    </div>
</div>

</div>

<?php $this->load->view('dashboard/myscript'); ?>

<!-- 28026  -->
<input type="hidden" id="url" value="<?php echo base_url();?>">
<input type="hidden" id="event_id" value="<?=$tbl_events->event_id?>">

<script src="<?php echo base_url();?>assets/plugins/ekko-lightbox/ekko-lightbox.js"></script>
  <script>
    console.log($(window).width())
    lightbox()
    function lightbox(){
      $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox({
            alwaysShowClose: true
          });
        });

      })
    }

    function AddInModal(){
        $.ajax({  
            url: "<?=base_url('Dashboard/GetEmployee')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''
                var num = 0;

                res +='<table class="table table-striped" id="usrTbl_">'
                res +='<thead>'
                res +='<tr>'
                    res +='<th scope="col" style="font-size:13px;">Name</th>'
                    res +='<th scope="col" style="font-size:13px;"></th>'
                res +='</tr>'
                res +='</thead>'

                res +='<tbody>'
                for (var i = 0; i < json.length; i++) {
                res +='<tr>'
                    res +='<td style="font-size:13px;">'+json[i].usr_lname+', '+json[i].usr_fname+' '+json[i].usr_mname+'</td>'
                    res +='<td style="font-size:13px;">'
                        res +='<button type="button" class="btn btn-info  btn-sm"><i class="fas fa-plus-square" onclick="InsertTimeInButton('+json[i].usr_id +')">Add</i></button>'
                    res +='</td>'
                res +='</tr>'
                }
                res +='</tbody>'
                res +='</table>'
                $('#UserTbl').html(res)
          // $('#accounts').html(res)
          $('#usrTbl_').DataTable( {
                "ordering": false
            })

                
            }
        });
        $('#AddInModal').modal()
    }

    function InsertTimeInButton(usr_id){
        event_id = $('#event_id').val()
        $.ajax({  
            url: "<?=base_url('Dashboard/InsertTimeInButton')?>",
            type: "POST",  
            data: {usr_id:usr_id, event_id:event_id},
            success: function(data){  
                var json = $.parseJSON(data)
                var res = '';
                $('#AddInModal').modal('hide')
                if(json.success == true){
                    res += '<center><h2 style="color:green;">'+json.date+' '+json.time+'</h2></center>'
                    res += '<b>Name</b>: '+json.firstname+' '+json.middlename+' '+json.surname+'</p>'
                    $('#modal_text').html(res)

                    $('#myModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    })

                    setTimeout(function() {
                       $('#myModal').modal('hide')
                    }, 4000);

                    EmployeeRecordsAttendance()
               }

               if (json.error == true) {
                    $('#ErrorMessage').html(json.error_message)
                    $('#WarningModal').modal()
               }

            }
        });
    }

    url = $('#url').val()
    
    

    var photo = null;
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var loadingMessage = document.getElementById("loadingMessage");
    var outputContainer = document.getElementById("output");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("outputData");
   

    function drawLine(begin, end, color) {
      canvas.beginPath();
      canvas.moveTo(begin.x, begin.y);
      canvas.lineTo(end.x, end.y);
      canvas.lineWidth = 4;
      canvas.strokeStyle = color;
      canvas.stroke();
    }
    // history.pushState(null, 'FeaturePoints Login', 'http://localhost/qrcodeEvent/');
    // Use facingMode: environment to attemt to get the front camera on phones

    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
      video.srcObject = stream;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.play();

          requestAnimationFrame(tick);

    })



//     // Prefer camera resolution nearest to 1280x720.
// var constraints = { audio: true, video: { width: 1280, height: 720 } }; 

// navigator.mediaDevices.getUserMedia(constraints)
// .then(function(mediaStream) {
//   var video = document.querySelector('video');
//   video.srcObject = mediaStream;
//   video.onloadedmetadata = function(e) {
//     video.play();
//     requestAnimationFrame(tick);
//   };
// })
// .catch(function(err) { console.log(err.name + ": " + err.message); }); // always check for errors at the end.
    





     var num_condition = 0;
    function tick() {

      loadingMessage.innerText = "⌛ Loading video..."
      if (video.readyState === video.HAVE_ENOUGH_DATA) {


        loadingMessage.hidden = true;
        canvasElement.hidden = false;
        outputContainer.hidden = false;

        canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height, {
          inversionAttempts: "dontInvert",
        });

        if (code) {

         // setTimeout(function() {
          drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
          drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
          drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
          drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
          outputMessage.hidden = true;
          outputData.parentElement.hidden = false;
          outputData.innerText = code.data;


           if (code.data != '') {
              if (num_condition == 0) {
                insert(code.data)
                setTimeout(function() {
                  num_condition = 0
                }, 5000);
              }

               console.log(num_condition)
           }else{

           }
        } else {

          outputMessage.hidden = false;
          outputData.parentElement.hidden = true;

        }

      }

      requestAnimationFrame(tick);

    }
       function takepicture() {
         var photo = document.getElementById('photo');
    // var context = canvas.getContext('2d');
    // if (width && height) {
      // canvasElement.width = width;
      // canvasElement.height = height;
       canvasElement.height = video.videoHeight;
        canvasElement.width = video.videoWidth;
      canvas.drawImage(video, 0, 0,  canvasElement.width, canvasElement.height);

      var data = canvasElement.toDataURL('image/png');
      // photo.setAttribute('src', data);
      datame = $("#my_image").attr("src",data);
      // console.log(data)
      // console.log(datame)
    // } else {
    //   clearphoto();
    // }
    return data
  }

    function insert(data1){
        event_id = $('#event_id').val()
        $.ajax({
          url: url+"Dashboard/InsertTimeIn",
          type: "POST",
          data: {data:data1,event_id:event_id},

          success: function(data)
          {
            var json = $.parseJSON(data)
            var res = ''
            if (json.success == true) {


                res += '<center><h2 style="color:green;">'+json.date+' '+json.time+'</h2></center>'
                res += '<b>Name</b>: '+json.firstname+' '+json.middlename+' '+json.surname+'</p>'
                $('#modal_text').html(res)

                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                })

                setTimeout(function() {
                   $('#myModal').modal('hide')
                }, 4000);
                
                EmployeeRecordsAttendance()
            }
            if (json.error == true) {
                $('#ErrorMessage').html(json.error_message)
                $('#WarningModal').modal()

                setTimeout(function() {
                   $('#WarningModal').modal('hide')
                }, 15000);
            }

          }
         });
        num_condition = 5;
    }



    EmployeeRecordsAttendance()
    function EmployeeRecordsAttendance(){
        event_id = $('#event_id').val()
        $('#SearchEmployee')[0].reset()
        $.ajax({
          url: url+"Dashboard/EmployeeRecordsAttendance",
          type: "POST",
          data: {event_id:event_id},
          success: function(data)
          {
            var json = $.parseJSON(data)
            var res = ''
            var num = 0;
            if (json.length == 0) {
                res +='<tr>'
                res +='<td colspan="5" style="text-align:center;">No records found</td>'
                res +='</tr>'
            }
            if (json.length != 0) {

                for (var i = 0; i < json.length; i++) {
                user_mname = ''
                if (json[i].usr_mname[0] == undefined) {
                    user_mname =''
                }else{
                    user_mname = json[i].usr_mname[0]
                }
                num++
                res +='<tr>'
                res +='<td>'+num+'</td>'
                res +='<td>'+json[i].usr_fname+' '+user_mname+'. '+json[i].usr_lname+'</td>'
                res +='<td>'+json[i].date+'</td>'
                res +='<td>'+json[i].time+'</td>'
                res +='</tr>'
                }
            }

            $('#table_body').html(res)
          }
         });
    }

    $(document).ready(function() {
        $('#SearchEmployee').on('submit', function(event) {
            event.preventDefault();
            var form = $(this).serializeArray();
            event_id = $('#event_id').val()
            form.push({name: 'event_id', value: event_id});
            $.ajax({  
                url: "<?=base_url('Dashboard/SearchEmployee')?>",
                type: "POST",  
                data: form,  
                success: function(data){  
                    var json = $.parseJSON(data)
                    var res = ''
                    var num = 0;

                    if (json.length == 0) {
                        res +='<tr>'
                        res +='<td colspan="5" style="text-align:center;">No matching records found</td>'
                        res +='</tr>'
                    }
                    if (json.length != 0) {
                        for (var i = 0; i < json.length; i++) {
                        user_mname = ''
                        if (json[i].usr_mname[0] == undefined) {
                            user_mname =''
                        }else{
                            user_mname = json[i].usr_mname[0]
                        }
                        num++
                        res +='<tr>'
                        res +='<td>'+num+'</td>'
                        res +='<td>'+json[i].usr_fname+' '+user_mname+'. '+json[i].usr_lname+'</td>'
                        res +='<td>'+json[i].date+'</td>'
                        res +='<td>'+json[i].time+'</td>'
                        res +='</tr>'
                        }
                    }

                    $('#table_body').html(res)
                }
            });
        });
    });


    $(document).ready(function() {
      GetClock();
        setInterval(GetClock,1000);
    })

 var tday=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var tmonth=["January","February","March","April","May","June","July","August","September","October","November","December"];

    function GetClock(){

    var d=new Date();
    var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getFullYear();
    var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

    if(nhour==0){ap=" AM";nhour=12;}
    else if(nhour<12){ap=" AM";}
    else if(nhour==12){ap=" PM";}
    else if(nhour>12){ap=" PM";nhour-=12;}

    if(nmin<=9) nmin="0"+nmin;
    if(nsec<=9) nsec="0"+nsec;

    var clocktext=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
    // document.getElementById('clockbox').innerHTML=clocktext;
    $('.digital-clock').html('<h3>'+clocktext+' (PST)</h3><br>')
    // $('.digital-clock').html('<h3 style="color:white;text-shadow: 2px 2px black">'+clocktext+' (PST)</h3><br>')
     // console.log(clocktext)
    }


    function GenerateReport(){
        event_id = $('#event_id').val()
        date_ = $('#date_').val()
        // console.log(event_id)
        // console.log(date_)
        // location.href="<?=base_url('Dashboard/GeneratePDF/')?>"+event_id+"/"+date_
         window.open("<?=base_url('Dashboard/GeneratePDF/')?>"+event_id+"/"+date_, '_blank');
    }





  </script>
</body>
</html>
