# Security Regression Matrix

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| Boundary | Positive check | Negative check | Evidence source |
| --- | --- | --- | --- |
| Login/status | Active account signs in | Inactive login/existing session blocked | ResumeRegressionTest |
| Ownership | Owner edits owned resume | Other user forbidden | ResumeManagementTest and section suites |
| Public grant | Correct password permits view | Wrong/no/stale grant fails | PublicResumeAccessTest; ResumeRegressionTest |
| Throttle | Ordinary attempt supported | Excess attempts limited | public_password_attempts_are_limited |
| Files | Owner/admin or authorized visitor reads permitted file | Grant/mode/active gate fails | private_file_access_obeys_password_owner_and_download_settings |
| Certificates | Own resume-scoped certificate reads | Foreign resume certificate ID fails | certificate_route_cannot_read_a_different_resumes_certificate |
| Deletion | Authorized delete cleans files | Last-admin/self safeguards retain access | AdminUserManagementTest; ResumeRegressionTest |
| Transaction failure | Successful replacement commits | Injected failure retains original state/files | failed_update_rolls_back_database_and_preserves_original_files |
| Migration | Legacy file content retained | Public duplicate removed | file_migration_preserves_content_and_removes_public_copy |
| External links | HTTP/HTTPS evidence saves | Invalid scheme rejected | SkillEvidenceLinkTest; ProjectDemoLinkTest |

Names refer to test method suffixes under tests/Feature. The [test inventory](automated-test-inventory.md) supplies exact files and methods. This mapping is traceability; use a recorded run to claim execution. Broader deployed headers/cookies, MySQL concurrency and secret/backup controls require environment-specific verification.
