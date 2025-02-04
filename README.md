# Newspack GhostCMS Migrator

This plugin provides a CLI command to migrate a [Ghost (CMS)](https://ghost.org/) website to WordPress.

## Step 1: Export JSON from Ghost

A JSON file backup/export of the current Ghost website will be needed. 

Options:
- [Backup a self-hosted site using the Admin](https://ghost.org/docs/faq/manual-backup/#export-content). Choose "Export your content".
- [Backup a self-hosted site using the Ghost CLI](https://ghost.org/docs/ghost-cli/#ghost-backup). Run `ghost backup`.
- [Exporting from a Ghost Pro site](https://ghost.org/help/exports/). See "content" export.

Note: the JSON export file could be very large. In most cases, the Newspack GhostCMS Migrator should be able to injest the file as-is. But if smaller chunks are needed, Ghost's gctools [json-split](https://github.com/TryGhost/gctools?tab=readme-ov-file#json-split) command line utility could be used to create smaller files.

## Step 2: Install this plugin

1. Download the [latest release](https://github.com/Automattic/newspack-ghostcms-migrator/releases) zip file `newspack-ghostcms-migrator.zip`.
2. Upload and activate this plugin on your WordPress site.
3. An additional (free) plugin [Co-Authors-Plus](https://wordpress.org/plugins/co-authors-plus/) must also be installed and activated.

## Step 3: Verify requirements

To run the migrator, you'll need:

- Command-line access to the WordPress website (this could mean SSH for remotely hosted sites).
- [WP-CLI](https://wp-cli.org/) installed.
- For remotely hosted sites, FTP/SFTP/SCP or other way to upload the Ghost JSON export to the server. (Depending on your WordPress security settings, you may be able to upload the JSON file into the Media Library, but this is not advised as it will make the JSON file publicly available).

## Step 4: Run the migrator

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

For testing, you can use these test values:
```
--default-user-id=1
--ghost-url=https://newspack.com
--json-file=wp-content/plugins/newspack-ghostcms-migrator/vendor/automattic/newspack-migration-tools/tests/fixtures/ghostcms.json
```

**To run a real migration, run this command (be sure to replace your values):**

`wp newspack-migration-tools ghostcms-import --default-user-id=<default-user-id> --ghost-url=<ghost-url> --json-file=<json-file> [--created-after=<created-after>]`



## Links

* [GhostCMS](https://ghost.org/)
* [Newspack Migration Tools GhostCMS Migrator documentation](https://github.com/Automattic/newspack-migration-tools/blob/trunk/docs/GhostCMS.md)

# Development

This plugin is simply a wrapper for the GhostCMS Migrator in Newspack Migration Tools.

-- cross-post --

# GhostCMS Migrator

The following CLI migrator can be used to import a Ghost JSON export file into new posts, featured images, categories, and authors.

### Required Plugin

[CoAuthorsPlus](https://wordpress.org/plugins/co-authors-plus/) (free plugin) must be installed and activated.

## Usage:

Command: `wp newspack-migration-tools ghostcms-import`

### Required arguments:

* `--default-user-id=` Default user id for `post_author`.  Ex: 1
* `--ghost-url=` This is the current LIVE site url. Ex: https://www.my-site.com/
* `--json-file=` Path to Ghost JSON export file.

### Optional arguments:

* `--created-after=` Cut off date to only import newer posts.  Ex: "2024-01-01 10:50:30"

### Output log files: 

* `GhostCMSMigrator_cmd_ghostcms_import.log` - Be sure to review for warning and error lines.
* `GhostCMSMigrator_cmd_ghostcms_import.log-skips.log` - Be sure to review for any posts that should have been added but were skipped.

## Fatal Conflicts:

If the Newspack Plugin is also active, and the following error has encountered:

```
Error: CoAuthorsPlusHelper construct threw exception: CoAuthors Plus is not installed or active. --> /newspack-repos/newspack-custom-content-migrator/dev/newspack-migration-tools/src/Logic/GhostCMSHelper.php:500
```

Please do [this fix](https://github.com/Automattic/newspack-migration-tools/issues/41):

`wp config set NEWSPACK_ENABLE_CAP_GUEST_AUTHORS true --raw --type=constant`


