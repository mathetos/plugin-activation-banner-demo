<?php
/*
Plugin Name: Plugin Activation Banner Demo
Plugin URI: http://wordimpress.com/creating-a-striking-wordpress-plugin-activation-banner
Description: Demo of how to show a dismissable plugin activation banner that your users will love.
Version: 1.0
Author: Matt Cromwell
Author URI: http://wordimpress.com/
License: GPLv2
*/

/* Stuff needed to make this a plugin
 * You don't really need this
 */

define( 'PABD_DIR', dirname( __FILE__ ) );
define( 'PABD_URL', plugin_dir_url( __FILE__ ));
define( 'PABD_VERSION', '1.0');
define( 'PABD_PATH', plugin_dir_path( __FILE__ ));


/* Now here's the stuff you'll need
 * to integrate into your own plugin
 */
 
/* Display a notice that can be dismissed 
 * Just leverages WordPress's core function
 * admin_notices
 * See here: http://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
 */

add_action('admin_notices', 'pabd_activation_admin_notice');

function pabd_activation_admin_notice() {
	//Get current user
	global $current_user ;
	$user_id = $current_user->ID;
	
	//Get the current page to add the notice to
	global $pagenow;
	
	//Make sure we're on the plugins page.
	if ( $pagenow == 'plugins.php' ) {
		
		// If the user hasn't already dismissed our alert, 
		// Output the activation banner
		if (!get_user_meta($user_id, 'pabd_activation_ignore_notice')) { ?>
			
			<!-- * I output inline styles here 
				 * because there's no reason to keep these
				 * enqueued after the alert is dismissed. -->
			<style>div.updated.pabd,
                div.updated.pabd header,
                div.updated.pabd header img,
                div.updated.pabd header h3,
                div.updated.pabd .dismiss,
                .pabd-actions,
                .pabd-action,
                .pabd-action #mc_embed_signup,
                div.updated.pabd .pabd-action span.dashicons:before {
                    -webkit-box-sizing: border-box;
                    /* Safari/Chrome, other WebKit */
                    -moz-box-sizing: border-box;
                    /* Firefox, other Gecko */
                    box-sizing: border-box;
                    /* Opera/IE 8+ */
                    width: 100%;
                    position: relative;
                    padding: 0;
                    margin: 0;
                    overflow: hidden;
                    float: none;
                    display: block;
                    text-align: left;
                }
                .pabd-action a,
                .pabd-action a:hover,
                div.updated.pabd .pabd-action.mailchimp:hover,
                div.updated.pabd .pabd-action.mailchimp span {
                    -webkit-transition: all 500ms ease-in-out;
                    -moz-transition: all 500ms ease-in-out;
                    -ms-transition: all 500ms ease-in-out;
                    -o-transition: all 500ms ease-in-out;
                    transition: all 500ms ease-in-out;
                }
                div.updated.pabd {
                    margin: 1rem 0 2rem 0;
                }
                div.updated.pabd header h3 {
                    line-height: 1.4;
                }
                @media screen and (min-width: 280px) {
                    div.updated.pabd {
                        border: 0px;
                        background: transparent;
                        -webkit-box-shadow: 0 1px 1px 1px rgba(0, 0, 0, 0.1);
                        box-shadow: 0 1px 1px 1px rgba(0, 0, 0, 0.1);
                    }
                    div.updated.pabd header {
                        background: #fff;
                        color: #E74F1D;
                        position: relative;
                        height: 5rem;
                    }
                    div.updated.pabd header img {
                        display: none;
                        max-width: 130px;
                        margin: 0 0 0 1rem;
                        float: left;
                    }
                    div.updated.pabd header h3 {
                        float: left;
                        max-width: 60%;
                        margin: 1rem;
                        display: inline-block;
                        color: #E74F1D;
                    }
					div.updated.pabd header h3 span {
						color: #38383A;
						font-weight: 900;
						font-family: 'Open Sans Black', 'Open Sans Regular', Verdana, Helvetica, sans-serif;
					}
                    div.updated.pabd a.dismiss {
                        display: block;
                        position: absolute;
                        left: auto;
                        top: 0;
                        bottom: 0;
                        right: 0;
                        width: 6rem;
                        background: rgba(231, 79, 29, 1);
                        color: #fff;
                        text-align: center;
                    }
                    .pabd a.dismiss:before {
                        font-family: 'Dashicons';
                        content: "\f153";
                        display: inline-block;
                        position: absolute;
                        top: 50%;

                        transform: translate(-50%);
                        right: 40%;
                        margin: auto;
                        line-height: 0;
                    }
                    div.updated.pabd a.dismiss:hover {
                        color: #777;
                        background: rgba(231, 79, 29, .7);
                    }

                    /* END ACTIVATION HEADER
                     * START ACTIONS
                     */
                    div.updated.pabd .pabd-action {
                        display: table;
                    }
                    .pabd-action a,
                    .pabd-action #mc_embed_signup {
                        background: rgba(0,0,0,.1);
                        color: rgba(51, 51, 51, 1);
                        padding: 0 1rem 0 6rem;
                        height: 4rem;
                        display: table-cell;
                        vertical-align: middle;
                    }
                    .pabd-action.mailchimp {
                        margin-bottom: -1.5rem;
                        top: -.5rem;
                    }
                    .pabd-action.mailchimp p {
                        margin: 9px 0 0 0;
                    }

                    .pabd-action #mc_embed_signup form {
                        display: inline-block;
                    }

                    div.updated.pabd .pabd-action span {
                        display: block;
                        position: absolute;
                        left: 0;
                        top: 0;
                        bottom: 0;
                        height: 100%;
                        width: auto;
                    }
                    div.updated.pabd .pabd-action span.dashicons:before {
                        padding: 2rem 1rem;
                        color: #E74F1D;
                        line-height: 0;
                        top: 50%;
                        transform: translateY(-50%);
                        background: rgba(163, 163, 163, .25);
                    }
                    div.updated.pabd .pabd-action a:hover,
                    div.updated.pabd .pabd-action.mailchimp:hover {
                        background: rgba(0,0,0,.2);
                    }
                    div.updated.pabd .pabd-action a {
                        text-decoration: none;
                    }

                    div.updated.pabd .pabd-action a,
                    div.updated.pabd .pabd-action #mc_embed_signup {
                        position: relative;
                        overflow: visible;
                    }
                    .pabd-action #mc_embed_signup form,
                    .pabd-action #mc_embed_signup form input#mce-EMAIL {
                        width: 100%;
                    }
                    div.updated.pabd .mailchimp form input#mce-EMAIL + input.submit-button {
                        display: block;
                        position: relative;
                        top: -1.75rem;
                        float: right;
                        right: 4px;
                        border: 0;
                        background: #cccccc;
                        border-radius: 2px;
                        font-size: 10px;
                        color: white;
                        cursor: pointer;
                    }

                    div.updated.pabd .mailchimp form input#mce-EMAIL:focus + input.submit-button {
                        background: #E74F1D;
                    }

                    .pabd-action #mc_embed_signup form input#mce-EMAIL div#placeholder,
                    input#mce-EMAIL:-webkit-input-placeholder {opacity: 0;}
                }
                @media screen and (min-width: 780px) {
                    div.updated.pabd header h3 {line-height: 3;}

                    div.updated.pabd .mailchimp form input#mce-EMAIL + input.submit-button {
                        top: -1.55rem;
                    }
                    div.updated.pabd header img {
                        display: inline-block;
                    }
                    div.updated.pabd header h3 {
                        max-width: 50%;
                    }
                    .pabd-action {
                        width: 30%;
                        float: left;
                    }
                    div.updated.pabd .pabd-action a {

                    }
                    .pabd-action a,
                    .pabd-action #mc_embed_signup {
                        padding: 0 1rem 0 4rem;
                    }
                    div.updated.pabd .pabd-action span.dashicons:before {

                    }
                    div.updated.pabd .pabd-action.mailchimp {
                        width: 40%;
                    }
                }</style>
				
				<!-- * Now we output the HTML
					 * of the banner 			-->
					 
				<div class="updated pabd">
					<header>
						<!-- Your Logo -->
						<img src="<?php echo PABD_URL; ?>/assets/generic-logo.jpg"  class="pabd-logo"/>
						
						<!-- Your Message -->
						<h3><?php _e('Thanks for installing this <span>AWESOME</span> Plugin!','pabd'); ?></h3>
						
						<!-- The Dismiss Button -->
						<?php printf(__('<a href="%1$s" class="dismiss"></a>', 'pabd'), '?pabd_notice_ignore=0'); ?>
					</header>
					
					<!-- * Now we output a few "actions"
						 * that the user can take from here -->
						 
					<div class="pabd-actions">
						
						<!-- Point them to your settings page -->
						<div class="pabd-action">
							<a href="#">
								<span class="dashicons dashicons-admin-settings"></span><?php _e('Go to Settings','pabd'); ?>
							</a>
						</div>
						
						<!-- Show them where they can upgrade -->
						<div class="pabd-action">
							<a href="https://wordimpress.com/plugins/google-places-reviews-pro/" target="_blank">
								<span class="dashicons dashicons-download"></span><?php _e('Upgrade to Pro','pabd'); ?>
							</a>
						</div>

						<!-- Let them signup for plugin updates -->
						<div class="pabd-action mailchimp">
							<div id="mc_embed_signup">
								<span class="dashicons dashicons-edit"></span>
								<form action="//wordimpress.us3.list-manage.com/subscribe/post?u=3ccb75d68bda4381e2f45794c&amp;id=cf1af2563c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
									<div class="mc-field-group">
										<p><small><?php _e('Get notified of plugin updates:','pabd'); ?></small></p>
										<input type="text" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="my.email@wordpress.com">
										<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="submit-button">
										<input type="hidden" value="8" name="group[13857]" id="mce-group[13857]-13857-3" checked="checked">
									</div>
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>
									<div style="position: absolute; left: -5000px;">
										<input type="text" name="b_3ccb75d68bda4381e2f45794c_83609e2883" value="">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
		<?php
		}
	}
}

/* This is the action that allows
 * the user to dismiss the banner
 * it basically sets a tag to their 
 * user meta data
 */
add_action('admin_init', 'pabd_notice_ignore');

function pabd_notice_ignore() {
	//Get the global user
	global $current_user;
	$user_id = $current_user->ID;
	
	/* If user clicks to ignore the notice, 
	 * add that to their user meta 
	 * the banner then checks whether this tag
	 * exists already or not.
	 * See here: http://codex.wordpress.org/Function_Reference/add_user_meta
	 */
	if ( isset($_GET['pabd_notice_ignore']) && '0' == $_GET['pabd_notice_ignore'] ) {
		add_user_meta($user_id, 'pabd_activation_ignore_notice', 'true', true);
	}
}