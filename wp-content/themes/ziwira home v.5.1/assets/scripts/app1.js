//api call for environment slider
function RemoveHTMLTags(html) {
      var regX = /(<([^>]+)>)/ig;
      return html.replace(regX, "")
}



  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=food&limit=15',
        success: function(e){
        jQuery('.news_block ul.article_listing_block').html('');
      var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= "..."; // string to place at the end when a large content is formatted
            var length = 200; // char length for the string.
            var title_length = 100; // char length for the string.
            var mob_length = 40; // char length for the string mobile.
            var slider_item_count = 15-1;
            jQuery.each(json,function(i, item){
              var shortDesc = RemoveHTMLTags(this.short_description);
              // shortDesc = String(shortDesc).substring(0, desc_length) + end;
              shortDesc = String(shortDesc).substring(0, length) + end;
              var image = this.image;
              // var title = this.short_title;
              var title = String(this.short_title).substring(0, title_length) + end;
              var mob_title = String(this.short_title).substring(0, mob_length) + end;

              var slug = this.slug

              if(i<=slider_item_count){

                jQuery('#newsslider .slides').append('<li><a href="http://globalnews.ziwira.com/article/'+ slug +'"><img src="' + image + '"/><div class="text"><div class="title">'+ title +'</div><div class="desc">'+ shortDesc +'</div></div></a></li>',1);
                jQuery('#newscarousel .slides').append('<li><a href="http://globalnews.ziwira.com/article/'+ slug +'"><img src="' + image + '"/><p>'+title+'</p></a></li>');
                jQuery('.home-slider .slides').append('<li><a href="http://globalnews.ziwira.com/article/'+ slug +'"><img src="'+ image +'"/><div class="col-xs-12 mob-top-title">'+ title +'</div></a></li>',1);
              }else{
                var desc_length = 25; // char length for the string.
                var title_length = 12; // char length for the string.
                shortDesc = String(shortDesc).substring(0, desc_length) + end;
                var title = String(this.short_title).substring(0, title_length) + end;
                jQuery('.news_block ul.article_listing_block').append('<li><a class="clearfix" href="http://globalnews.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12"><img src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
                jQuery('.mob-global ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://globalnews.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">Global Now</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://globalnews.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }
            });
            //console.log('news');

            //flexslider initialization for mobile

            jQuery('.mob-flexslider').flexslider({
              animation: "fade",
              start: function(slider){
                jQuery('body').removeClass('loading');
              }
            });

            //flexslider initialization
            var newscarouselObj = jQuery('#newscarousel').flexslider({
              animation: "slide",
              controlNav: true,
              animationLoop: true,
              itemWidth: 141,
              itemMargin: 2,
              asNavFor: '#newsslider'
            });

            var newssliderObj = jQuery('#newsslider').flexslider({
              animation: "fade",
              controlNav: false,
              slideshowSpeed: 5000,
              animationLoop: true,
              animationSpeed	: 500,
              sync: "#newscarousel",
              start: function(slider){
                jQuery('body').removeClass('loading');
              }
            });

            jQuery('#newscarousel li').on('mouseover',function(){
              jQuery(this).trigger('click');
            });
          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=food&limit=4',
        success: function(e){

      var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var length = 200; // char length for the string.
            var title_length = 40; // char length for the string.
            var mob_title_length = 45; // char length for the string.
            var slider_item_count = 2-1;
            jQuery.each(json,function(i, item){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, title_length) + end;
              var mob_title = String(this.short_title).substring(0, mob_title_length) + end;
              var slug = this.slug

              if(i<=slider_item_count){
                jQuery('.food_block ul.article_listing_block').append('<li><a class="clearfix" href="http://food.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12 new-block"><img class="lazy" src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12 new-content-block"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
                jQuery('.mob-food ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://food.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">food</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://food.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }else{
                jQuery('.mob-food ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://food.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">food</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://food.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }

            });

          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=lifestyle&limit=3',
        success: function(e){
            var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var desc_length = 35; // char length for the string.
            var title_length = 12; // char length for the string.
            var mob_title_length = 62; // char length for the string mobile.
            jQuery('.lifestyle_block ul.article_listing_block').html('');
            jQuery.each(json,function(){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, desc_length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, 50) + end;
              var mob_title = String(this.short_title).substring(0, mob_title_length) + end;
              var slug = this.slug
              jQuery('.life.lifestyle_block ul.article_listing_block').append('<li><a class="clearfix" href="http://lifestyle.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12 new-life"><img class="lazy" src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12 new-life-content"><h2>'+ title +'</h2><p class="description" style="display:none">'+ shortDesc +'</p></div></a></li>');
              jQuery('.mob-lifestyle ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://lifestyle.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">lifestyle</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://lifestyle.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

            });

          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=fashion&limit=3',
        success: function(e){
            var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var desc_length = 35; // char length for the string.
            var title_length = 62; // char length for the string.
            var mob_title_length = 62; // char length for the string mobile.
            jQuery('.lifestyle_block ul.article_listing_block').html('');
            jQuery.each(json,function(){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, desc_length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, title_length) + end;
              var mob_title = String(this.short_title).substring(0, mob_title_length) + end;
              var slug = this.slug
              jQuery('.fas.fas_block ul.article_listing_block').append('<li><a class="clearfix" href="http://fashion.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12 new-life"><img class="lazy" src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12 new-life-content"><h2>'+title+'</h2><p class="description" style="display:none">'+ shortDesc +'</p></div></a></li>');
              jQuery('.mob-lifestyle ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://fashion.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">lifestyle</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://lifestyle.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

            });

          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=auto&limit=8',
        success: function(e){

      var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var length = 70; // char length for the string.
            var desc_length = 100; // char length for the string.
            var slider_item_count = 4-1;
            jQuery.each(json,function(i, item){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, 300) + end;
              var image = this.image;
              var title = this.short_title;
              var slug = this.slug

              if(i<=slider_item_count){
                  jQuery('#envslider.flexslider ul').append('<li><a href="http://environment.ziwira.com/article/'+ slug +'"><img class="lazy" src="' + image + '"/><div class="text"><div class="title">'+ title +'</div><div class="desc">'+ shortDesc +'</div></div></a></li>');
                  jQuery('.mob-environment ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://environment.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">environment</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://environment.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }else{
                var desc_length = 25; // char length for the string.
                var title_length = 12; // char length for the string.
                shortDesc = String(shortDesc).substring(0, desc_length) + end;
                var title = String(this.short_title).substring(0, title_length) + end;
                jQuery('.env_block_left ul.article_listing_block').append('<li><a class="clearfix" href="http://environment.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12"><img src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
              }

            });
            //flexslider initialization
            jQuery('#envslider').flexslider({
              animation: "fade",
              controlNav: false,
              slideshowSpeed: 5000,
              animationLoop: true,
              animationSpeed	: 500,
            //  sync: "#carousel",
              start: function(slider){
                jQuery('body').removeClass('loading');
              }
            });

          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=ecotech&limit=2',
        success: function(e){
            var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var desc_length = 105; // char length for the string.
            var title_length = 35; // char length for the string.
            var mob_title_length = 55; // char length for the string.
            jQuery('.ecotech_block ul.article_listing_block').html('');
            jQuery.each(json,function(){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, desc_length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, title_length) + end;
              var mob_title = String(this.short_title).substring(0, mob_title_length) + end;
              var slug = this.slug
              jQuery('.ecotech_block ul.article_listing_block').append('<li><a class="clearfix" href="http://ecotech.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12 eco-new"><img class="lazy" src="' + image + '"/></div><div class="eco-new-content col-md-6 col-sm-6 col-xs-12"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
              jQuery('.mob-ecotech ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://ecotech.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">eco tech</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://ecotech.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

            });

          },
          error : function (e){
          }
  });




  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=auto&limit=4',
        success: function(e){

      var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var length = 70; // char length for the string.
            var desc_length = 150; // char length for the string.
            var slider_item_count = 2-1;
            jQuery.each(json,function(i, item){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, desc_length) + end;
              var image = this.image;
              var title = this.short_title;
              var slug = this.slug

              if(i<=slider_item_count){
                jQuery('.auto_block ul.article_listing_block').append('<li><a class="clearfix" href="http://auto.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12 eco-new"><div class="thumb_img_block" ><img class="lazy" src="' + image + '"/></div></div><div class="col-md-6 col-sm-6 col-xs-12 eco-new-content"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
                jQuery('.mob-auto ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://auto.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">auto</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://auto.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }else{
                jQuery('.mob-auto ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://auto.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">auto</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://auto.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }

            });

          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=travel&limit=1',
        success: function(e){
            var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var desc_length = 35; // char length for the string.
            var title_length = 75; // char length for the string.
            var mob_title_length = 55; // char length for the string.
            jQuery('.travel_block ul.article_listing_block').html('');
            jQuery.each(json,function(){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, desc_length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, title_length) + end;
              var mob_title = String(this.short_title).substring(0, mob_title_length) + end;
              var slug = this.slug
              jQuery('.travel_block ul.article_listing_block').append('<li><a class="clearfix" href="http://travel.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12" style="height: 188px;"><img style="width: 100%;height: 188px;" class="lazy" src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12" style="background: #fff;padding: 20px 20px;"><h2>'+ title +'</h2><p class="description" style="display:none">'+ shortDesc +'</p></div></a></li>');
              jQuery('.mob-travel ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://travel.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">travel</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://travel.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

            });

          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=realestate&limit=1',
        success: function(e){
            var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var desc_length = 35; // char length for the string.
            var title_length = 75; // char length for the string.
            var mob_title_length = 55; // char length for the string.
            jQuery('.realestate_block ul.article_listing_block').html('');
            jQuery.each(json,function(){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, desc_length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, title_length) + end;
              var mob_title = String(this.short_title).substring(0, mob_title_length) + end;
              var slug = this.slug
              jQuery('.realestate_block ul.article_listing_block').append('<li><a class="clearfix" href="http://realestate.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12" style="height:188px;"><img style="width:100%;height:188px;" class="lazy" src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12" style="background: #fff;padding: 20px 20px;"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
              jQuery('.mob-realestate ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://realestate.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">real estate</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://realestate.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

            });

          },
          error : function (e){
          }
  });



  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=finance&limit=1',
        success: function(e){

      var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var length = 70; // char length for the string.
            var desc_length = 35; // char length for the string.
            var title_length = 75; // char length for the string.
            var slider_item_count = 1-1;
            jQuery.each(json,function(i, item){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, desc_length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, title_length) + end;
              var slug = this.slug

              if(i<=slider_item_count){
                jQuery('.finance_block ul.article_listing_block').append('<li><a class="clearfix" href="http://finance.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12"><div class="thumb_img_block" style="height:188px"><img style="height:188px;width:100%;" class="lazy" src="' + image + '"/></div></div><div class="col-md-6 col-sm-6 col-xs-12" style="background: #fff;padding: 20px 20px;"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
                jQuery('.mob-finance ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://finance.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">finance</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://finance.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }else{
                jQuery('.mob-finance ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://finance.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">finance</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://finance.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }

            });

          },
          error : function (e){
          }
  });

  jQuery.ajax({
    type: 'GET',
        url: 'https://t5i5zt0tra.execute-api.us-east-1.amazonaws.com/prod/homepage?path=fashion&limit=4',
        success: function(e){

      var json = jQuery.parseJSON(e);
            //console.log(json);
            var end= ".."; // string to place at the end when a large content is formatted
            var length = 35; // char length for the string.
            var title_length = 45; // char length for the string.
            var mob_title_length = 45; // char length for the string.
            var slider_item_count = 2-1;
            jQuery.each(json,function(i, item){
              var shortDesc = RemoveHTMLTags(this.short_description);
              shortDesc = String(shortDesc).substring(0, length) + end;
              var image = this.image;
              var title = String(this.short_title).substring(0, 45) + end;
              var mob_title = String(this.short_title).substring(0, mob_title_length) + end;
              var slug = this.slug

              if(i<=slider_item_count){
                jQuery('.fashion_block ul.article_listing_block').append('<li><a class="clearfix fir" href="http://fashion.ziwira.com/article/'+ slug +'"><div class="col-md-6 col-sm-6 col-xs-12"><img class="lazy" src="' + image + '"/></div><div class="col-md-6 col-sm-6 col-xs-12"><h2>'+ title +'</h2><p class="description">'+ shortDesc +'</p></div></a></li>');
                jQuery('.mob-fashion ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://fashion.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">fashion</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://fashion.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }else{
                jQuery('.mob-fashion ul.article_listing_block').append('<li class="col-xs-12"><div class="mob-list-container"><a href="http://fashion.ziwira.com/article/'+ slug +'"><div class="col-xs-4 no-pad"><img src="'+ image +'"/></div><div class="col-xs-8"><div class="mob-title">'+ mob_title +'</div><div class="mob-read-more"><div class="col-xs-6 no-pad mob-sec-title">fashion</div><div class="col-xs-6 no-pad right-align mob-read"><a href="http://fashion.ziwira.com/article/'+ slug +'">Read More</a></div></div></div></a></div></li>');

              }

            });

          },
          error : function (e){
          }
  });

  // jQuery(document).ajaxStop(function(){
  //   jQuery("img.lazy").lazyload({
  //       effect: "fadeIn"
  //   }).removeClass("lazy");
  // });
