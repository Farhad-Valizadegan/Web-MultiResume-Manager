# Risks and Success Criteria

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

| Risk | Existing control or required follow-up |
| --- | --- |
| Unauthorized resume/file access | Owner/role checks, private resume storage and access regression tests; review every new file route |
| Stale access after password changes | Public session grants derive from the password hash; preserve revocation coverage |
| File/database inconsistency | ResumeFiles transaction wrapper cleans new files on failure and obsolete files after success |
| Dependency advisories | Composer and npm audit steps in CI; review updates before integration |
| Incomplete or broken PDF/layout | Automated access checks plus manual PDF and responsive checks; broader visual evidence remains a backlog item |
| Operational data loss | Back up database, private uploads and application key together; restore exercise needs recorded evidence |
| Documentation drift | Update requirements, traceability and release records with behavior changes |

Success requires owner isolation and access behavior to pass relevant tests; agreed editing/public/PDF journeys to work; required CI checks to pass on the reviewed commit; and upgrade/recovery steps to be understood. No numerical availability, performance or accessibility target is claimed as achieved without measurement.
