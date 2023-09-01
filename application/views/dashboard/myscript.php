<script>
function LoadSync(){
    $.ajax({  

         // url: "https://evrstw2022.dost8.ph/Settings/AccountsRecords",
         url: "https://evrstw2022.dost8.ph/Settings/AccountsRecordsAPI",
         // url: "http://localhost/rstw2022/Settings/AccountsRecords",
        type: "POST",  
        success: function(data){  

            var json = $.parseJSON(data)
            if (json.length != 0) {
                AutoSyncData(json)
                // console.log('okay')
            }
        }
    });
}

function LoadSyncAll(){
    $.ajax({  
         url: "https://evrstw2022.dost8.ph/Settings/AccountsRecords",
         // url: "http://localhost/rstw2022/Settings/AccountsRecords",
        type: "POST",  
        success: function(data){  

            var json = $.parseJSON(data)
            if (json.length != 0) {
                AutoSyncData(json)
                console.log('okay')
            }
        }
    });
}





// Same code with DTR Sync
function AutoSyncData(data){
    $.ajax({  
        url: "<?=base_url('Dashboard/AutoSyncData')?>",
        type: "POST",  
        data: {data:data},  
        beforeSend: function(){
            $('#addFromGuideLoad').show()
            $('#addFromGuideSubmit').hide()
        },
        success: function(data){  
        }
    });
}
</script>