<div id="page-content-wrapper">

    <div class="container-fluid p-2">

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Firewall</li>
            </ol>
        </nav>

        <div class="row page-header">
            <div class="col-md-12">
                <h6 class="page-title d-inline-block"><strong>Firewall</strong><?php echo ' - ' . 'SN MAIN' ?></h6>
                <span class="sub-title"><?php echo 'ipaddress' . ' - ' . 'username' ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-nat-tab" data-toggle="pill" href="#pills-nat" role="tab" aria-controls="pills-nat" aria-selected="true">NAT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-rule-tab" data-toggle="pill" href="#pills-rule" role="tab" aria-controls="pills-rule" aria-selected="false">Rule</a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link" id="pills-webfilter-tab" data-toggle="pill" href="#pills-webfilter" role="tab" aria-controls="pills-webfilter" aria-selected="false">Web Filter</a>
                    </li>                
                </ul>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-nat" role="tabpanel" aria-labelledby="pills-nat-tab">

                        <div class="row page-sub-header">
                            <div class="col-md-12 pb-3">
                                <h6 class="page-sub-title d-inline-block"><strong>NAT</strong></h6>                                   
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_snat_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Source NAT</a>                                                                                                                               
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_dnat_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Destination NAT</a>                                                                                                                               
                            </div>           
                        </div>

                        <?php 
                            
                            $ip_table_name='nat';
                            $ip_table_data=$nat;
    
                            $linecnt = sizeof($ip_table_data);
    
                            for ( $i=0; $i<$linecnt; $i++ ){
    
                                $chain_data = explode("|",$ip_table_data[$i]);     
                                                                    
                                $rowcnt = sizeof($chain_data);
    
                                if ( $rowcnt >= 4 ){
    
                                    echo '<div class="div-title-1">'.'Chain '.$chain_data[1].'</div>';
    
                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';
    
                                    $header_data = explode(" ",$chain_data[2]);      
                                    $headercnt = sizeof($header_data);
    
                                    for ( $j=0; $j<$headercnt-1; $j++ ){
                                        echo '<th scope="col">'.ucfirst($header_data[$j]).'</th>';
                                    }
    
                                    echo '<th scope="col">Remarks</th>';
                                    echo '<th scope="col">Actions</th>';
    
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
    
                                    if ( $rowcnt == 4 ){
                                        echo '<tr>';
                                        echo '<td colspan="12">No Details Available</td>';
                                        echo '</tr>';
                                    }
    
                                    for ( $j=3; $j<$rowcnt-1; $j++ ){
    
                                        $in_col_data = explode(" ",$chain_data[$j]);      
                                        $incolcnt = sizeof($in_col_data);
    
                                        echo '<tr>';
    
                                        $in_col_str='';
                                        $colcnt=$headercnt;
    
                                        for ( $k=0; $k<$incolcnt; $k++ ){
                                                            
                                            $data_str='';
                                            if ( $k < $colcnt-1 ) {
                                                if ($k == 3){
                                                    if (array_search($in_col_data[$k],$nat_target,true)){
                                                        echo '<td>'.$in_col_data[$k].'</td>';
                                                    }else{                                                            
                                                        echo '<td>--</td>'; 
                                                        echo '<td>'.$in_col_data[$k].'</td>';
                                                        $colcnt--;                                                       
                                                    }                                                        
                                                }else{
                                                    echo '<td>'.$in_col_data[$k].'</td>';
                                                }
                                            }else{
                                                $in_col_str=$in_col_str.' '.$in_col_data[$k];
                                            }
                                        }
    
                                        if ($in_col_str){
                                            echo '<td>'.$in_col_str.'</td>';
                                        }
    
                                        echo '<td>';
                                            // <a class="btn btn-sm btn-outline btn-outline-secondary edit_record" href="javascript:void(0)" role="button" ' . $data_str . '><i class="fas fa-pencil-alt"></i></a>
                                        echo '<a class="btn-grid delete_record" href="javascript:void(0)" role="button" data-0="'. $ip_table_name .'" data-1="' . explode(' ',$chain_data[1])[1] . '" data-2="' . $in_col_data[0] . '" role="button"><i class="far fa-trash-alt"></i></a>
                                        </td>';
                                        echo '</tr>';
    
                                        // echo $chain_data[$j];
                                        // echo '<br>';
                                    }
    
                                    //echo '</tr>';
                                    echo '</tbody>';
                                    echo '</table>';
    
                                }                                    
                            }
    
                        ?>

                    </div>

                    <div class="tab-pane fade" id="pills-rule" role="tabpanel" aria-labelledby="pills-rule-tab">
                  
                        <div class="row page-sub-header">
                            <div class="col-md-12 pb-3">
                                <h6 class="page-sub-title d-inline-block"><strong>Rule</strong></h6>  
                                <a href="javascript:void(0);" data-toggle="modal" data-target="##add_outbound_rule_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Add Outbound Rule</a>                                                                                                                               
                                <a href="javascript:void(0);" data-toggle="modal" data-target="##add_inbound_rule_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Add Inbound Rule</a>                                                     
                            </div>           
                        </div>

                        <?php 
                                
                            $ip_table_name='filter';
                            $ip_table_data=$filter;

                            $linecnt = sizeof($ip_table_data);

                            for ( $i=0; $i<$linecnt; $i++ ){

                                $chain_data = explode("|",$ip_table_data[$i]);     
                                                                    
                                $rowcnt = sizeof($chain_data);

                                if ( $rowcnt >= 4 ){

                                    echo '<div class="div-title-1">'.'Chain '.$chain_data[1].'</div>';

                                    echo '<table class="table">';
                                    echo '<thead>';
                                    echo '<tr>';

                                    $header_data = explode(" ",$chain_data[2]);      
                                    $headercnt = sizeof($header_data);

                                    for ( $j=0; $j<$headercnt-1; $j++ ){
                                        echo '<th scope="col">'.ucfirst($header_data[$j]).'</th>';
                                    }

                                    echo '<th scope="col">Remarks</th>';
                                    echo '<th scope="col">Actions</th>';

                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    if ( $rowcnt == 4 ){
                                        echo '<tr>';
                                        echo '<td colspan="12">No Details Available</td>';
                                        echo '</tr>';
                                    }

                                    for ( $j=3; $j<$rowcnt-1; $j++ ){

                                        $in_col_data = explode(" ",$chain_data[$j]);      
                                        $incolcnt = sizeof($in_col_data);

                                        echo '<tr>';

                                        $in_col_str='';
                                        $colcnt=$headercnt;

                                        for ( $k=0; $k<$incolcnt; $k++ ){
                                                            
                                            $data_str='';
                                            if ( $k < $colcnt-1 ) {
                                                if ($k == 3){
                                                    if (array_search($in_col_data[$k],$filter_target,true)){
                                                        echo '<td>'.$in_col_data[$k].'</td>';
                                                    }else{                                                            
                                                        echo '<td>--</td>'; 
                                                        echo '<td>'.$in_col_data[$k].'</td>';
                                                        $colcnt--;                                                       
                                                    }                                                        
                                                }else{
                                                    echo '<td>'.$in_col_data[$k].'</td>';
                                                }
                                            }else{
                                                $in_col_str=$in_col_str.' '.$in_col_data[$k];
                                            }
                                        }

                                        if ($in_col_str){
                                            echo '<td>'.$in_col_str.'</td>';
                                        }

                                        echo '<td>
                                            <a class="btn-grid edit_record" href="javascript:void(0)" role="button" ' . $data_str . '><i class="far fa-edit"></i></a>
                                            <a class="btn-grid delete_record" href="javascript:void(0)" role="button" data-0="'. $ip_table_name .'" data-1="' . explode(' ',$chain_data[1])[1] . '" data-2="' . $in_col_data[0] . '" role="button"><i class="far fa-trash-alt"></i></a>
                                        </td>';
                                        echo '</tr>';

                                        // echo $chain_data[$j];
                                        // echo '<br>';
                                    }

                                    //echo '</tr>';
                                    echo '</tbody>';
                                    echo '</table>';

                                }                                    
                            }

                        ?>

                    </div>

                    <div class="tab-pane fade" id="pills-webfilter" role="tabpanel" aria-labelledby="pills-webfilter-tab">
                  
                        <div class="row page-sub-header">
                            <div class="col-md-12 pb-3">
                                <h6 class="page-sub-title d-inline-block"><strong>Web Filter</strong></h6>                
                            </div>           
                        </div>

                    </div>
                    

                </div>

            </div>

        </div>

    </div>

