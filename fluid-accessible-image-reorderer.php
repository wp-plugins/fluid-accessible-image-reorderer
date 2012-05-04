<?php
/*
Plugin Name: Fluid Accessible Image Reorderer
Plugin URI: http://wordpress.org/extend/plugins/fluid-accessible-image-reorderer/
Description: WAI-ARIA Enabled Image Reorderer Plugin for Wordpress
Author: Dionysia Kontotasiou
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "FluidAccessibleImageReorderer_init");
function FluidAccessibleImageReorderer_init() {
    register_sidebar_widget(__('Fluid Accessible Image Reorderer'), 'widget_FluidAccessibleImageReorderer');
    register_widget_control(   'Fluid Accessible Image Reorderer', 'FluidAccessibleImageReorderer_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_FluidAccessibleImageReorderer') ) {
        wp_register_script('InfusionAll', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-image-reorderer/lib/InfusionAll.js'));
        wp_enqueue_script('InfusionAll');

        wp_register_script('FluidAccessibleImageReorderer', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-image-reorderer/lib/FluidAccessibleImageReorderer.js'));
        wp_enqueue_script('FluidAccessibleImageReorderer');

        wp_register_style('FluidAccessibleImageReorderer_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-image-reorderer/lib/FluidAccessibleImageReorderer.css'));
        wp_enqueue_style('FluidAccessibleImageReorderer_css');
		
		wp_register_style('reorderer', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-image-reorderer/lib/Reorderer.js'));
        wp_enqueue_style('reorderer');
		
		wp_register_style('reorderer_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-image-reorderer/lib/Reorderer.css'));
        wp_enqueue_style('reorderer_css');
    }
}

function widget_FluidAccessibleImageReorderer($args) {
    extract($args);

    $options = get_option("widget_FluidAccessibleImageReorderer");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'Fluid Accessible Image Reorderer',
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
  FluidAccessibleImageReordererContent();
    echo $after_widget;
}

function FluidAccessibleImageReordererContent() {

    $options = get_option("widget_FluidAccessibleImageReorderer");
    if (!is_array($options)) {
        $options = array(
            'title' => 'Fluid Accessible Image Reorderer',
        );
    }

    echo '<div class="demo-imageReorderer-container">
           
    <form action="#" id="reorder-images-form" class="flc-imageReorderer fl-imageReorderer fl-reorderer-horizontalLayout fl-focus">
    
        <div>      
            <a href="./wp-content/plugins/fluid-accessible-image-reorderer/images/Dragonfruit.jpg" class="flc-imageReorderer-item fl-imageReorderer-item">
                <img src="./wp-content/plugins/fluid-accessible-image-reorderer/images/Dragonfruit.jpg" alt="Dragonfruit thumbnail" />
                <span class="flc-reorderer-imageTitle  fl-imageReorderer-caption">Dragonfruit</span>
                <input name="dragonfruit" value="0" type="hidden" /> 
            </a>
			<a href="./wp-content/plugins/fluid-accessible-image-reorderer/images/Banana.jpg" class="flc-imageReorderer-item fl-imageReorderer-item">
                <img src="./wp-content/plugins/fluid-accessible-image-reorderer/images/Banana.jpg" alt="Banana thumbnail" />
                <span class="flc-reorderer-imageTitle  fl-imageReorderer-caption">Banana</span>
                <input name="Banana" value="0" type="hidden" /> 
            </a>
    
            <a href="./wp-content/plugins/fluid-accessible-image-reorderer/images/Blackberry.jpg" class="flc-imageReorderer-item fl-imageReorderer-item">
                <img src="./wp-content/plugins/fluid-accessible-image-reorderer/images/Blackberry.jpg" alt="Blackberry thumbnail" />
                <span class="flc-reorderer-imageTitle  fl-imageReorderer-caption">Blackberry</span>
                <input name="Blackberry" value="0" type="hidden" /> 
            </a>
    
            <a href="./wp-content/plugins/fluid-accessible-image-reorderer/images/Cherry.jpg" class="flc-imageReorderer-item fl-imageReorderer-item">
                <img src="./wp-content/plugins/fluid-accessible-image-reorderer/images/Cherry.jpg" alt="Cherry thumbnail" />
                <span class="flc-reorderer-imageTitle  fl-imageReorderer-caption">Cherry</span>
                <input name="Cherry" value="0" type="hidden" /> 
            </a>
    
            <a href="./wp-content/plugins/fluid-accessible-image-reorderer/images/Fig.jpg" class="flc-imageReorderer-item fl-imageReorderer-item">
                <img src="./wp-content/plugins/fluid-accessible-image-reorderer/images/Fig.jpg" alt="Fig thumbnail" />
                <span class="flc-reorderer-imageTitle  fl-imageReorderer-caption">Fig</span>
                <input name="Fig" value="0" type="hidden" /> 
            </a>
       </div>
    </form>
    
    <script type="text/javascript">
        demo.formBasedImageReorderer();
    </script>';
}

function FluidAccessibleImageReorderer_control() {
    $options = get_option("widget_FluidAccessibleImageReorderer");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'Fluid Accessible Image Reorderer',
        );
    }

    if ($_POST['FluidAccessibleImageReorderer-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['FluidAccessibleImageReorderer-WidgetTitle']);
        update_option("widget_FluidAccessibleImageReorderer", $options);
    }

    ?>
    <p>
        <label for="FluidAccessibleImageReorderer-WidgetTitle">Widget Title: </label>
        <input type="text" id="FluidAccessibleImageReorderer-WidgetTitle" name="FluidAccessibleImageReorderer-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="FluidAccessibleImageReorderer-SubmitTitle" name="FluidAccessibleImageReorderer-SubmitTitle" value="1" />
    </p>
    
    <?php
}

?>
