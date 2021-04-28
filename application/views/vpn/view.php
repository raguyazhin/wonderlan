<div id="page-content-wrapper">

    <div class="container-fluid p-2">

    <!-- <div id="mainContainer" class="clearfix"></div> -->

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">VPN</li>
            </ol>
        </nav>

        <div class="row page-header">
            <div class="col-md-12">
                <h6 class="page-title d-inline-block"><strong>VPN</strong><?php echo ' - ' . 'SN MAIN' ?></h6>
                <span class="sub-title"><?php echo 'ipaddress' . ' - ' . 'username' ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-openvpn-tab" data-toggle="pill" href="#pills-openvpn" role="tab" aria-controls="pills-openvpn" aria-selected="true">Open VPN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-ipsecvpn-tab" data-toggle="pill" href="#pills-ipsecvpn" role="tab" aria-controls="pills-ipsecvpn" aria-selected="false">IP Sec VPN</a>
                    </li>                
                </ul>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-openvpn" role="tabpanel" aria-labelledby="pills-openvpn-tab">
                        <div class="row">
                            <div class="col-2 pr-1">
                                <div class="list-group list-group-flush" id="list-tab" role="tablist">

                                    <?php if($host_data[0]['host_type'] == "SERVER") { ?>
                                        <a class="list-group-item list-group-item-action active" id="list-ca-list" data-toggle="list" href="#list-ca" role="tab" aria-controls="ca">Certificate Authority<i class="fa fa-chevron-right"></i></a>
                                        <a class="list-group-item list-group-item-action" id="list-srvc-list" data-toggle="list" href="#list-srvc" role="tab" aria-controls="srvc">Server Certificate<i class="fa fa-chevron-right"></i></a>
                                        <a class="list-group-item list-group-item-action" id="list-clic-list" data-toggle="list" href="#list-clic" role="tab" aria-controls="clic">Client Certificate<i class="fa fa-chevron-right"></i></a>
                                    <?php } else { ?>
                                        <a class="list-group-item list-group-item-action active" id="list-ucli-list" data-toggle="list" href="#list-ucli" role="tab" aria-controls="ucli">Upload Client Package<i class="fa fa-chevron-right"></i></a>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="col-10 pl-1">
                                <div class="tab-content" id="nav-tabContent">

                                <?php if($host_data[0]['host_type'] == "SERVER") { ?>

                                    <div class="tab-pane fade show active" id="list-ca" role="tabpanel" aria-labelledby="list-ca-list">
                                        
                                        <div class="row page-sub-header">
                                            <div class="col-md-12 pb-1">
                                                <h6 class="page-sub-title d-inline-block"><strong>Certificate Authority</strong></h6>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_ca_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Add new Certificate Authority</a>
                                            </div>           
                                        </div>

                                        <table class="table" id="ca">
                                            <thead>
                                                <tr>
                                                    <th scope="col">CA Name</th>
                                                    <th scope="col">Key Length</th>
                                                    <th scope="col">Digest Algorithm</th>
                                                    <th scope="col">Lifetime (Days)</th>
                                                    <th scope="col">Country Code</th>
                                                    <th scope="col">State or province</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Organization</th>
                                                    <th scope="col">Organization Unit</th>
                                                    <th scope="col">Email Address</th>
                                                    <th scope="col">Common Name</th>
                                                    <th scope="col">Actions</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($ca as $row){ ?>

                                                    <tr>
                                                        <td><?php echo $row['ca_name'] ?></td>
                                                        <td><?php echo $row['key_length'] ?></td>
                                                        <td><?php echo $row['digest_algorithm'] ?></td>
                                                        <td><?php echo $row['life_time'] ?></td>
                                                        <td><?php echo $row['country_code'] ?></td>
                                                        <td><?php echo $row['state_province'] ?></td>
                                                        <td><?php echo $row['city'] ?></td>
                                                        <td><?php echo $row['organization'] ?></td>
                                                        <td><?php echo $row['organization_unit'] ?></td>
                                                        <td><?php echo $row['email_address'] ?></td>
                                                        <td><?php echo $row['common_name'] ?></td> 
                                                        <td>
                                                            <a class="btn-grid edit_record" href="javascript:void(0)" 
                                                            data-0="<?php echo $row['ca_name'] ?>" 
                                                            data-1="<?php echo $row['key_length'] ?>" 
                                                            data-2="<?php echo $row['digest_algorithm'] ?>" 
                                                            data-3="<?php echo $row['life_time'] ?>" 
                                                            data-4="<?php echo $row['country_code'] ?>"
                                                            data-5="<?php echo $row['state_province'] ?>" 
                                                            data-6="<?php echo $row['city'] ?>" 
                                                            data-7="<?php echo $row['organization'] ?>"
                                                            data-8="<?php echo $row['organization_unit'] ?>"
                                                            data-9="<?php echo $row['email_address'] ?>"
                                                            data-10="<?php echo $row['common_name'] ?>" 
                                                            role="button"><i class="far fa-edit"></i></a>
                                                            <a class="btn-grid delete_record" href="javascript:void(0)" 
                                                            data-0="<?php echo $row['ca_name'] ?>"  
                                                            role="button"><i class="far fa-trash-alt"></i></a>
                                                        </td>                               
                                                    </tr>
                                                    
                                                <?php } ?>
                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="list-srvc" role="tabpanel" aria-labelledby="list-srvc-list">

                                        <div class="row page-sub-header">
                                            <div class="col-md-12 pb-1">
                                                <h6 class="page-sub-title d-inline-block"><strong>Server Certificate</strong></h6>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_srvc_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Add new Server Certificate</a>
                                            </div>           
                                        </div>

                                        <table class="table" id="srvc">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Certificate Name</th>
                                                    <th scope="col">Port</th>
                                                    <th scope="col">Protocol</th>
                                                    <th scope="col">Tunnel Type</th>
                                                    <th scope="col">Tunnel Name</th>
                                                    <th scope="col">Mode</th>
                                                    <th scope="col">Authentication</th>
                                                    <th scope="col">Cipher</th>
                                                    <th scope="col">Tunnel Network</th>
                                                    <th scope="col">Local Network</th> 
                                                    <th scope="col">Ceriticate Authority</th> 
                                                    <th scope="col">Actions</th>                             
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach($srvc as $row){ ?>

                                                    <tr>
                                                        <td><?php echo $row['srvc_name'] ?></td>
                                                        <td><?php echo $row['port'] ?></td>
                                                        <td><?php echo $row['protocol'] ?></td>
                                                        <td><?php echo $row['tunnel_type'] ?></td>
                                                        <td><?php echo $row['tunnel_name'] ?></td>
                                                        <td><?php echo $row['mode'] ?></td>
                                                        <td><?php echo $row['authentication'] ?></td>
                                                        <td><?php echo $row['cipher'] ?></td>
                                                        <td><?php echo $row['tunnel_network'] ?></td>
                                                        <td><?php echo $row['local_network'] ?></td>
                                                        <td><?php echo $row['ca_name'] ?></td>
                                                        <td>
                                                            <a class="btn-grid edit_record" href="javascript:void(0)" 
                                                            data-0="<?php echo $row['srvc_name'] ?>" 
                                                            data-1="<?php echo $row['port'] ?>" 
                                                            data-2="<?php echo $row['protocol'] ?>" 
                                                            data-3="<?php echo $row['tunnel_type'] ?>" 
                                                            data-4="<?php echo $row['tunnel_name'] ?>"
                                                            data-5="<?php echo $row['mode'] ?>" 
                                                            data-6="<?php echo $row['authentication'] ?>" 
                                                            data-7="<?php echo $row['cipher'] ?>"
                                                            data-8="<?php echo $row['tunnel_network'] ?>"
                                                            data-9="<?php echo $row['local_network'] ?>"
                                                            data-10="<?php echo $row['ca_name'] ?>" 
                                                            role="button"><i class="far fa-edit"></i></a>
                                                            <a class="btn-grid delete_record" href="javascript:void(0)" 
                                                            data-0="<?php echo $row['srvc_name'] ?>"  
                                                            role="button"><i class="far fa-trash-alt"></i></a>
                                                        </td>                               
                                                    </tr>
                                                    
                                                <?php } ?>

                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="tab-pane fade" id="list-clic" role="tabpanel" aria-labelledby="list-clic-list">

                                        <div class="row page-sub-header">
                                            <div class="col-md-12 pb-1">
                                                <h6 class="page-sub-title d-inline-block"><strong>Client Certificate</strong></h6>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#add_clic_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-plus"></span> Add new Client Certificate</a>                                                                                               
                                            </div>           
                                        </div>

                                        <table class="table" id="clic">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Client Certificate</th>
                                                    <th scope="col">Port</th>
                                                    <th scope="col">Protocol</th>
                                                    <th scope="col">Tunnel Type</th>
                                                    <th scope="col">Tunnel Name</th>
                                                    <th scope="col">Remote Peer</th>
                                                    <th scope="col">Authentication</th>
                                                    <th scope="col">Cipher</th>
                                                    <th scope="col">Tunnel Network</th>
                                                    <th scope="col">Client Local Network</th> 
                                                    <th scope="col">Server Certificate</th> 
                                                    <th scope="col">Server Local Network</th> 
                                                    <th scope="col">Actions</th>                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($clic as $row){ ?>

                                                    <tr>
                                                        <td><?php echo $row['clic_name'] ?></td>
                                                        <td><?php echo $row['port'] ?></td>
                                                        <td><?php echo $row['protocol'] ?></td>
                                                        <td><?php echo $row['tunnel_type'] ?></td>
                                                        <td><?php echo $row['tunnel_name'] ?></td>
                                                        <td><?php echo $row['remote_peer'] ?></td>
                                                        <td><?php echo $row['authentication'] ?></td>
                                                        <td><?php echo $row['cipher'] ?></td>
                                                        <td><?php echo $row['tunnel_network'] ?></td>
                                                        <td><?php echo $row['cli_local_network'] ?></td>
                                                        <td><?php echo $row['srvc_name'] ?></td>
                                                        <td><?php echo $row['srv_local_network'] ?></td>
                                                        <td>
                                                            <a class="btn-grid" href="http://<?php echo $host_data[0]['ip_address'] .'/' . $project_name  . '/vpn_client_bundle/' . $row['clic_name'] . '.zip' ?>" role="button" download><i class="fa fa-download"></i></a>
                                                            <a class="btn-grid edit_record" href="javascript:void(0)" 
                                                            data-0="<?php echo $row['clic_name'] ?>" 
                                                            data-1="<?php echo $row['port'] ?>" 
                                                            data-2="<?php echo $row['protocol'] ?>" 
                                                            data-3="<?php echo $row['tunnel_type'] ?>" 
                                                            data-4="<?php echo $row['tunnel_name'] ?>"
                                                            data-5="<?php echo $row['remote_peer'] ?>" 
                                                            data-6="<?php echo $row['authentication'] ?>" 
                                                            data-7="<?php echo $row['cipher'] ?>"
                                                            data-8="<?php echo $row['tunnel_network'] ?>"
                                                            data-9="<?php echo $row['cli_local_network'] ?>"
                                                            data-10="<?php echo $row['srvc_name'] ?>" 
                                                            data-11="<?php echo $row['srv_local_network'] ?>" 
                                                            role="button"><i class="far fa-edit"></i></a>
                                                            <a class="btn-grid delete_record" href="javascript:void(0)" 
                                                            data-0="<?php echo $row['clic_name'] ?>" 
                                                            data-1="<?php echo $row['srvc_name'] ?>"  
                                                            role="button"><i class="far fa-trash-alt"></i></a>                                        
                                                        </td>                               
                                                    </tr>

                                                <?php } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                <?php } else { ?>

                                    <div class="tab-pane fade show active" id="list-ucli" role="tabpanel" aria-labelledby="list-ucli-list">

                                        <div class="row page-sub-header">
                                            <div class="col-md-12 pb-1">
                                                <h6 class="page-sub-title d-inline-block"><strong>Upload Clients</strong></h6>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#upload_clic_modal" class="btn btn-control btn-secondary float-right"><span class="fas fa-upload"></span> Upload Client Certificate</a>                                                                                         
                                            </div>           
                                        </div>

                                        <table class="table" id="upload_clic">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Client Certificate</th>
                                                    <th scope="col">Server Certificate</th>
                                                    <th scope="col">Table ID</th>
                                                    <th scope="col">Uploaded on</th>
                                                    <th scope="col">Actions</th>                             
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($upload_clic as $row){ ?>

                                                    <tr>

                                                        <td><?php echo $row['clic_name'] ?></td>
                                                        <td><?php echo $row['srvc_name'] ?></td>
                                                        <td><?php echo $row['ip_table_id'] ?></td>
                                                        <td><?php echo $row['uploaded_on'] ?></td>
                                                        <td>
                                                            <a class="btn-grid delete_record" href="javascript:void(0)" 
                                                            data-0="<?php echo $row['clic_name'] ?>" 
                                                            data-1="<?php echo $row['srvc_name'] ?>"  
                                                            role="button"><i class="far fa-trash-alt"></i></a>                                        
                                                        </td>                               
                                                    </tr>

                                                <?php } ?>

                                            </tbody>

                                        </table>

                                    </div>

                                <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-ipsecvpn" role="tabpanel" aria-labelledby="pills-ipsecvpn-tab">
                        Comming Soon...
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

<!------------------------------------------------------------->

<form id="add_ca" method="post">

    <div class="modal right fade" id="add_ca_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Add</strong> Certificate Authority</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-4">CA Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="ca_name" name="ca_name" required placeholder="CA Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Key length (bits)</label>
                        <div class="col-sm-3">
                            <select id="ca_key_length" name="ca_key_length" required class="form-control">
                                <option value="2048" selected>2048</option>
                                <option value="4096">4096</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Digest Algorithm</label>
                        <div class="col-sm-3">
                            <select id="ca_digest_algorithm" name="ca_digest_algorithm" required class="form-control">
                                <option value="sha256">sha256</option>                          
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Lifetime (days)</label>
                        <div class="col-sm-3">
                            <select id="ca_life_time" name="ca_life_time" required class="form-control">
                                <option value="1080">1080</option>
                                <option value="3650">3650</option>                           
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Country Code</label>
                        <div class="col-sm-2">
                            <select id="ca_country_code" name="ca_country_code" required class="form-control">
                                <option value="IN">IN</option>
                                <option value="US">US</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">State or Province</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ca_state_province" name="ca_state_province" required placeholder="State or Province (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">City</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ca_city" name="ca_city" required placeholder="City (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Organization</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ca_organization" name="ca_organization" required placeholder="Organization (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Organization Unit</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ca_organization_unit" name="ca_organization_unit" placeholder="OU (Optional)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Email Address</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="ca_email_address" name="ca_email_address" required placeholder="Email Address (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Common Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ca_common_name" name="ca_common_name" required placeholder="Common Name (Required)">
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

<form id="update_ca" method="post">

    <div class="modal right fade" id="update_ca_modal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit</strong> Certificate Authority</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                    <label  class="col-sm-4">CA Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="edit_ca_name" name="edit_ca_name" required placeholder="CA Name (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Key length (bits)</label>
                        <div class="col-sm-3">
                            <select id="edit_ca_key_length" name="edit_ca_key_length" required class="form-control">
                                <option value="2048" selected>2048</option>
                                <option value="4096">4096</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Digest Algorithm</label>
                        <div class="col-sm-3">
                            <select id="edit_ca_digest_algorithm" name="edit_ca_digest_algorithm" required class="form-control">
                                <option value="sha256">sha256</option>                          
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Lifetime (days)</label>
                        <div class="col-sm-3">
                            <select id="edit_ca_life_time" name="edit_ca_life_time" required class="form-control">
                                <option value="1080">1080</option>
                                <option value="3650">3650</option>                           
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Country Code</label>
                        <div class="col-sm-2">
                            <select id="edit_ca_country_code" name="edit_ca_country_code" required class="form-control">
                                <option value="IN">IN</option>
                                <option value="US">US</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">State or Province</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_ca_state_province" name="edit_ca_state_province" required placeholder="State or Province (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">City</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_ca_city" name="edit_ca_city" required placeholder="City (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Organization</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_ca_organization" name="edit_ca_organization" required placeholder="Organization (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Organization Unit</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_ca_organization_unit" name="edit_ca_organization_unit" placeholder="OU (Optional)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Email Address</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="edit_ca_email_address" name="edit_ca_email_address" required placeholder="Email Address (Required)">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Common Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="edit_ca_common_name" name="edit_ca_common_name" required placeholder="Common Name (Required)">
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

<form id="delete_ca" method="post">

    <div class="modal fade" id="delete_ca_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Delete</strong> Certificate Authority</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="del_ca" id="del_ca" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            
            </div>

        </div>
    </div>

</form>

<!------------------------------------------------------------->

<form id="add_srvc" method="post">

    <div class="modal right fade" id="add_srvc_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Add</strong> Server Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-4">Certificate Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="srvc_name" name="srvc_name" required placeholder="Certificate Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Port</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="srvc_port" name="srvc_port" required placeholder="Eg. 1194">
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Protocol</label>
                        <div class="col-sm-3">
                            <select id="srvc_protocol" name="srvc_protocol" required class="form-control">
                                <option value="udp" selected>udp</option>
                                <option value="tcp-server">tcp server</option>
                                <option value="tcp-client">tcp client</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Type</label>
                        <div class="col-sm-3">
                            <select id="srvc_tuntype" name="srvc_tuntype" required class="form-control">
                                <option value="tun" selected>tun</option>
                                <option value="tap">tap</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="srvc_tunname" name="srvc_tunname">
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Authentication</label>
                        <div class="col-sm-5">
                            <select id="srvc_authentication" name="srvc_authentication" required class="form-control">
                                <option value="sha256">sha256</option>                          
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Cipher</label>
                        <div class="col-sm-5">
                            <select id="srvc_cipher" name="srvc_cipher" required class="form-control">
                                <option value="AES-256-CBC">AES-256-CBC</option>                          
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Network</label>
                        <div class="col-sm-5">
                        <input type="text" class="form-control" id="srvc_tunnet" name="srvc_tunnet" required placeholder="10.0.0.0/24">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Local Network</label>
                        <div class="col-sm-5">
                        <!-- <input type="text" class="form-control" id="srvc_locnet" name="srvc_locnet" required placeholder="10.0.0.0/24"> -->
                        <input type="text" class="form-control" id="srvc_locnet" name="srvc_locnet" data-role="tagsinput" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Certificate Authority</label>
                        <div class="col-sm-6">
                            <select id="srvc_ca_name" name="srvc_ca_name" required class="form-control">
                                <?php foreach($ca as $row) { echo '<option value="' . $row['ca_name'] . '">' . $row['ca_name'] . '</option>'; }?>                       
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

<form id="update_srvc" method="post">

    <div class="modal right fade" id="update_srvc_modal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit</strong> Server Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-4">Certificate Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="edit_srvc_name" name="edit_srvc_name" readonly required placeholder="Certificate Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Port</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="edit_srvc_port" name="edit_srvc_port" required placeholder="Eg. 1194">
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Protocol</label>
                        <div class="col-sm-3">
                            <select id="edit_srvc_protocol" name="edit_srvc_protocol" required class="form-control">
                                <option value="udp" selected>udp</option>
                                <option value="tcp-server">tcp server</option>
                                <option value="tcp-client">tcp client</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Type</label>
                        <div class="col-sm-3">
                            <select id="edit_srvc_tuntype" name="edit_srvc_tuntype" required class="form-control">
                                <option value="tun" selected>tun</option>
                                <option value="tap">tap</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="edit_srvc_tunname" name="edit_srvc_tunname">
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Authentication</label>
                        <div class="col-sm-5">
                            <select id="edit_srvc_authentication" name="edit_srvc_authentication" required class="form-control">
                                <option value="sha256">sha256</option>                          
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Cipher</label>
                        <div class="col-sm-5">
                            <select id="edit_srvc_cipher" name="edit_srvc_cipher" required class="form-control">
                                <option value="AES-256-CBC">AES-256-CBC</option>                          
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Network</label>
                        <div class="col-sm-5">
                        <input type="text" class="form-control" id="edit_srvc_tunnet" name="edit_srvc_tunnet" required placeholder="10.0.0.0/24">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Local Network</label>
                        <div class="col-sm-5">
                        <!-- <input type="text" class="form-control" id="edit_srvc_locnet" name="edit_srvc_locnet" required placeholder="10.0.0.0/24"> -->
                        <input type="text" class="form-control" id="edit_srvc_locnet" name="edit_srvc_locnet" data-role="tagsinput" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Certificate Authority</label>
                        <div class="col-sm-6">
                            <select id="edit_srvc_ca_name" name="edit_srvc_ca_name" required class="form-control">
                                <?php foreach($ca as $row) { echo '<option value="' . $row['ca_name'] . '">' . $row['ca_name'] . '</option>'; }?>                       
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

<form id="delete_srvc" method="post">

    <div class="modal fade" id="delete_srvc_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Delete</strong> Server Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="del_srvc" id="del_srvc" class="form-control">    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            
            </div>

        </div>
    </div>

</form>

<!------------------------------------------------------------->

<form id="add_clic" method="post">

    <div class="modal right fade" id="add_clic_modal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Add</strong> Client Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-4">Certificate Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="clic_name" name="clic_name" required placeholder="Certificate Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Server Certificate</label>
                        <div class="col-sm-6">
                            <select id="clic_srvc_name" name="clic_srvc_name" required class="form-control">
                                <?php foreach($srvc as $row) { echo '<option value="' . $row['srvc_name'] . '">' . $row['srvc_name'] . '</option>'; }?>                       
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Protocol</label>
                        <div class="col-sm-3">
                            <select id="clic_protocol" name="clic_protocol" required class="form-control">
                                <option value="udp" selected>udp</option>
                                <option value="tcp-client">tcp client</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="clic_tunname" name="clic_tunname">
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Remote Peer IP</label>
                        <div class="col-sm-5">
                        <input type="text" class="form-control" id="clic_remotepeer" name="clic_remotepeer" required placeholder="0.0.0.0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Local Network</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="clic_locnet" name="clic_locnet" data-role="tagsinput" required>
                            <!-- <input type="text" class="form-control" id="clic_locnet" name="clic_locnet" required placeholder="10.0.0.0/24"> -->
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

<form id="update_clic" method="post">

    <div class="modal right fade" id="update_clic_modal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Edit</strong> Client Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">  

                    <div class="form-group row">
                        <label  class="col-sm-4">Certificate Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="edit_clic_name" name="edit_clic_name" readonly required placeholder="Certificate Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Server Certificate</label>
                        <div class="col-sm-6">
                            <select id="edit_clic_srvc_name" name="edit_clic_srvc_name" required class="form-control">
                                <?php foreach($srvc as $row) { echo '<option value="' . $row['srvc_name'] . '">' . $row['srvc_name'] . '</option>'; }?>                       
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4">Protocol</label>
                        <div class="col-sm-3">
                            <select id="edit_clic_protocol" name="edit_clic_protocol" required class="form-control">
                                <option value="udp" selected>udp</option>
                                <option value="tcp-client">tcp client</option>
                            </select>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Tunnel Name</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="edit_clic_tunname" name="edit_clic_tunname">
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Remote Peer IP</label>
                        <div class="col-sm-5">
                        <input type="text" class="form-control" id="edit_clic_remotepeer" name="edit_clic_remotepeer" required placeholder="0.0.0.0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Local Network</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="edit_clic_locnet" name="edit_clic_locnet" data-role="tagsinput" required>
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

<form id="delete_clic" method="post">

    <div class="modal fade" id="delete_clic_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Delete</strong> Client Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="del_clic" id="del_clic" class="form-control">
                    <input type="hidden" name="del_clic_srvc" id="del_clic_srvc" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            
            </div>

        </div>
    </div>

</form>

<!------------------------------------------------------------->

    <div class="modal fade" id="upload_clic_modal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><strong>Upload</strong> Client Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                
                    <div id="upload_clic_wizard">

                        <ul>
                            <li><a href="#upload_cli_pack">Step 1<br /><small>Upload Client Package</small></a></li>
                            <li><a href="#update_local_ip">Step 2<br /><small>Update Local IP Address</small></a></li>
                            <li><a href="#cli_route">Step 3<br /><small>Write Client Route</small></a></li>
                        </ul>

                        <div class="pt-2">

                            <div id="upload_cli_pack" class="">

                                <form id="frm_upload_clic_package" method="post" enctype="multipart/form-data">

                                    <div class="form-group row">
                                        
                                        <div class="col-md-8">
                                            <div class="file-upload">
                                                <div class="file-select">
                                                    <div class="file-select-button" id="fileName">Choose File</div>
                                                    <div class="file-select-name" id="noFile">No file chosen...</div> 
                                                    <input type="file" name="client_upload_file" id="client_upload_file">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <button type="submit" name="subform" class="btn btn-secondary upload-btn" value="save">Upload</button>  
                                        </div> 

                                    </div> 
                                
                                </form>

                            </div>

                            <div id="update_local_ip" class="">
                              
                                <form id="frm_update_local_ip" method="post" enctype="multipart/form-data">

                                    <div class="form-group row">
                                        <label  class="col-sm-3">Interface</label>
                                        <div class="col-sm-3">
                                            <select id="update_local_ip_interface" name="update_local_ip_interface" required class="form-control">
                                                <?php foreach($all_interfaces as $key=>$value) { echo '<option value="' . $value . '">' . $value . '</option>'; }?>                   
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3">Server Certficate</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="update_local_ip_serv_cert" name="update_local_ip_serv_cert" readonly required>
                                        </div>                                       
                                    </div>

                                    <div class="form-group row">
                                        <label  class="col-sm-3">Client Certficate</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="update_local_ip_clic_cert" name="update_local_ip_clic_cert" readonly required>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>

                                </form>

                            </div>

                            <div id="cli_route" class="">
                                <textarea class="form-control" rows="5" id="client_route" name="client_route"></textarea>
                            </div>

                        </div>

                    </div>

                </div>
                
            </div>

        </div>
    </div>

<style>
    #upload_clic_wizard .nav-item {
        line-height: 1.5;
    }
</style>

<script>

    ///////////////////////////////////////////////////////////////////////////////

    $(document).ready(function(){

        $('#ca').DataTable({});

        $('#srvc').DataTable({});

        $('#clic').DataTable({
            "scrollX": true
        }); 


        $('#upload_clic').DataTable({});

        $('a[data-toggle="list"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');

        if(activeTab){
            $('#list-tab a[href="' + activeTab + '"]').tab('show');
        }

        if($("#noFile").text() === 'No file chosen...'){
            $('.upload-btn').prop("disabled", true)
        }

        $('#upload_clic_wizard').smartWizard({
            selected: 0,
            theme: 'dots',
            transitionEffect:'fade',
            showStepURLhash: false
        });

    });

    ///////////////////////////////////////////////////////////////////////////////

    $('#ca .edit_record').on('click', function() {
       
        var ca_name = $(this).attr('data-0');
        var key_length = $(this).attr('data-1');
        var digest_algorithm = $(this).attr('data-2');
        var life_time = $(this).attr('data-3');
        var country_code = $(this).attr('data-4');
        var state_province = $(this).attr('data-5');
        var city = $(this).attr('data-6');
        var organization = $(this).attr('data-7');
        var organization_unit = $(this).attr('data-8');
        var email_address = $(this).attr('data-9');
        var common_name = $(this).attr('data-10');

        $('#edit_ca_name').val(ca_name);
        $("#edit_ca_key_length").val(key_length).change();
        $("#edit_ca_digest_algorithm").val(digest_algorithm).change();
        $("#edit_ca_life_time").val(life_time).change();
        $("#edit_ca_country_code").val(country_code).change();
        $('#edit_ca_state_province').val(state_province);
        $('#edit_ca_city').val(city);
        $('#edit_ca_organization').val(organization);
        $('#edit_ca_organization_unit').val(organization_unit);
        $('#edit_ca_email_address').val(email_address);
        $('#edit_ca_common_name').val(common_name);

        $('#update_ca_modal').modal('show');

    });

    $('#ca .delete_record').on('click', function() {

        var ca_name = $(this).attr('data-0');
        $('#del_ca').val(ca_name);
        $('#delete_ca_modal').modal('show');

    });

    $('#add_ca').on('submit', function (e) {
        e.preventDefault();
        var str = $("#add_ca").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/add_ca",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#add_ca")[0].reset();
                    $('#add_ca_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to add Certificate Authority !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    $('#update_ca').on('submit', function (e) {
        e.preventDefault();
        var str = $("#update_ca").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/edit_ca",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#update_ca")[0].reset();
                    $('#update_ca_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to update Certificate Authority !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    $('#delete_ca').on('submit', function (e) {
        e.preventDefault();
        var str = $("#delete_ca").serialize();
        //alert(str);
        $.ajax({
            url : "<?php echo site_url() ?>/VPNController/delete_ca",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#delete_ca")[0].reset();
                    $('#delete_ca_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to delete Certificate Authority !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    ///////////////////////////////////////////////////////////////////////////////

    $('#srvc .edit_record').on('click', function() {
       
       var srvc_name = $(this).attr('data-0');
       var port = $(this).attr('data-1');
       var protocol = $(this).attr('data-2');
       var tuntype = $(this).attr('data-3');
       var tunname = $(this).attr('data-4');
       var authentication = $(this).attr('data-6');
       var cipher = $(this).attr('data-7');
       var tunnet = $(this).attr('data-8');
       var locnet = $(this).attr('data-9');
       var caname = $(this).attr('data-10');

       $('#edit_srvc_name').val(srvc_name);
       $("#edit_srvc_port").val(port);
       //$("#edit_srvc_port").val(port).change();
       $("#edit_srvc_protocol").val(protocol).change();
       $("#edit_srvc_tuntype").val(tuntype).change();
       $("#edit_srvc_tunname").val(tunname);
       $('#edit_srvc_authentication').val(authentication).change();
       $('#edit_srvc_cipher').val(cipher).change();
       $('#edit_srvc_tunnet').val(tunnet);
       $('#edit_srvc_locnet').tagsinput('add', locnet);
       $('#edit_srvc_ca_name').val(caname).change();

       $('#update_srvc_modal').modal('show');

    });

    $('#srvc .delete_record').on('click', function() {

       var srvc_name = $(this).attr('data-0');
       $('#del_srvc').val(srvc_name);
       $('#delete_srvc_modal').modal('show');

    });

    $('#add_srvc').on('submit', function (e) {
        e.preventDefault();
        var str = $("#add_srvc").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/add_srvc",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#add_srvc")[0].reset();
                    $('#add_srvc_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to add Server Certificate !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    $('#update_srvc').on('submit', function (e) {
        e.preventDefault();
        var str = $("#update_srvc").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/edit_srvc",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                alert(response);
                if (response) {
                    $("#update_srvc")[0].reset();
                    $('#update_srvc_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to update Server Certificate !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });

        // $("#loader").ajaxStop(function(){
        //     $(this).hide();
        // });

    });

    $('#delete_srvc').on('submit', function (e) {
        e.preventDefault();
        var str = $("#delete_srvc").serialize();
        //alert(str);
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/delete_srvc",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#delete_srvc")[0].reset();
                    $('#delete_srvc_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to delete Server Certificate !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    ///////////////////////////////////////////////////////////////////////////////

    $('#clic .edit_record').on('click', function() {
       
       var clic_name = $(this).attr('data-0');
       var protocol = $(this).attr('data-2');
       var tunname = $(this).attr('data-4');
       var remotepeer = $(this).attr('data-5');
       var locnet = $(this).attr('data-9');
       var srvc_name = $(this).attr('data-10');

       $('#edit_clic_name').val(clic_name);
       $("#edit_clic_protocol").val(protocol).change();
       $("#edit_clic_tunname").val(tunname);
       $("#edit_clic_remotepeer").val(remotepeer);
       $('#edit_clic_locnet').tagsinput('add', locnet);
       $('#edit_clic_srvc_name').val(srvc_name).change();

       $('#update_clic_modal').modal('show');

    });

    $('#clic .delete_record').on('click', function() {

       var clic_name = $(this).attr('data-0');
       var srvc_name = $(this).attr('data-1');

       $('#del_clic').val(clic_name);
       $('#del_clic_srvc').val(srvc_name);

       $('#delete_clic_modal').modal('show');

    });

    $('#add_clic').on('submit', function (e) {
       e.preventDefault();
       var str = $("#add_clic").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/add_clic",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#add_clic")[0].reset();
                    $('#add_clic_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to add Client Certificate !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
       });
    });

    $('#update_clic').on('submit', function (e) {
       e.preventDefault();
       var str = $("#update_clic").serialize();
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/edit_clic",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#update_clic")[0].reset();
                    $('#update_clic_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to update Client Certificate !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
       });
    });

    $('#delete_clic').on('submit', function (e) {
        e.preventDefault();
        var str = $("#delete_clic").serialize();
        //alert(str);
        $.ajax({
            url : "<?php echo site_url() ?>/VPNController/delete_clic",
            data : str,
            type : 'post',
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            success : function(response) {
                if (response) {
                    $("#delete_clic")[0].reset();
                    $('#delete_clic_modal').modal('hide');
                    location.reload();
                } else {
                    alert("Failed to delete Client Certificate !");
                    return false;
                }
            },
            complete:function(data){
                // Hide image container
                $("#loader").hide();
            }
        });
    });

    ///////////////////////////////////////////////////////////////////////////////

    $('#frm_upload_clic_package').on('submit', function(e){
		e.preventDefault();
        $.ajax({
            url:"<?php echo base_url();?>VPNController/upload_client_package", 
            method:"POST",
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success:function(data)
            {
                if(data){
                    //console.log(data);
                    var arr_out = JSON.parse(data).split(',');
                    $('#update_local_ip_serv_cert').val(arr_out[0]);
                    $('#update_local_ip_clic_cert').val(arr_out[1]);
                    $('#upload_clic_wizard').smartWizard("next");
                }
            }
        });

    });

    ///////////////////////////////////////////////////////////////////////////////

    $('#frm_update_local_ip').on('submit', function(e){
        e.preventDefault();
        var str = $("#frm_update_local_ip").serialize();
        //alert(str);
        $.ajax({
            url : "<?php echo site_url() ?>VPNController/update_local_ip_address",
            data : str,
            type : 'post',
            success:function(data){
                if (data) {
                    alert(data);
                    $('#client_route').val(JSON.parse(data));
                    $('#upload_clic_wizard').smartWizard("next");
                } else {
                    alert(JSON.parse(data));
                    return false;
                }
            }
        });
    });   

    ///////////////////////////////////////////////////////////////////////////////

    $('#client_upload_file').bind('change', function () {
        var filename = $("#client_upload_file").val();
        if (/^\s*$/.test(filename)) {
            $(".file-upload").removeClass('active');
            $("#noFile").text("No file chosen..."); 
            $('.upload-btn').prop("disabled", true)  
        }
        else {
            $(".file-upload").addClass('active');
            $("#noFile").text(filename.replace("C:\\fakepath\\", ""));  
            $('.upload-btn').prop("disabled", false)           
        }
    });

</script>