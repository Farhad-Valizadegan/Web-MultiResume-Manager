# Storage and Update Consistency

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Storage boundary

The private disk and local disk root at storage/app/private; public disk roots at storage/app/public and supports the public storage link. Resume uploads use private storage by default. Account profile photos have a separate public policy. File responses include X-Content-Type-Options: nosniff.

## Transaction workflow

ResumeFiles::transaction begins tracking created and obsolete files around DB::transaction. store() records new paths. delete() defers old-path removal during the transaction. On an exception, new paths are removed and database changes roll back. On success, obsolete paths are removed after commit. Nested service calls reuse the current tracker.

## Failure limits

Deletion failure reports an exception and does not recreate rolled-back state. This compensation design is not a distributed transaction: a process crash between commit and cleanup or filesystem failure can leave an orphan. Operators need reconciliation evidence and should not delete an apparently unused file without checking current references and backups.

## Related-record update semantics

Most replaceable resume detail collections are deleted/recreated from validated submitted rows. Certificates use identity-aware synchronization to preserve retained files and respect explicitly removed rows. Sparse array indexes and submitted IDs require regression coverage. Private migration uses resumes:protect-files to preserve contents while moving legacy public files; it is an upgrade operation with backup requirements.

See [Private-file access sequence](private-file-access-sequence.md) for the corresponding PlantUML view.

See [Resume deletion and file cleanup](resume-deletion-sequence.md) for the corresponding PlantUML view.
