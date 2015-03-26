<?php
/*-----------------------------------------------------------------------------------*/
/* ProPanel Version 2.0.1
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Admin Interface
/*-----------------------------------------------------------------------------------*/

function propanel_siteoptions_add_admin() {

    global $query_string;
   
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'siteoptions' ) {
		if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
			$options =  get_option('of_template'); 
			propanel_of_reset_options($options,'siteoptions');
			header("Location: admin.php?page=siteoptions&reset=true");
			die;
		}
    }
		
    $tt_page = add_theme_page('Site Options', 'Site Options', 'edit_theme_options', 'siteoptions','propanel_siteoptions_options_page');
	add_action("admin_print_scripts-$tt_page", 'propanel_of_load_only');
	add_action("admin_print_styles-$tt_page",'propanel_of_style_only');
} 

add_action('admin_menu', 'propanel_siteoptions_add_admin');





/*-----------------------------------------------------------------------------------*/
/* Reset Function
/*-----------------------------------------------------------------------------------*/
function propanel_of_reset_options($options,$page = ''){

			//@since 2.0 mod by denzel, reset defaults
			//replace of_reset_options() function..			
			$template = get_option('of_template');

			foreach($template as $t):
				@$option_name = $t['id'];
				@$default_value = $t['std'];
				update_option("$option_name","$default_value");
			endforeach;		
			//end of mod	

}




/*---------------------------------------------------------------*/
/* Build the Options Panel */
/*---------------------------------------------------------------*/
function propanel_siteoptions_options_page(){
$options   =  get_option('of_template');

// Rev up the Options Machine
$return = propanel_siteoptions_machine($options);
?>

<div class="wrap" id="truethemes_container">

  <div id="of-popup-save" class="of-save-popup">
    <div class="of-save-save">Options Updated</div>
  </div>
  <div id="of-popup-reset" class="of-save-popup">
    <div class="of-save-reset">Options Reset</div>
  </div>
  
	<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="POST" enctype="multipart/form-data" id="ofform">   
<div id="main">
   
	<div id="tt-options-content-wrap">
    	<h2 class="truethemes-admin-logo">Site Options</h2>
            
		<div id="content"> 
      		<?php echo $return[0]; /* Settings */ ?>
            	<!-- <div class="clear"></div> -->
		</div><!-- END #content -->      
        
        
        <?php 
		//check for IE8
		//only display bottom save bae if not IE8
		$IE8 = (ereg('MSIE 8',$_SERVER['HTTP_USER_AGENT'])) ? true : false;
		
		
		if (($IE8 == 1)) {
			//time to update your browser
			} else { ?>

            <div id="tt-options-footer-save-bar">
            <input type="submit" value="Save All Changes" class="button-primary" />
            <input type="hidden" name="of_save" value="submit" />
            </form>
            
            <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="ofform-reset">
    			<input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('CAUTION: Any and all settings will be lost! Click OK to reset.');" />
    			<input type="hidden" name="of_save" value="reset" />
             </form>
             </div> <!-- END #tt-options-footer-save-bar -->
            
             <?php } //END ie8 check ?>
                 
         </div><!-- END #tt-options-content-wrap -->
      
    
    
    
    <div id="tt-options-sidebar">
		<ul id="tt-options-nav">
          <?php echo $return[1] ?>
        </ul><!-- END #tt-options-nav -->
        
        <div id="tt-options-sidebar-controls">
        <input type="submit" value="Save All Changes" class="button-primary" />
        <input type="hidden" name="of_save" value="submit" />
        </form>
        </div><!-- END #tt-options-sidebar-controls -->
    </div><!-- END #tt-options-sidebar -->
    
</div><!-- END #main -->


  
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div><!-- END .wrap -->
<?php
}







/*-----------------------------------------------------------------------------------*/
/* Load required styles for Options Page
/*-----------------------------------------------------------------------------------*/

function propanel_of_style_only() {
	wp_enqueue_style('admin-style', get_stylesheet_directory_uri().'/admin/admin-style.css');
	wp_enqueue_style('color-picker', get_stylesheet_directory_uri().'/admin/colorpicker.css');
}





