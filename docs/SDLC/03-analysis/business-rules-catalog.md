# Business Rules Catalog

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| ID | Rule | Source |
| --- | --- | --- |
| BR-001 | User endpoints enforce resume ownership. | User/ResumeController |
| BR-002 | Public access filters active resume status. | PublicResumeController |
| BR-003 | Password-free resumes need no session grant. | Resume::allowsPublicAccess |
| BR-004 | Protected grants derive from password hash and application key. | Resume::publicAccessToken |
| BR-005 | Each download enforces mode separately. | PublicResumeController; ResumeFileController |
| BR-006 | File-route owners/admins bypass visitor gating; certificate lookup stays resume-scoped. | ResumeFileController |
| BR-007 | View count is per successful view, not unique identity. | PublicResumeController::view |
| BR-008 | Month selection is stored as YYYY-MM-01. | normalizeResumeMonths |
| BR-009 | Employment cannot be future; education completion can. | ResumeController validation |
| BR-010 | At least one active administrator is retained. | Admin/UserController; profile deletion safeguards |
| BR-011 | Failed transactional writes remove newly created uploads. | ResumeFiles |
| BR-012 | Cleanup failure is reported; filesystem and database are not a distributed atomic transaction. | ResumeFiles::remove |

Rules are implementation observations and regression obligations, not inferred product promises. In particular, inactive owner and inactive resume are distinct: public content checks the resume state. Changing account-state effects on existing public resumes needs an explicit requirement and focused regression tests.
