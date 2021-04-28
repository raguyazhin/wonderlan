<div id="page-content-wrapper">

    <div class="container-fluid p-2">

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Routing</li>
            </ol>
        </nav>

        <div class="row page-header">
            <div class="col-md-12">
                <h6 class="page-title d-inline-block"><strong>Routing</strong><?php echo ' - ' . 'SN MAIN' ?></h6>
                <span class="sub-title"><?php echo 'ipaddress' . ' - ' . 'username' ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-bgp-tab" data-toggle="pill" href="#pills-bgp" role="tab" aria-controls="pills-bgp" aria-selected="true">BGP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-eigrp-tab" data-toggle="pill" href="#pills-eigrp" role="tab" aria-controls="pills-eigrp" aria-selected="false">EIGRP</a>
                    </li>                
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-bgp" role="tabpanel" aria-labelledby="pills-bgp-tab">
            
                        <?php

                            $attributes = array('id' => 'frmbgp','class' => 'form-horizontal');
                            echo form_open('routing/bgp/add', $attributes);

                            echo validation_errors();

                        ?>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="row page-sub-header">
                                <div class="col-md-12 pb-3">
                                    <h6 class="page-sub-title d-inline-block"><strong>BGP Routing</strong></h6>                
                                </div>           
                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Local BGP Options</div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">LOCAL AS</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bgp_local_as" name="bgp_local_as" required placeholder="0" value="<?php echo (empty($bgp[0]['local_as'])) ? '' : $bgp[0]['local_as'] ; ?>">                                          
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2">Router ID</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" id="bgp_router_id" name="bgp_router_id" required value="<?php echo (empty($bgp[0]['router_id'])) ? '' : $bgp[0]['router_id'] ; ?>">                                          
                                </div>
                            </div>
                                
                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Neighbors</div>

                            <div class="row">
                                <div class="col-sm-8 pb-2">
                                    <div class="table-header">
                                        <button type="button" class="btn btn-control btn-secondary float-right add-new-bgp-neighbors"><span class="fas fa-plus"></span> Create New</button>
                                    </div>                                      
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">

                                    <table id="tblbgpneighbors" class="table">
                                        <thead>
                                            <tr>
                                                <th>IP</th>
                                                <th>Remote AS</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>                                        
                                        <tbody>
                                        
                                        <?php 

                                        if(!empty($bgp[0]['neighbor_ip'])) {
                                        
                                            $arr_neighbor_ip = explode(',',$bgp[0]['neighbor_ip']);
                                            $arr_remote_as = explode(',',$bgp[0]['remote_as']);
                                        
                                            for ($x = 0; $x <= count($arr_neighbor_ip)-1; $x++) {  ?>

                                                <tr>
                                                    <td><?php echo $arr_neighbor_ip[$x]; ?></td>
                                                    <td><?php echo $arr_remote_as[$x]; ?></td>
                                                    <td>
                                                        <a class="add btn-grid"><i class="fas fa-plus"></i></a>
                                                        <a class="edit btn-grid"><i class="fas fa-pencil-alt"></i></a>
                                                        <a class="delete btn-grid"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>

                                        <?php }} ?>

                                        </tbody>
                                    </table>                                        
                                </div>  
                                
                                <input type="hidden" id="txt_bgp_neighbors_ip" name="txt_bgp_neighbors_ip" value="<?php echo (empty($bgp[0]['neighbor_ip'])) ? '' : $bgp[0]['neighbor_ip'] ; ?>">
                                <input type="hidden" id="txt_bgp_remote_as" name="txt_bgp_remote_as" value="<?php echo (empty($bgp[0]['remote_as'])) ? '' : $bgp[0]['remote_as'] ; ?>">

                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Networks</div>
                            
                            <div class="row">
                                <div class="col-sm-6">

                                    <table id="tblbgpnetworks" class="table">

                                        <?php 

                                        $z = 0;

                                        if(!empty($bgp[0]['networks'])) {
                                                                                    
                                            $arr_networks = explode(',',$bgp[0]['networks']);

                                            for ($z = 0; $z <= count($arr_networks)-1; $z++) {  

                                                if ($z == 0) { ?>

                                                    <tr>
                                                        <td width="30%"><label>IP/Netmask</label></td>
                                                        <td><input type="text" name="bgp_network_ip_mask[]" class="form-control" value="<?php echo $arr_networks[$z]; ?>" /></td>
                                                        <td><button type="button" name="add_bgp_network" id="add_bgp_network" class="btn-control btn-primary"><i class="fa fa-plus"></i></button></td>                                                
                                                    </tr>

                                                <?php } else { ?>

                                                    <tr id="row-bgp-networks<?php echo $z; ?>">
                                                        <td width="30%"></td><td>
                                                        <input type="text" name="bgp_network_ip_mask[]" class="form-control" value="<?php echo $arr_networks[$z]; ?>"/></td>
                                                        <td><button type="button" name="remove" data-0="<?php echo $z; ?>" class="btn-control btn-secondary btn_bgp_network_remove"><i class="fa fa-times"></i></button></td>
                                                    </tr>

                                                <?php }} ?>

                                        <?php } else { ?>

                                            <tr>
                                                <td width="30%"><label>IP/Netmask</label></td>
                                                <td><input type="text" name="bgp_network_ip_mask[]" class="form-control" /></td>
                                                <td><button type="button" name="add_bgp_network" id="add_bgp_network" class="btn-control btn-primary"><i class="fa fa-plus"></i></button></td>                                                
                                            </tr>

                                        <?php } ?>
                                        
                                    </table>   

                                </div>
                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Advanced Options</div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Cluster ID</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bgp_cluster_id" name="bgp_cluster_id" placeholder="0.0.0.0" value="<?php echo (empty($bgp[0]['cluster_id'])) ? '' : $bgp[0]['cluster_id'] ; ?>">
                                </div>
                            </div>

                            <div class="div-title">Timers</div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Keepalive</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bgp_keep_alive" name="bgp_keep_alive" placeholder="60" value="<?php echo (empty($bgp[0]['keep_alive'])) ? '' : $bgp[0]['keep_alive'] ; ?>">
                                </div>
                                <label class="col-sm-2 control-label">Seconds</label>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Holdtime</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bgp_hold_time" name="bgp_hold_time" placeholder="180" value="<?php echo (empty($bgp[0]['hold_time'])) ? '' : $bgp[0]['hold_time'] ; ?>">       
                                </div>
                                <label class="col-sm-2 control-label">Seconds</label>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Background Scan</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="bgp_background_scan" name="bgp_background_scan" placeholder="60" value="<?php echo (empty($bgp[0]['background_scan'])) ? '' : $bgp[0]['background_scan'] ; ?>">                   
                                </div>
                                <label class="col-sm-2 control-label">Seconds</label>
                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Redistribute</div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Connected</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="bgp_connected" id="bgp_connected" <?php echo ((empty($bgp[0]['connected'])) ? '' : (($bgp[0]['connected']) ? 'checked' : '')) ; ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">RIP</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="bgp_rip" id="bgp_rip" <?php echo ((empty($bgp[0]['rip'])) ? '' : (($bgp[0]['rip']) ? 'checked' : '')) ; ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">OSPF</label>
                                <div class="col-sm-1">
                                    <td><input type="checkbox" name="bgp_ospf" id="bgp_ospf" <?php echo ((empty($bgp[0]['ospf'])) ? '' : (($bgp[0]['ospf']) ? 'checked' : '')) ; ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Static</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="bgp_static" id="bgp_static" <?php echo ((empty($bgp[0]['static'])) ? '' : (($bgp[0]['static']) ? 'checked' : '')) ; ?>>                                          
                                </div>
                            </div>
                                                      
                            <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <button type="submit" class="btn btn-control btn-primary float-right">Apply</button>

                            <?php echo form_close(); ?>

                    </div>

                    <!-----eigrp------>

                    <div class="tab-pane fade" id="pills-eigrp" role="tabpanel" aria-labelledby="pills-eigrp-tab">
                  
                        <?php

                            $attributes = array('id' => 'frmeigrp','class' => 'form-horizontal');
                            echo form_open('host/'.$host_id.'/routing/eigrp/add', $attributes);

                            echo validation_errors();

                        ?>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="row page-sub-header">
                                <div class="col-md-12 pb-3">
                                    <h6 class="page-sub-title d-inline-block"><strong>EIGRP Routing</strong></h6>                
                                </div>           
                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Local EIGRP Options</div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">LOCAL AS</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="eigrp_local_as" name="eigrp_local_as" required placeholder="0" value="<?php echo (empty($eigrp[0]['local_as'])) ? '' : $eigrp[0]['local_as'] ; ?>">         
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Router ID</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="eigrp_router_id" name="eigrp_router_id" required value="<?php echo (empty($eigrp[0]['router_id'])) ? '' : $eigrp[0]['router_id'] ; ?>">
                                </div>
                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Neighbors</div>

                            <div class="row">
                                <div class="col-sm-6">

                                    <table id="tbleigrpneighbors" class="table">

                                    <?php 

                                    $y = 0;

                                    if(!empty($eigrp[0]['neighbor_ip'])) {
                                                                                    
                                        $arr_neighbors = explode(',',$eigrp[0]['neighbor_ip']);

                                        for ($y = 0; $y <= count($arr_neighbors)-1; $y++) {  

                                            if ($y == 0) { ?>

                                                <tr>
                                                    <td width="30%"><label>IP Address</label></td>
                                                    <td><input type="text" name="eigrp_neighbor_ip[]" class="form-control" value="<?php echo $arr_neighbors[$y]; ?>" /></td>
                                                    <td><button type="button" name="add-eigrp-neighbors" id="add-eigrp-neighbors" class="btn-control btn-primary"><i class="fa fa-plus"></i></button></td>                                                
                                                </tr>

                                            <?php } else { ?>

                                                <tr id="row-eigrp-neighbors<?php echo $y; ?>">
                                                    <td width="30%"></td><td>
                                                    <input type="text" name="eigrp_neighbor_ip[]" class="form-control" value="<?php echo $arr_neighbors[$y]; ?>"/></td>
                                                    <td><button type="button" name="remove" data-0="<?php echo $y; ?>" class="btn-control btn-secondary btn_eigrp_neighbor_remove"><i class="fa fa-times"></i></button></td>
                                                </tr>

                                            <?php }} ?>

                                        <?php } else { ?>

                                            <tr>
                                                <td width="30%"><label>IP Address</label></td>
                                                <td><input type="text" name="eigrp_neighbor_ip[]" class="form-control" /></td>
                                                <td><button type="button" name="add-eigrp-neighbors" id="add-eigrp-neighbors" class="btn-control btn-primary"><i class="fa fa-plus"></i></button></td>                                                
                                            </tr>

                                        <?php } ?>

                                                                            
                                    </table>   

                                </div>
                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Networks</div>

                            <div class="row">
                                <div class="col-sm-6">

                                    <table id="tbleigrpnetworks" class="table">

                                    <?php 

                                    $x = 0;

                                    if(!empty($eigrp[0]['networks'])) {
                                                                                    
                                        $arr_networks = explode(',',$eigrp[0]['networks']);

                                        for ($x = 0; $x <= count($arr_networks)-1; $x++) {  

                                            if ($x == 0) { ?>

                                                <tr>
                                                    <td width="30%"><label>IP/Netmask</label></td>
                                                    <td><input type="text" name="eigrp_network_ip_mask[]" class="form-control" value="<?php echo $arr_networks[$x]; ?>" /></td>
                                                    <td><button type="button" name="add-eigrp-networks" id="add-eigrp-networks" class="btn-control btn-primary"><i class="fa fa-plus"></i></button></td>                                                
                                                </tr>

                                            <?php } else { ?>

                                                <tr id="row-eigrp-networks<?php echo $x; ?>">
                                                    <td width="30%"></td><td>
                                                    <input type="text" name="eigrp_network_ip_mask[]" class="form-control" value="<?php echo $arr_networks[$x]; ?>"/></td>
                                                    <td><button type="button" name="remove" data-0="<?php echo $x; ?>" class="btn-control btn-secondary btn_eigrp_network_remove"><i class="fa fa-times"></i></button></td>
                                                </tr>

                                            <?php }} ?>

                                        <?php } else { ?>

                                            <tr>
                                                <td width="30%"><label>IP/Netmask</label></td>
                                                <td><input type="text" name="eigrp_network_ip_mask[]" class="form-control" /></td>
                                                <td><button type="button" name="add-networks" id="add-networks" class="btn-control btn-primary"><i class="fa fa-plus"></i></button></td>                                                
                                            </tr>

                                        <?php } ?>

                                                                            
                                    </table>   

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2">Variance</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="eigrp_variance" name="eigrp_variance" value="<?php echo (empty($eigrp[0]['variance'])) ? '' : $eigrp[0]['variance'] ; ?>">
                                </div>
                            </div>

                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                            <div class="div-title">Redistribute</div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Connected</label>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="eigrp_connected" id="eigrp_connected" <?php echo ((empty($eigrp[0]['connected'])) ? '' : (($eigrp[0]['connected']) ? 'checked' : '')) ; ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">RIP</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="eigrp_rip" id="eigrp_rip" <?php echo ((empty($eigrp[0]['rip'])) ? '' : (($eigrp[0]['rip']) ? 'checked' : '')) ; ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">OSPF</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="eigrp_ospf" id="eigrp_ospf" <?php echo ((empty($eigrp[0]['ospf'])) ? '' : (($eigrp[0]['ospf']) ? 'checked' : '')) ; ?>>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label">Static</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" name="eigrp_static" id="eigrp_static" <?php echo ((empty($eigrp[0]['static'])) ? '' : (($eigrp[0]['static']) ? 'checked' : '')) ; ?>>                                          
                                </div>
                            </div>

                            
                        <!-------------------------------------------------------------------------------------------------------------------------------------->

                        <button type="submit" class="btn btn-control btn-primary float-right">Apply</button>

                        <?php echo form_close(); ?>

                    </div>
                    

                </div>

            </div>

        </div>

    </div>