/*-----------------------------------------------------------------------------------*/
/* Load required javascripts for Options Page
/*-----------------------------------------------------------------------------------*/

function propanel_of_load_only() {

	add_action('admin_head', 'propanel_of_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_register_script('jquery-input-mask', get_stylesheet_directory_uri().'/admin/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('jquery-input-mask');
	wp_enqueue_script('color-picker', get_stylesheet_directory_uri().'/admin/js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', get_stylesheet_directory_uri().'/admin/js/ajaxupload.js', array('jquery'));
	
	function propanel_of_admin_head() { 
	?>
    
    
<script type="text/javascript" language="javascript">

		jQuery(document).ready(function(){
		
		// Race condition to make sure js files are loaded
		if (typeof AjaxUpload != 'function') { 
			return ++counter < 6 && window.setTimeout(init, counter * 500);
		}
		
			//Color Picker
			<?php $options = get_option('of_template');
			
			foreach($options as $option){ 
			if($option['type'] == 'color' OR $option['type'] == 'typography' OR $option['type'] == 'border'){
				if($option['type'] == 'typography' OR $option['type'] == 'border'){
					$option_id = $option['id'];
					$temp_color = get_option($option_id);
					$option_id = $option['id'] . '_color';
					$color = $temp_color['color'];
				}
				else {
					$option_id = $option['id'];
					$color = get_option($option_id);
				}
				?>
				 jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');    
				 jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({
					color: '<?php echo $color; ?>',
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						//jQuery(this).css('border','1px solid red');
						jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
						jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);
						
					}
				  });
			  <?php } } ?>
		 
		});
		
		</script>
		
		<?php
		//AJAX Upload
		?>
<script type="text/javascript">
			jQuery(document).ready(function(){
				
				var i = 0;
				jQuery('#tt-options-nav li a').attr('id', function() {
				   i++;
				   return 'item'+i;
				});

			
			var flip = 0;
				
			jQuery('#expand_options').click(function(){
				if(flip == 0){
					flip = 1;
					jQuery('#truethemes_container #tt-options-nav').hide();
					jQuery('#truethemes_container #content').width(755);
					jQuery('#truethemes_container .group').add('#truethemes_container .group h2').show();
	
					jQuery(this).text('[-]');
					
				} else {
					flip = 0;
					jQuery('#truethemes_container #tt-options-nav').show();
					jQuery('#truethemes_container #content').width(579);
					jQuery('#truethemes_container .group').add('#truethemes_container .group h2').hide();
					jQuery('#truethemes_container .group:first').show();
					jQuery('#truethemes_container #tt-options-nav li').removeClass('current');
					jQuery('#truethemes_container #tt-options-nav li:first').addClass('current');
					
					jQuery(this).text('[+]');
				
				}
			
			});
			
				jQuery('.group').hide();
				jQuery('.group:first').fadeIn();
				
				jQuery('.group .collapsed').each(function(){
					jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
						function(){
           					if (jQuery(this).hasClass('last')) {
           						jQuery(this).removeClass('hidden');
           						return false;
           					}
           					jQuery(this).filter('.hidden').removeClass('hidden');
           				});
           		});
           					
				jQuery('.group .collapsed input:checkbox').click(unhideHidden);
				
				function unhideHidden(){
					if (jQuery(this).attr('checked')) {
						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}
					else {
						jQuery(this).parent().parent().parent().nextAll().each( 
							function(){
           						if (jQuery(this).filter('.last').length) {
           							jQuery(this).addClass('hidden');
									return false;
           						}
           						jQuery(this).addClass('hidden');
           					});
           					
					}
				}
				
				jQuery('.of-radio-img-img').click(function(){
					jQuery(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
					jQuery(this).addClass('of-radio-img-selected');
					
				});
				jQuery('.of-radio-img-label').hide();
				jQuery('.of-radio-img-img').show();
				jQuery('.of-radio-img-radio').hide();
				jQuery('#tt-options-nav li:first').addClass('current');
				jQuery('#tt-options-nav li a').click(function(evt){
				
						jQuery('#tt-options-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');
						
						var clicked_group = jQuery(this).attr('href');
		 
						jQuery('.group').hide();
						
							jQuery(clicked_group).fadeIn();
		
						evt.preventDefault();
						
					});
				
				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){
					
					var reset_popup = jQuery('#of-popup-reset');
					reset_popup.fadeIn();
					window.setTimeout(function(){
						   reset_popup.fadeOut();                        
						}, 2000);
						//alert(response);
					
				}			
			
		
			//AJAX Upload
			jQuery('.image_upload_button').each(function(){
			
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				  action: '<?php echo admin_url("admin-ajax.php"); ?>',
				  name: clickedID, // File upload name
				  data: { // Additional data to send
						action: 'of_ajax_post_action',
						type: 'upload',
						data: clickedID },
				  autoSubmit: true, // Submit file after selection
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension){
						clickedObject.text('Uploading'); // change button text, when user selects file	
						this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
						interval = window.setInterval(function(){
							var text = clickedObject.text();
							if (text.length < 13){	clickedObject.text(text + '.'); }
							else { clickedObject.text('Uploading'); } 
						}, 200);
				  },
				  onComplete: function(file, response) {
				   
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable(); // enable upload button
					
					// If there was an error
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);
					
					}
					else{
						var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();	
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						clickedObject.next('span').fadeIn();
						clickedObject.parent().prev('input').val(response);
					}
				  }
				});
			
			});
			
			//AJAX Remove (clear option value)
			jQuery('.image_reset_button').click(function(){
			
					var clickedObject = jQuery(this);
					var clickedID = jQuery(this).attr('id');
					var theID = jQuery(this).attr('title');	
	
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				
					var data = {
						action: 'of_ajax_post_action',
						type: 'image_reset',
						data: theID
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var image_to_remove = jQuery('#image_' + theID);
						var button_to_hide = jQuery('#reset_' + theID);
						image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
						button_to_hide.fadeOut();
						clickedObject.parent().prev('input').val('');
						
						
						
					});
					
					return false; 
					
				});
				
				   	 	
			
			//Save everything else
			jQuery('#ofform').submit(function(){
				
					function newValues() {
					  var serializedValues = jQuery("#ofform").serialize();
					  return serializedValues;
					}
					jQuery(":checkbox, :radio").click(newValues);
					jQuery("select").change(newValues);
					jQuery('.ajax-loading-img').fadeIn();
					var serializedReturn = newValues();
					 
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				
					 //var data = {data : serializedReturn};
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'siteoptions'){ ?>
						type: 'options',
						<?php } ?>

						action: 'of_ajax_post_action',
						data: serializedReturn
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#of-popup-save');
						var loading = jQuery('.ajax-loading-img');
						loading.fadeOut();
						var timeout;
						clearTimeout(timeout);  
						success.fadeIn();
						timeout = setTimeout("jQuery('#of-popup-save').fadeOut()", 3000);
					});
					
					return false; 
					
				});   	 	
				
			});
			
			
