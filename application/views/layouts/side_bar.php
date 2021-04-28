<!-- Sidebar -->

<style>

    #host .page-sub-header {
        margin: 5px;
    }

    #host .page-sub-title {
        font-size: 11px;
    }

    #host table {
        border-top: 1px #D5D5D5 solid;
        margin-top: 5px;
        padding: 3px;
    }

    #host table, th, td {
        border-collapse: collapse;
        cursor: pointer;
    }

    #host th, td {
        padding: 10px 5px;
    }

</style>

<div id="sidebar-wrapper">

	<div class="sidebar-container">
		<div class="right-panel">
			<nav class="navbar">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url() . 'dashboard' ?>" data-toggle="tooltip" data-placement="right" title="Dashboard"><i class="icon-speedometer"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url() . 'interface' ?>" data-toggle="tooltip" data-placement="right" title="Interface"><i class="icon-layers"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url() . 'firewall' ?>" data-toggle="tooltip" data-placement="right" title="Firewall"><i class="icon-shield"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url() . 'vpn' ?>" data-toggle="tooltip" data-placement="right" title="VPN"><i class="icon-link"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url() . 'routing' ?>" data-toggle="tooltip" data-placement="right" title="Routing"><i class="icon-directions"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url() . 'services' ?>" data-toggle="tooltip" data-placement="right" title="Services"><i class="icon-star"></i></a></li>
				</ul>

				<ul class="navbar-nav footer">	
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url() . 'alerts' ?>" data-toggle="tooltip" data-placement="right" title="Alerts"><i class="icon-bell"></i></a></li>					
					<li class="nav-item"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="right" title="Settings"><i class="icon-settings"></i></a></li>
					<li class="nav-item"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="right" title="Logout"><i class="icon-logout"></i></a></li>
				</ul>
			</nav>
		</div>

		<div class="left-panel">
			<!-- <nav class="navbar navbar-expand-md sidebar-top-nav">
				<div class="navbar-nav">
					<a href="#" class="nav-item nav-link active"><i class="icon-grid"></i></a>
					<a href="#" class="nav-item nav-link"><i class="icon-refresh"></i></a>
					<a href="#" class="nav-item nav-link"><i class="icon-settings"></i></a>
					<a href="#" class="nav-item nav-link"><i class="icon-info"></i></a>
                    <a href="#" class="nav-item nav-link"><i class="fas fa-expand"></i></a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-terminal"></i></a>                   
				</div>
			</nav> -->

			<div id="host">

				<div class="row page-sub-header">
					<div class="col-md-12 p-0 m-0">
						<h6 class="page-sub-title d-inline-block"><strong>Hosts</strong></h6>
						<div class="float-right">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#add_host_modal" class="btn btn-control"><span class="fas fa-plus"></span></a>
							<a href="javascript:void(0);" class="btn btn-control edit_host_record"><span class="fas fa-edit"></span></a>
							<a href="javascript:void(0);" class="btn btn-control delete_host_record"><span class="fas fa-trash-alt"></span></a>
						</div>
					</div>           
				</div>
                
				<?php
                    //$hosts = $this->jsondb->get_data('hosts',null,false);
				?>

				<!-- <table id="host-table">
					<?php foreach($hosts as $row){ ?>
						<tr class='host-row' data-href='<?php echo site_url() . 'host/'. $row['host_id'] .'/'. $this->uri->segment(3,null) ?>' data-0="<?php echo $row['host_id']; ?>" data-1="<?php echo $row['host_name']; ?>" data-2="<?php echo $row['ip_address']; ?>">
                            <td width=3%><i class="fas fa-h-square" style="color:#00a0df"></i></td>		
							<td><?php echo $row['host_name']; ?></td>													
                            <td width=3%><i id="<?php echo str_replace(".","",$row['ip_address']) ?>" class="far fa-dot-circle"></i></td>                            
						</tr>
					<?php } ?>
				</table> -->

			</div>

		</div>

	</div>

</div>
<!-- /#sidebar-wrapper -->

<form id="add_host" method="post">

    <div class="modal fade" id="add_host_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Add</strong> Host</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-3">Host Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="host_name" name="host_name" required placeholder="Host Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">IP Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="host_ip_address" name="host_ip_address" required placeholder="0.0.0.0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">SSH Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ssh_user_name" name="ssh_user_name" required placeholder="SSH Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">SSH Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="ssh_password" name="ssh_password" required placeholder="SSH Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">DB Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="db_user_name" name="db_user_name" required placeholder="DB Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">DB Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="db_password" name="db_password" required placeholder="DB Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">VPN Type</label>
                        <div class="col-sm-8">
                            <select id="vpn_type" name="vpn_type" required class="form-control select">
                                <option value=""></option>
                                <option value="SERVER">SERVER</option>
                                <option value="CLIENT">CLIENT</option>                                
                            </select>
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

