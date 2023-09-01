<?php  $this->load->view('Templates/admin/reusable'); ?>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> 
<div class="container">
    <div class="row py-0">
        <div class="col-md-4">
            <div class="card card-shadow">
                <div class="card-body ">
                    <canvas id="ApprovalStats" style="height:20px !important;"></canvas>  
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-shadow">
                <div class="card-body ">
                    <canvas id="doughnut" style="height:20px !important;"></canvas>  
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-shadow">
                <div class="card-body ">
                    <canvas id="clusterGraph"></canvas>  
                </div>
            </div>
        </div>
    </div>
    <div class="row py-4">
        <div class="col-lg">
            <div class="card card-shadow">
                <div class="card-body ">
                    <canvas id="myChart" style="height:20px !important;"></canvas>  
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-shadow">
                <div class="card-body ">
                    <canvas id="roleChart"></canvas>  
                </div>
            </div>
        </div>
    </div>
    <div class="row py-4">
        <div class="col-lg">
        <div class="card card-shadow">
            <div class="card-header">
                <h5 class="card-title pendingTxt">
                    Approved Participants
                </h5>
            </div>
            <div class="card-body table-responsive">
                <div id="EventStats"></div>
            </div>
        </div>
        </div>
    </div>
    <!-- <div class="row py-4">
        <div class="col-lg">
        <div class="card card-shadow">
            <div class="card-header">
                <h5 class="card-title pendingTxt">
                    Pending Participants
                </h5>
            </div>
            <div class="card-body table-responsive">
                <div id="EventPeningStats"></div>
            </div>
        </div>
        </div>
    </div> -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header heading">
        <h5 class="modal-title" id="exampleModalLabel">Participants - <span class="orangeTxt" id="statusDisplay"></span> <br><small id="event_name_show"></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="EventParticipants"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <span id="PrintButton"></span>
      </div>
    </div>
  </div>
</div>



