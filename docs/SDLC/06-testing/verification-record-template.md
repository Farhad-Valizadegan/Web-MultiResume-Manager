# Verification Record Template

Status: Reusable procedure
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Use the following fields for a real check; this file contains no invented result.

| Field | Required content |
| --- | --- |
| Record ID and date | Unique ID and timezone-aware date |
| Scope | Requirement/backlog/PR and reviewed commit |
| Environment | OS, PHP/Node/browser, DB/storage/session, fixture |
| Command or journey | Exact relevant check, sanitized |
| Expected outcome | Acceptance criterion, including negative behavior |
| Actual outcome | Exit status, test counts or visible result |
| Evidence | Log/screenshot/PDF reference with no private data |
| Limitations | Checks omitted, environment differences, residual risks |
| Decision | Pass/fail/blocked and next action |

Attach evidence to the specific commit. A later code change may invalidate the record’s applicability. Historical release results remain historical. If a document or diagram was validated, report documentation checks rather than implying application tests were rerun.
