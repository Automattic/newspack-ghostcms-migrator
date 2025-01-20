<?php
/**
 * Plugin Name: Newspack GhostCMS Migrator
 * Description: A set of tools in a CLI environment to assist in migrating GhostCMS to Newspack.
 * Plugin URI:  https://newspack.blog/
 * Author:      Automattic
 * Author URI:  https://newspack.blog/
 * Version:     1.0
 */

// Don't do anything outside WP CLI.
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	return;
}

require __DIR__ . '/vendor/autoload.php';

use Newspack\MigrationTools\Command\GhostCMSMigrator;

// Add GhostCMSMigrator command(s) from Migration Tools package into WP_CLI commands.
array_map(
	function ( $command ) {
		WP_CLI::add_command( ...$command );
	},
	GhostCMSMigrator::get_cli_commands()
);

// Turn on logging.
add_filter( 'newspack_migration_tools_enable_file_log', '__return_true' );
add_filter( 'newspack_migration_tools_enable_cli_log', '__return_true' );
