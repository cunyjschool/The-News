<?php
/**
 * FlexiPanel.php
 * FlexiPanel theme framework by FlexiThemes.com
*/

class FlexiPanel
{
    var $theme;
    var $flexipanel_version = '2.0.1';
    var $flexipanel_updated = 'September 27, 2010';
    
    function FlexiPanel()
    {
        if(is_admin()) {
            global $theme, $pagenow;
            $this->theme = $theme;
            
            if(isset($_GET['activated'] ) && $pagenow == "themes.php") {
                wp_redirect( admin_url('themes.php?page=flexipanel') );
                exit();
            } 
            
            add_action('admin_menu', array(&$this, 'loadMenu'));
            add_action('admin_head', array(&$this, 'loadHead') );
            add_action('wp_ajax_flexipanel_ajax', array(&$this, 'Ajax') );
            
            $this->setupFlexiPanel();
        }
    }
    
    function setupFlexiPanel($reset = false)
    {
        if(!$this->theme->options['theme_options'] || $reset) {
            if(is_array($this->theme->admin_options)) {
                $save_options = array();
                foreach($this->theme->admin_options as $flexipanel_options) {
                    if(is_array($flexipanel_options['content'])) {
                        foreach($flexipanel_options['content'] as $flexipanel_options_content) {
                            if(isset($flexipanel_options_content['content']) && is_array($flexipanel_options_content['content'])) {
                                foreach($flexipanel_options_content['content'] as $flexipanel_options_content_elements) {
                                    if(is_array($flexipanel_options_content_elements['content'])) {
                                        $elements = $flexipanel_options_content_elements['content'];
                                        if($elements['type'] !='content' && $elements['type'] !='raw') {
                                            $save_options[$elements['name']] = $elements['value'];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                update_option($this->theme->options['theme_options_field'], $save_options);
                $this->theme->options['theme_options'] = $save_options;
            }
        }
    }

    function loadMenu()
	{
	   add_theme_page($this->theme->theme_name . " Theme Options", $this->theme->theme_name . " Theme Options", 'administrator', 'flexipanel',  array(&$this, 'FlexiThemeOptions'));
	}
    
    function loadHead()
	{
		echo "<script type='text/javascript'> var flexipanel_nonce = \"" . wp_create_nonce( 'flexipanel-nonce' ) . "\"; </script> \n";
        echo "<script type='text/javascript' src='" . FLEXIPANEL_ADMIN_URL . "/js/ajaxupload.js'></script> \n";
		echo "<script type='text/javascript' src='" . FLEXIPANEL_ADMIN_URL . "/js/common.js'></script> \n";
		echo "<link rel='stylesheet' href='" . FLEXIPANEL_ADMIN_URL . "/style.css' type='text/css' media='all' /> \n";
        echo "<script type='text/javascript' src='" . FLEXIPANEL_ADMIN_URL . "/js/colorpicker/colorpicker.js'></script> \n";
		echo "<link rel='stylesheet' href='" . FLEXIPANEL_ADMIN_URL . "/js/colorpicker/css/colorpicker.css' type='text/css' media='all' /> \n";
        echo "<script type='text/javascript' src='" . FLEXIPANEL_ADMIN_URL . "/js/jscolor/jscolor.js'></script> \n";
        echo '<!--[if lt IE 8]><style type="text/css"><!-- input.fp-text, textarea.fp-textarea { width: 97%; } --></style><![endif]-->' . "\n";
	}
    
    function Ajax() 
	{
		check_ajax_referer( "flexipanel-nonce");
        $act = 'ajax_' . $this->theme->request('act');
        
		if (is_callable(array(get_class($this), $act))) {
            $this->$act();
        } else {
            echo 'Call to not defined ajax function: ' . $act;
        }
		exit();
	}
    
    function ajax_savechanges()
    {
        if($_POST) {
           $options = $this->theme->options['theme_options'];
           foreach($options as $option_key =>$option_val) {
                $saveval = isset($_POST[$option_key]) ? $_POST[$option_key] : '';
                $options[$option_key] = $saveval;  
           }
           update_option($this->theme->options['theme_options_field'], $options);
        }
        echo '<span style="color:green; font-weight:bold;">Changes saved successfully!</span>';
    }
    
    function ajax_imageupload()
    {
        $allowed_imagetypes = array('.jpg', '.jpeg', '.gif', '.png', '.bmp', '.ico');
        $imgname = $_POST['imgname'];
        $filename = $_FILES[$imgname];
        $filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
        $filename_ext = substr($filename['name'], strpos($filename['name'],'.'), strlen($filename['name'])-1); 
        
        if(!in_array(strtolower($filename_ext),$allowed_imagetypes)) {
            echo 'Upload Error: The file extension ' . $filename_ext . ' is not allowed!'; 
        } else {
            $override['test_form'] = false;
            $override['action'] = 'wp_handle_upload';    
            $uploaded_image = wp_handle_upload($filename,$override);
            
            if(!empty($uploaded_image['error'])) {
                echo 'Upload Error: ' . $uploaded_image['error']; 
            } else { 
                echo  $uploaded_image['url']; 
            }
        }
    }
    
    function ajax_admin_options()
    {
        $do = $this->theme->request('do');
        if($do == 'export') {
            echo '<textarea class="fp-textarea" style="height:300px; margin-bottom:30px;">' . base64_encode(serialize(get_option($this->theme->options['theme_options_field']))) . '</textarea>';
        } elseif($do == 'import') {
            $import_flexipanel_options =  $_POST['import_flexipanel_options'];
            $import_flexipanel_options = unserialize(base64_decode($import_flexipanel_options));
            if(is_array($import_flexipanel_options)) {
                update_option($this->theme->options['theme_options_field'], $import_flexipanel_options);
                echo '<div class="fp-success">The options was imported successfully. <a href="'. admin_url() . 'themes.php?page=flexipanel">Click here</a> to reload the FlexiPanel.</div>';
            } else {
                echo '<div class="fp-error">It seems that the code you pasted is invalid. Please check and try again!</div>';
            }
        } elseif($do == 'reset') {
            $this->setupFlexiPanel(true);
            echo '<div class="fp-success">The options was reset successfully. <a href="'. admin_url() . 'themes.php?page=flexipanel">Click here</a> to reload the FlexiPanel.</div>';
        }
    }
    
    function get_priority($array = array(), $current_priority) 
    {
        if(isset($array[$current_priority])) {
            $return_priority = $this->get_priority($array, $current_priority+1);
        } else {
            $return_priority = $current_priority;
        }
        return $return_priority;
    }
    
    function do_priority($array = array()) 
    {
        $i = time();
        $return = array();
        foreach($array as $key=>$val) {
            $i++;
            $priority = $val['priority'] ? $val['priority'] : $i;
            $val['name'] = $key;
            $return[$this->get_priority($return, $priority)] = $val;
        }
        ksort($return);
        return $return;
    }
    
    function apply_attributes($attributes = array()) 
    {
        $skip = array('type', 'name', 'value', 'help', 'priority', 'display', 'options', 'prefix', 'suffix', 'callback');
        $returnval = '';
		foreach ($attributes as $key => $val) {
			if(!in_array($key, $skip)) {
				$returnval .= ' ' . $key . '="' . $val . '" ';
			}
		}
		return $returnval;
    }
    
    
    function form_text ($name, $attributes = array())
	{
        $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
		return $prefix . '<input type="text" class="fp-text" name="' . $name . '" value="' . $this->theme->get_option($name) .'" ' . $this->apply_attributes($attributes) . ' />' . $suffix;
	}
    
    function form_textarea ($name, $attributes = array())
	{
        $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
		return $prefix . '<textarea class="fp-textarea" name="' . $name . '" ' . $this->apply_attributes($attributes) . ' />' . $this->theme->get_option($name) . '</textarea>' . $suffix;
	}
    
    function form_checkbox ($name, $attributes = array())
	{
	    $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
		$checked = (strlen($this->theme->get_option($name)) > 0) ? ' checked="checked" ' : '';
        $thevalue = (strlen($attributes['value']) > 0) ? $attributes['value'] : $name;
		return $prefix . '<input type="checkbox" class="fp-checkbox" name="' . $name . '" value="' . $thevalue . '"' . $checked . '' . $this->apply_attributes($attributes) . ' />' . $suffix;
	}
    
    function form_checkboxes ($name, $attributes = array())
	{
	    $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '<br />';
	    $current_val = is_array($this->theme->get_option($name)) ? $this->theme->get_option($name) : array();
		$options = $attributes['options'];
        $returnval = '';
        foreach ($options as $option_name => $option_value) {
         
            $checked = in_array($option_name,$current_val) ? ' checked="checked" ' : '';
            $returnval .=  $prefix . '<input type="checkbox" class="fp-checkbox" name="' . $name . '[]" value="' .$option_name . '"' . $checked . '' . $this->apply_attributes($attributes) . ' /> ' . $option_value . $suffix . "\n";
        }
		return $returnval;
	}
    
    function form_radio ($name, $attributes = array())
	{
	    $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '<br />';
	    $current_val = $this->theme->get_option($name);
		$options = $attributes['options'];
        $returnval = '';
        foreach ($options as $option_name => $option_value) {
            $checked = $current_val ==  $option_name ? ' checked="checked" ' : '';
            $returnval .= $prefix . '<input class="fp-radio" type="radio" name="' . $name . '" value="' . $option_name . '"' . $checked . '' . $this->apply_attributes($attributes) . ' /> ' . $option_value . $suffix . "\n";
        }
		return $returnval;
	}
    
    function form_select ($name, $attributes = array())
	{
	    $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
	    $current_val = $this->theme->get_option($name);
		$options = $attributes['options'];
        $returnval = $prefix . '<select class="fp-select" name="' . $name . '" ' . $this->apply_attributes($attributes) . '>' . "\n";
        foreach ($options as $option_name => $option_value) {
            $selected = $current_val ==  $option_name ? ' selected="selected" ' : '';
            $returnval .= "\t" . '<option value="' . $option_name . '"' . $selected . '>' . $option_value . '</option>' . "\n";
        }
		$returnval .= '</select>' . $suffix . "\n";
		return $returnval;
	}
    
    function form_hidden ($name, $attributes = array())
	{
	    $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
		return $prefix . '<input type="hidden" name="' . $name . '" value="' . $this->theme->get_option($name) .'" ' . $this->apply_attributes($attributes) . ' />' . $suffix;
	}
    
    function form_content ($name, $attributes = array())
	{
	    $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
		return $prefix . '<div class="fp-element-content" ' . $this->apply_attributes($attributes) . '>' . $attributes['value'] . '</div>' . $suffix;
	}
    
    function form_callback ($name, $attributes = array())
    {
        if(isset($attributes['callback']) && is_array(($attributes['callback']))) {
            $callback = $attributes['callback'];
            $callback[0]->$callback[1]();
        } else {
            if(function_exists($name)) {
                return $name($attributes);
            }
        }
        
    }

    function form_colorpicker ($name, $attributes = array())
    {
        $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
        $return = $prefix . "<input name=\"$name\"  value=\"" . $this->theme->get_option($name) . "\" class=\"color {required:false}\" style=\"border:2px solid #dcdfe4; width: 72px;  \" " .  $this->apply_attributes($attributes) . ">" . $suffix;
        return $return;
    }
    
    function form_colorpicker2 ($name, $attributes = array())
    {
        $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
        $return = $prefix . "<div class=\"fpColorSelector fpColorSelector_$name\" id=\"$name\"><div style=\"background-color: #" . $this->theme->get_option($name) . ";\"></div></div>\n";
        $return .= "<input type=\"hidden\" id=\"fpColorSelectorVal_$name\" name=\"$name\" value=\"" . $this->theme->get_option($name) . "\" " .  $this->apply_attributes($attributes) . " />" . $suffix;
        return $return;
    }
    
    function form_imageupload ($name, $attributes = array())
    {
        $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
        $current_image = $this->theme->get_option($name);
        echo $prefix;
        ?>
    
        <div id="<?php echo $name; ?>_error" class="fp-error" style="display: none; margin-bottom:10px;" ></div>
        <div id="<?php echo $name; ?>_preview" style="<?php if(!$current_image) { ?>display: none;<?php }?>" class="fp-image-preview" ><?php if($current_image) { ?><a href="<?php echo $current_image; ?>" target="_blank"><img src="<?php echo $current_image; ?>" title="The image might be resized, click for full preview!" alt=""  /></a><br /><span>The image might be resized, click for full preview!</span><?php } ?></div>
        <div style="padding-bottom:10px;"><input class="fp-text flexi_panel_image_upload_<?php echo $name; ?>" type="text" name="<?php echo $name; ?>" value="<?php echo  $current_image; ?>" <?php  echo $this->apply_attributes($attributes); ?> /></div>
        <div style="padding-bottom:10px;">
            <a id="flexi_panel_image_upload_<?php echo $name; ?>" class="fp_imageupload button" >Upload Now</a>
            <a <?php if(!$current_image) { ?> style="display: none;" <?php }?> id="<?php echo $name; ?>_reset" title="<?php echo $name; ?>" class="button fp_imageupload_reset" >Remove</a>
        </div>
    
        <?php
        echo $suffix;
    }
    
    function form_fileupload ($name, $attributes = array())
    {
        $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
        $current_image = $this->theme->get_option($name);
        echo $prefix;
        ?>
    
        <div id="<?php echo $name; ?>_error" class="fp-error" style="display: none; margin-bottom:10px;" ></div>
        <div id="<?php echo $name; ?>_result" style="display: none;" class="fp-result" ></div>
        <div style="padding-bottom:10px;">

        <div style="padding-bottom:10px;">
            <a id="flexi_panel_file_upload_<?php echo $name; ?>" class="fp_fileupload button" >Upload Now</a>
        </div>
    
        <?php
        echo $suffix;
    }
    
    function form_raw ($name, $attributes = array())
	{
	    $prefix = isset($attributes['prefix']) ? $attributes['prefix'] : '';
        $suffix = isset($attributes['suffix']) ? $attributes['suffix'] : '';
		return $prefix . $attributes['value'] . $suffix;
	}
    
    function FlexiThemeOptions()
    {
    ?>
        <div class="wrap">
        <form id="fpForm" method="POST">
            <div class="fp-header">
                <div class="fp-logo">
                    <a href="<?php echo admin_url(); ?>themes.php?page=flexipanel"><img src="<?php echo FLEXIPANEL_ADMIN_URL;?>/images/flexipanel-logo.png" align="left" /></a>
                </div>
                <div class="fp-themeinfo">
                    <?php 
                        $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
                        $theme_version = $theme_data['Version'] ? $theme_data['Version'] : '';
                        $theme_url = $theme_data['URI'] ? $theme_data['URI'] : false;
                        if($theme_url) {
                            printf("%s" . $this->theme->theme_name . " $theme_version%s", "<a href=\"$theme_url\" target=\"_blank\" title=\"Browse to Theme Homepage\">", "</a>");
                        } else {
                            echo $this->theme->theme_name . " $theme_version";
                        }
                    ?> 
                </div>
             </div>
                
             <div class="fp-wrap">
                <div class="fp-container">
                    <div class="fp-sidebar">
                        <div class="fp-menuwrap">
                            <?php $this->optionsPageMenu(); ?>
                        </div>
                    </div>
                    <div class="fp-content">
                        <?php 
                            $optionsPageContent = $this->optionsPageContent();
                            if($optionsPageContent == 'no-options') {
                                echo 'No theme options available!';
                            } else {
                            ?>   
                            <div style="clear: both; margin: 15px 0 0 0; height: 30px;">
                                <a class="button-primary" onclick="flexipanel_savechanges('savechanges','fpForm','fpSaveChanges');" style="float: left;">Save Changes</a>
                                <span id="fpSaveChanges" style="display:none; padding: 4px 15px;"></span> 
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
             </div>
        </form>
        <div class="fp-credits">Powered by <a href="http://flexithemes.com/flexipanel/" target="_blank">FlexiPanel</a> Version <?php echo $this->flexipanel_version; ?></div>
        </div>
    <?php
    }
    
    function optionsPageMenu()
    {
        $menuids = 0;
        $flexipanel_options = $this->do_priority($this->theme->admin_options);
        ?>
        <ul id="fp-menuwrap">
            <?php
                if( is_array($flexipanel_options) && count($flexipanel_options) > 0) {
                    
                    foreach($flexipanel_options as $menu) {
                        $menuids++;
                        $default_active = $menuids == '1' ? ' fp-menu-active' : '';
                        $default_first_menu = $menuids == '1' ? ' class="fp-first-menu" ' : '';
                        $fp_menu_icon = $menu['icon'] ? $menu['icon'] : FLEXIPANEL_ADMIN_URL . '/images/icon-default.png';
                        ?>
                        <li>
                            <?php 
                                $submenus = $this->do_priority($menu['content']);
                                if(is_array($submenus))  {
                                    if(count($submenus) == '1') {
                                        ?>
                                        <a id="menu-<?php echo $menuids; ?>-header" class="fp-menu<?php echo $default_active ?>" href="javascript:flexipanel_menu('menu-<?php echo $menuids; ?>', 'menu-<?php echo $menuids; ?>-submenu-1');" style="background: url(<?php echo $fp_menu_icon; ?>) 8px 6px no-repeat;"><?php echo $menu['name']; ?></a>
                                        <?php
                                    } else {
                                         ?>
                                        <a id="menu-<?php echo $menuids; ?>-header" class="fp-menu<?php echo $default_active ?>" href="javascript:flexipanel_menu('menu-<?php echo $menuids; ?>', '');" style="background: url(<?php echo $fp_menu_icon; ?>) 8px 6px no-repeat;"><?php echo $menu['name']; ?></a>
                                        <?php
                                        $submenuids = 0;
                                        echo "<ul id=\"menu-$menuids\" $default_first_menu>\n";
                                        
                                        foreach($submenus as $submenu_items) {
                                            $submenuids++;
                                            $default_submenu_active = ($menuids == '1' && $submenuids == '1' )? ' fp-submenu-active' : '';
                                            if(isset($submenu_items['display']) && $submenu_items['display'] == 'link') {
                                                $submenu_link_title = $submenu_items['link_title'];
                                                $submenu_link_url = $submenu_items['link_url'];
                                                $submenu_link_target = 'target="_blank"';
                                            } else {
                                                $submenu_link_title = $submenu_items['name'];
                                                $submenu_link_url = "javascript:flexipanel_menu('menu-$menuids', 'menu-$menuids-submenu-$submenuids');";
                                                $submenu_link_target = '';
                                            }
                                        ?>
                                            <li id="menu-<?php echo $menuids; ?>-submenu-<?php echo $submenuids; ?>"><a <?php echo $submenu_link_target; ?> class="fp-submenu<?php echo $default_submenu_active; ?>" href="<?php echo $submenu_link_url; ?>"><?php echo $submenu_link_title; ?></a></li>
                                        <?php
                                        }
                                        echo "</ul>\n";
                                    }
                                        
                                    
                                }
                             ?>
                        </li>
                        <?php
                    }
                } 
            ?>
    	</ul>
        <?php
    }
    
    function optionsPageContent()
    {
        $menuids = 0;
        $flexipanel_options = $this->do_priority($this->theme->admin_options);
        if( is_array($flexipanel_options) && count($flexipanel_options) > 0) {
            foreach($flexipanel_options as $menu) {
                $menuids++;
                $submenus = $this->do_priority($menu['content']);
                if(is_array($submenus))  {
                    $submenuids = 0;
                    foreach($submenus as $submenu_items) {
                        if(isset($submenu_items['content']) && is_array($submenu_items['content'])) {
                            $submenu_items_content = $this->do_priority($submenu_items['content']);
                            $submenuids++;
                            $default_first_menu = ($menuids == '1' && $submenuids == '1') ? ' fp-menu-content-first' : '';
                        ?>
                            <div class="fp-menu-content fp-menu-content-menu-<?php echo $menuids; ?>-submenu-<?php echo $submenuids; echo $default_first_menu?>">
                                <?php $this->optionsPageContentItems($submenu_items_content); ?>
                            </div>
                        <?php
                        }
                    }
                } 
            }
        } else {
            return 'no-options';
        }
    }
    
    function optionsPageContentItems($content = array())
    {
        $valid_form_elements = array('text', 'textarea', 'checkbox', 'checkboxes', 'radio', 'select', 'hidden', 'content', 'callback', 'colorpicker', 'colorpicker2', 'imageupload', 'fileupload', 'raw');       
        ?>
            <?php
                foreach($content as $itemvals) {
                    $itemval = $itemvals['content'];
                    if (in_array($itemval['type'], $valid_form_elements)) {
                        $form_item = 'form_' . $itemval['type'];
                        $item_display = isset($itemval['display']) ? $itemval['display'] : false;
                        $item_help = isset($itemval['help']) ? $itemval['help'] : false;
                        if($item_display == 'clean' || $itemval['type'] == 'hidden' || $itemval['type'] == 'raw') {
                            echo $this->$form_item($itemval['name'], $itemval);
                        } else {
                        ?>
                                <div class="fp-form-element">
                                    <?php if($item_display == 'inline') {
                                        ?>
                                            <table width="100%">
                                                <tr>
                                                    <td class="fp-inline-label" valign="top"><?php echo $itemval['title']; ?>:</td>
                                                    <td class="fp-inline-content" valign="top"><?php echo $this->$form_item($itemval['name'], $itemval); if($item_help) {?><div class="fp-inline-help"><?php echo $item_help; ?></div><?php } ?></td>
                                                </tr>
                                            </table>
                                        <?php
                                    } elseif($item_display == 'block') {
                                        ?>
                                            <div class="fp-form-label"><?php echo $itemval['title'];?></div>
                                            <table width="100%">
                                                <tr>
                                                    <td class="fp-inline-content2" valign="top"><?php echo $this->$form_item($itemval['name'], $itemval); ?></td>
                                                    <td class="fp-inline-label2" valign="top"><?php if($item_help) {?><div class="fp-inline-help2"><?php echo $item_help; ?></div><?php } ?></td>
                                                </tr>
                                            </table>
                                        <?php
                                    } elseif($item_display == 'extended') { ?>
                                        <div class="fp-form-label"><?php echo $itemval['title']; ?></div>
                                        <?php echo $this->$form_item($itemval['name'], $itemval); 
                                        if($item_help) {?><div class="fp-extended-help"><?php echo $item_help; ?></div><?php }
                                        
                                    } elseif($item_display == 'extended-top') { ?>
                                        <div class="fp-form-label"><?php echo $itemval['title']; ?></div>
                                        <?php if($item_help) {?><div class="fp-extended-top-help"><?php echo $item_help; ?></div><?php } ?>
                                        <?php echo $this->$form_item($itemval['name'], $itemval);
                                        
                                    } else {
                                        if($item_help) { ?>
                                                <a href="javascript:flexipanel_showHide('<?php echo $itemval['name'] . '_help'; ?>');"><img src="<?php echo FLEXIPANEL_ADMIN_URL;?>/images/help.gif" class="fp-help" title="Click for Help" /></a>
                                        <?php }?>
                                        <div class="fp-form-label"><?php echo $itemval['title']; if($item_help) { ?>
                                                <div class="fp-show-help" id="<?php echo $itemval['name'] . '_help'; ?>" ><?php echo $item_help; ?></div>
                                        <?php }?>
                                        </div>
                                        <?php echo $this->$form_item($itemval['name'], $itemval);
                                    }
                                    ?>
                                </div>
                            <?php
                        }
                    }
                }
            ?>
        <?php
    }
}
?>