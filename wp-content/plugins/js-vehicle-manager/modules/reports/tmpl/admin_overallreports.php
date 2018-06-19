<?php
if(!defined('ABSPATH'))
    die('Restricted Access');
?>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>

<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    
    google.setOnLoadCallback(drawStackChart);
    function drawStackChart() {
      var data = google.visualization.arrayToDataTable([
        <?php echo jsvehiclemanager::$_data['conditions']; ?>
      ]);

      var view = new google.visualization.DataView(data);
      var options = {
        width: '95%',
        legend: {position: 'none'},
        bar: { groupWidth: '75%' },
        isStacked: true,
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("stack_chart"));
      chart.draw(view, options);
    }   
    
    google.setOnLoadCallback(drawPie3d2Chart);
    function drawPie3d2Chart() {
        var data = google.visualization.arrayToDataTable([                  
            <?php echo jsvehiclemanager::$_data['vehicletypes']; ?>
        ]);

        var options = {
          title: '<?php echo __('vehicle by vehicle types','js-vehicle-manager'); ?>',
          chartArea :{width:450,height:350,top:80,left:80},
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie3d_chart2'));
        chart.draw(data, options);
    }   
    google.setOnLoadCallback(drawSliceChart);
    function drawSliceChart() {
      var data = google.visualization.arrayToDataTable([
        <?php echo jsvehiclemanager::$_data['makes']; ?>
      ]);

      var options = {
        pieSliceText: 'label',
        legend : {position: 'left'},
        chartArea : {width:700,height:400},
        slices: { 2: {offset: 0.1},
                  4: {offset: 0.2},
                  5: {offset: 0.3},
        },
      };

      var chart = new google.visualization.PieChart(document.getElementById('slice_chart'));
      chart.draw(data, options);
    }
    
    google.setOnLoadCallback(drawSliceChart2);
    function drawSliceChart2() {
      var data = google.visualization.arrayToDataTable([
        <?php echo jsvehiclemanager::$_data['fueltype']; ?>
      ]);

      var options = {
        title: '<?php echo __('Vehicles by fuel types','js-vehicle-manager'); ?>',
        pieHole: 0.4,
        chartArea :{width:450,height:350,top:80,left:80},
      };
      var chart = new google.visualization.PieChart(document.getElementById('slice_chart2'));
      chart.draw(data, options);
    }

  google.setOnLoadCallback(drawPie3d1Chart);
  function drawPie3d1Chart() {
        var data = google.visualization.arrayToDataTable([
          <?php echo jsvehiclemanager::$_data['transmission']; ?>
        ]);

        var options = {
          title: '<?php echo __('Vehicles by transmission','js-vehicle-manager'); ?>',
          chartArea :{width:450,height:350,top:80,left:80},
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie3d_chart1'));
        chart.draw(data, options);
    }

</script>    
<div id="jsvehiclemanageradmin-wrapper">
    <div id="jsvehiclemanageradmin-leftmenu">
        <?php JSVEHICLEMANAGERincluder::getClassesInclude('jsvehiclemanageradminsidemenu'); ?>
    </div>
    <div id="jsvehiclemanageradmin-data">
        <span class="jsvm_js-admin-title">
            <a class="jsvm_js-admin-title-left" href="<?php echo admin_url('admin.php?page=jsvehiclemanager'); ?>"><img src="<?php echo jsvehiclemanager::$_pluginpath; ?>includes/images/back-icon.png" />
                <?php echo __('Overall Reports', 'js-vehicle-manager'); ?>
            </a>
        </span>
        <div id="js-vehicle-managergraph-wrap">
            <div class="jsvehiclemanager-garap-title jsvm_back-color-1"><?php echo __('Vehicles By Makes' , 'js-vehicle-manager'); ?></div>
            <div class="js-vehicle-managergraph-divcss" style="height:500px;" id="slice_chart"></div>
        </div>  
        <div class="js-vehicle-manager-fullwidthwrap">
            <div class="js-vehicle-manager-halfwidth-graph">
                <div id="js-vehicle-managergraph-wrap">
                    <div class="jsvehiclemanager-garap-title jsvm_back-color-2"><?php echo __('Vehicles By Conditions' , 'js-vehicle-manager'); ?></div>
                    <div class="js-vehicle-managergraph-divcss" style="height:400px;" id="stack_chart"></div>
                </div>  
            </div>
            <div class="js-vehicle-manager-halfwidth-graph">
                <div id="js-vehicle-managergraph-wrap">
                    <div class="jsvehiclemanager-garap-title jsvm_back-color-3"><?php echo __('Vehicles By Types' , 'js-vehicle-manager'); ?></div>
                    <div class="js-vehicle-managergraph-divcss" style="height:400px;" id="pie3d_chart2"></div>
                </div>  
            </div>
        </div>
        <div class="js-vehicle-manager-fullwidthwrap">
          <div class="js-vehicle-manager-halfwidth-graph">
            <div id="js-vehicle-managergraph-wrap">
              <div class="jsvehiclemanager-garap-title jsvm_back-color-4"><?php echo __('Vehicles By Transmission' , 'js-vehicle-manager'); ?></div>
              <div class="js-vehicle-managergraph-divcss" style="height:400px;" id="pie3d_chart1"></div>
            </div>  
          </div>
          <div class="js-vehicle-manager-halfwidth-graph">
            <div id="js-vehicle-managergraph-wrap">
              <div class="jsvehiclemanager-garap-title jsvm_back-color-5"><?php echo __('Vehicles By Fuel types' , 'js-vehicle-manager'); ?></div>
              <div class="js-vehicle-managergraph-divcss" style="height:400px;" id="slice_chart2"></div>
            </div>  
          </div>
        </div>
    </div>
</div>