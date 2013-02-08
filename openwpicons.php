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
 * Add menu-item
 */
function openwpicons_admin_menu_item() {
  add_options_page('OpenWeb Icons', 'OpenWeb Icons', 10, 'openwebicons', 'openwpicons_admin_show_settings');
}
add_action('admin_menu', 'openwpicons_admin_menu_item');

/**
 * Settings page
 */
function openwpicons_admin_show_settings() {
  $css = openwpicons_parse_css();
?>
<div class="wrap">
  <i class="icon32 openwebicons-open-web" style="font-size: 32px;"></i>
  
  <h2><?php _e('OpenWeb Icons', 'openwpicons') ?></h2>

  <p>Visit <a href="http://pfefferle.github.com/openwebicons/">http://pfefferle.github.com/openwebicons/</a> for more informations</p>
  
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
        <td><i class="<?php echo $css[1][$i]; ?>" style="font-size: 25px;"></i></td>
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

/**
 * Parse css-file to generate a preview
 */
function openwpicons_parse_css() {
  $css = @file_get_contents(dirname(__FILE__)."/css/openwebicons.css");
  
  preg_match_all("/\.(.+):before { content: \"(.+)\"; }/i", $css, $matches);
  
  return $matches;
}
