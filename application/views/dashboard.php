<div id="page-content-wrapper">

    <div class="container-fluid p-2">

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
        
        <div class="row page-header">
            <div class="col-md-12">
                <h6 class="page-title d-inline-block"><strong>Dashboard</strong><?php echo ' - ' . 'SN MAIN' ?></h6>
                <span class="sub-title"><?php echo 'ipaddress' . ' - ' . 'username' ?></span>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 pr-1">

                <div class="chart">

                    <h6 class="chart-title">CPU</h6>
                    <div id="gauge-cpu"></div>
                    
                </div>

            </div>

            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 pl-1 pr-1">

                <div class="chart">

                    <h6 class="chart-title">MEMORY</h6>
                    <div id="gauge-memory"></div>
                    
                </div>

            </div>

            <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 pl-1 pr-1">

                <div class="chart">

                    <h6 class="chart-title">DISK</h6>
                    <div id="gauge-disk"></div>
                    
                </div>

            </div>

        </div>

        <div class="row mb-2">

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3 pr-1">

                <div class="chart">

                    <h6 class="chart-title">SYSTEM INFORMATION</h6>

                    <?php 

                        echo $sys_info;

                    ?>
                       
                </div>

                <div class="chart">

                    <h6 class="chart-title">INTERFACES</h6>

                    <div id="interface_status_data">
                    <?php 

                        echo str_replace("APP_BASE_URL",base_url(),$interface_status); 
                        
                    ?>
                    </div>
                       
                </div>

                <div class="chart">

                    <h6 class="chart-title">SERVICES STATUS</h6>

                    <?php 

                        echo $service_status;
                        
                    ?>
                 
                </div>

            </div>

            

            <!-- <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9 pl-1">

                <?php

                $colcnt=0;

                foreach($all_interfaces as $key=>$value) { 

                    if ($colcnt==0) {

                        echo '<div class="row">';

                    }

                ?>

                <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="chart">

                        <h6 class="chart-title"><?php echo strtoupper(trim($value)) ?></h6>
                        <div id="<?php echo trim($value) ?>" style="height: 200px;"></div>

                        <div class="row justify-content-center chart-legend">

                            <div class="col-xs-12 col-sm-12 col-md-1"> 

                                <div class="row chart-legend-title">
                                    <div class="col">&nbsp;</div>
                                </div>

                                <div class="row chart-legend-title">
                                    <div class="col"><div id="<?php echo trim($value) . '-tx-legend' ?>"></div></div>                                       
                                </div>

                                <div class="row chart-legend-title">
                                    <div class="col"><div id="<?php echo trim($value) . '-rx-legend' ?>"></div></div>                                       
                                </div>

                            </div> 

                            <div class="col-xs-12 col-sm-12 col-md-10">  

                                <div class="row chart-legend-title">
                                    <div class="col">Min</div>
                                    <div class="col">Max</div>
                                    <div class="col">Avg</div>
                                    <div class="col">Current</div>
                                    <div class="col">Total</div>
                                </div>

                                <div class="row chart-legend-value">
                                    <div class="col"><div id="<?php echo trim($value) . '-tx-min' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-tx-max' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-tx-avg' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-tx-current' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-tx-total' ?>"></div></div>
                                </div>

                                <div class="row chart-legend-value">
                                    <div class="col"><div id="<?php echo trim($value) . '-rx-min' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-rx-max' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-rx-avg' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-rx-current' ?>"></div></div>
                                    <div class="col"><div id="<?php echo trim($value) . '-rx-total' ?>"></div></div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php

                    $colcnt=$colcnt+12;
                                                    
                        if ($colcnt==12) {

                            echo '</div>';
                            $colcnt=0;

                        }

                }

                if (($colcnt>0) && ($colcnt<12)) {

                    echo '</div>';
                    $colcnt=0;

                }

                ?>


            </div>  -->

        </div>

    </div>

</div>

