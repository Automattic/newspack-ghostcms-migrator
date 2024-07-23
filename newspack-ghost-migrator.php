<?php
/**
 * Plugin Name: Newspack Ghost Migrator
 * Description: A set of tools in a CLI environment to assist in migrating Ghost CMS to Newspack.
 * Plugin URI:  https://newspack.blog/
 * Author:      Automattic
 * Author URI:  https://newspack.blog/
 * Version:     1.0
 *
 * @package  Newspack_Ghost_Migrator
 */

namespace NewspackGhostMigrator;

// Don't do anything outside WP CLI.
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	return;
}

require __DIR__ . '/vendor/autoload.php';

PluginSetup::register_migrators( array() );