</div>

<!------------------------------------------------------------->

<form id="add_dnat" method="post">

    <div class="modal right fade" id="add_dnat_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Add</strong> DNAT Rule<span style="font-size:12px;color:#9c9c9c;"> - Traffic from Outside to Inside</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  
                
                    <div class="form-group row">
                        <label class="col-sm-4">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="dnat_name" name="dnat_name">
                        </div> 
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Name of the Rule"></i>
                        </div>                           
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Interface</label>
                        <div class="col-sm-5">
                            <select id="dnat_interface" name="dnat_interface" required class="form-control">
                                <option value="" selected>Interface</option>
                                <?php foreach($all_interfaces as $key=>$value) { echo '<option value="' . $value . '">' . $value . '</option>'; }?>
                            </select>
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="WAN Interface ( Outgoing )."></i>
                        </div>    
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Protocol</label>
                        <div class="col-sm-5">
                            <select id="dnat_protocol" name="dnat_protocol" required class="form-control">
                                <option value="" selected>Protocol</option>
                                <option value="TCP">TCP</option>
                                <option value="UDP">UDP</option>
                                <option value="UDPLITE">UDP LITE</option>
                                <option value="ICMP">ICMP</option>
                                <option value="ICMPV6">ICMP V6</option>
                                <option value="AH">AH</option>
                                <option value="SCTP">SCTP</option>
                                <option value="MH">MH</option>
                                <option value="ALL">ALL</option>
                            </select>
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Match incoming traffic using the given protocol."></i>
                        </div>    
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Public IP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="dnat_public_ip" name="dnat_public_ip" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Match incoming traffic from the specified public ip address."></i>
                        </div>                    
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">LAN IP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" required id="dnat_lan_ip" name="dnat_lan_ip" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Redirect matches incomming traffic to the specified internal host"></i>
                        </div>                        
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Allowed Remote IPs</label>
                        <div class="col-sm-5">
                            <select id="dnat_source" name="dnat_remote" class="form-control">
                                <option value="ANY" selected>Any</option>
                                <option value="IPADDRESS">IP Address</option>
                                <option value="NETWORK">Network</option>
                            </select>
                        </div>
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Type of Source"></i>
                        </div> 
                    </div>

                    <div id="dnat_source_ipaddress_block" style="display: none">

                        <div class="form-group row">
                            <label  class="col-sm-4">IP Address</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="dnat_remote_ip" name="dnat_remote_ip" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                            </div>
                            <div class="col-sm-1 pl-0">
                                <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Match incoming traffic directed at the given source ip address - Format 0.0.0.0"></i>
                            </div> 
                        </div>

                    </div>

                    <div id="dnat_source_network_block" style="display: none">

                        <div class="form-group row">
                            <label class="col-sm-4">Network</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="dnat_remote_network" name="dnat_remote_network" placeholder="___.___.___.___/__" minlength="9" maxlength="18" size="18" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])+\/[0-9]{1,}$">
                            </div>
                            <div class="col-sm-1 pl-0">
                                <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Match incoming traffic directed at the given source network - Format 0.0.0.0/0"></i>
                            </div> 
                        </div>

                    </div>

                    <div class="mute-title row">
                        <div class="col-sm-4">Port Forwarding</div>
                        <div class="col-sm-1"><input type="checkbox" name="chk_dnat_port_forwarding" id="chk_dnat_port_forwarding"></div>
                    </div>

                    <div id="dnat_port_forward_block" style="display: none">

                        <div class="form-group row">
                            <label class="col-sm-4">Public Port</label>                      
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="dnat_public_port" name="dnat_public_port">
                            </div>  
                            <div class="col-sm-1 pl-0">
                                <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Map the external port - Format Single Port 1-65535,Port Range a:b where a is lesser then b and greater than 1."></i>
                            </div> 
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-4">LAN Port</label>                      
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="dnat_lan_port" name="dnat_lan_port">
                            </div>  
                            <div class="col-sm-1 pl-0">
                                <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Redirect matched incoming traffic to the given port on the internal host - Format Single Port 1-65535,Port Range a:b where a is lesser then b and greater than 1."></i>
                            </div> 
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

