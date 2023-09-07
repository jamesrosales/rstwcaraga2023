<script src="<?=base_url('assets/dist/js/jquery.qrcode.min.js')?>"></script>

<style type="text/css">

</style>

<div class="container">
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
                    usr_institution = json[i].usr_institution;

                    if(json[i].usr_suffix!='') { suffix = ', '+json[i].usr_suffix; } else { suffix = ''; }
                    if (json[i].usr_mname.length != 0) { usr_mname = json[i].usr_mname.charAt(0)+'.' } else { usr_mname = '' }
                    name = json[i].usr_fname+' '+usr_mname+' '+json[i].usr_lname+''+suffix;

                    usr_role = json[i].role_name;

                    var img = "";
                    var text_output = "";

                    if (json[i].usr_cluster == 'Luzon') {
                        img +='<img class="imgID" src="'+'<?php echo base_url('assets/img/ID.png'); ?>'+'"'+''+'>'
                    } else if (json[i].usr_cluster == 'Visayas'){
                        img +='<img class="imgID" src="'+'<?php echo base_url('assets/img/ID.png'); ?>'+'"'+''+'>'
                    } else {
                        img +='<img class="imgID" src="'+'<?php echo base_url('assets/img/ID.png'); ?>'+'"'+''+'>'
                    }

                    res +='<div class="col-6">'
                    res += img
                    res +='<div id="qrcode'+usr_id+'" class="QrCodeOutput qr_code"></div><br>'
                    res += '<div class="centered_name center" style="color: #003366; font-size: 20px;">' + name + '</div>';
                    res +='<div class="centered_inst" style="color: #003366; font-size: 15px;"><br>'+usr_institution+'</br></div>'

                    if (usr_role.length <= 13) {
                        res +='<div class="centered_role">'+usr_role+'</div><br>'
                    } else {
                        res +='<div class="centered_role_less">'+usr_role+'</div><br>'
                    }

                    res +='</div>'
                    
                    res +='<div class="col-6" style="">'
                    res += img
                    res +='<div id="qrcode'+usr_id+'QR'+json[i].usr_id+'" class="QrCodeOutput qr_code"></div><br>'
                    res += '<div class="centered_name center" style="color: #003366; font-size: 20px;">' + name + '</div>';
                    res +='<div class="centered_inst" style="color: #003366; font-size: 15px;"><br>'+usr_institution+'</br></div>'

                    if (usr_role.length <= 13) {
                        res +='<div class="centered_role">'+usr_role+'</div><br>'
                    } else {
                        res +='<div class="centered_role_less">'+usr_role+'</div><br>'
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
     
    function printMe(){
        window.print();
    }

    function printDiv() {
        window.print();
    }
</script>
