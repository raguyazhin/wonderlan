<div id="page-content-wrapper">

    <div class="container-fluid p-2">

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Interfaces</li>
            </ol>
        </nav>

        <div class="row page-header">
            <div class="col-md-12">
                <h6 class="page-title d-inline-block"><strong>Interface</strong><?php echo ' - ' . 'SN MAIN' ?></h6>
                <span class="sub-title"><?php echo 'ipaddress' . ' - ' . 'username' ?></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">

                <?php 

                    $row=0;
                    $i=0;
                    $j=0;
                    $col_cnt=13;
                    $data_str='';

                    echo '<table class="table" id="tblintf">';
                    echo '<thead>';
                    echo '<tr>';

                    foreach($physical_interfaces as $key=>$value) {

                        if (($i > 0) && ($j == $col_cnt)){
                            $i++;
                            $row++;
                            echo '</tr>';
                            echo '<tr>';
                            $j=0;
                            $data_str='';
                        }

                        if ($i == 0){
                            echo '<th scope="col">'.$value.'</th>';
                        }else{
                            if (trim($value) == '3' || trim($value) == '2' || trim($value) == '1' || trim($value) == '0') {
                                echo '<td><img width="12" height="12" src="' . base_url() . 'assets/img/' . $value . '.png" alt=""></td>';
                                $data_str.=' data-'. $j .'="' . $value . '"';                                
                            }elseif (trim($value) == 'YES' || trim($value) == 'NO') {
                                echo '<td><input type="checkbox" name="is_enable" id="is_enable"' . (trim($value) == 'YES' ? 'checked' : '') .' value="'. $row .'"></td>';
                                $data_str.=' data-'. $j .'="' . $value . '"';                                
                            }else{
                                echo '<td valign="middle">'.$value.'</td>';
                                $data_str.=' data-'. $j .'="' . $value . '"';
                            }                                
                        }

                        $j++;   
                        
                        
                        if (($i > 0) && ($j == $col_cnt)){                                
                            echo '<td>
                                <a class="btn-grid edit_record" href="javascript:void(0)" role="button" ' . $data_str . '><i class="far fa-edit"></i></a>                                    
                            </td>';
                        }
                        
                        if (($i == 0) && ($j == $col_cnt)){
                            $i++;
                            echo '<th scope="col">Actions</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                        }
                        
                    } 

                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';

                ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <?php 

                    $i=0;
                    $j=0;
                    $col_cnt=13;
                    $data_str='';

                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';

                    foreach($user_interfaces as $key=>$value) {

                        if (($i > 0) && ($j == $col_cnt)){
                            $i++;
                            echo '</tr>';
                            echo '<tr>';
                            $j=0;
                            $data_str='';
                        }

                        if ($i == 0){
                            echo '<th scope="col">'.$value.'</th>';
                        }else{
                            if (trim($value) == '3' || trim($value) == '2' || trim($value) == '1' || trim($value) == '0') {
                                echo '<td><img width="12" height="12" src="' . base_url() . 'assets/img/' . $value . '.png" alt=""></td>';
                                $data_str.=' data-'. $j .'="' . $value . '"';
                            }elseif (trim($value) == 'YES' || trim($value) == 'NO') {
                                echo '<td><input type="checkbox" name="is_enable" id="is_enable"' . (trim($value) == 'YES' ? 'checked' : '') .' value="'. $row .'"></td>';
                                $data_str.=' data-'. $j .'="' . $value . '"';      
                            }else{
                                echo '<td valign="middle">'.$value.'</td>';
                                $data_str.=' data-'. $j .'="' . $value . '"';
                            }                                
                        }

                        $j++;   
                        
                        if (($i > 0) && ($j == $col_cnt)){
                            echo '<td>                                    
                                <a class="btn-grid delete_record" href="javascript:void(0)" role="button" ' . $data_str . ' role="button"><i class="far fa-trash-alt"></i></a>
                            </td>';
                        }
                        
                        if (($i == 0) && ($j == $col_cnt)){
                            $i++;
                            echo '<th scope="col">Actions</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                        }
                        
                    } 

                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';

                ?> 

            </div>
        </div>

    </div>

</div>

<form id="update_interface" method="post">

    <div class="modal right fade" id="update_interface_modal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit</strong> Interface</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">    

                    <div class="form-group row">
                        <label  class="col-sm-3">Display Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_display_name" name="edit_display_name" required placeholder="Interface Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Interface Name</label>
                        <div class="col-sm-9">
                            <select id="edit_interface" name="edit_interface" required class="form-control">
                                <?php foreach($all_interfaces as $key=>$value) { echo '<option value="' . $value . '">' . $value . '</option>'; }?>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Interface Type</label>
                        <div class="col-sm-9">
                            <select id="edit_interface_type" name="edit_interface_type" required class="form-control select">
                                <option value="LAN" selected>LAN</option>
                                <option value="WAN">WAN</option>                                
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Protocol</label>
                        <div class="col-sm-9">
                            <select id="edit_protocol" name="edit_protocol" required class="form-control">
                                <option value="DHCP" selected>DHCP</option>
                                <option value="STATIC">STATIC</option>
                            </select>
                        </div>  
                    </div>

                    <div id="edit_static_block" style="display: none">

                        <div class="form-group row">
                            <label  class="col-sm-3">IP Address</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="edit_ipaddress" name="edit_ipaddress" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-3">Netmask</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="edit_netmask" name="edit_netmask" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label  class="col-sm-3">Gateway</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="edit_gateway" name="edit_gateway" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                            </div>
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label  class="col-sm-3">DNS 1</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="edit_dns_1" name="edit_dns_1" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">DNS 2</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="edit_dns_2" name="edit_dns_2" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </div>
        </div>
    </div>
</form>

<form id="delete_interface" method="post">

    <div class="modal  fade" id="delete_interface_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Delete</strong> Interface</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="del_interface" id="del_interface" class="form-control">
                    <input type="hidden" name="del_interface_type" id="del_interface_type" class="form-control">                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            
            </div>

        </div>
    </div>

</form>

<script>

    $(document).ready(function(){

        $('#tblintf tbody').sortable();

        $("#edit_display_name").keydown(function(e){
            return e.which !== 32;
        });

        $("#display_name").keydown(function(e){
            return e.which !== 32;
        });

    });

    $("#protocol").change(function () {
        if ($(this).val() == "STATIC") {
            $("#static_block").show();    
            $('#ipaddress').attr("required", true);  
            $('#netmask').attr("required", true);   
            $('#gateway').attr("required", true);               
        } else {
            $("#static_block").hide();
            $('#ipaddress').removeAttr("required");
            $('#netmask').removeAttr("required");
            $('#gateway').removeAttr("required");
        }
    });

    $("#edit_protocol").change(function () {
        if ($(this).val() == "STATIC") {
            $("#edit_static_block").show();    
            $('#edit_ipaddress').attr("required", true);  
            $('#edit_netmask').attr("required", true);   
            $('#edit_gateway').attr("required", true);               
        } else {
            $("#edit_static_block").hide();
            $('#edit_ipaddress').removeAttr("required");
            $('#edit_netmask').removeAttr("required");
            $('#edit_gateway').removeAttr("required");
        }
    });

    $('.edit_record').on('click', function() {

        var display_name = $(this).attr('data-0');
        var interface_name = $(this).attr('data-1');
        var interface_type = $(this).attr('data-2');
        var protocol = $(this).attr('data-3');
        var ipaddress = $(this).attr('data-4');
        var subnetmask = $(this).attr('data-5');
        var gateway = $(this).attr('data-6');
        var dns_1 = $(this).attr('data-7');
        var dns_2 = $(this).attr('data-8');

        $('#edit_display_name').val(display_name);
        $("#edit_interface").val(interface_name).change();
        $("#edit_interface_type").val(interface_type).change();
        $("#edit_protocol").val(protocol).change();
        $('#edit_ipaddress').val(ipaddress);
        $('#edit_netmask').val(subnetmask);
        $('#edit_gateway').val(gateway);
        $('#edit_dns_1').val(dns_1);
        $('#edit_dns_2').val(dns_2);

        if($('#edit_interface option:selected').text().length === 0){
            $("#edit_interface").prepend("<option value='"+interface_name+"' selected='selected'>"+interface_name+"</option>");
        }

        $('#update_interface_modal').modal('show');

    });

    $('.delete_record').on('click', function() {

        var interface_name = $(this).attr('data-1');
        var interface_type = $(this).attr('data-2');

        $('#del_interface').val(interface_name);
        $('#del_interface_type').val(interface_type);
        $('#delete_interface_modal').modal('show');

    });

    $('#update_interface').on('submit', function (e) {
        e.preventDefault();
        var str = $("#update_interface").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>/InterfaceController/edit_interface",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#update_interface")[0].reset();
                    $('#update_interface_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to update Interface !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    $('#delete_interface').on('submit', function (e) {
        e.preventDefault();
        var str = $("#delete_interface").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>/InterfaceController/delete_interface",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#delete_interface")[0].reset();
                    $('#delete_interface_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to delete Interface !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    $(document).on('change', '[type=checkbox]', function (e) {

        //alert(this.checked);
        //alert(this.value);

        var row = this.value;

        var display_name = $('#tblintf tr:eq(' + row + ') td:eq(' + 0 + ')').text();
        var interface_name = $('#tblintf tr:eq(' + row + ') td:eq(' + 1 + ')').text();
        var interface_type = $('#tblintf tr:eq(' + row + ') td:eq(' + 2 + ')').text();
        var protocol = $('#tblintf tr:eq(' + row + ') td:eq(' + 3 + ')').text();
        var ipaddress = $('#tblintf tr:eq(' + row + ') td:eq(' + 4 + ')').text();
        var subnetmask = $('#tblintf tr:eq(' + row + ') td:eq(' + 5 + ')').text();
        var gateway = $('#tblintf tr:eq(' + row + ') td:eq(' + 6 + ')').text();
        var dns_1 = $('#tblintf tr:eq(' + row + ') td:eq(' + 7 + ')').text();
        var dns_2 = $('#tblintf tr:eq(' + row + ') td:eq(' + 8 + ')').text();

        if (this.checked){
            var enable="YES"
        } else {
            var enable="NO"
        }

        //alert(enable);
        //alert(interface_name);

        $.ajax({
            url : "<?php echo site_url() ?>/InterfaceController/enable_interface",
            data : {'display_name':display_name,'interface': interface_name,'interface_type': interface_type,'protocol': protocol,'ipaddress': ipaddress,'netmask': subnetmask,'gateway': gateway,'dns_1': dns_1,'dns_2': dns_2,'enable': enable},
            dataType: 'json',
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    location.reload();
                } else {
                    alert("Failed to enable Interface !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });

    });

</script>