<script>

    function showEventParticipants(event_id, status){
    $.ajax({  
        url: "<?=base_url('Admin/EventParticipants')?>",
        type: "POST",  
        data: {event_id: event_id, status : status},
        success: function(data){  
            var json = $.parseJSON(data)
            console.log(json)
            $('#event_name_show').html(json.event.event_name)
            $('#statusDisplay').html(json.displayStatus)
            var res = ''
            res +='<table class="table table-hover " id="EventParticipantsTBL">'
            res +='<thead>'
                res +='<tr >'
                    res +='<th>Name</th>'
                    res +='<th>Gender</th>'
                    res +='<th>Cluster</th>'
                    res +='<th>Role</th>'
                res +='</tr>'
            res +='</thead>'
            res +='<tbody style="font-size:13px;">'
            for (var i = 0; i < json.EventParticipants.length; i++) {
                res +='<tr>'
                    if(json.EventParticipants[i].usr_suffix!='') { suffix = json.EventParticipants[i].usr_suffix; } else { suffix = ''; }
                    res +='<td>'+json.EventParticipants[i].usr_lname+', '+suffix+' '+json.EventParticipants[i].usr_fname+' '+json.EventParticipants[i].usr_mname+'.</td>'
                    res +='<td ">'+json.EventParticipants[i].usr_gender+'</td>'
                    res +='<td ">'+json.EventParticipants[i].usr_cluster+'</td>'
                    res +='<td ">'+json.EventParticipants[i].role_name+'</td>'
                res +='</tr>'
            }
            res +='</tbody>'
            res +='</table>'
            $('#EventParticipants').html(res)
            $('#EventParticipantsTBL').DataTable({
                "ordering": false,
                // 'header': false,
                // dom: 'Bfrtip',
                // text: 'Print current page',
                // buttons: [
                //     {
                //     extend: 'print',
                //     text: 'ButtonLabelHere',
                //     title: '<h5>'+json.event.event_name+'</h5>',
                //          customize: function(win) {
                //                 // $(win.document.body).append('Status: Pending'); //after the table
                //                 $(win.document.body).prepend('Status: Pending'); //before the table
                //         }
                //     }
                // ],
                
            });
            url = "<?=base_url('Admin/ParticipantsPrint')?>"
            $('#PrintButton').html('<a type="button" class="btn btn-primary newPrimary" target="_blank" href="'+url+'/'+event_id+'/'+status+'">Print <i class="fa-solid fa-print"></i></a>')
            $('#exampleModal').modal()
        }
      });
    }

    EventStats()
    function EventStats(){
        $.ajax({  
            url: "<?=base_url('Admin/EventStats')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''
                approvedStatus = 1;
                checklistURL = "<?=base_url('Admin/checklist')?>"
                
                res +='<table class="table table-hover " id="TBL">'
                res +='<thead>'
                    res +='<tr class="heading">'
                        res +='<th height="2px"style="height:2px;">Event Name</th>'
                        res +='<th class="text-center">Number of Participants</th>'
                        res +='<th class="text-center">Maximum</th>'
                        res +='<th class="text-center">Checklist</th>'
                    res +='</tr>'
                res +='</thead>'
                res +='<tbody style="font-size:13px;">'
                for (var i = 0; i < json.length; i++) {
                    res +='<tr>'
                        res +='<td><a style="cursor:pointer;" onclick="showEventParticipants('+json[i].event_id+','+approvedStatus+')">'+json[i].event_name+'</a></td>'
                        res +='<td style="text-align:center;">'+json[i].num_participants+'</td>'
                        res +='<td style="text-align:center;">'+json[i].maximum+'</td>'
                        res +='<td style="text-align:center;"><a class="btn btn-sm btn-primary newPrimary" target="_blank" href="'+checklistURL+'/'+json[i].event_id+'">View</a></td>'
                    res +='</tr>'
                }
                res +='</tbody>'
                res +='</table>'
                $('#EventStats').html(res)
                $('#TBL').DataTable({
                    "ordering": false
                });
            }
        });
    }

    // EventPeningStats()
    // function EventPeningStats(){
       
    //     $.ajax({  
    //         url: "<?=base_url('Admin/EventPeningStats')?>",
    //         type: "POST",  
    //         success: function(data){  
    //             var json = $.parseJSON(data)
    //             var res = ''
    //             pendingStatus = 0;

    //             res +='<table class="table table-hover " id="TBLpndng">'
    //             res +='<thead>'
    //                 res +='<tr class="heading">'
    //                     res +='<th height="2px"style="height:2px;">Event Name</th>'
    //                     res +='<th class="text-center">Number of Pending Participants</th>'
    //                     // res +='<th class="text-center">Maximum</th>'
    //                 res +='</tr>'
    //             res +='</thead>'
    //             res +='<tbody style="font-size:13px;">'
    //             for (var i = 0; i < json.length; i++) {
    //                 res +='<tr>'
    //                     res +='<td><a style="cursor:pointer;" onclick="showEventParticipants('+json[i].event_id+','+pendingStatus+')">'+json[i].event_name+'</a></td>'
    //                     res +='<td style="text-align:center;">'+json[i].num_participants+'</td>'
    //                     // res +='<td style="text-align:center;">'+json[i].maximum+'</td>'
    //                 res +='</tr>'
    //             }
    //             res +='</tbody>'
    //             res +='</table>'
    //             $('#EventPeningStats').html(res)
    //             $('#TBLpndng').DataTable({
    //                 "ordering": false
    //             });
    //         }
    //     });
    // }
    
    ApprovalStats()
    function ApprovalStats(){
         $.ajax({  
            url: "<?=base_url('Admin/ApprovalStats')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)
                console.log('approval', json.Approved)
               
                const ApprovalStats = document.getElementById('ApprovalStats');

                new Chart(ApprovalStats, {
                    type: 'doughnut',
                    data: {
                    labels: [
                        'Pending'+' '+ json.Pending,
                        'Approved'+' '+ json.Approved
                    ],
                    options: {
                        responsive: true,
                        scales: {
                             r: {
                                pointLabels: {
                                  display: true,
                                  centerPointLabels: true,
                                  font: {
                                    size: 18
                                  }
                                }
                            },
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                    datasets: [{
                    data: [json.Pending, json.Approved],
                    backgroundColor: [
                      '#ef961b',
                      '#354093',
                    ]
                  }]
                  }
                });
            }
        });
    }

    GenderStats()
    function GenderStats(){
         $.ajax({  
            url: "<?=base_url('Admin/GenderStats')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)
                Male = '';
                MaleCount = 0;

                Female = '';
                FemaleCount = 0;


                for (var i = 0; i < json.length; i++) {
                    if (json[i].usr_gender == 'Male') {
                        Male = json[i].usr_gender;
                        MaleCount = json[i].count;
                    }else{
                        Female = json[i].usr_gender;
                        FemaleCount = json[i].count;
                    }
                }    
                const doughnut = document.getElementById('doughnut');

                new Chart(doughnut, {
                    type: 'pie',
                    data: {
                    labels: [
                        Male+' '+ MaleCount,
                        Female+' '+ FemaleCount
                    ],
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                    datasets: [{
                    // label: 'My First Dataset',
                    data: [MaleCount, FemaleCount],
                    backgroundColor: [
                      '#ef961b',
                      '#354093',
                    ]
                  }]
                  }
                });
            }
        });
    }

    ClusterGraph()
    function ClusterGraph(){
         $.ajax({  
            url: "<?=base_url('Admin/ClusterGraph')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)
                const clusterGraph = document.getElementById('clusterGraph');
                dataLabel = [];
                dataGraph = [];
                for (var i = 0; i < json.length; i++) {
                    dataLabel.push( json[i].usr_cluster +' ('+json[i].total+')' )
                    dataGraph.push( json[i].total )
                }
                console.log('cluster', dataLabel)

                new Chart(clusterGraph, {
                    type: 'doughnut',
                    data: {
                    labels: dataLabel,
                    datasets: [{
                    // label: 'My First Dataset',
                    data: dataGraph,
                    backgroundColor: [
                      '#ef961b',
                      '#354093',
                      'rgb(255, 205, 86)'
                    ]
                  }]
                  }
                });
            }
        });
    }

    AgeBracket()
    function AgeBracket(){
        $.ajax({  
            url: "<?=base_url('Admin/AgeBracket')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)

                const bar = document.getElementById('myChart');

                new Chart(bar, {
                  type: 'bar',
                  data: {
                    labels: [
                    '15 - 30',
                    '31 - 45',
                    '46 - 59',
                    '60 & above',
                  ],
                  datasets: [{
                    label: 'Age Bracket',
                    data: [json.Age15TO30, json.Age31TO45, json.Age46TO59, json.Age60Above],
                    backgroundColor: [
                      '#ef961b',
                      '#354093',
                      'rgb(255, 205, 86)',
                      'rgb(54, 162, 235)'
                    ]
                  }]
                  },
                   options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                });
            }
        });
    }

    RoleStats()
    function RoleStats(){
        $.ajax({  
            url: "<?=base_url('Admin/RoleStats')?>",
            type: "POST",  
            success: function(data){  
                var json = $.parseJSON(data)

                dataLabel = [];
                dataGraph = [];
                for (var i = 0; i < json.length; i++) {
                    dataLabel.push( json[i].role_name +' ('+json[i].total+')' )
                    dataGraph.push( json[i].total )
                }
                console.log('role', json)
                const bar = document.getElementById('roleChart');

                new Chart(bar, {
                    type: 'bar',
                    data: {
                    labels: dataLabel,
                    datasets: [{
                    label: 'Role',
                    // data: [json.Age15TO30, json.Age31TO45, json.Age46TO59, json.Age60Above],
                    data: dataGraph,
                   
                    backgroundColor: [
                      '#ef961b',
                      '#354093',
                      'rgb(255, 205, 86)',
                      'rgb(54, 162, 235)',
                      'rgb(54, 162, 235)',
                    ]
                  }]
                  },
                    options: {
                        responsive: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                });
            }
        });
    }
</script>