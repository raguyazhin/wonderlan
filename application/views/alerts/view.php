<div id="page-content-wrapper">

    <div class="container-fluid p-2">

        <div class="row page-header">
            <div class="col-md-12">
                <h6 class="page-title d-inline-block"><strong>Alerts</strong><?php echo ' - ' . $host_data['name'] ?></h6>
                <span class="sub-title"><?php echo $host_data['ipaddress'] . ' - ' . $host_data['ssh_username'] ?></span>
            </div>
        </div>
        
        <div class="row">

            <div class="col-2 pr-1">
                <div class="list-group">
                    <?php foreach($log_files as $key=>$value) { ?>
                        <a href="#" class="list-group-item"><?php echo $value; ?></a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-10 pl-1">
                <div id="logs">                    
                </div>
            </div>

        </div>

    </div> 

</div>

<script>

    var log_file_name

    $(".list-group a").click(function(){
        log_file_name = $(this).text();
    });

    var get_logs = function () {

        var str = 'log_file=' + log_file_name;
        $.ajax({
            url : "<?php echo site_url() ?>AlertsController/get_logs",
            data : str,
            type : 'post',
            success : function(get_logs) {
                if (get_logs) {
                    $('#logs').empty()
                    $("#logs").append(get_logs);
                } else {
                    alert("Failed to get logs !");
                    return false;
                }
            }
        });

        setTimeout(get_logs, 6000);  

    }; 

    $(document).ready(function()
    {
        log_file_name="<?php echo $log_files[0] ?>"
        get_logs();
    });  
</script>
