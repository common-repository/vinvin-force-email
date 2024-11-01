<?php

/*
Plugin Name: Vinvin Force Email
Description: Force all email to being to an specific email
Author: Développeur WordPress Montréal
Version: 1.0.0.1
Author URI: https://vinvin.dev
textdomain: vinvin-force-email
*/


add_action('wp_mail' , 'vinvin_force_email_send');
function vinvin_force_email_send( $args ){

    $args['subject'] = '['. $args['to'] . '] | ' .  $args['subject'];
    $args['to'] = get_option('email_force');

    return $args;

}


add_action('admin_init', 'vinvin_force_email_send_settings');  
function vinvin_force_email_send_settings() {  
    
    register_setting('general','email_force', 'esc_attr');
    add_settings_field( // Option 1
        'email_force', // Option ID
        'Force email', // Label
        'vinvin_force_email_send_settings_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'default', // Name of our section
        array( // The $args
            'email_force' // Should match Option ID
        )  
    ); 
    
}

function vinvin_force_email_send_settings_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input class="regular-text ltr" placeholder="'.__('Mail address used to force all email' , 'vinvin-force-email').'" type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