<form id="add_snat" method="post">

    <div class="modal right fade" id="add_snat_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Add</strong> SNAT Rule<span style="font-size:12px;color:#9c9c9c;"> - Traffic from Inside to Outside</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  
                
                    <div class="form-group row">
                        <label class="col-sm-4">Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="snat_name" name="snat_name">
                        </div> 
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Description"></i>
                        </div>                           
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Interface</label>
                        <div class="col-sm-5">
                            <select id="snat_interface" name="snat_interface" required class="form-control">
                                <option value="" selected>Interface</option>
                                <?php foreach($all_interfaces as $key=>$value) { echo '<option value="' . $value . '">' . $value . '</option>'; }?>
                            </select>
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Description"></i>
                        </div>    
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Protocol</label>
                        <div class="col-sm-5">
                            <select id="snat_protocol" name="snat_protocol" required class="form-control">
                                <option value="" selected>Protocol</option>
                                <option value="TCP">TCP</option>
                                <option value="UDP">UDP</option>
                                <option value="UDPLITE">UDP LITE</option>
                                <option value="ICMP">ICMP</option>
                                <option value="ICMPV6">ICMP V6</option>
                                <option value="AH">AH</option>
                                <option value="SCTP">SCTP</option>
                                <option value="MH">MH</option>
                                <option value="ALL">ALL</option>
                            </select>
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Description"></i>
                        </div>    
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">LAN IP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" required id="snat_lan_ip" name="snat_lan_ip" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Description"></i>
                        </div>                        
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Public IP</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="snat_public_ip" name="snat_public_ip" placeholder="___.___.___.___" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">
                        </div>  
                        <div class="col-sm-1 pl-0">
                            <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Description"></i>
                        </div>                    
                    </div>

                    <div class="mute-title row">
                        <div class="col-sm-4">Port Forwarding</div>
                        <div class="col-sm-1"><input type="checkbox" name="chk_snat_port_forwarding" id="chk_snat_port_forwarding"></div>
                    </div>

                    <div id="snat_port_forward_block" style="display: none">

                        <div class="form-group row">
                            <label class="col-sm-4">LAN Port</label>                      
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="snat_lan_port" name="snat_lan_port">
                            </div>  
                            <div class="col-sm-1 pl-0">
                                <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Description"></i>
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4">Public Port</label>                      
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="snat_public_port" name="snat_public_port">
                            </div>  
                            <div class="col-sm-1 pl-0">
                                <i class="fas fa-info-circle info-control" data-toggle="tooltip" title="Description"></i>
                            </div> 
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


