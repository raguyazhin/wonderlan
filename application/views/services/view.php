<div id="page-content-wrapper">

    <div class="container-fluid p-2">   

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </nav>

        <div class="row page-header">
            <div class="col-md-12">
                <h6 class="page-title d-inline-block"><strong>Services</strong><?php echo ' - ' . 'SN MAIN' ?></h6>
                <span class="sub-title"><?php echo 'ipaddress' . ' - ' . 'username' ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-dhcp-tab" data-toggle="pill" href="#pills-dhcp" role="tab" aria-controls="pills-dhcp" aria-selected="true">DHCP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-other-tab" data-toggle="pill" href="#pills-other" role="tab" aria-controls="pills-other" aria-selected="false">Other</a>
                    </li>                
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-dhcp" role="tabpanel" aria-labelledby="pills-dhcp-tab">

                        <div class="row page-sub-header">
                            <div class="col-md-12 pb-3">
                                <h6 class="page-sub-title d-inline-block"><strong>DHCP</strong></h6>   
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_dhcp_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Add new DHCP</a>             
                            </div>           
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Interface Name</th>
                                    <th scope="col">Start Range</th>
                                    <th scope="col">End Range</th>
                                    <th scope="col">Lease</th>
                                    <th scope="col">Gateway</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Actions</th>                                
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($dhcp as $row){ ?>

                                    <tr>
                                        <td><?php echo $row['interface_name'] ?></td>
                                        <td><?php echo $row['start_range'] ?></td>
                                        <td><?php echo $row['end_range'] ?></td>
                                        <td><?php echo $row['lease_time'] ?> <?php echo $row['lease_format'] ?></td>
                                        <td><?php echo $row['gateway'] ?></td>
                                        <td><?php echo $row['description'] ?></td>
                                        <td>
                                            <a class="btn-grid edit_record" href="javascript:void(0)" 
                                            data-0="<?php echo $row['interface_name'] ?>" 
                                            data-1="<?php echo $row['start_range'] ?>" 
                                            data-2="<?php echo $row['end_range'] ?>" 
                                            data-3="<?php echo $row['lease_time'] ?>" 
                                            data-4="<?php echo $row['lease_format'] ?>"
                                            data-5="<?php echo $row['gateway'] ?>"
                                            data-6="<?php echo $row['description'] ?>"
                                            role="button"><i class="far fa-edit"></i></a>
                                            <a class="btn-grid delete_record" href="javascript:void(0)" 
                                            data-0="<?php echo $row['interface_name'] ?>"  
                                            role="button"><i class="far fa-trash-alt"></i></a>
                                        </td>                               
                                    </tr>
                                    
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>

                    <!-----other------>

                    <div class="tab-pane fade" id="pills-other" role="tabpanel" aria-labelledby="pills-other-tab">
                  
                        <div class="row page-sub-header">
                            <div class="col-md-12 pb-3">
                                <h6 class="page-sub-title d-inline-block"><strong>Other</strong></h6>                
                            </div>           
                        </div>

                    </div>
                    

                </div>

            </div>

        </div>

    </div>

</div>


<form id="add_dhcp" method="post">

    <div class="modal right fade" id="add_dhcp_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Add</strong> DHCP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-3">Interface Name</label>
                        <div class="col-sm-5">
                            <select id="interface_name" name="interface_name" required class="form-control">
                                <?php foreach($physical_interfaces as $key=>$value) { echo '<option value="' . $value . '">' . $value . '</option>'; }?>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Start Range</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="start_range" name="start_range" required placeholder="Start">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">End Range</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="end_range" name="end_range" required placeholder="End">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Lease Time</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="lease_time" name="lease_time" required placeholder="Lease">
                        </div>
                        <div class="col-sm-3">
                            <select id="lease_format" name="lease_format" required class="form-control">
                                <option value="h">Hours(s)</option>
                                <option value="d">Day(s)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Gateway</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="gateway" name="gateway" required placeholder="0.0.0.0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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

<form id="update_dhcp" method="post">

    <div class="modal right fade" id="update_dhcp_modal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit</strong> DHCP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-3">Interface Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="edit_interface_name" name="edit_interface_name" required readonly placeholder="Start">                           
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Start Range</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="edit_start_range" name="edit_start_range" required placeholder="Start">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">End Range</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="edit_end_range" name="edit_end_range" required placeholder="End">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Lease Time</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="edit_lease_time" name="edit_lease_time" required placeholder="Lease">
                        </div>
                        <div class="col-sm-3">
                            <select id="edit_lease_format" name="edit_lease_format" required class="form-control">
                                <option value="h">Hours(s)</option>
                                <option value="d">Day(s)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Gateway</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="edit_gateway" name="edit_gateway" required placeholder="0.0.0.0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="edit_description" name="edit_description" rows="3"></textarea>
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

<form id="delete_dhcp" method="post">

    <div class="modal fade" id="delete_dhcp_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Delete</strong> DHCP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="del_interface_name" id="del_interface_name" class="form-control">    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            
            </div>

        </div>
    </div>

</form>

<script>

    $(document).ready(function(){

        //////////////////////////////////////////////////////////////////////////////////

        $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');

        if(activeTab){
            $('#pills-tab a[href="' + activeTab + '"]').tab('show');
        }

        //////////////////////////////////////////////////////////////////////////////////

    });

    $('.edit_record').on('click', function() {
       
        var interface_name = $(this).attr('data-0');
        var start_range = $(this).attr('data-1');
        var end_range = $(this).attr('data-2');
        var lease_time = $(this).attr('data-3');
        var lease_format = $(this).attr('data-4');
        var gateway = $(this).attr('data-5');
        var description = $(this).attr('data-6');

        $("#edit_interface_name").val(interface_name);
        $("#edit_start_range").val(start_range);
        $("#edit_end_range").val(end_range);
        $("#edit_lease_time").val(lease_time);
        $("#edit_lease_format").val(lease_format).change();
        $("#edit_gateway").val(gateway);
        $("#edit_description").val(description);

        $('#update_dhcp_modal').modal('show');

    });

    $('.delete_record').on('click', function() {

        var interface_name = $(this).attr('data-0');

        $('#del_interface_name').val(interface_name);
        $('#delete_dhcp_modal').modal('show');

    });


    $('#add_dhcp').on('submit', function (e) {
        e.preventDefault();
        var str = $("#add_dhcp").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>ServicesController/add_dhcp",
            data : str,
            type : 'post',
            success : function(response) {
                if (response) {
                    $("#add_dhcp")[0].reset();
                    $('#add_dhcp_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to add DHCP !");
                    return false;
                }
            }
        });
    });

    $('#update_dhcp').on('submit', function (e) {
        e.preventDefault();
        var str = $("#update_dhcp").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>ServicesController/edit_dhcp",
            data : str,
            type : 'post',
            success : function(response) {
                if (response) {
                    $("#update_dhcp")[0].reset();
                    $('#update_dhcp_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to update DHCP !");
                    return false;
                }
            }
        });
    });

    $('#delete_dhcp').on('submit', function (e) {
        e.preventDefault();
        var str = $("#delete_dhcp").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>ServicesController/delete_dhcp",
            data : str,
            type : 'post',
            success : function(response) {
                if (response) {
                    $("#delete_dhcp")[0].reset();
                    $('#delete_dhcp_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to delete DHCP !");
                    return false;
                }
            }
        });
    });

</script>