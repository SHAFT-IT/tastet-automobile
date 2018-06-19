jQuery(document).ready(function () {
    window.setTimeout(function() {
            jQuery("#jsvm_autohidealert").fadeTo(500, 0).slideUp(500, function(){
                jQuery(this).remove();
           });
    }, 5000);   
     // Call block for all the #
    jQuery("body").delegate('a[href="#"]', "click", function (event) {
        event.preventDefault();
    });
    // Check boxess multi-selection
    jQuery('#jsvm_selectall').click(function (event) {
        if (this.checked) {
            jQuery('.jsvehiclemanager-cb').each(function () {
                this.checked = true;
            });
        } else {
            jQuery('.jsvehiclemanager-cb').each(function () {
                this.checked = false;
            });
        }
    });
    //submit form with anchor
    jQuery("a.jsvm_multioperation").click(function (e) {
        e.preventDefault();
        var total = jQuery('.jsvehiclemanager-cb:checked').size();
        if (total > 0) {
            var task = jQuery(this).attr('data-for');
            if (task.toLowerCase().indexOf("remove") >= 0) {
                if (confirmdelete(jQuery(this).attr('confirmmessage')) == true) {
                    jQuery("input#task").val(task);
                    jQuery("form#jsvehiclemanager-list-form").submit();
                }
            } else {
                jQuery("input#task").val(task);
                jQuery("form#jsvehiclemanager-list-form").submit();
            }
        } else {
            var message = jQuery(this).attr('message');
            alert(message);
        }
    });
    
    //submit form with anchor
    jQuery("a.jsvm_multioperation-frontend").click(function (e) {
        e.preventDefault();
        var total = jQuery('.jsvehiclemanager-cb:checked').size();
        if (total > 0) {
            var task = jQuery(this).attr('data-for');
            var formid = jQuery(this).attr('data-formid');
            if (task.toLowerCase().indexOf("removemulti") >= 0) {
                if (confirmdelete(jQuery(this).attr('confirmmessage')) == true) {
                    jQuery("input#task").val(task);
                    jQuery("form#"+formid).submit();
                }
            }
        } else {
            var message = jQuery(this).attr('message');
            alert(message);
        }
    });

    jsvehiclemanagerPopupLink();
    jQuery("img#jsvm_popup_cross").click(function () {
        jsvehiclemanagerClosePopup();
    });
    jQuery("div#jsvm_jsauto-popup-background").click(function () {
        jsvehiclemanagerClosePopup();
    });
});

function jsvehiclemanagerPopupLink() {
    jQuery('a.jsvehiclemanager-popup').click(function (e) {
        e.preventDefault();
    });
}

function confirmdelete(message) {
    if (confirm(message) == true) {
        return true;
    } else {
        return false;
    }
}


function jsvehiclemanagerClosePopup() {
    jQuery("div#jsvehiclemanager-popup").slideUp();
    jQuery("div#jsvehiclemanager-listpopup").slideUp();
    setTimeout(function () {
    jQuery("div#jsvehiclemanager-popup-background").hide();
        jQuery("div#jsvehiclemanager-popup").html(' ');
    }, 350);
}


function jsvm_showloading(){
    jQuery('div#jsvm_ajaxloaded_wait_overlay').show();
    jQuery('img#jsvm_ajaxloaded_wait_image').show();
}
function jsvm_hideloading(){
    jQuery('div#jsvm_ajaxloaded_wait_overlay').hide();
    jQuery('img#jsvm_ajaxloaded_wait_image').hide();
}


function emailverify(email) {
    var emailParts = email.toLowerCase().split('@');
    if (emailParts.length == 2) {
        regex = /^[a-zA-Z0-9.!#$%&‚Äô*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        return regex.test(email)
    }
    return false;
}

function getDataForDepandantField(parentf, childf, type) {
    if (type == 1) {
        var val = jQuery("select#" + parentf).val();
    } else if (type == 2) {
        var val = jQuery("input[name=" + parentf + "]:checked").val();
    }
    jQuery.post(common.ajaxurl, {action: 'jsvehiclemanager_ajax', jsvmme: 'fieldordering', task: 'DataForDepandantField', fvalue: val, child: childf}, function (data) {
        if (data) {
            var d = jQuery.parseJSON(data);
            jQuery("select#" + childf).replaceWith(d);
        }
    });
}

function deleteCutomUploadedFile (field1) {
    jQuery("input#"+field1).val(1);
    jQuery("span."+field1).hide();
    
}

function fillSpaces(string) {
    string = string.replace(" ", "%20");
    return string;
}




    function closePopup(){        
        jQuery('div#jsvehiclemanager-pop-transparent').slideUp(function(){
            jQuery('div.jsvehiclemanager-pop-body-content-hid').hide();
        }); 
    }
    function closePopupFromOverlay(event){
        if( event.target.id == "jsvehiclemanager-pop-transparent" ){
            closePopup();
        }
    }

/*common popup funcitons end*/