<script>

    ///////////////////////////////////////////////////////////////////////////////

    $(document).ready(function(){

        $('a[data-toggle="list"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#list-tab a[href="' + activeTab + '"]').tab('show');
        }

        // jQuery.validator.addMethod("selectnic", function(value, element){
            
        //     if ($("#dnat_public_port").val()) {               
        //         return false;  // FAIL validation when REGEX matches                
        //     } else {
        //         alert(value);
        //     alert(element);
        //         return true;   // PASS validation otherwise
        //     };
        // }, "wrong nic number"); 

    });


    ///////////////////////////////////////////////////////////////////////////////

    $(function () {

        $("#chk_dnat_port_forwarding").change(function() {
            var checked = $(this).is(":checked");
            if (checked) {
                $("#dnat_port_forward_block").show();
                $('#dnat_public_port').attr("required", true); 
                $('#dnat_lan_port').attr("required", true);                 
            }else{
                $("#dnat_port_forward_block").hide(); 
                $('#dnat_public_port').removeAttr("required");
                $('#dnat_lan_port').removeAttr("required");
            }
        });
    });

    ///////////////////////////////////////////////////////////////////////////////

    $(function () {

        $("#chk_snat_port_forwarding").change(function() {
            var checked = $(this).is(":checked");
            if (checked) {
                $("#snat_port_forward_block").show();
                $('#snat_public_port').attr("required", true); 
                $('#snat_lan_port').attr("required", true);                 
            }else{
                $("#snat_port_forward_block").hide(); 
                $('#snat_public_port').removeAttr("required");
                $('#snat_lan_port').removeAttr("required");
            }
        });
    });

    ///////////////////////////////////////////////////////////////////////////////

    $(function () {

        $("#dnat_source").change(function () {

            if ($(this).val() == "IPADDRESS") {

                $("#dnat_source_ipaddress_block").show();    
                $('#dnat_source_ipaddress').attr("required", true); 

                $("#dnat_source_network_block").hide(); 
                $('#dnat_source_network').removeAttr("required");

            } else if ($(this).val() == "NETWORK") {

                $("#dnat_source_network_block").show();    
                $('#dnat_source_network').attr("required", true); 

                $("#dnat_source_ipaddress_block").hide(); 
                $('#dnat_source_ipaddress').removeAttr("required");

            } else {

                $("#dnat_source_network_block").hide(); 
                $('#dnat_source_network').removeAttr("required");

                $("#dnat_source_ipaddress_block").hide(); 
                $('#dnat_source_ipaddress').removeAttr("required");

            }

        });
    });

    ///////////////////////////////////////////////////////////////////////////////

    $(function () {

        $("#snat_source").change(function () {

            if ($(this).val() == "IPADDRESS") {

                $("#snat_source_ipaddress_block").show();    
                $('#snat_source_ipaddress').attr("required", true); 

                $("#snat_source_network_block").hide(); 
                $('#snat_source_network').removeAttr("required");

            } else if ($(this).val() == "NETWORK") {

                $("#snat_source_network_block").show();    
                $('#snat_source_network').attr("required", true); 

                $("#snat_source_ipaddress_block").hide(); 
                $('#snat_source_ipaddress').removeAttr("required");

            } else {

                $("#snat_source_network_block").hide(); 
                $('#snat_source_network').removeAttr("required");

                $("#snat_source_ipaddress_block").hide(); 
                $('#snat_source_ipaddress').removeAttr("required");

            }

        });
    });
   
    ///////////////////////////////////////////////////////////////////////////////

    // $('#add_dnat').on('submit', function (e) {

    //     e.preventDefault();
    //     var str = $("#add_dnat").serialize();
    //     $.ajax({
    //         url : "<?php echo site_url() ?>FirewallController/add_dnat",
    //         data : str,
    //         type : 'post',
    //         beforeSend: function(){
    //             // Show image container
    //             $("#loader").show();
    //         },
    //         success : function(response) {
    //             alert(response);
    //             if (response) {
    //                 $("#add_dnat")[0].reset();
    //                 $('#add_dnat_modal').modal('hide');
    //                 location.reload();
    //             } else {
    //                 alert("Failed to add DNAT !");
    //                 return false;
    //             }
    //         },
    //         complete:function(data){
    //             // Hide image container
    //             $("#loader").hide();
    //         }
    //     });
    // });

