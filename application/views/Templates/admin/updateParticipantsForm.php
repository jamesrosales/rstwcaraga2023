<?php 
    $order_by = [
        'a' => 'event_name',
        'b' => 'asc'
    ];
    $events = $this->Functions->select_table_OrderBy($order_by,"tbl_events");

    $order_byR = [
        'a' => 'role_id',
        'b' => 'asc'
    ];
    $roles = $this->Functions->select_table_OrderBy($order_byR,"tbl_roles");

        // $data = [ 
        //     'events' => $events,
        //     'roles' => $roles,

        // ];

 ?>
<div class="col-sm-12">
    <div class="form-row">
        <div class="form-group col-sm-4">                      
          <input type="hidden" name="usr_id"  class="form-control input_textarea usr_id_update"  placeholder="Last Name">                   
          <input type="text" name="usr_lname"  class="form-control input_textarea usr_lname" required placeholder="Last Name">                   
        </div>
        <div class="form-group col-sm-4">
          <input type="text" name="usr_fname" class="form-control input_textarea usr_fname" required  placeholder="First Name">                     
        </div>
        <div class="form-group col-sm-2">
          <input type="text" name="usr_mname" class="form-control input_textarea usr_mname" placeholder="MI">
        </div>
        <div class="form-group col-sm-2">
          <input type="text" name="usr_suffix" class="form-control input_textarea usr_suffix"  placeholder="Suffix">
        </div>
      </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="form-group col-sm-5">
            <div class="row">
                <div class="col-sm-4">
                    <label style="margin-top:5px;font-size:17px;color: #1b4485;">Birthdate</label>
                </div>
                <div class="col-sm-8">
                    <input type="date" name="birth_date" class="form-control input_textarea birth_date" placeholder="Date" >
                </div>
            </div>
        </div>
        <div class="form-group col-sm-3">
            <select class=" btn input_textarea usr_gender" placeholder="Choose Privilege" name="usr_gender" >
                <option selected disabled>Gender</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
        <div class="form-group col-sm-4">
            <input type="text" class="form-control input_textarea usr_contact" name="usr_contact" required placeholder="Mobile Number" >
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="form-group col-sm-6">
            <input type="text" class="form-control input_textarea usr_occupation" name="usr_occupation"  required placeholder="Occupation/Position" >
        </div>
        <div class="form-group col-sm-6">
            <input type="text" class="form-control input_textarea usr_institution" name="usr_institution"  required placeholder="Name of Firm/Institution" >
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="form-group col-sm-6">
            <input type="email" class="form-control input_textarea usr_email" name="usr_email" placeholder="Email Address"  required style="text-transform: none;">
        </div>
        <div class="form-group col-sm-6">
            <input type="text" class="form-control input_textarea usr_municipality" name="usr_municipality"  required placeholder="Address" >
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="form-group col-sm-4">
            <select required class="btn input_textarea form-control usr_sector" name="usr_sector" placeholder="Sector"  >
                <option selected disabled>Sector/Institution</option>
                <option>Academe (Teacher, Professor, Faculty, University Researcher)</option>
                <option>Association</option>
                <option>Cooperative</option>
                <option>Individual / NEET(Not in Education, Employment, or Training)</option>
                <option>Government</option>
                <option>LGU</option>
                <option>NGO</option>
                <option>OFW</option>
                <option>Private(Sole Proprietor, Entrepreneur, MSME)</option>
                <option>Student</option>
                <!-- <option value="others">Others, please specify:</option> -->
            </select>
        </div>
        <div class="form-group col-sm-4">
            <select required class="btn input_textarea form-control usr_role" name="usr_role" placeholder="Role"  >
                <option selected disabled>Role of Participation</option>
                <!-- <option value="1">Participant</option>
                <option value="2">VIP</option>
                <option value="3">Organizer</option>
                <option value="4">Resource Speaker</option>
                <option value="5">DOST Official</option> -->
                 <?php foreach ($roles as $var) { ?>    
                     <option value="<?=$var['role_id']?>"><?=$var['role_name']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-sm-4">
             <select required class="btn input_textarea usr_cluster" name="usr_cluster" placeholder="Sector">
                <option selected disabled>Regional Cluster</option>
                <option value="Luzon">Luzon</option>
                <option value="Visayas">Visayas</option>
                <option value="Mindanao">Mindanao</option>
            </select>
        </div>
    </div>
   <!--  <div class="row" id="other_sector" style="display:none">
        <input type="text" name="usr_sector_other" id="" class="input_textarea form-control" >
    </div> -->
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <label><b>Pre Registered Events</b></label>
            <select style="font-size:10px !important;" required class="select2 event_name" multiple="multiple" data-placeholder="Select Events" name="event_name[]"  >
                <?php foreach ($events as $var) { ?>     
                <option  value="<?=$var['event_id']?>"><?=$var['event_name']?></option>                  
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<br>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <label><b>Events Approved</b></label>
            <select style="font-size:10px !important;"  class="select2 event_approved_id" multiple="multiple" data-placeholder="Select Events" name="event_approved_id[]"  >
                <?php foreach ($events as $var) { ?>     
                <option  value="<?=$var['event_id']?>"><?=$var['event_name']?></option>                  
                <?php } ?>
            </select>
        </div>
    </div>
</div>

<script>
    
</script>