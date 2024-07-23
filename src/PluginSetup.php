<?php

namespace NewspackGhostMigrator;

use Newspack\MigrationTools\Command\WpCliCommandInterface;
use Newspack\MigrationTools\Command\WpCliCommands;
use WP_CLI;

/**
 * PluginSetup class.
 */
class PluginSetup {

	/**
	 * Registers migrators' commands.
	 *
	 * @param array $migrator_classes Array of Command\InterfaceCommand classes.
	 */
	public static function register_migrators( $migrator_classes ) {

		foreach ( WpCliCommands::get_classes_with_cli_commands() as $command_class ) {
			$class = $command_class::get_instance();
			if ( is_a( $class, WpCliCommandInterface::class ) ) {
				array_map( function ( $command ) {
					WP_CLI::add_command( ...$command );
				}, $class->get_cli_commands() );
			}
		}

	}

}