<script>

    var g_cpu;
    var g_memory;
    var g_disk;

    function roundoff(a){
        roundOff = (Math.round(a * 100.0) / 100.0);
        return roundOff;
    }

    function bits2byte(y) {

        var sizes = ['bytes', 'Kbps', 'Mbps', 'Gbps', 'Tbps'];

        if (y == 0) return '0';
        var i = parseInt(Math.floor(Math.log(y) / Math.log(1024)));
        if (i == 0) return y + ' ' + sizes[i];
        if (i > 0) {
            return (y / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i]; 
        } else {
            return (y / Math.pow(1024, i)).toFixed(1) + ' ' + 'bits'; 
        }
    }

    var interface_status = function () {

        var post_url = "<?php echo site_url() ?>DashboardController/get_interface_status"
        var dataString = ''

        var chart_element='';
        var chart_json_string='';

        $.ajax(
        {
            type: "POST",
            url: post_url,
            data: dataString,
            dataType: "json",
            cache: false,

            success: function(interface_status)
            {
                
                interface_status = interface_status.toString().replace(/APP_BASE_URL/g, "<?php echo base_url(); ?>");
                $('#interface_status_data').html(interface_status);
                //console.log(interface_status);
                                        
            } //end success
                    
        }); //end AJAX

        setTimeout(interface_status, 600);  

    }; 

    var sys_usage = function () {

        var post_url = "<?php echo site_url() ?>DashboardController/get_sys_usage"
        var dataString = ''
        
        var chart_element='';
        var chart_json_string='';

        $.ajax(
        {
            type: "POST",
            url: post_url,
            data: dataString,
            dataType: "json",
            cache: false,

            success: function(sys_usage)
            {                
                g_cpu.refresh(sys_usage[0].trim().slice(0, -1));
                g_memory.refresh(sys_usage[1].trim().slice(0, -1));
                g_disk.refresh(sys_usage[2].trim().slice(0, -1));             
                                          
            } //end success
                    
        }); //end AJAX

        setTimeout(sys_usage, 600);  
    }; 

    var interface_traffic = function () {
        
        var post_url = "<?php echo site_url() ?>DashboardController/get_interface"
        var dataString = ''
        
        var chart_element='';
        var chart_json_string='';
        
        $.ajax(
        {
            type: "POST",
            url: post_url,
            data: dataString,
            dataType: "json",
            cache: false,

            success: function(interface_traffic)
            {
                
                $.each(interface_traffic,function(i,interface_traffic)                 
                {        
                    
                    //alert(interface_traffic);
                    var post_url_interface = "<?php echo site_url() ?>DashboardController/get_interface_traffic"
                    var dataString_interface = 'interface_name=' + interface_traffic.trim()

                    var chart_json_string = '';

                    $.ajax(
                    {

                    type: "POST",
                    url: post_url_interface,
                    data: dataString_interface,
                    dataType: "json",
                    cache: false,

                        success: function(TXRX_Interface_Traffic) //we're calling the response json array 'nwdevicestatus'
                        {

                            // console.log(TXRX_Interface_Traffic['results'][0]['series'][0]['values']);
                            // console.log(TXRX_Interface_Traffic['results'][1]['series'][0]['values']);
                            //console.log(TXRX_Interface_Traffic['results'][2]['series'][0]['values'][0]);
                            //console.log(TXRX_Interface_Traffic['results'][3]['series'][0]['values'][0]);

                            tx=TXRX_Interface_Traffic['results'][0]['series'][0]['values'];
                            rx=TXRX_Interface_Traffic['results'][1]['series'][0]['values'];

                            document.getElementById(interface_traffic.trim() + '-tx-min').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][2]['series'][0]['values'][0][1]));
                            document.getElementById(interface_traffic.trim() + '-tx-max').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][2]['series'][0]['values'][0][2]));
                            document.getElementById(interface_traffic.trim() + '-tx-avg').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][2]['series'][0]['values'][0][3]));
                            document.getElementById(interface_traffic.trim() + '-tx-current').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][2]['series'][0]['values'][0][4]));
                            document.getElementById(interface_traffic.trim() + '-tx-total').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][2]['series'][0]['values'][0][5]));

                            document.getElementById(interface_traffic.trim() + '-rx-min').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][3]['series'][0]['values'][0][1]));
                            document.getElementById(interface_traffic.trim() + '-rx-max').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][3]['series'][0]['values'][0][2]));
                            document.getElementById(interface_traffic.trim() + '-rx-avg').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][3]['series'][0]['values'][0][3]));
                            document.getElementById(interface_traffic.trim() + '-rx-current').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][3]['series'][0]['values'][0][4]));
                            document.getElementById(interface_traffic.trim() + '-rx-total').innerHTML = bits2byte(roundoff(TXRX_Interface_Traffic['results'][3]['series'][0]['values'][0][5]));

                            var dt=new Date();

                            for (var i=0;i<rx.length;i++) {

                                var d = new Date(rx[i][0]);
                                var n = d.toTimeString();
                                var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();

                                //dt = Date(rx[i][0]);

                                chart_json_string += '{"time":"' + time + '","tx":' + tx[i][1] + ',"rx":' + rx[i][1] + '},'

                                //console.log(time,rx[i][1],tx[i][1]);

                            }

                            chart_json_string = '[' + chart_json_string.substring(0, chart_json_string.length - 1) + ']';
                            //console.log(chart_json_string);
                            var acct_regs =  $.parseJSON(chart_json_string);

                            $('#' + interface_traffic.trim()).empty();

                            var data = acct_regs,
                            config = {
                                data: data,
                                xkey: 'time',
                                ykeys: ['tx', 'rx'],
                                labels: ['Send', 'Receive'],
                                fillOpacity: 1.0,
                                hideHover: 'auto',
                                behaveLikeLine: true,
                                resize: true,
                                yLabelFormat: function(y){ var sizes = ['bytes', 'Kbps', 'Mbps', 'Gbps', 'Tbps'];
                                        if (y == 0) return '0';
                                        var i = parseInt(Math.floor(Math.log(y) / Math.log(1024)));
                                        if (i == 0) return y + ' ' + sizes[i];
                                        if (i > 0) {
                                            return (y / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i]; 
                                        } else {
                                            return (y / Math.pow(1024, i)).toFixed(1) + ' ' + 'bits'; 
                                        }
                                    },
                                //pointFillColors:['#ffffff'],
                                // pointStrokeColors: ['black'],
                                lineColors:['#ffc623','#00A0DF'],
                                parseTime: false,
                                verticalGrid: true,
                                verticalGridType: '-',
                                dataLabels:false,
                                lineWidth:1,
                                pointSize:1,
                                pointSizeGrow:1,
                                numLines: 4,
                                animate: false,
                                xLabelAngle:60,
                                smooth:true,
                                gridTextColor:['#000'],
                                gridTextSize:11
                            };

                        config.element = interface_traffic.trim();
                        var chart=Morris.Area(config);

                        // Legend for Bar chart
                        chart.options.labels.forEach(function(label, i) {

                            var legend_label = ['tx', 'rx'];

                            var legendItem = $('<span class="legend-item"></span>').text('            ' + label).prepend('<span class="legend-color" style="border:1px #D5D5D5 solid;">&nbsp;&nbsp;&nbsp;&nbsp;</span>');
                            legendItem.find('span').css('backgroundColor', chart.options.lineColors[i]);

                            $('#' + interface_traffic.trim() + '-' + legend_label[i] + '-legend').empty();
                            $('#' + interface_traffic.trim() + '-' + legend_label[i] + '-legend').append(legendItem) // ID pf the legend div declared above
                        });

                        } //end success

                    }); //end AJAX

                });
                                    
            } //end success

        }); //end AJAX
        
        setTimeout(interface_traffic, 600);  
    }; 

    $(document).ready(function()
    {

        g_cpu = new JustGage({
            id: "gauge-cpu",
            value: <?php echo $this->utility->chop_last_char($sys_usage[0]); ?>,
            decimals: true,
            decimals: 2,
            min: 0,
            max: 100,
            symbol: "%",
            pointer: true,
                pointerOptions: {
                toplength: -15,
                bottomlength: 5,
                bottomwidth: 6,
                color: '#8e8e93',
                stroke: '#ffffff',
                stroke_width: 3,
                stroke_linecap: 'round'
                },
            gaugeWidthScale: 0.7,
            // counter: true,
            label: "CPU"
        });

        g_memory = new JustGage({
            id: "gauge-memory",
            value: <?php echo $this->utility->chop_last_char($sys_usage[1]); ?>,
            decimals: true,
            decimals: 2,
            min: 0,
            max: 100,
            symbol: "%",
            pointer: true,
                pointerOptions: {
                toplength: -15,
                bottomlength: 5,
                bottomwidth: 6,
                color: '#8e8e93',
                stroke: '#ffffff',
                stroke_width: 3,
                stroke_linecap: 'round'
                },
            gaugeWidthScale: 0.7,
            // counter: true,
            label: "MEMORY"
        });

        g_disk = new JustGage({
            id: "gauge-disk",
            value: <?php echo $this->utility->chop_last_char($sys_usage[2]); ?>,
            decimals: true,
            decimals: 2,
            min: 0,
            max: 100,
            symbol: "%",
            pointer: true,
                pointerOptions: {
                toplength: -15,
                bottomlength: 5,
                bottomwidth: 6,
                color: '#8e8e93',
                stroke: '#ffffff',
                stroke_width: 3,
                stroke_linecap: 'round'
                },
            gaugeWidthScale: 0.7,
            // counter: true,
            label: "DISK"
        });

        sys_usage();
        interface_status();
        //interface_traffic();
        
    });

</script>



