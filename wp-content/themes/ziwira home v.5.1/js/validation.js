jQuery(function($){
    $(document).ready(function(){



      function validation_products_groups(element,fieldtype){
        if(fieldtype=='file'){
            var validationTitleval = $(element).parent().parent().parent().parent().siblings('.prod-name').find("input:text").val();
            if(validationTitleval != '')
              return true;
            else
              return false;
        }else{
          var validationFileval = $(element).parent().parent().siblings('.prod-image').find("input:file").val();
          if(validationFileval != '')
            return true;
          else
            return false;
        }
      }
      $.validator.addClassRules({
          gnr_group_class:{
          gnrGroupCheck: true
        },
        company_group_class:{
          companyGroupCheck: true
        },
        products_group_class:{
          productsGroupCheck: true
        },
        validate_number:{
          number: true
        },
        check_only_url:{
          url: true
        },
        email: {
        required: true,
        email: true
        },
        c_email: {
                  required: true,
                  equalTo: "#email",
                  minlength: 5
            },
        product_title_group1:{
          required: function (element) {
            return validation_products_groups(element,'title');
          }
        },
        product_file_group1:{
          required: function (element) {
            return validation_products_groups(element,'file');
          }
        },
        product_title_group2:{
          required: function (element) {
            return validation_products_groups(element,'title');
          }
        },
        product_file_group2:{
          required: function (element) {
            return validation_products_groups(element,'file');
          }
        },
        product_title_group3:{
          required: function (element) {
            return validation_products_groups(element,'title');
          }
        },
        product_file_group3:{
          required: function (element) {
            return validation_products_groups(element,'file');
          }
        }
      });

      $.validator.addMethod("gnrGroupCheck", function (value, element) {

        var gnrGroupCheck_length = $('input.gnr_group_class:checked').length;
        $('#group-checkbox-error').remove();
        if(gnrGroupCheck_length > 0){
         $('.gnr_group_class label.error').remove();
         return true;
        }
        else{
          $('.gnr_group_class label.error').remove();
          $(element).parent().parent().append('<label id="group-checkbox-error" class="error" for="" style="display: inline-block;">Please check at least one checkbox</label>');
         return false;
        }

      }, 'error');

      $.validator.addMethod("companyGroupCheck", function (value, element) {
        var companyGroupCheck_length = $('input.company_group_class:checked').length;
        $('#companygroup-checkbox-error').remove();
        if(companyGroupCheck_length > 0){
         $('.company_group_class label.error').remove();
         return true;
        }
        else{
          $('.company_group_class label.error').remove();
          $(element).parent().parent().append('<label id="companygroup-checkbox-error" class="error" for="" style="display: inline-block;">Please check at least one checkbox</label>');
         return false;
        }

      }, 'error');

      $.validator.addMethod("productsGroupCheck", function (value, element) {
        var companyGroupCheck_length = $('input.products_group_class:checked').length;
        $('#productsgroup-checkbox-error').remove();
        if(companyGroupCheck_length > 0){
         $('.products_group_class label.error').remove();
         return true;
        }
        else{
          $('.products_group_class label.error').remove();
          $(element).parent().parent().append('<label id="productsgroup-checkbox-error" class="error" for="" style="display: inline-block;">Please check at least one checkbox</label>');
         return false;
        }

      }, 'error');




      $("#gb_reg__form").validate({
        rules: {
            "password": {
	                required: true,
	                //alphanumeric: true,
	                rangelength: [8, 20]
	            }
        },
        messages: {
	            "password": {
	                //alphanumeric: "Login format not valid",
	                rangelength: "Password length should be minimum 8 and maximum 20"
	            }
	        },
        errorPlacement: function(error, element) {

          if(element.attr("name") == "company-logo") {
            error.appendTo( $(element).parent().parent().append(error) );
          } else if($(element).parent().parent().parent().parent().siblings('.prod-name').find("input").hasClass("product_title_groups")){
            error.appendTo($(element).parent().parent().parent().parent().parent('li').find('.prod-image').append(error));
          } else {
    			     $(element).parent().append(error);
          }
    		},

      });
      $("#gb_reg__form").validate({
        rules: {
          "password": {
	                required: true,
	                //alphanumeric: true,
	                rangelength: [8, 20]
	            }
        },
        messages: {
	            "password": {
	                //alphanumeric: "Login format not valid",
	                rangelength: "Password length should be minimum 8 and maximum 20"
	            }
	        },
        errorPlacement: function(error, element) {
          if(element.attr("name") == "company-logo") {
            error.appendTo( $(element).parent().parent().append(error) );
          } else {
    			$(element).parent().append(error);
          }
    		},

      });


    });

$("#article_submission_form").validate({
        rules: {
          "required": {
                  required: true,
                  //alphanumeric: true,
                  //rangelength: [8, 20]
              },
          "maxlength-req-120":{
            required: true,
            maxlength: 120
          },
          "maxlength-req-400":{
            required: true,
            maxlength: 120
          }
        }
      });


});