</div>



<style type="text/css">

    #tblbgpneighbors tr:nth-child(even) {background-color: #FFF;}
    #tblbgpneighbors tbody tr:hover{background-color: #FFF;}

    #tblbgpnetworks tr:nth-child(even) {background-color: #FFF;}
    #tblbgpnetworks tbody tr:hover{background-color: #FFF;}

    #tbleigrpneighbors tr:nth-child(even) {background-color: #FFF;}
    #tbleigrpneighbors tbody tr:hover{background-color: #FFF;}

    #tbleigrpnetworks tr:nth-child(even) {background-color: #FFF;}
    #tbleigrpnetworks tbody tr:hover{background-color: #FFF;}

    table.table td a {cursor: pointer;display: inline-block;}    

	table.table td .add {display: none;}
    
</style>

<script type="text/javascript">

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

	$('[data-toggle="tooltip"]').tooltip();

    //////////////////////////////////////////////////////////////////////////////////

	//var actions = $("#tblbgpneighbors td:last-child").html();

    var actions = '<a class="add btn-grid"><i class="fas fa-plus"></i></a>\n' +
                '<a class="edit btn-grid"><i class="fas fa-pencil-alt"></i></a>\n' +
                '<a class="delete btn-grid"><i class="fas fa-trash-alt"></i></a>\n';

	// Append table with add row form on add new button click
    $(".add-new-bgp-neighbors").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("#tblbgpneighbors tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="bgp_neighbors_ip" id="bgp_neighbors_ip"></td>' +
            '<td><input type="text" class="form-control" name="bgp_neighbors_remote_as" id="bgp_neighbors_remote_as"></td>' +
			'<td>\n' + actions + '</td>' +
        '</tr>';
    	$("#tblbgpneighbors").append(row);		
		$("#tblbgpneighbors tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });

    //////////////////////////////////////////////////////////////////////////////////

	// Add row on add button click
	$(document).on("click", ".add", function(){

		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');

        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});

		$(this).parents("tr").find(".error").first().focus();

		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new-bgp-neighbors").removeAttr("disabled");
		}

        alert('hi');
        get_bgp_neighbors_data();	

    });

    //////////////////////////////////////////////////////////////////////////////////

	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new-bgp-neighbors").attr("disabled", "disabled");
    });

	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		$(".add-new-bgp-neighbors").removeAttr("disabled");

        get_bgp_neighbors_data();

    });

    //////////////////////////////////////////////////////////////////////////////////

    function get_bgp_neighbors_data() {
  
        var bgp_neighbors_ip = "";  
        var remote_as = "";  

        $('#tblbgpneighbors tbody>tr').each(function () {  

            var $tds = $(this).find('td');

            bgp_neighbors_ip += $tds.eq(0).text() + ",";
            remote_as += $tds.eq(1).text() + ",";
            
        });  

        bgp_neighbors_ip = bgp_neighbors_ip.slice(0,-1)
        remote_as = remote_as.slice(0,-1)

        $("#txt_bgp_neighbors_ip").val(bgp_neighbors_ip);
        $("#txt_bgp_remote_as").val(remote_as);

        //alert(bgp_neighbors_ip);
        //alert(remote_as);

    }

    //////////////////////////////////////////////////////////////////////////////////

    var i=<?php echo $z-1 ?>;

	$('#add_bgp_network').click(function(){
		i++;
		$('#tblbgpnetworks').append('<tr id="row-bgp-networks'+i+'"><td width="20%"></td><td><input type="text" name="bgp_network_ip_mask[]" class="form-control" /></td><td><button type="button" name="remove" data-0="'+i+'" class="btn-control btn-secondary btn_bgp_network_remove"><i class="fa fa-times"></i></button></td></tr>');
	});
	
	$(document).on('click', '.btn_bgp_network_remove', function(){
		var button_id = $(this).attr("data-0"); 
		$('#row-bgp-networks'+button_id+'').remove();
	});

    //////////////////////////////////////////////////////////////////////////////////

    var k=<?php echo $y-1 ?>;

    $('#add-eigrp-neighbors').click(function(){
        k++;
        $('#tbleigrpneighbors').append('<tr id="row-eigrp-neighbors'+k+'"><td width="20%"></td><td><input type="text" name="eigrp_neighbor_ip[]" class="form-control" /></td><td><button type="button" name="remove" data-0="'+k+'" class="btn-control btn-secondary btn_eigrp_neighbor_remove"><i class="fa fa-times"></i></button></td></tr>');
    });

    $(document).on('click', '.btn_eigrp_neighbor_remove', function(){
		var button_id = $(this).attr("data-0"); 
		$('#row-eigrp-neighbors'+button_id+'').remove();
	});

    //////////////////////////////////////////////////////////////////////////////////

    var j=<?php echo $x-1 ?>;

	$('#add-eigrp-networks').click(function(){
		j++;
		$('#tbleigrpnetworks').append('<tr id="row-eigrp-networks'+j+'"><td width="20%"></td><td><input type="text" name="eigrp_network_ip_mask[]" class="form-control" /></td><td><button type="button" name="remove" data-0="'+j+'" class="btn-control btn-secondary btn_eigrp_network_remove"><i class="fa fa-times"></i></button></td></tr>');
	});
	
	$(document).on('click', '.btn_eigrp_network_remove', function(){
		var button_id = $(this).attr("data-0"); 
		$('#row-eigrp-networks'+button_id+'').remove();
	});
	
});
</script>
