# Requirements and Acceptance Criteria

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

These identifiers document current behavior retrospectively. Implementation and evidence links are maintained in [traceability](../../Project-Management/traceability.md).

| ID | Requirement | Acceptance criteria |
| --- | --- | --- |
| FR-001 | Separate administrator/user access | Protected routes reject unauthorized roles; inactive accounts cannot continue authenticated access |
| FR-002 | Manage multiple owned resumes | Owner can create/update/delete their resumes; another user cannot manage them |
| FR-003 | Maintain resume sections and attachments | Supported details persist; replacements/deletions retain the intended files and remove obsolete ones |
| FR-004 | Control public access | Inactive resumes are unavailable; protected views and downloads require the current access grant |
| FR-005 | Configure downloads | Generated/uploaded/both options permit only the selected downloads |
| FR-006 | Attach named evidence/demo links | Optional valid HTTP/HTTPS URLs and custom labels persist and appear in public/PDF output |
| FR-007 | Edit and display dates | Month selections persist; reversed month ranges and future employment dates fail validation; public/PDF dates use abbreviated month and year |
| FR-008 | Provide compact, themed editors | Both editors expose expandable sections; closing preserves values; invalid fields can be revealed; appearance preference is remembered |
| FR-009 | Track public viewing activity | Public view updates aggregate count and last-viewed timestamp; no unique-visitor guarantee is implied |
| NFR-001 | Protect resume uploads | Resume photos/PDFs/certificates are private and served through authorization checks |
| NFR-002 | Maintain reproducible verification | Locked dependency installation, audits, frontend build and tests run in CI |
| NFR-003 | Make workflows usable and accessible | Labels, keyboard operation, error feedback and responsive layout require both targeted automation and manual review |

Performance budgets, full accessibility conformance and production restore objectives remain unspecified; agree targets before marking them verified.

## Detailed catalogs

This overview summarizes the baseline. Use the [functional catalog](functional-requirements.md), [quality catalog](non-functional-requirements.md), [security/privacy catalog](security-and-privacy-requirements.md), [stories/use cases](user-stories-and-use-cases.md), and [validation matrix](validation-and-acceptance-matrix.md) for detailed acceptance scope.