jQuery(document).ready(function(){
	jQuery('#tt-options-sidebar').fixTo('#main');
	truethemes_admin_scrolltop();
});

/*--------------------------------------*/
/*
/*	Option Menu Scroll Top + Sticky
/*
/*--------------------------------------*/
/* scroll top */
function truethemes_admin_scrolltop(){
jQuery('#tt-options-nav a').click(function () {
	if (!jQuery.browser.opera) {
		jQuery('body').animate({
			scrollTop: 0
		}, {
			queue: false,
			duration: 600
		})
	}
	jQuery('html').animate({
		scrollTop: 0
	}, {
		queue: false,
		duration: 600
	});
	return false
});
}
	
	
/*! fixto - v0.1.7 - 2013-02-02
* http://github.com/bbarakaci/fixto/*/
var fixto=function(a,b,c){function h(b,c,d){this.child=b,this._$child=a(b),this.parent=c,this._replacer=new e.MimicNode(b),this._ghostNode=this._replacer.replacer,this.options=a.extend({className:"fixto-fixed"},d),this.options.mind&&(this._$mind=a(this.options.mind)),this.options.zIndex&&(this.child.style.zIndex=this.options.zIndex),this._saveStyles(),this._saveViewportHeight(),this._proxied_onscroll=this._bind(this._onscroll,this),this._proxied_onresize=this._bind(this._onresize,this),this.start()}var d=function(){var a={getAll:function(a){return c.defaultView.getComputedStyle(a)},get:function(a,b){return this.getAll(a)[b]},toFloat:function(a){return parseFloat(a,10)||0},getFloat:function(a,b){return this.toFloat(this.get(a,b))},_getAllCurrentStyle:function(a){return a.currentStyle}};return c.documentElement.currentStyle&&(a.getAll=a._getAllCurrentStyle),a}(),e=function(){function b(a){this.element=a,this.replacer=c.createElement("div"),this.replacer.style.visibility="hidden",this.hide(),a.parentNode.insertBefore(this.replacer,a)}b.prototype={replace:function(){var a=this.replacer.style,b=d.getAll(this.element);a.width=this._width(),a.height=this._height(),a.marginTop=b.marginTop,a.marginBottom=b.marginBottom,a.marginLeft=b.marginLeft,a.marginRight=b.marginRight,a.cssFloat=b.cssFloat,a.styleFloat=b.styleFloat,a.position=b.position,a.top=b.top,a.right=b.right,a.bottom=b.bottom,a.left=b.left,a.display=b.display},hide:function(){this.replacer.style.display="none"},_width:function(){return this.element.getBoundingClientRect().width+"px"},_widthOffset:function(){return this.element.offsetWidth+"px"},_height:function(){return this.element.getBoundingClientRect().height+"px"},_heightOffset:function(){return this.element.offsetHeight+"px"},destroy:function(){a(this.replacer).remove();for(var b in this)this.hasOwnProperty(b)&&(this[b]=null)}};var e=c.documentElement.getBoundingClientRect();return e.width||(b.prototype._width=b.prototype._widthOffset,b.prototype._height=b.prototype._heightOffset),{MimicNode:b,computedStyle:d}}(),f=navigator.appName==="Microsoft Internet Explorer",g;f&&(g=parseFloat(navigator.appVersion.split("MSIE")[1])),h.prototype={_bind:function(a,b){return function(){return a.call(b)}},_toresize:g===8?c.documentElement:b,_mindtop:function(){var b=0;return this._$mind&&a(this._$mind).each(function(){b+=a(this).outerHeight(!0)}),b},_onscroll:function(){this._scrollTop=c.documentElement.scrollTop||c.body.scrollTop,this._parentBottom=this.parent.offsetHeight+this._fullOffset("offsetTop",this.parent)-d.getFloat(this.parent,"paddingBottom");if(!this.fixed)this._scrollTop<this._parentBottom&&this._scrollTop>this._fullOffset("offsetTop",this.child)-d.getFloat(this.child,"marginTop")-this._mindtop()&&this._viewportHeight>this.child.offsetHeight+d.getFloat(this.child,"marginTop")+d.getFloat(this.child,"marginBottom")&&(this._fix(),this._adjust());else{if(this._scrollTop>this._parentBottom||this._scrollTop<this._fullOffset("offsetTop",this._ghostNode)-d.getFloat(this._ghostNode,"marginTop")-this._mindtop()){this._unfix();return}this._adjust()}},_adjust:function(){var a=this._parentBottom-this._scrollTop-(this.child.offsetHeight+d.getFloat(this.child,"marginTop")+d.getFloat(this.child,"marginBottom")+this._mindtop()),b=this._mindtop();a<0?this.child.style.top=a+b+"px":this.child.style.top=0+b+"px"},_fullOffset:function(a,b){var c=b[a];while(b.offsetParent!==null)b=b.offsetParent,c=c+b[a];return c},_fix:function(){var a=this.child,b=a.style;this._saveStyles();if(c.documentElement.currentStyle){var e=d.getAll(a);b.left=this._fullOffset("offsetLeft",a)-d.getFloat(a,"marginLeft")+"px",b.width=a.offsetWidth-(d.toFloat(e.paddingLeft)+d.toFloat(e.paddingRight)+d.toFloat(e.borderLeftWidth)+d.toFloat(e.borderRightWidth))+"px"}else b.width=d.get(a,"width"),b.left=a.getBoundingClientRect().left-d.getFloat(a,"marginLeft")+"px";this._replacer.replace(),b.position="fixed",b.top=this._mindtop()+"px",this._$child.addClass(this.options.className),this.fixed=!0},_unfix:function(){var a=this.child.style;this._replacer.hide(),a.position=this._childOriginalPosition,a.top=this._childOriginalTop,a.width=this._childOriginalWidth,a.left=this._childOriginalLeft,this._$child.removeClass(this.options.className),this.fixed=!1},_saveStyles:function(){var a=this.child.style;this._childOriginalPosition=a.position,this._childOriginalTop=a.top,this._childOriginalWidth=a.width,this._childOriginalLeft=a.left},_onresize:function(){this._saveViewportHeight(),this._unfix(),this._onscroll()},_saveViewportHeight:function(){this._viewportHeight=b.innerHeight||c.documentElement.clientHeight},stop:function(){this._unfix(),a(b).unbind("scroll",this._proxied_onscroll),a(this._toresize).unbind("resize",this._proxied_onresize),this._running=!1},start:function(){this._running||(this._onscroll(),a(b).bind("scroll",this._proxied_onscroll),a(this._toresize).bind("resize",this._proxied_onresize),this._running=!0)},destroy:function(){this.stop(),this._$child.removeData("fixto-instance"),this._replacer.destroy();for(var a in this)this.hasOwnProperty(a)&&(this[a]=null)}};var i=function(a,b,c){return new h(a,b,c)},j="ontouchstart"in b;if(j||g<8)i=function(){return"not supported"};return a.fn.fixTo=function(b,c){var d=a(b),e=0;return this.each(function(){var f=a(this).data("fixto-instance");if(!f)a(this).data("fixto-instance",i(this,d[e],c));else{var g=b;f[g].call(f)}e++})},{FixToContainer:h,fixTo:i,computedStyle:d,mimicNode:e}}(window.jQuery,window,document);

