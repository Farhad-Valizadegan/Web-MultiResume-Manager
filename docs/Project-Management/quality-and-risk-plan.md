# Quality and Risk Plan

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Quality combines correct owner/public/file behavior, integrity of updates, usable editing/public/PDF presentation, reproducible checks and recoverability. Requirements define acceptance, threat register defines scenarios, backlog schedules control work, and verification records supply results.

Review high-impact changes first: authentication/ownership, private file routes, password/session logic, upload migration, application key, deletion and database transactions. UI/presentation changes require actual rendering at the relevant boundary. Review package updates with current audit/build/test evidence.

Residual risk must be explicit: cleanup crash windows, account-state/public-state ambiguity, missing production restore and full visual/accessibility evidence. Agree required controls with the owner and track them rather than inventing a ready-to-release score. The release pipeline owns final evidence gates.
