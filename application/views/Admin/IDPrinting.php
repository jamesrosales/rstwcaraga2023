 <script src="<?=base_url('assets/dist/js/jquery.qrcode.min.js')?>"></script>

<style type="text/css">

</style>

 <!-- Nix tanan nga css adto ka ma edit ha Views/Templates/admin/idPrintingCSS -->
<div class="container">
	<!-- <button class="btn btn-primary btn-xs" onclick="printMe()"> print</button> -->
    <div id="IDPrinting">
        

    </div>
</div>

<script>
    $('.breadcrumb').remove()
	IDPrintingFetch()
    function IDPrintingFetch(){
        var cluster = '<?=$cluster?>';
        $.ajax({  
            url: "<?=base_url('Admin/IDPrintingFetch')?>",
            type: "POST",  
            data: {cluster:cluster},
            success: function(data){  
                var json = $.parseJSON(data)
                var res = ''
                res +='<div class="row">'
                for (var i = 0; i < json.length; i++) {
                	usr_id = json[i].usr_id;
                	qrcode = json[i].qrcode
                	usr_institution = json[i].usr_institution.split("").reverse().join("");

                	if(json[i].usr_suffix!='') { suffix = ', '+json[i].usr_suffix; } else { suffix = ''; }
                	if (json[i].usr_mname.length != 0) { usr_mname = json[i].usr_mname.charAt(0)+'.' } else { usr_mname = '' }
                	name = json[i].usr_fname+' '+usr_mname+' '+json[i].usr_lname+''+suffix

                	nameFinal = name.split("").reverse().join("");

                    usr_role = json[i].role_name.split("").reverse().join("");

                    var img = "";
                    var text_output = "";
              

                    // if (nameFinal.length >= 20) {
                    //    res +='<div class="centered_name center">'+nameFinal+'</div>'
                    // } else {
                    //     res +='<div class="less_size center">'+nameFinal+'</div>'
                    // }

                    if (json[i].usr_cluster == 'Luzon') {
                        img +='<img class="imgID" src="'+'<?php echo base_url('assets/img/ID Card LUZON.png'); ?>'+'"'+''+'>'
                    } else if (json[i].usr_cluster == 'Visayas'){
                        img +='<img class="imgID" src="'+'<?php echo base_url('assets/img/ID Card VISAYAS.png'); ?>'+'"'+''+'>'
                    } else {
                        img +='<img class="imgID" src="'+'<?php echo base_url('assets/img/ID Card MINDANAO.png'); ?>'+'"'+''+'>'
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
                            res +='<div class="centered_role">'+usr_role+'</div><br>'
                            
                        } else {
                            res +='<div class="centered_role_less">'+usr_role+'</div><br>'
                            
                        }
                		
                        // res += json[i].usr_cluster
                		
			    	res +='</div>'
                    // res +='<div class="col-1"></div>'
                    
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
                            res +='<div class="centered_role">'+usr_role+'</div><br>'
                            
                        } else {
                            res +='<div class="centered_role_less">'+usr_role+'</div><br>'
                            
                        }
                        // res +=json[i].usr_cluster
                    // res +='<div class="col-1"></div>'
                        
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
     	
function printMe(){
	window.print();
}
function printDiv() 
{
    window.print();
  // var divToPrint=document.getElementById('IDPrinting');

  // var newWin=window.open('','Print-Window');

  // newWin.document.open();

  // newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  // newWin.document.close();

  // setTimeout(function(){newWin.close();},10);

}
</script>