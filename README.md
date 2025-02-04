# Newspack GhostCMS Migrator

This plugin provides a CLI command to migrate a [Ghost (CMS)](https://ghost.org/) website to WordPress.

## How to Export from Ghost

A JSON file backup/export of the current Ghost website will be needed. 

Options:
- [Backup a self-hosted site using the Admin](https://ghost.org/docs/faq/manual-backup/#export-content). Choose "Export your content".
- [Backup a self-hosted site using the Ghost CLI](https://ghost.org/docs/ghost-cli/#ghost-backup). Run `ghost backup`.
Ghost export the JSON file from Ghost. 
Ghost Admin

Note: the JSON export could be a very large file. In most cases, the Newspack GhostCMS Migrator should be able to injest the file as-is. But if smaller chunks are needed, please see the Ghost command-line tools to split the JSON file.

Information about exporting a full-site JSON backup file from Ghost can be found here.


provides CLI access to the Newspack Migration Tools GhostCMS Migrator.

## How to use this Plugin

1. Upload and activate this plugin's zip file into your WordPress site.
2. Open your prefered terminal program and navigate to your WordPress folder.
3. Run the GhostCMS CLI command as [documented here](https://github.com/Automattic/newspack-migration-tools/blob/trunk/docs/GhostCMS.md).


## Links

* [GhostCMS](https://ghost.org/)
* [Newspack Migration Tools GhostCMS Migrator documentation](https://github.com/Automattic/newspack-migration-tools/blob/trunk/docs/GhostCMS.md)

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


