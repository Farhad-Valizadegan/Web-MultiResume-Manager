# Backup and Recovery Runbook

Status: Runbook — no production restore claimed
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Backup set

Capture database, storage/app/private, any required account-profile public uploads, deployment version and protected configuration/application key. Database references and files must represent a coherent state; coordinate writes or use a declared consistency mechanism. Keep keys/configuration protected separately from broadly shared artifacts.

## Operator decisions

Approve frequency, retention, access roles, off-host destination, encryption/key handling, restore-point objective and restore-time objective. These values are not specified by the repository and must not be silently guessed. A cloud backup or successful file copy is not restore evidence.

## Isolated rehearsal

1. Choose a synthetic or appropriately protected snapshot and an isolated destination.
2. Restore source version/configuration with the original key and compatible dependencies.
3. Restore database and file set; verify permissions and migration state.
4. Confirm record counts, referenced file contents, representative images/certificates/PDFs and owner/public access gates.
5. Check whether backed-up sessions are intentionally restored or invalidated.
6. Record missing/orphaned files, data window, duration, failures and responsible reviewer.

Do not run a destructive restore against production during documentation work. Delete rehearsal copies only under the approved retention process. After real recovery verify access and document incidents; downloaded visitor copies cannot be recalled through restore.
