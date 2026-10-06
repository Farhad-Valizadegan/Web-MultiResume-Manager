# Release and Upgrade Runbook

Status: Runbook — deployment execution pending
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Preconditions

Choose the exact reviewed commit/tag; ensure release scope and required checks are accepted. Review migrations, file migrations, dependency changes and compatibility. Identify the operator, maintenance window, backup set and rollback decision. Verify that retained APP_KEY/configuration are recoverable.

## Installation steps

For a controlled environment: back up database/private uploads/configuration consistently; place the selected source; install Composer from lock with deployment-appropriate flags; install npm dependencies with npm ci; build assets; apply pending migrations; clear compiled views/configuration; rebuild caches as appropriate for the environment. Use php artisan migrate --force only in the intended production deployment after reviewing migrations. Do not run migrate:fresh as an upgrade.

For installations predating private files, review resumes:protect-files, preserve backups and confirm moved content before removing any legacy exposure. For v1.2.0 schema changes, include evidence/demo-label migrations. v1.2.1 adds no further migrations. The post-v1.2.1 rename changes branding/configuration/docs rather than release history.

## Post-upgrade gate

Verify login, owner edit, another-user rejection, public password-free/protected access, inactive resume, enabled/disabled downloads, images/certificates and representative PDF output. Inspect operator logs without exposing personal data. Record version, commands/results, migrations, health observations and remaining issues.

## Rollback

Use the agreed compatibility decision. Code rollback is insufficient if schema or file migration is incompatible. Restore database and files from the same protected set when necessary; retain the correct application key. Validate restore separately before returning traffic. No restore timing guarantee is asserted without a measured rehearsal.
