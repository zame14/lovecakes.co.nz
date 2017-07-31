<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/3/2017
 * Time: 12:18 PM
 */

/**
 * Forces a stylesheet (usually the theme's) to appear at the very end when wp_head() is being generated
 *
 * @return void
 *
 * @author Nigel Wells
 * @modified 2016.02.29
 */
/*
add_action( 'wp_print_styles', 'apex_adjustStylesheetOrder', 99);
function apex_adjustStylesheetOrder() {
    global $wp_styles, $apexAdjustStylesheet;

    if(!$apexAdjustStylesheet) return;

    $keys=[];
    $keys[] = $apexAdjustStylesheet;

    foreach($keys as $currentKey) {
        $keyToSplice = array_search($currentKey,$wp_styles->queue);

        if ($keyToSplice!==false && !is_null($keyToSplice)) {
            $elementToMove = array_splice($wp_styles->queue,$keyToSplice,1);
            $wp_styles->queue[] = $elementToMove[0];
        }

    }

    return;
}
*/
/**
 * Load any Visual Composer templates to map in to the editor
 *
 * @param string $vcDir     Directory to search for custom Visual Composer templates
 *
 * @return void
 *
 * @author Nigel Wells
 * @modified 2016.03.02
 */
function apex_loadVCTemplates($vcDir = '') {
    if(!function_exists('vc_map')) return;
    // Set default
    if(!$vcDir) {
        $vcDir = STYLESHEETPATH . '/includes/vc_templates/';
    }
    if (is_dir($vcDir)) {
        if ( $dh = opendir( $vcDir ) ) {
            while ( ( $file = readdir( $dh ) ) !== false ) {
                if ( substr( $file, 0, 3 ) == 'vc_' && substr( $file, - 4 ) == '.php' ) {
                    require_once($vcDir . $file);
                }
            }
        }
    }
}

function request($name) {
    $value = '';
    if(isset($_REQUEST[$name])) {
        $value = $_REQUEST[$name];
        if(is_string($value)) $value = trim($value);
    }
    return $value;
}