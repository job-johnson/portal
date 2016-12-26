<?php
/*
 Plugin Name: Custom Field Revisions
 Plugin URI: http://wordpress.org/extend/plugins/custom-field-revisions
 Description: Enables custom fields in revisions and makes preview work as expected when using custom fields
 Version: 1.0.2
 Author: Mika Jauhonen
 Author URI: http://coocoomoo.com
 */


require 'class-custom-field-revisions-settings.php';
require 'class-custom-field-revisions.php';

// Settings
$settings =  new Custom_Field_Revisions_Settings();

// Do revisioning of custom fields
new Custom_Field_Revisions( $settings );
