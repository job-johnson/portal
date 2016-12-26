 jQuery(document).ready(function($){
 $(".rates_left input:radio").change(function () {
 var id = $( this ).val();
  var name = $( this ).attr('name');

    var data = {
    action: 'sop_checkout_action',
    security : zebutech.security,
    cartpriceid: id,
     request_from:'product_view'
    
  };

  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  $.post(zebutech.ajaxurl, data, function(response) {
 //     alert(response);
    //  var removeZeo = response.replace("}0",'}');
    var obj = JSON.parse(response);
     //console.log(obj.result);
         if(response !=''){
       // console.log(response);
         //  alert(response);
         //var data =
         //alert(obj.subtotal);
       if(obj.website_ads !==null){
       $("#website-preview-block").html(obj.website_ads);}
   if(obj.magazine_ads !==null){
       $("#magazine-preview-block").html(obj.magazine_ads);
   }
       $("#subtotal_prview22").html(obj.subtotal);
         $("#tax_total").html(obj.tax);
        $("#grand_total_preview").html(obj.grandtotal);
      
   }
   
    //alert('Got this from the server: ' + response);
  });
  
});


$("#basic").change(function () {

  var id = $( this ).val();
  var name = $( this ).attr('name');

    var data = {
    action: 'sop_checkout_action',
    security : zebutech.security,
    taxId: id,
    request_from:'tax_on_change'
  };

  $.post(zebutech.ajaxurl, data, function(response) {
    //  alert(response);
    //  var removeZeo = response.replace("}0",'}');
    var obj = JSON.parse(response);
    // alert(obj.tax);
     //console.log(obj.result);
         if(response !=''){
       // console.log(response);
         //var data =
         //alert(obj.subtotal);
       $("#tax_total").html(obj.tax);
        $("#grand_total_preview").html(obj.grandtotal_taxed);
   }

    //alert('Got this from the server: ' + response);
  });

});

$("#checkout-btn").live( "click", function() {


var data = {
    action: 'sop_checkout_paypal_action',
    security : zebutech.security

  };

  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
  $.post(zebutech.ajaxurl, data, function(response) {
      var obj = JSON.parse(response);
      if(obj.error !=''){
          alert(obj.error);
      }else{
   var actionForm = $('<form>', {'action': 'https://www.paypal.com/cgi-bin/webscr', 'method': 'post'}).append(obj.html);
actionForm.appendTo("body").submit();
//actionForm.submit();
      }
      return false;

    //alert('Got this from the server: ' + response);
  });
});

//$(".prod_remove").click(function () {




});


jQuery(".curr_flag a").live( "click", function() {
var id = jQuery( this ).attr('id');

    var data = {
    action: 'sop_currency_convert',
    security : zebutech.security,
    currency_id: id,
    request_from:'convert_currency'
  };
  
  
  jQuery.post(zebutech.ajaxurl, data, function(response) {
//      alert(response);
   
       if(response !=''){
       
if(response == 'success'){
      location.reload();
}else{
     alert(response);
}

         }
  });


});


jQuery( ".prod_remove a" ).live( "click", function() {

var id = jQuery( this ).attr('id');
    var data = {
    action: 'sop_checkout_action',
    security : zebutech.security,
    remove_id: id,
    request_from:'remove_action'
  };

   jQuery.post(zebutech.ajaxurl, data, function(response) {
      //alert(response);
    //  var removeZeo = response.replace("}0",'}');
    var obj = JSON.parse(response);
     //console.log(obj.result);
         if(response !=''){
       // console.log(response);
         //  alert(response);
         //var data =
         //alert(obj.subtotal);
       if(obj.website_ads !==null){
       jQuery("#website-preview-block").html(obj.website_ads);}
   if(obj.magazine_ads !==null){
       jQuery("#magazine-preview-block").html(obj.magazine_ads);
   }
       jQuery("#subtotal_prview22").html(obj.subtotal);
         jQuery("#tax_total").html(obj.tax);
        jQuery("#grand_total_preview").html(obj.grandtotal);
       jQuery('[value='+id+']').prop('checked', false);

   }

    //alert('Got this from the server: ' + response);
  });

});