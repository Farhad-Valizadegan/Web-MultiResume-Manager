# Assumptions and Constraints

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| ID | Assumption or constraint | Effect and review trigger |
| --- | --- | --- |
| AC-001 | Existing accounts are provisioned by administrators | Public registration routes remain disabled; changing this needs onboarding/security requirements |
| AC-002 | A resume is owned by one user | No shared editing or organization tenancy is implied |
| AC-003 | Application and database run as one Laravel deployment | Deployment scaling must account for shared sessions, uploads and application key |
| AC-004 | Local development uses Windows/XAMPP; CI uses Linux | Path casing, filesystem behavior and GD configuration need platform-aware checks |
| AC-005 | Dependencies are installed from lockfiles | A version constraint is not the installed version; package updates require lockfile review |
| AC-006 | Some content is intentionally public | Owner chooses content and password policy; public links are not secret-access guarantees |
| AC-007 | Browser and PDF rendering are separate | CSS changes in the web view may not affect generated PDF output |
| AC-008 | Month inputs persist as dates | First-day normalization is a storage convention; original day precision is not preserved by month editing |

No production capacity, service-level agreement, retention period or recovery duration has been established in this repository evidence. Proposed targets must be approved and measured. Existing live-domain references identify an address; they do not prove deployment configuration or availability.

Implementation constraints: PHP 8.2 or later, Laravel 12, database configuration, writable framework/private-upload directories, a stable application key, and supported image/PDF handling. Secrets belong in environment configuration, never documentation examples.
