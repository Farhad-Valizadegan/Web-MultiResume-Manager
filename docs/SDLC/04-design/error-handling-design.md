# Error Handling Design

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| Failure | Current handling | User/operator implication |
| --- | --- | --- |
| Invalid form fields | Validation errors and old input | Text rows restored; files cannot be recreated from browser old input |
| Foreign owner operation | 403 | No mutation; do not leak private content |
| Missing/inactive public resume | 404 | Avoid claiming it exists to visitors |
| Missing current grant | Public controller redirect; file route 403 | Different contracts are intentional at baseline |
| Wrong public password | Return with error | No grant; throttle limits attempts |
| Missing enabled uploaded PDF | 404 | Owner/operator must reconcile path/file |
| Disabled download mode | 403 | Mode is an access rule, not merely hidden UI |
| Failed transactional update | Database rollback and new-file compensation | Preserve original record/files; investigate exception |
| Obsolete-file cleanup failure | Exception reported | Operator reconciliation; no silent claim of full cleanup |
| Hosted CI queued/cancelled | Infrastructure/run status | Inspect actual steps before diagnosing a code defect |

Production should suppress detailed stack traces to visitors and expose diagnostic evidence only to authorized operators. Log redaction, alert delivery and incident handling are environment-specific and need actual configuration review. This document does not change the application exception handler.
