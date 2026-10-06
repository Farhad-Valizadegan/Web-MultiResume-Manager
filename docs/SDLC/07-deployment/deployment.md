# Deployment, Upgrades and Recovery

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

The [root installation guide](../../../README.md) owns initial setup instructions. Use PHP 8.2+, Composer, compatible Node/npm, a configured database and required PHP extensions. Production should serve only public/, use HTTPS and APP_DEBUG=false, and protect .env and storage.

## Upgrade sequence

Back up database, private uploads and configuration before changing a live installation. Review the target release and migrations. Install the release, run composer install and npm ci, then apply php artisan migrate, npm run build and php artisan view:clear. Clear stale configuration after changing environment values. Do not regenerate the application key on an existing installation.

Legacy installations predating private resume uploads should review and run php artisan resumes:protect-files. Protect the database and uploaded files as a coordinated backup set. This command is a file migration; it is not needed on every request.

Set APP_NAME="MultiResume Manager" for existing installations after the rename. The local folder/repository is Web-MultiResume-Manager. A folder rename may require updating web-server document roots and restarting development servers. It does not rename the database or purchase/configure a domain.

## Verification and recovery

Check login, owner editing, public/password access, images/certificates, enabled downloads and PDF rendering after deployment. Before a release agree whether rollback is code-only or needs data restoration. New fields/migrations may make simply switching an old tag unsafe. Restore exercises, infrastructure configuration and production monitoring are environment-specific and are not claimed verified by this repository baseline.
