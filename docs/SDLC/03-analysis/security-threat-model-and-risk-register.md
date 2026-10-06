# Threat Model and Risk Register

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Assets, boundaries and adversaries

Assets are account access, private resume files, personal content, public grants, administrator continuity, application key and recoverable state. Boundaries are browser/web request, authenticated role/owner, public/password gate, file storage, database and operator/backup access. Consider unauthenticated guessing, authenticated cross-owner tampering, malformed uploads, hostile URLs, compromised dependencies and operator mistakes.

| Risk | Scenario | Requirement | Observed control | Residual action |
| --- | --- | --- | --- | --- |
| RISK-001 | Cross-owner read/write | SEC-001 | Ownership/role checks and regressions | Review each new endpoint |
| RISK-002 | Direct private-file disclosure | SEC-004 | Private disk and file-route gate | Audit deployment document roots/static exposure |
| RISK-003 | Old visitor access survives password change | SEC-003 | Password-derived grant token | Keep revocation regression |
| RISK-004 | Password guessing | SEC-007 | Public password throttle | Review actual proxy/session behavior |
| RISK-005 | Upload abuse or misleading content | SEC-005 | Type/size validation | No malware scanning claim; assess need |
| RISK-006 | Untrusted links/content | SEC-006 | Blade escape; evidence/demo scheme restriction | Review remaining URL fields and external navigation |
| RISK-007 | Lost files on partial update | NFR-004 | Transaction plus compensation | Monitor cleanup errors and reconcile orphans |
| RISK-008 | Administrator lockout | SEC-010 | Active-admin lock/check | Review concurrency on production DB |
| RISK-009 | Secret/key/backup loss | SEC-009/012 | Environment configuration; restore runbook | Actual backup/key access evidence pending |
| RISK-010 | Dependency vulnerability | SEC-011 | CI audits | Remediate advisories and inspect updates |
| RISK-011 | Inactive-account public exposure ambiguity | FR-001/004 | Account and resume statuses separately enforced | Owner must decide whether account deactivation unpublishes resumes |
| RISK-012 | Unsupported recovery/privacy claim | NFR-006/008 | Explicit documentation limits | Approve retention/recovery targets and exercise them |

This is a qualitative engineering register. Priorities and acceptable residual risk need owner review; no penetration test, regulatory approval or deployed control certification is claimed. Reassess after route/authentication/storage changes, new integrations, dependency advisories or a confirmed incident. Link control work to backlog items and verification before marking mitigations complete.
