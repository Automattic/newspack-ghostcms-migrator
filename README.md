#  Todo: 

Once the Migration Tools GhostCMS branch is merged ( https://github.com/Automattic/newspack-migration-tools/pull/5 ), then do the following:

- Update this composer.json:
  - from: "automattic/newspack-migration-tools": "dev-add/ghostcms-migrator"
  - to:  "automattic/newspack-migration-tools": "dev-trunk" (or maybe a tag/release number?)

- Add composer.lock, package.json, .gitignore, or other build files you see fit into this repo.

- Possibly create a release/tag and a release zip for downloading as an installable plugin.

- Verify that the 2 links below point to the documentation in migration tool after the Migration Tools merge above.

- Set this repo to Public.

---- delete this line and the todos above ---

# Newspack GhostCMS Migrator

This WordPress Plugin provides CLI access to the Newspack Migration Tools GhostCMS Migrator.

## How to use this Plugin

1. Upload and activate this plugin's zip file into your WordPress site.
2. Open your prefered CLI (terminal) and navigate to your WordPress folder.
3. Run your desired GhostCMS CLI commands as [documented here](https://github.com/Automattic/newspack-migration-tools/docs/GhostCMS.md).


## Links

* [GhostCMS](https://ghost.org/)
* [Newspack Migration Tools GhostCMS Migrator documentation](https://github.com/Automattic/newspack-migration-tools/docs/GhostCMS.md)