///////////////////////////////////////////////////////////////////////////////

    $("#add_dnat").validate({

        rules:{
            dnat_name:{required : true,minlength:5,maxlength:20},
            dnat_interface:{required : true},
            dnat_protocol:{required : true},
            dnat_public_port:{number : true,range: [1, 65535]},
            dnat_lan_ip:{required : true},
            dnat_lan_port:{number : true,range: [1, 65535]},
            // dnat_lan_port: {selectnic: true}
        },

        messages: {
            dnat_name:{minlength:"Description should contain atleast 5 charecters", maxlength:"Description should contain lessthan 21 charecters", required:"Please enter the Description"},
            dnat_interface:{required:"Please select the Interface"},
            dnat_protocol:{required:"Please select the Protocol"},
            dnat_public_port:{number : "Port must be a number",range:"Port must between 1 and 65535"},
            dnat_lan_ip:{required : "Please enter the LAN IP"},
            dnat_lan_port:{number : "Port must be a number",range:"Port must between 1 and 65535"},
            // dnat_lan_port:{selectnic:"invalid Lan Port"},
        },

        submitHandler: function(form){
            //e.preventDefault();
            var str = $(form).serialize();
            $.ajax({
                url : "<?php echo site_url() ?>FirewallController/add_dnat",
                data : str,
                type : 'post',
                beforeSend: function(){
                    // Show image container
                    $("#loader").show();
                },
                success : function(response) {
                    alert(response);
                    if (response) {
                        $("#add_dnat")[0].reset();
                        $('#add_dnat_modal').modal('hide');
                        location.reload();
                    } else {
                        alert("Failed to add DNAT !");
                        return false;
                    }
                },
                complete:function(data){
                    // Hide image container
                    $("#loader").hide();
                }
            });	
            return false;	
        },
    });

