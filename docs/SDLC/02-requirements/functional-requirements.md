# Functional Requirements

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| ID | Capability | Requirement | Acceptance criteria |
| --- | --- | --- | --- |
| FR-001 | Role and account access | Protected admin/user areas enforce roles and active authenticated accounts. | Wrong role rejected; deactivation invalidates continuing authenticated use. |
| FR-002 | Owned resume management | Create, list, update and delete multiple owned resumes. | Other owners cannot edit/delete records through user endpoints. |
| FR-003 | Structured sections and uploads | Maintain personal information and seven related detail collections. | Repeatable rows persist correctly; failed submissions retain entered text and valid file references. |
| FR-004 | Public resume access | Serve active resumes with optional password grants. | Inactive/missing resumes fail; password change invalidates the previous grant. |
| FR-005 | Download modes | Support generated, uploaded and both. | Each public download enforces active state, grant and selected mode. |
| FR-006 | Named external links | Save optional skill evidence and separate project/demo labels/URLs. | HTTP/HTTPS evidence/demo validation; labels escaped; HTML/PDF render valid content. |
| FR-007 | Month editing and date display | Normalize month inputs; display abbreviated month/year. | Reject reversed month ranges and future employment dates; permit expected graduation. |
| FR-008 | Compact editor and appearance | Native expandable sections and Light/Dark/System. | Fields survive closing; navigation opens destination; invalid fields are revealed. |
| FR-009 | Aggregate view statistics | Increment public view count and record latest view timestamp. | Authorized public viewing updates values; no unique-visitor claim. |
| FR-010 | Administrator provisioning | Create/update account roles/status and manage platform resumes. | Valid unique email and password required; invalid role/status rejected; self/last-admin safeguards enforced. |
| FR-011 | Account profile lifecycle | Update profile, password and permitted account deletion. | Validation errors do not change existing values; deletion safeguards and file cleanup remain effective. |
| FR-012 | Certificate attachments | Maintain certificate content and optional file/link fields. | A certificate file route cannot retrieve a certificate belonging to a different resume. |

Requirements describe the inspected application, not historical planning approvals. Verification mapping is in [traceability](../../Project-Management/traceability.md); browser/PDF acceptance criteria require representative output evidence in addition to persistence tests. Public owner-account deactivation semantics need clarification: current public queries filter resume status, not the owner's status.
