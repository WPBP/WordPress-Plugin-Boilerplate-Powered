<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */
?>

<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <div id="tabs" class="settings-tab">
		<ul>
			<li><a href="#tabs-1"><?php _e( 'Settings' ); ?></a></li>
			<li><a href="#tabs-2"><?php _e( 'Settings 2', PN_TEXTDOMAIN ); ?></a></li>
			<?php
			//WPBPGen{{#unless backend_impexp-settings}}
			?>
			<li><a href="#tabs-3"><?php _e( 'Import/Export', PN_TEXTDOMAIN ); ?></a></li>
			<?php
			//{{/unless}}
			?>
		</ul>
		<?php
		require_once( plugin_dir_path( __FILE__ ) . 'settings.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'settings-2.php' );
		?>
		<?php
		//WPBPGen{{#unless backend_impexp-settings}}
		?>
		<div id="tabs-3" class="metabox-holder">
			<div class="postbox">
				<h3 class="hndle"><span><?php _e( 'Export Settings', PN_TEXTDOMAIN ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Export the plugin\'s settings for this site as a .json file. This will allows you to easily import the configuration to another installation.', PN_TEXTDOMAIN ); ?></p>
					<form method="post">
						<p><input type="hidden" name="pn_action" value="export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'pn_export_nonce', 'pn_export_nonce' ); ?>
							<?php submit_button( __( 'Export' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div>
			</div>

			<div class="postbox">
				<h3 class="hndle"><span><?php _e( 'Import Settings', PN_TEXTDOMAIN ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Import the plugin\'s settings from a .json file. This file can be retrieved by exporting the settings from another installation.', PN_TEXTDOMAIN ); ?></p>
					<form method="post" enctype="multipart/form-data">
						<p>
							<input type="file" name="pn_import_file"/>
						</p>
						<p>
							<input type="hidden" name="pn_action" value="import_settings" />
							<?php wp_nonce_field( 'pn_import_nonce', 'pn_import_nonce' ); ?>
							<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div>
			</div>
		</div>
		<?php
		//{{/unless}}
		?>
    </div>

    <div class="right-column-settings-page metabox-holder">
		<div class="postbox">
			<h3 class="hndle"><span><?php _e( 'Plugin Name.', PN_TEXTDOMAIN ); ?></span></h3>
			<div class="inside">
				<a href="https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered"><img src="https://raw.githubusercontent.com/WPBP/boilerplate-assets/master/icon-256x256.png" alt=""></a>
			</div>
		</div>
    </div>
</div>
