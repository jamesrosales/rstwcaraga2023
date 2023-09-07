 <script src="<?=base_url('assets/dist/js/jquery.qrcode.min.js')?>"></script>

<style type="text/css">
    @media print{@page {size: portrait;}}
     .QrCodeOutput{
/*             background-color: #fff;*/
             text-align: center;
             padding-top: 15px;
             padding-bottom: 10px;

        }
    .col{
        padding: 10px;
    }
    .upper {
      text-transform: uppercase;
    }
    
    @page {
      size: A4;
      margin: 0;
    }
    @media print {
      html, body {
        width: 210mm;
        height: 297mm;
      }
      /* ... the rest of the rules ... */
    }

     .container {
      text-align: center;
    }
     /* Centered text */
    .centered_name {
      font-size:30px;
      font-weight: bold;
      text-transform: uppercase;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

       
    }

    .less_size {
      font-size:27px;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 6px;
     
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

       
    }

    .centered_inst {
      margin-top: -15px;
      font-size:25px;
      font-weight: bolder;

      text-transform: uppercase;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

       
    }


    .centered_role {
      margin-top: -5px;
      font-size:35px;
      font-weight: bolder;
      text-transform: uppercase;
      color: #144a88;
      margin-bottom: 120px;
      -webkit-text-stroke: 0.5px white;
      font-family: arial black;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

       
    }

    .centered_role_less {
      margin-top: 2px;
      font-size:25px;
      font-weight: bolder;
      text-transform: uppercase;
      color: #144a88;
      margin-bottom: 120px;

      -webkit-text-stroke: 0.5px white;
      font-family: arial black;
      /*-moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        -ms-transform: scale(-1, 1);
        transform: scale(-1, 1);*/

       
    }

    .luzon{
        background:#e8642b;
    }
    .visayas{

    }
/*
    .qr_code{
        margin-left: 5px;
        margin-top: -72%;
        margin-bottom: 2%;
    }*/

/*    .imgID{
        height: 600px;
        margin-top: 40px;
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }*/

canvas{
/*        margin-top: -110px;*/
/*        margin-left: -10px;*/
        width: 160px;
        height: 160px;
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }
@media only screen   
            and (min-width: 1080px)   
            and (max-width: 1920px)  
            {

                .imgID{
                    height: 650px;
                    margin-top: 20px;
                }

                canvas{
                    margin-top: -4px;
                    width: 180px;
                    height: 180px;
                    margin-left: -10px;
                }

                .centered_inst {
                  margin-top: -12px;
                  font-size:20px;
                  font-weight: bolder;
                  text-transform: uppercase;
                }

                .centered_role {
                    margin-top: 4px;
                }
            } 
</style>

 <!-- Nix tanan nga css adto ka ma edit ha Views/Templates/admin/idPrintingCSS -->
<div class="container">
	<!-- <button class="btn btn-primary btn-xs" onclick="printMe()"> print</button> -->
    <div id="IDPrinting">
        
    </div>
</div>

<script>
    
    $('.breadcrumb').remove()
	IDPrintingSoloData()
    function IDPrintingSoloData(){
        var usr_id = '<?=$usr_id?>';
        $.ajax({  
            url: "<?=base_url('Admin/IDPrintingSoloData')?>",
            type: "POST",  
            data: {usr_id:usr_id},
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''
                res +='<div class="row">'
                for (var i = 0; i < json.length; i++) {
                	usr_id = json[i].usr_id;
                	qrcode = json[i].qrcode
                	usr_institution = json[i].usr_institution;

                	if(json[i].usr_suffix!='') { suffix = ', '+json[i].usr_suffix; } else { suffix = ''; }
                	if (json[i].usr_mname.length != 0) { usr_mname = json[i].usr_mname.charAt(0)+'.' } else { usr_mname = '' }
                	name = json[i].usr_fname+' '+usr_mname+' '+json[i].usr_lname+''+suffix

                	nameFinal = name;

                    usr_role = json[i].role_name;

                    var img = "";
                    var text_output = "";
                    var background = "";
                    if (json[i].usr_cluster == 'Luzon') {
                        background = 'background:#e8642b; background-position:;'
                    } else if (json[i].usr_cluster == 'Visayas'){
                        background = 'background:#e8642b; background-position:;'
                    } else {
                       background = 'background:#e8642b; background-position:;'
                    }

                    

                	res +='<div class="col-6">'
                        res += img
                        res +='<div id="qrcode'+usr_id+'" class="QrCodeOutput qr_code"></div><br>'
                        // res +='<div class="centered_name">'+nameFinal+'</div>'
                                            
                        if (nameFinal.length >= 20) {
                            res +='<div class="less_size center">'+nameFinal+'</div>'
                        } else {
                            res +='<div class="centered_name center">'+nameFinal+'</div>'
                        }
                        res +='<div class="centered_inst">'+usr_institution+'</div>'

                        if (usr_role.length <= 13) {
                            res +='<div class="centered_role " >'+usr_role+'</div><br>'
                            
                        } else {
                            res +='<div class="centered_role_less "   >'+usr_role+'</div><br>'
                            
                        }
                		
                		
			    	res +='</div>'
                    
			    	res +='<div class="col-6" style="">'
                        res += img
                        res +='<div id="qrcode'+usr_id+'QR'+json[i].usr_id+'" class="QrCodeOutput qr_code"></div><br>'
                        if (nameFinal.length >= 20) {
                            res +='<div class="less_size center">'+nameFinal+'</div>'
                        } else {
                            res +='<div class="centered_name center">'+nameFinal+'</div>'
                        }
                        res +='<div class="centered_inst">'+usr_institution+'</div>'

                        if (usr_role.length <= 13) {
                            res +='<div class="centered_role " >'+usr_role+'</div><br>'
                            
                        } else {
                            res +='<div class="centered_role_less " >'+usr_role+'</div><br>'
                            
                        }
                        
			    	res +='</div>'
                    
                }
                res +='</div>'
                $('#IDPrinting').html(res)
               
               for (var i = 0; i < json.length; i++) {
		    		jQuery("#qrcode"+json[i].usr_id+"").qrcode(json[i].qrcode);
		    		jQuery("#qrcode"+json[i].usr_id+"QR"+json[i].usr_id).qrcode(json[i].qrcode);
               }
            }

        });
    }
     	
</script>