#  Todo: 

- PHPCS
- php unit tests? link to migration tools test?
- remove branch from composer.config: "automattic/newspack-migration-tools": "dev-add/ghostcms-migrator"
  - set this to a specific migration tools tag/release number?
  - other composer json clean up?
  - rerun composer install and commit the latest composer.lock.
  - does migration tools need to have composer install run itself?
- create a release zip
- create a release in Github

# Newspack GhostCMS Migrator

This WordPress Plugin provides CLI access to the Newspack Migration Tools GhostCMS Migrator.

## How to use this Plugin

1. Upload and activate this plugin's zip file into your WordPress site.
2. Open your prefered CLI (terminal) and navigate to your WordPress folder.
3. Run your desired GhostCMS CLI commands as [documented here](https://github.com/Automattic/newspack-migration-tools/docs/GhostCMS.md).


## Links

* [GhostCMS](https://ghost.org/)
* [Newspack Migration Tools GhostCMS Migrator documentation](https://github.com/Automattic/newspack-migration-tools/docs/GhostCMS.md)