</script>


<?php }
}










/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action
/*-----------------------------------------------------------------------------------*/

add_action('wp_ajax_of_ajax_post_action', 'propanel_of_ajax_callback');

function propanel_of_ajax_callback() {
	global $wpdb; // this is how you get access to the database
	
		
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
			
			$id = $_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	
	}	
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];
		
		parse_str($data,$output);
		//print_r($output);
		
		//Pull options
        	$options = get_option('of_template');
		
		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';
			
			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}
	
			if(isset($option_array['id'])) { // Non - Headings...

			
					$type = $option_array['type'];
					
					if ( is_array($type)){
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];
								if($new_value == ''){ $new_value = $std; }
								update_option( $id, stripslashes($new_value));
							}
						}                 
					}
					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save
						
						update_option($id,'true');
					}
					elseif($type == 'multicheck'){ // Multi Check Save
						
						$option_options = $option_array['options'];
						
						foreach ($option_options as $options_id => $options_value){
							
							$multicheck_id = $id . "_" . $options_id;
							
							if(!isset($output[$multicheck_id])){
							  update_option($multicheck_id,'false');
							}
							else{
							   update_option($multicheck_id,'true'); 
							}
						}
					} 
	
					elseif($type != 'upload_min'){
					
						update_option($id,stripslashes($new_value));
					}
				}
			}	
	
	}

  die();

}



