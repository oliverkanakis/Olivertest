<?php
/**
 * @package Flow_Widget
 * @version 0.0.3
 */
/*
Plugin Name: Flow Widget
Description: The Flow Widget plugin - your company web page contact center.
Version: 0.0.3
Author: Flow
Author URI: https://joinflow.com
*/
include('classes/flow-widget-class.php');
/**
 * Add Flow Widget settings section to Settings/General section in admin
 */
function flow_widget_init_menu() {
    add_settings_section(
        'flow_widget_setting_section',
        'Flow Widget',
        'flow_widget_section_function',
        'general'
    );
}

/**
 * Callback function used by add_settings_section.
 * Prints the Flow Widget settings section.
 */
function flow_widget_section_function( $arg ) {
    settings_fields( 'flow_widget_option-group' );
    echo "<table class=\"form-table\">";
    flow_widget_print_setting("Import script", "Copy paste the widget script from Flow admin here", "flow_widget_script");
    flow_widget_print_setting("Show widget on pages regex (optional)", "Use the regex setting to control which pages the widget will be displayed on. Only frontend pages are valid i.e. the script is never injected on admin pages.
                                 If left blank the widget will show on all pages.<br><br>
                                 The following example will target pages ending with /contact and /support:<br>
                                 <code>.*\/contact|.*\/support</code><br><br>
                                 TIP: Use a tool like <a href=\"https://regex101.com/\" name=\"https://regex101.com/\" target=\"_blank\" rel=\"noopener noreferrer\">https://regex101.com/</a> to test your regex", "flow_widget_path_regex");
    echo "</table>";
}

/**
 * Print settings row
 */
function flow_widget_print_setting($label, $description, $option_name) {
    echo '
      <tr>
        <th scope="row"><label for="' . $option_name . '">' . $label . '</label></th>
        <td>
          <input name="' . $option_name . '" type="text" id="' . $option_name . '" aria-describedby="' . $option_name . '-description" value="' . esc_attr(get_option($option_name)) . '" class="regular-text ltr">
          <p class="description" id="' . $option_name . '-description">' . $description . '</p>
        </td>
      </tr>
    ';
}

/**
 * Register the Flow Widget settings
 */
function flow_widget_register_settings() {
    register_setting( 'flow_widget_option-group', 'flow_widget_script' );
    register_setting( 'flow_widget_option-group', 'flow_widget_path_regex' );
}

/**
 * Inject the Flow Widget script tag.
 *
 * 1. Get the script tag configured in admin/Settings/General Flow Widget
 * 2. Echo the script on pages matching the regex. If regex is empty echo the script on all pages.
 */
function flow_widget_inject_script() {
    $script = get_option('flow_widget_script');
    if (empty($script)) { // the script tag is not configured
        return;
    }

    $regex = get_option('flow_widget_path_regex');
    if (empty($regex)) { // no regex limitation, print on all pages
        inject_cw_script($script);
        return;
    }

    if (preg_match("/$regex/i", $_SERVER['REQUEST_URI'])) {
        inject_cw_script($script);
    }

}

function inject_cw_script($script) {
    $cw = new FlowWidgetClass($script);
    try {
        $script_src = $cw->getWidgetURI();
        wp_enqueue_script("Flow Widget Client", $script_src, array(), null, true);
    } catch (Exception $exception) {
        // No widget id was set, do not load the widget on the WP-site
        echo "<script>console.error( 'Widget ID was not set correctly in WP plugin, could not load Flow Widget.');</script>";
    }
}


////// RUN CODE //////

add_action( 'admin_init', 'flow_widget_register_settings' );
add_action( 'admin_menu', 'flow_widget_init_menu' );
add_action( 'wp_footer', 'flow_widget_inject_script' );

?>
