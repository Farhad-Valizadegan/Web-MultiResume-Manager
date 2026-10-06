# Design Decisions and Trade-offs

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

These decisions describe the observed implementation retrospectively; they are not fabricated historical architecture approvals.

| ID | Choice | Benefit | Cost / review trigger |
| --- | --- | --- | --- |
| DD-001 | Laravel server-rendered monolith | One deployment and existing Blade/auth conventions | Separate API/frontend only if a real requirement justifies complexity |
| DD-002 | Independent personal data per resume | Tailored versions do not silently inherit changed profile data | Duplication; optional explicit copy flow would require UX design |
| DD-003 | Private upload service with compensation | Coordinates file replacements and rollback behavior | Crash/cleanup failures can leave orphans; reconciliation needed |
| DD-004 | Password-hash-derived grants | Old grants fail after hash change without enumerating sessions | APP_KEY stability essential; downloaded copies cannot be revoked |
| DD-005 | Separate public/PDF templates | Renderer-specific layout control | Presentation drift; both need validation |
| DD-006 | Month-to-first-day normalization | Fits date columns and simplifies month editing | Changes day precision on month submission |
| DD-007 | Native details editor sections | Keyboard semantics and values retained without remounting | Error mapping/navigation need explicit behavior |
| DD-008 | Inline controller request rules | Local, visible validation | Store/update duplication can drift; refactor only with behavior evidence |
| DD-009 | Browser-local appearance | No schema change, responsive to system setting | Per-browser preference, not cross-device account setting |

New decisions should record context, alternatives, selected choice, consequences, source/test references and approval date. Keep future options explicitly proposed.
