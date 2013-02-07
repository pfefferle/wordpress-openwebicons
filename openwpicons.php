<?php
/*
Plugin Name: OpenWeb Icons for WordPress
Plugin URI: http://github.com/pfefferle/openwpicons
Description: Nice little OpenWeb Icons
Author: Matthias Pfefferle
Author URI: http://notizblog.org
Version: 1.0.0
*/

/**
 * Include stylesheet.
 */
function openwpicons_css() {
  wp_enqueue_style( 'openwebicons', plugins_url('openwebicons.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'openwpicons_css' );
add_action( 'admin_enqueue_scripts', 'openwpicons_css' );

/**
 * adds an item to the admin-menu
 */
function openwpicons_admin_menu_item() {
  add_options_page('OpenWeb Icons', 'OpenWeb Icons', 10, 'openwebicons', 'openwpicons_admin_show_settings');
}
add_action('admin_menu', 'openwpicons_admin_menu_item');

function openwpicons_admin_show_settings() {
  $css = openwpicons_parse_css();
?>
<div class="wrap">
  <img src="<?php echo WP_PLUGIN_URL ?>/yiidit/logo_32x32.png" alt="Spreadly" class="icon32" />
  
  <h2><?php _e('OpenWeb Icons', 'openwpicons') ?></h2>

  <p>Check out the social media reach of your blog at <a href="http://spreadly.com" target="_blank">spreadly.com</a></p>
  
  <table class="widefat" cellspacing="0">
    <thead>
      <tr>
        <th>icon</th>
        <th>class-name</th>
        <th>ascii-code</th>
        <th>sample-html</th>
      </tr>
    </thead>
  	<tbody>
      <?php for ($i = 0; $i < count($css[0]); $i++) { ?>
      <tr class="alternate">
        <td><i class="<?php echo $css[1][$i]; ?>"></i></td>
  	    <td><?php echo $css[1][$i]; ?></td>
        <td><?php echo $css[2][$i]; ?></td>
        <td><code>&lt;i class="<?php echo $css[1][$i]; ?>"&gt;&lt/i&gt;</code></td>
  	  </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php
}

function openwpicons_parse_css() {
  $css = @file_get_contents(dirname(__FILE__)."/css/openwebicons.css");
  
  preg_match_all("/\.(.+):before { content: \"(.+)\"; }/i", $css, $matches);
  
  return $matches;
}