<?php
/*
 * Plugin Name: Tha Sendgrid Transactional Emails
 * Version: 1.0
 * Plugin URI: http://andrewrendall.com
 * Description: Trigger SendGrid transactional email templates with Substitution Tags. 
 * Author: Andrew Rendall
 * Author URI: http://www.andrewrendall.com/
 *
 * Text Domain: thasendgrid
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Andrew Rendall
 * @since 1.0.0
 */

if (!defined('ABSPATH'))
    exit;

require_once('includes/class-thasendgrid.php');
require_once('includes/class-settings.php');
require_once('includes/class-mailer.php');

function thaSendGrid()
{
    $instance = thaSendGrid::instance(__FILE__, '1.0.0');
    
    if (is_null($instance->settings)) {
        $instance->settings = ThaSendGridSettings::instance($instance);
    }
    
    if (is_null($instance->mailer)) {
        $instance->mailer = ThaSendGridMailer::instance($instance);
    }
    
    return $instance;
}

thaSendGrid();
