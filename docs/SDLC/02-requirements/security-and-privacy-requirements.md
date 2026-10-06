# Security and Privacy Requirements

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| ID | Required behavior | Source/evidence boundary |
| --- | --- | --- |
| SEC-001 | Enforce ownership and role access on every protected operation | Routes, middleware and controller checks; negative tests |
| SEC-002 | Check active resume and current public grant on visitor content/files | Public controller/model and file controller |
| SEC-003 | Hash access passwords; invalidate prior grants on password change | Hash API and password-derived HMAC token |
| SEC-004 | Keep resume uploads outside public storage and prevent certificate cross-link access | Private disk, scoped certificate lookup, migration/regression tests |
| SEC-005 | Validate uploads, lengths, dates and allowed values server-side | ResumeController validation; request limits also depend on deployment |
| SEC-006 | Escape rendered user content and reject unsafe evidence/demo URL schemes | Blade escaping and url:http,https rules; no blanket claim for all URL fields |
| SEC-007 | Throttle public resume password attempts | Explicit throttle:10,1 route; regression test |
| SEC-008 | Preserve CSRF/session and inactive-account protections | Web middleware and auth flows; deployed cookie configuration still requires review |
| SEC-009 | Keep secrets and private uploads out of source/docs/log examples | Repository hygiene; runtime secret/log policy needs operational evidence |
| SEC-010 | Preserve at least one active administrator | Admin transaction/locking safeguards and regression tests |
| SEC-011 | Review dependency advisories before release | Composer audit and npm audit high threshold in CI |
| SEC-012 | Restore without replacing an existing application key | Recovery procedure; actual backup/key access policy pending |

These are engineering requirements, not a declaration of compliance with a privacy regulation. Review lawful processing, retention, user notice and deployment jurisdiction with the responsible owner. See [data lifecycle](../03-analysis/data-classification-and-lifecycle.md) for explicitly unresolved retention decisions.