///////////////////////////////////////////////////////////////////////////////

    $("#add_snat").validate({

        rules:{
            snat_name:{required : true,minlength:5,maxlength:20},
            snat_interface:{required : true},
            snat_protocol:{required : true},
            snat_lan_ip:{required : true},
            snat_lan_port:{number : true,range: [0, 65353]},
            snat_public_ip:{required : true},
            snat_public_port:{number : true,range: [0, 65353]},
            // snat_lan_port: {selectnic: true}
        },

        messages: {
            snat_name:{minlength:"Description should contain atleast 5 charecters", maxlength:"Description should contain lessthan 21 charecters", required:"Please enter the Description"},
            snat_interface:{required:"Please select the Interface"},
            snat_protocol:{required:"Please select the Protocol"},
            snat_lan_ip:{required : "Please enter the LAN IP"},
            snat_lan_port:{number : "Port must be a number",range:"Port must between 0 and 65353"},
            snat_public_ip:{required : "Please enter the Public IP"},
            snat_public_port:{number : "Port must be a number",range:"Port must between 0 and 65353"},

            // snat_lan_port:{selectnic:"invalid Lan Port"},
        },

        submitHandler: function(form){
            //e.preventDefault();
            var str = $(form).serialize();
            $.ajax({
                url : "<?php echo site_url() ?>FirewallController/add_snat",
                data : str,
                type : 'post',
                beforeSend: function(){
                    // Show image container
                    $("#loader").show();
                },
                success : function(response) {
                    alert(response);
                    if (response) {
                        $("#add_snat")[0].reset();
                        $('#add_snat_modal').modal('hide');
                        location.reload();
                    } else {
                        alert("Failed to add SNAT !");
                        return false;
                    }
                },
                complete:function(data){
                    // Hide image container
                    $("#loader").hide();
                }
            });	
            return false;	
        },
    });


//     $('#myform').validate({
//     submitHandler: function(form) {
//         $.ajax({
//             url: "processo.php", 
//             type: "POST",             
//             data: new FormData($(form)),
//             cache: false,             
//             processData: false,      
//             success: function(data) {
//                 $('#loading').hide();
//                 $("#message").html(data);
//             }
//         });
//         return false;
//     },
//     // other options
// });

</script>