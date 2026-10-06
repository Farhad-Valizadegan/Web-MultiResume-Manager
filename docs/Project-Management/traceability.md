# Requirements Traceability

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

The evidence below is code/test mapping from the inspected baseline, not a fresh execution report. Paths are relative to the application directory. The automated baseline is recorded in the [testing guide](../SDLC/06-testing/testing.md).

| Requirement | Implementation | Evidence / limits |
| --- | --- | --- |
| FR-001 | routes/auth.php; app/Http/Middleware | Auth/AuthenticationTest.php; Admin/AdminUserManagementTest.php; ResumeRegressionTest.php |
| FR-002 | User/ResumeController.php | User/ResumeManagementTest.php; ResumeRegressionTest.php |
| FR-003 | Models; migrations; ResumeFiles service | User section suites; ResumeCertificateUpdateTest.php; ResumeRegressionTest.php |
| FR-004 | Resume::allowsPublicAccess; PublicResumeController | PublicResumeAccessTest.php; ResumeRegressionTest.php |
| FR-005 | PublicResumeController; ResumeFileController | PublicResumeAccessTest.php; ResumeRegressionTest.php |
| FR-006 | ResumeSkill/ResumeProject; forms; public/PDF views | SkillEvidenceLinkTest.php; ProjectLinkLabelTest.php; ProjectDemoLinkTest.php |
| FR-007 | normalizeResumeMonths; date validation; public/PDF views | ResumeDateEditorTest.php; visual date checks still require representative output |
| FR-008 | editor templates; appearance.js; workspace.js | Historical build/manual checks; QA-001 proposes broader reproducible evidence |
| FR-009 | PublicResumeController view tracking | PublicResumeAccessTest.php and management/regression suites; no unique visitor guarantee |
| NFR-001 | ResumeFiles; private disk; ResumeFileController | PublicResumeAccessTest.php; ResumeRegressionTest.php |
| NFR-002 | .github/workflows/tests.yml; lockfiles | Historical successful CI; inspect each future reviewed commit |
| NFR-003 | labels; native details; error feedback | Partial implementation; comprehensive conformance not claimed |

Test names without a path prefix above are under tests/Feature; section tests are under tests/Feature/User. New work should connect requirement → backlog item → design/code → check → release evidence. Do not mark a planned control verified solely because a document exists.

## Extended requirement coverage

| Requirement | Code boundary | Named evidence |
| --- | --- | --- |
| FR-010 | Admin/UserController; middleware | AdminUserManagementTest; last-administrator regressions |
| FR-011 | ProfileController; auth password controllers | ProfileTest; PasswordUpdateTest; profile-validation/last-admin regressions |
| FR-012 | Certificate synchronization; ResumeFileController | ResumeCertificateTest; ResumeCertificateUpdateTest; foreign certificate regression |
| NFR-004 | ResumeFiles | Failed transactional update / cleanup regressions |
| NFR-005 | This documentation set | Relative link/source inventory/whitespace validation; owner review pending |
| NFR-006 | Backup/recovery runbook | OPS-001: actual rehearsal remains proposed |
| NFR-007 | Performance requirement | No declared measurement; owner targets pending |
| NFR-008 | Data lifecycle/operations | Privacy/log/retention review pending |

The [threat register](../SDLC/03-analysis/security-threat-model-and-risk-register.md) maps security requirements to scenarios and observed controls. The [security matrix](../SDLC/06-testing/security-regression-matrix.md) and [test inventory](../SDLC/06-testing/automated-test-inventory.md) map actual named cases. Future work should reference these IDs instead of creating a competing requirement list.
