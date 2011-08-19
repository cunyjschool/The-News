<?php
/**
 * Widget: Flexi Banners 125
 * Author: FlexiThemes.com
 * Version: 2.0
 * Updated: September 23, 2010
*/

global $theme;

$flexi_banners_125_defaults = array(
    'randomize' => '',
    'banners' => array(
        '<a href="http://flexithemes.com" target="_blank"><img src="http://flexithemes.com/wp-content/examples/flexi125.gif" alt="FlexiThemes" title="FlexiThemes" /></a>',
        '<a href="http://flexithemes.com" target="_blank"><img src="http://flexithemes.com/wp-content/examples/mix125.gif" alt="FlexiThemes" title="FlexiThemes" /></a>'
    )
);

$theme->options['widgets_options']['banners-125'] = is_array($theme->options['widgets_options']['banners-125'])
    ? array_merge($flexi_banners_125_defaults, $theme->options['widgets_options']['banners-125'])
    : $flexi_banners_125_defaults;

add_action('widgets_init', create_function('', 'return register_widget("FlexiBanners125");'));

class FlexiBanners125 extends WP_Widget 
{
    function FlexiBanners125() 
    {
        $widget_options = array('description' => __('Add 125x125 banners.', 'flexithemes') );
        $control_options = array( 'width' => 600);
		$this->WP_Widget('flexi_banners_125', '&raquo; Flexi Banners 125', $widget_options,$control_options);
    }

    function widget($args, $instance)
    {
        extract( $args );
        
        $get_banners = $instance['banners'];
        $returnval = '';
         if(is_array($get_banners)) {
            $returnval .= '<ul class="wrap-widget"><li class="flexi-banners">';
            if($instance['randomize']) {
                shuffle($get_banners);
            }
            
            foreach($get_banners as $get_banner) {
                if($get_banner) {
                    $returnval .= stripslashes($get_banner);
                }
            }
            $returnval .='</li></ul>';
        }
        
        echo $returnval;
    }

    function update($new_instance, $old_instance) 
    {				
    	$instance = $old_instance;
        $instance['randomize'] = strip_tags($new_instance['randomize']);
        $instance['banners'] = $new_instance['banners'];
        return $instance;
    }
    
    function form($instance) 
    {	
        global $theme;
		$instance = wp_parse_args( (array) $instance, $theme->options['widgets_options']['banners-125'] );
        $get_banners = $instance['banners'];
        ?>
        
        <script type="text/javascript">
            function flexithemes_125_banner_new()
            {
                var new_banner_id = 10000+Math.floor(Math.random()*100000);
                var get_new_banner_container = $flexipaneljQ('.flexithemes_125_banner_prototype').html();
                var get_new_banner_container_name = get_new_banner_container.replace(/the__id__/g, ''+new_banner_id+'');
                var new_banner_container = get_new_banner_container_name.replace('__textarea_name__', '<?php echo $this->get_field_name('banners'); ?>[]');
                $flexipaneljQ('#<?php echo $this->get_field_id('flexithemes_new_125_banner'); ?>').append(''+new_banner_container+'');
            }
            
            function flexithemes_125_banner_preview(id)
            {
                $flexipaneljQ('#preview_'+id+'').fadeOut();
                
                $flexipaneljQ('#preview_'+id+'').fadeIn();
                $flexipaneljQ('#preview_'+id+'').empty();
                var bannersource = $flexipaneljQ('textarea#source_'+id+'').val();
                $flexipaneljQ('#preview_'+id+'').append(''+bannersource+'');
            }
            
            function flexithemes_125_banner_delete(id)
            {
                $flexipaneljQ('#container_'+id+'').remove();
            }
            
        </script>

        <div style="margin-bottom: 20px;">
            <a class="button" onclick="flexithemes_125_banner_new();" >Add New Banner</a> &nbsp; &nbsp; <input type="checkbox" name="<?php echo $this->get_field_name('randomize'); ?>" <?php checked('true', $instance['randomize']); ?> value="true" /> Randomize Banner Order
        </div>
        <?php
            if(is_array($get_banners)) {
                foreach($get_banners as $banner_id=>$banner_source) {
                    ?>
                    <div class="fp-clearfix" style="padding: 0 0 20px 0; border-bottom: 1px solid #ddd; margin-bottom: 20px;" id="container_<?php echo $this->get_field_id($banner_id); ?>">
                        <div style="width: 133px; float: right; ">
                            <div style="width: 125px; height: 125px; border: 4px solid #eee; margin-bottom: 10px;" id="preview_<?php echo $this->get_field_id($banner_id); ?>"><?php echo stripslashes($banner_source); ?></div>
                            <div><a class="button"  onclick="flexithemes_125_banner_preview('<?php echo $this->get_field_id($banner_id); ?>');">Preview</a> <a class="button fp-button-red" onclick="if (confirm('The selected banner will be deleted! Do you really want to continue?')) { flexithemes_125_banner_delete('<?php echo $this->get_field_id($banner_id); ?>'); } return false;">Delete</a></div>
                        </div>
                        <div style="margin-right: 150px;">
                            <textarea class="fp-textarea" style="height: 162px;" id="source_<?php echo $this->get_field_id($banner_id); ?>" name="<?php echo $this->get_field_name('banners'); ?>[]"><?php echo stripslashes($banner_source); ?></textarea>
                        </div>
                    </div>
                    <?php
                }
            }
        
        ?>
            <div id="<?php echo $this->get_field_id('flexithemes_new_125_banner'); ?>">
                <div class="flexithemes_125_banner_prototype" style="display: none;">
                    <div class="fp-clearfix" style="padding: 0 0 20px 0; border-bottom: 1px solid #ddd; margin-bottom: 20px;" id="container_the__id__">
                        <div style="width: 133px; float: right; ">
                            <div style="width: 125px; height: 125px; border: 4px solid #eee; margin-bottom: 10px;" id="preview_the__id__">&nbsp;</div>
                            <div><a class="button"  onclick="flexithemes_125_banner_preview('the__id__');">Preview</a> <a class="button fp-button-red" onclick="if (confirm('The selected banner will be deleted! Do you really want to continue?')) { flexithemes_125_banner_delete('the__id__'); } return false;">Delete</a></div>
                        </div>
                        <div style="margin-right: 150px;">
                            <textarea class="fp-textarea" style="height: 162px;" id="source_the__id__" name="__textarea_name__"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
} 
?>