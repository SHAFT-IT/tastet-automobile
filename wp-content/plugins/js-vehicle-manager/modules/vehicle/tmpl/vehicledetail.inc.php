<?php 
$rand_id = rand();

?>
<script type="text/javascript">

	/*
	jsvehiclemanager_pop_vehicleid
	global variable defined with popup functions in common.js
	*/

	jQuery(document).ready(function(){
		jQuery("img.jsvehiclemanager-vehcileimage").click(function(){
	        var imgnum = jQuery(this).attr("data-imagenumber");
            if(imgnum >= 0){
                jQuery("li.jsvehiclemanager_slid-img").picEyes({
                    "fuelgage": "<?php echo CAR_MANAGER_IMAGE.'/light-box-milage.png';?>",
                    "transmission": "<?php echo CAR_MANAGER_IMAGE.'/light-box-transmission.png';?>",
                    "fueltype": "<?php echo CAR_MANAGER_IMAGE.'/light-box-fuel.png';?>",
                });
                jQuery('li img[data-imagenumber="'+imgnum+'"]').click();
            }
	    });
	})

</script>