<form id="update_host" method="post">

    <div class="modal fade" id="update_host_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit</strong> Host</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-3">Host Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_host_name" name="edit_host_name" required placeholder="Host Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">IP Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_host_ip_address" name="edit_host_ip_address" required placeholder="0.0.0.0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">SSH Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_ssh_user_name" name="edit_ssh_user_name" required placeholder="SSH Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">SSH Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="edit_ssh_password" name="edit_ssh_password" required placeholder="SSH Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">DB Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_db_user_name" name="edit_db_user_name" required placeholder="DB Username">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">DB Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="edit_db_password" name="edit_db_password" required placeholder="DB Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3">VPN Type</label>
                        <div class="col-sm-8">
                            <select id="edit_vpn_type" name="edit_vpn_type" required class="form-control select">
                                <option value=""></option>
                                <option value="SERVER">SERVER</option>
                                <option value="CLIENT">CLIENT</option>                                
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
					<input type="hidden" name="edit_host_id" id="edit_host_id" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </div>

        </div>

    </div>

</form>

<form id="delete_host" method="post">

    <div class="modal  fade" id="delete_host_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Delete</strong> Host</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                
                <div class="modal-footer">
					<input type="hidden" name="del_host_id" id="del_host_id" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            
            </div>

        </div>
    </div>

</form>

<script>

	// var host_id;
	// var host_name;
	// var host_ipaddress;
	// var ssh_username;
	// var ssh_password;

	$(function() {
		var href = window.location.href;
		$('nav a').each(function(e,i) {
			if (href.indexOf($(this).attr('href')) >= 0) {
			$(this).addClass('active');
			}
		});
	});

	$(document).ready(function(){

		$('[data-toggle="tooltip"]').tooltip();  

        //ping_host();

	});

	 //listen for clicks
	 $('#host-table').on('click','tr', function(){

        host_id = $(this).attr('data-0');
		host_name = $(this).attr('data-1');
		host_ipaddress = $(this).attr('data-2');
		ssh_username = $(this).attr('data-3');
		ssh_password = $(this).attr('data-4');
        db_username = $(this).attr('data-5');
		db_password = $(this).attr('data-6');
        vpn_type = $(this).attr('data-7');

		//alert( $(this).data("href"));
		window.location.href = $(this).data("href");

    });

    $('.edit_host_record').on('click', function() {

		$('#edit_host_id').val(host_id);
		$('#edit_host_name').val(host_name);
		$('#edit_host_ip_address').val(host_ipaddress);
		$('#edit_ssh_user_name').val(ssh_username);
		$('#edit_ssh_password').val(ssh_password);
        $('#edit_db_user_name').val(db_username);
		$('#edit_db_password').val(db_password);
        $('#edit_vpn_type').val(vpn_type).change();

		$('#update_host_modal').modal('show');

	});

    $('.delete_host_record').on('click', function() {

		$('#del_host_id').val(host_id);
		$('#delete_host_modal').modal('show');

	});

	$('#add_host').on('submit', function (e) {
        e.preventDefault();
        var str = $("#add_host").serialize();
		//alert(str);
        $.ajax({
            url : "<?php echo site_url() ?>HostController/add_host",
            data : str,
            type : 'post',
            success : function(response) {
                if (response) {
                    $("#add_host")[0].reset();
                    $('#add_host_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to add Host !");
                    return false;
                }
            }
        });
    });

    $('#update_host').on('submit', function (e) {
        e.preventDefault();
        var str = $("#update_host").serialize();
        //alert(str);
        $.ajax({
            url : "<?php echo site_url() ?>HostController/edit_host",
            data : str,
            type : 'post',
            success : function(response) {
                if (response) {
                    $("#update_host")[0].reset();
                    $('#update_host_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to update Host !");
                    return false;
                }
            }
        });
    });

	$('#delete_host').on('submit', function (e) {
        e.preventDefault();
        var str = $("#delete_host").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>HostController/delete_host",
            data : str,
            type : 'post',
            success : function(response) {
                if (response) {
                    $("#delete_host")[0].reset();
                    $('#delete_host_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to delete Host !");
                    return false;
                }
            }
        });
    });

    var ping_host = function () {

        var post_url = "<?php echo site_url() ?>HostController/get_host" 
        var dataString = ''
        var imgcolor = ['red', 'green'];

        $.ajax(
        {
            type: "POST",
            url: post_url,
            data: dataString,
            dataType: "json",
            cache: false,

            success: function(host)
            {              
                $.each(host['hosts'],function(i,host)                 
                {     
                    var post_url = "<?php echo site_url() ?>HostController/ping_host" 
                    var ipaddress=host['ipaddress'].trim()

                    $.ajax(
                    {
                        type : "POST",
                        url : post_url,
                        data  : {'ip_address':ipaddress},
                        dataType : "json",
                        cache : false,

                        success: function(ping_host)
                        {
                            //console.log(ping_host[0]);  
                            var id=ipaddress.replace(/\./g,'')
                            //console.log(ipaddress)
                            //console.log(id)   

                            $("#"+id).removeClass("green");      
                            $("#"+id).removeClass("red"); 
                            $("#"+id).addClass(imgcolor[ping_host[0]]);    
                                    
                            //document.getElementById(id).src = imgpath + ping_host[0] + ".png";

                        } //end success
                                
                    }); //end AJAX

                });         
                                        
            } //end success

        }); //end AJAX

        setTimeout(ping_host, 6000);  

    }; 

</script>