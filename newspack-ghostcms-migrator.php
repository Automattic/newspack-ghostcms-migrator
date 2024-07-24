<?php
/**
 * Plugin Name: Newspack GhostCMS Migrator
 * Description: A set of tools in a CLI environment to assist in migrating GhostCMS to Newspack.
 * Plugin URI:  https://newspack.blog/
 * Author:      Automattic
 * Author URI:  https://newspack.blog/
 * Version:     1.0
 *
 * @package  Newspack_GhostCMS_Migrator
 */

namespace NewspackGhostCMSMigrator;

// Don't do anything outside WP CLI.
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	return;
}

require __DIR__ . '/vendor/autoload.php';

PluginSetup::register_migrators( array() );


