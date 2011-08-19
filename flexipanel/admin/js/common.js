   
    $flexipaneljQ=jQuery.noConflict();
        
    function flexipanel_ajax(requests,appendto,loading) 
    {
    	$flexipaneljQ.ajax({
    		url: "admin-ajax.php",
    		type: "POST",
    		dataType: "html",
    		data: "action=flexipanel_ajax&_ajax_nonce="+flexipanel_nonce+"&"+requests+"",
    		success: function(response){$flexipaneljQ("#"+appendto+"").html(response);}
    	});
        
        if(loading) {
            flexipanel_loading(appendto);
        }
    	
    }
    
    function flexipanel_loading(appendto) 
    {
    	$flexipaneljQ("#"+appendto+"").empty();
        $flexipaneljQ("#"+appendto+"").show();
    	$flexipaneljQ("#"+appendto+"").append('<p style="padding:4px; margin:4px;"><img src="images/loading.gif" align="absmiddle"> <span style="font-size:11px; color: #999;">Loading, please wait...</span></p>');
    }
    
    
    function flexipanel_form(requests,formname,appendto,loading) 
    {
    	$flexipaneljQ.ajax({
    		url: "admin-ajax.php?action=flexipanel_ajax&_ajax_nonce="+flexipanel_nonce+"&act="+requests+"",
    		type: "POST",
    		dataType: "html",
    		data: $flexipaneljQ("#"+formname+"").serialize(),
    		success: function(response){$flexipaneljQ("#"+appendto+"").html(response);}
    	});
        
        if(loading) {
            flexipanel_loading(appendto);
        }
    	return false;
    }
    
    function flexipanel_savechanges(requests,formname,appendto) 
    {
    	$flexipaneljQ.ajax({
            url: "admin-ajax.php?action=flexipanel_ajax&_ajax_nonce="+flexipanel_nonce+"&act="+requests+"",
    		type: "POST",
    		dataType: "html",
    		data: $flexipaneljQ("#"+formname+"").serialize(),
    		success: function(response){
    		    $flexipaneljQ("#"+appendto+"").empty();
                $flexipaneljQ("#"+appendto+"").show();
                $flexipaneljQ("#"+appendto+"").html(response);
                $flexipaneljQ("#"+appendto+"").fadeIn(5000);
                $flexipaneljQ("#"+appendto+"").fadeOut(1000);
              }
    	});
        $flexipaneljQ("#"+appendto+"").empty();
        $flexipaneljQ("#"+appendto+"").show();
	    $flexipaneljQ("#"+appendto+"").append('<img src="images/loading.gif" align="absmiddle"> <span style="font-size:11px; color: #999;">Saving changes, please wait...</span>');
        return false;
    }
        
    function flexipanel_showHide(id)
    {
    	if ($flexipaneljQ("#"+id+"").is(":hidden")) {
            $flexipaneljQ("#"+id+"").slideDown('fast');
          } else {
        	  $flexipaneljQ("#"+id+"").slideUp('fast');
          }
    }
    
    function flexipanel_hide(id) 
    {
    	$flexipaneljQ("#"+id+"").empty();
    }
    
    function flexipanel_remove(id) 
    {
    	$flexipaneljQ("#"+id+"").remove();
    }
    
    function flexipanel_hoverShow(id) 
    {
    	$flexipaneljQ("#"+id+"").css("display","inline");
    }
    
    function flexipanel_hoverHide(id) 
    {
    	$flexipaneljQ("#"+id+"").css("display","none");
    }
    
    function flexipanel_menu(menu,submenu)
    {
        if($flexipaneljQ('#' + menu + '').is(':visible')) {
            $flexipaneljQ('#fp-menuwrap a ').removeClass('fp-submenu-active');
            if(submenu) {
                $flexipaneljQ('#' + submenu + ' a').addClass('fp-submenu-active');
                $flexipaneljQ(".fp-menu-content").hide();
                $flexipaneljQ(".fp-menu-content-first").hide();
            	$flexipaneljQ(".fp-menu-content-"+submenu).fadeIn();
            } else {
                $flexipaneljQ('#fp-menuwrap a ').removeClass('fp-menu-active');
                $flexipaneljQ('#' + menu + '').slideUp();
            }
            
        } else {
            $flexipaneljQ('#fp-menuwrap a ').removeClass('fp-menu-active');
            $flexipaneljQ('#fp-menuwrap a ').removeClass('fp-submenu-active');
            $flexipaneljQ('#fp-menuwrap ul').slideUp();
             
            $flexipaneljQ('#' + menu + '-header').addClass('fp-menu-active');
            if(submenu) {
                $flexipaneljQ(".fp-menu-content").hide();
                $flexipaneljQ(".fp-menu-content-first").hide();
            	$flexipaneljQ(".fp-menu-content-"+submenu).fadeIn();
            } else {
                $flexipaneljQ('#' + menu + '').slideDown();
            }
             
        }
    }
        
 	
    jQuery(document).ready(function($){
        
        // Color Picker 2 
        $('.fpColorSelector').each(function(){
            var cpid = $(this).attr('id');
            var cpcolor = $('#fpColorSelectorVal_'+cpid+'').attr('value');
            $('.fpColorSelector_'+cpid).ColorPicker({
    			color: cpcolor,
    			onShow: function (colpkr) {
    				$(colpkr).fadeIn(200);
    				return false;
    			},
    			onHide: function (colpkr) {
    				$(colpkr).fadeOut(200);
    				return false;
    			},
    			onChange: function (hsb, hex, rgb) {
    				$('.fpColorSelector_'+cpid+' div').css('backgroundColor', '#' + hex);
                    $('#fpColorSelectorVal_'+cpid+'').val(hex);
    			}
    		});
        });
        
        // Image Upload
         $('.fp_imageupload').each(function(){
			
			var clickedObject = $(this);
            var clickedID = $(this).attr('id');
			var getClickedID = clickedID.replace("flexi_panel_image_upload_", "");
            	
			new AjaxUpload(clickedID, {
			  action: 'admin-ajax.php?action=flexipanel_ajax&_ajax_nonce='+flexipanel_nonce+'&act=imageupload',
			  name: clickedID,
			  data: { 
				imgname: clickedID
                },
                
			  onChange: function(file, extension){},
              
			  onSubmit: function(file, extension){
					clickedObject.text('Uploading'); 
					this.disable(); 
					interval = window.setInterval(function(){
						var text = clickedObject.text();
						if (text.length < 13){	clickedObject.text(text + '.'); }
						else { clickedObject.text('Uploading'); } 
					}, 200);
			  },
              
			  onComplete: function(file, response) {
			   if(response.search('Upload Error') > -1){
			            window.clearInterval(interval);
    				    clickedObject.text('Upload Now');
                        this.enable(); 
			            $('#'+getClickedID+'_error').text(response);
						$('#'+getClickedID+'_error').show();
					
				} else{
    				window.clearInterval(interval);
    				clickedObject.text('Upload Now');	
    				this.enable(); 
                    $('#'+getClickedID+'_error').hide();
    				$('.'+clickedID+'').val(response);	
    				$('#'+getClickedID+'_reset').show();
                    var previewImage = '<a href="'+response+'" target="_blank"><img src="'+response+'" title="The image might be resized, click for full preview!" alt="" /></a><br /><span>The image might be resized, click for full preview!</span>';
                    $('#'+getClickedID+'_preview').html(previewImage);
                    $('#'+getClickedID+'_preview').show();
                } 
              }
              
			});
		});
        
        // Reset the image filed
        $('.fp_imageupload_reset').click(function(){
			
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
			var theID = $(this).attr('title');	

			$('.flexi_panel_image_upload_'+theID+'').val('');	
			$('#'+clickedID+'').hide();
            $('#'+theID+'_preview').hide();
			return false; 
			
		}); 
        $('#fp-menuwrap ul').hide();
        $('.fp-first-menu').slideDown();
        
        // File Upload
         $('.fp_fileupload').each(function(){
			
			var upclickedObject = $(this);
            var upclickedID = $(this).attr('id');
			var upgetupclickedID = upclickedID.replace("flexi_panel_file_upload_", "");
            	
			new AjaxUpload(upclickedID, {
			  action: 'admin-ajax.php?action=flexipanel_ajax&_ajax_nonce='+flexipanel_nonce+'&act=' + upgetupclickedID + '',
			  name: upclickedID,
			  data: { 
				imgname: upclickedID
                },
                
			  onChange: function(file, extension){},
              
			  onSubmit: function(file, extension){
					upclickedObject.text('Uploading'); 
					this.disable(); 
					interval = window.setInterval(function(){
						var text = upclickedObject.text();
						if (text.length < 13){	upclickedObject.text(text + '.'); }
						else { upclickedObject.text('Uploading'); } 
					}, 200);
			  },
              
			  onComplete: function(file, response) {
			   if(response.search('Upload Error') > -1){
			            window.clearInterval(interval);
    				    upclickedObject.text('Upload Now');
                        this.enable(); 
			            $('#'+upgetupclickedID+'_error').text(response);
						$('#'+upgetupclickedID+'_error').show();
					
				} else{
    				window.clearInterval(interval);
    				upclickedObject.text('Upload Now');	
    				this.enable(); 
                    $('#'+upgetupclickedID+'_error').hide();
                    $('#'+upgetupclickedID+'_result').html(response);
    				$('#'+upgetupclickedID+'_result').show();
                } 
              }
              
			});
		});
        
    });	 	
    