/*-----------------------------------------------------------------------------------*/
/* Cases fpr various option types
/*-----------------------------------------------------------------------------------*/

function propanel_siteoptions_machine($options) {
        
    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
		$counter++;
		$val = '';
		//Start Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
			$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
			$output .= '<h4 class="heading">'. $value['name'] .'</h3>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

		 } 
		 //End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
		break;
		
		
		
		
		
		
		case 'select':

			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $option) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $option) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				 }
				  
				 $output .= '<option'. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;
		
		
		
		//@since 2.0 added by denzel to allow value different from label.
		case 'select-advance':

			$output .= '<select class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'">';
		
			$select_value = get_option($value['id']);
			 
			foreach ($value['options'] as $key => $option) {
				
				$selected = '';
				
				 if($select_value != '') {
					 if ( $select_value == $key) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $key) { $selected = ' selected="selected"'; }
				 }
				  
				 $output .= '<option value="'. $key .'" '. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';
			 
			 } 
			 $output .= '</select>';

			
		break;		
		
		
		
		case 'fontsize':
		
		/* Font Size */
			$val = $default['size'];
			if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
			$output .= '<select class="of-typography of-typography-size" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
				for ($i = 9; $i < 71; $i++){ 
					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
			$output .= '</select>';
		
		
		break;
		
		
		
		
		
		
		
		case "multicheck":
		
			$std =  $value['std'];         
			
			foreach ($value['options'] as $key => $option) {
											 
			$tt_key = $value['id'] . '_' . $key;
			$saved_std = get_option($tt_key);
					
			if(!empty($saved_std)) 
			{ 
				  if($saved_std == 'true'){
					 $checked = 'checked="checked"';  
				  } 
				  else{
					  $checked = '';     
				  }    
			} 
			elseif( $std == $key) {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';                                                                                    }
			$output .= '<input type="checkbox" class="checkbox of-input" name="'. $tt_key .'" id="'. $tt_key .'" value="true" '. $checked .' /><label for="'. $tt_key .'">'. $option .'</label><br />';
										
			}
		break;
		
		
		
		
		
		
		
		
		case 'textarea':
			
			$cols = '8';
			$ta_value = '';
			
			if(isset($value['std'])) {
				
				$ta_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['id']);
				if( $std != "") { $ta_value = stripslashes( $std ); }
				$output .= '<textarea class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
			
			
		break;
		
		
		
		
		
		
		
		
		case "radio":
			
			 $select_value = get_option( $value['id']);
				   
			 foreach ($value['options'] as $key => $option) 
			 { 

				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .= '<input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
			
			}
			 
		break;
		
		
		
		
		
		
		
		
		
		case "checkbox": 
		
		   $std = $value['std'];  
		   
		   $saved_std = get_option($value['id']);
		   
		   $checked = '';
			
			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox of-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;
	
		
		
		
		
		
		
		
		case "upload":
			
			$output .= propanel_siteoptions_uploader_function($value['id'],$value['std'],null);
			
		break;
		
		
		
		
		
		
		
		
		
		case "upload_min":
			
			$output .= propanel_siteoptions_uploader_function($value['id'],$value['std'],'min');
			
		break;
		case "color":
			$val = $value['std'];
			$stored  = get_option( $value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="of-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
		break;   
		
		
		
		
		
		
		
		 
		
		case "images":
			$i = 0;
			$select_value = get_option( $value['id']);
				   
			foreach ($value['options'] as $key => $option) 
			 { 
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; } 
				    } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						else { $checked = ''; }
					}	
				
				$output .= '<span>';
				$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="of-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
				$output .= '</span>';
				
			}
		
		break; 
		
		
		
		
		
		
		
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;
		
		
		
		
		
		
		
	
	                                 
		
		case "heading":
			
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;                                  
		} 
		
		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id = $array['id']; 
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){$std = $saved_std;} 
					$meta = $array['meta'];
					
					if($array['type'] == 'text') { // Only text at this point
						 
						 $output .= '<input class="input-text-small of-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != "heading" ) { 
			if ( $value['type'] != "checkbox" ) 
				{ 
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 
			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}
	   
	}
    $output .= '</div>';
    return array($output,$menu);

}










/*-----------------------------------------------------------------------------------*/
/* File Uploading
/*-----------------------------------------------------------------------------------*/

function propanel_siteoptions_uploader_function($id,$std,$mod){
    
	$uploader = '';
    $upload = get_option($id);
	
	if($mod != 'min') { 
			$val = $std;
            if ( get_option( $id ) != "") { $val = get_option($id); }
            $uploader .= '<input class="of-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
	}
	
	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';
	
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
    	$uploader .= '</a>';
		}
	$uploader .= '<div class="clear"></div>' . "\n"; 


return $uploader;
}

?>