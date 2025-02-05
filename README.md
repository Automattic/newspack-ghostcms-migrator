# Newspack GhostCMS Migrator

This plugin provides a CLI command to migrate a [Ghost (CMS)](https://ghost.org/) website to WordPress. This migrator will import a Ghost JSON export file into new posts, featured images, authors, and categories.

## Features

### Posts and Content

Public, published posts that contain body content and a title will be migrated. Excerpts are imported too. Already imported posts will be skipped, along with posts that have a matching title on the same date or a matching slug. An optional migration argument allow migrating only posts after a given date. 

### Images

Featured images are fetched from the current Ghost website. Alt and captions are added too.

### Authors

Post authors are imported. Authors must have a visibility of public. If the imported author's user login matches an existing WordPress user with role ('Administrator', 'Editor', 'Author', or 'Contributor') then the WP User will be used, otherwise a Co-Authors Plus Guest Author will be created.

### Categories and Tags

Ghost tags will be imported as WordPress categories.

## How to Migrate

### Step 1: Export JSON from Ghost

A JSON file backup/export of the current Ghost website is needed. 

Options:
- [Export from a self-hosted site using the Admin](https://ghost.org/docs/faq/manual-backup/#export-content). Choose "Export your content".
- [Export from a self-hosted site using the Ghost CLI](https://ghost.org/docs/ghost-cli/#ghost-backup). Run `ghost backup`.
- [Export from a Ghost Pro site](https://ghost.org/help/exports/). See "content" export.

Note: the JSON export file could be very large. In most cases, the Newspack GhostCMS Migrator should be able to injest the file as-is. But if smaller chunks are needed, Ghost's gctools [json-split](https://github.com/TryGhost/gctools?tab=readme-ov-file#json-split) command line utility could be used to create smaller files.

### Step 2: Install this plugin

1. Download the [latest release](https://github.com/Automattic/newspack-ghostcms-migrator/releases) zip file `newspack-ghostcms-migrator.zip`.
2. Upload and activate this plugin on your WordPress site.
3. An additional (free) plugin [Co-Authors Plus](https://wordpress.org/plugins/co-authors-plus/) must also be installed and activated.

### Step 3: Verify requirements

To run the migrator, you'll need:

- Command-line access to the WordPress website (this could mean SSH for remotely hosted sites).
- [WP-CLI](https://wp-cli.org/) installed.
- For remotely hosted sites, FTP/SFTP/SCP or other method to upload the Ghost JSON file to the server. (Depending on your WordPress security settings, you may be able to upload the JSON file into the Media Library, but this is not advised as it will make the JSON file publicly available).

### Step 4: Run the migrator

#### Review help and arguments

Before running the migrator, please review the help output to understand the required and optional arguments.

Help command: `wp help newspack-migration-tools ghostcms-import` 

Required arguments:
```
--default-user-id=<default-user-id>
  User ID for default "post_author" for wp_insert_post(). Integer.

--ghost-url=<ghost-url>
  Public URL of current/live Ghost Website. Scheme with domain: https://www.mywebsite.com

--json-file=<json-file>
  Path to Ghost JSON export file.
```

Optional arguments:
```
  --created-after=<created-after>
  Datetime cut-off to only import posts AFTER this date. (Must be parseable by strtotime).
```

#### Run a test (if desired)

For testing, you can use these test values:
```
--default-user-id=1
--ghost-url=https://newspack.com
--json-file=wp-content/plugins/newspack-ghostcms-migrator/vendor/automattic/newspack-migration-tools/tests/fixtures/ghostcms.json
```

#### Run a real migration

Command (_be sure to replace your values_):
```
wp newspack-migration-tools ghostcms-import --default-user-id=<default-user-id> --ghost-url=<ghost-url> --json-file=<json-file> [--created-after=<created-after>]
```

If the migrator command is stopped mid-migration, it is OK to simply re-run the command.
- Previously imported content will be skipped.
- Log files will be appended to automatically.

If the command will not run, please view the `wp-content/debug.log` file and/or the output logs listed below. Also see _Errors_ below.

### Step 5 (optional): Review output logs 

The following output logs will be created:

* `GhostCMSMigrator_cmd_ghostcms_import.log` - This log file will list all content that was imported along with any warning or errors encountered.
* `GhostCMSMigrator_cmd_ghostcms_import.log-skips.log` - If a post was already imported, it will not be imported again. A list of "skipped" posts will be written to this file.

## Errors

`Error: CoAuthorsPlusHelper construct threw exception: CoAuthors Plus is not installed or active. --> src/Logic/GhostCMSHelper.php:500`

**Fix 1:**

Verify the free plugin [Co-Authors Plus](https://wordpress.org/plugins/co-authors-plus/) is installed and activated.

**Fix 2:**

If the Newspack Plugin is also active on the WordPress site, and the following error has been encountered:

Please add a config value to the `wp-config.com` file:

- By hand: `define( 'NEWSPACK_ENABLE_CAP_GUEST_AUTHORS', true );`
- Or by wp-cli: `wp config set NEWSPACK_ENABLE_CAP_GUEST_AUTHORS true --raw --type=constant`

## Development

This plugin is simply a wrapper for the GhostCMS Migrator in Newspack Migration Tools [doc](https://github.com/Automattic/newspack-migration-tools/blob/trunk/docs/GhostCMS.md). Please make changes there, then create a release here.

**How to create a release**

1) Make changes as needed in Newspack Migration Tools and/or this plugin.
2) If changes were made in Newspack Migration Tools, make sure they are merged into trunk.
3) Run command `composer update automattic/newspack-migration-tools` to update the version of Newspack Migration Tools in the `composer.lock` file (and vendor folder).
4) Run command `composer run-script build-release` to create the release zip (created in the `release/` folder).
5) Prior to uploading the release zip to GitHub, it is advisable to run a test to make sure everything is working. To do this, 'ln -s' this repo folder into a WordPress site and run the test command `wp newspack-migration-tools ghostcms-import --default-user-id=1 --ghost-url=https://newspack.com --json-file=wp-content/plugins/newspack-ghostcms-migrator/vendor/automattic/newspack-migration-tools/tests/fixtures/ghostcms.json`
6) If the command runs as expected, proceed to uploading the zip as a new release in GitHub.
7) Be sure also git add/commit/push the updated `composer.lock` file.

-- cross-post to NMT --





