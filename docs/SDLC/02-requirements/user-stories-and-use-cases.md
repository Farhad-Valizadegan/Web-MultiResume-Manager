# User Stories and Use Cases

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Stories

US-001: As an owner, I want several resumes so I can tailor each version to an opportunity (FR-002/003). US-002: As a visitor, I want a readable resume and permitted PDF without needing an account (FR-004/005). US-003: As an owner, I want separate named repository/demo links so evidence is understandable (FR-006). US-004: As an owner, I want month-based dates and compact sections so editing is manageable (FR-007/008). US-005: As an administrator, I want controlled provisioning while retaining administrator access (FR-010). US-006: As a maintainer, I want reproducible checks and recovery procedures (NFR-002/006).

## UC-001 — Create a resume

Precondition: active authenticated user with required route access. Enter title, content, display/download settings and optional files/password. Validate data and normalize month fields. Store uploads and related records through the transaction wrapper. Success redirects with confirmation and a generated public link. Invalid inputs return errors/old text; failed transactions remove newly created files. Uploaded/both mode requires a PDF. No claim that a cancelled browser upload preserves its bytes.

## UC-002 — Update an existing resume

Precondition: ownership. Load current details, edit repeatable rows, select retained/replaced files and submit. Validate before replacing records. Certificates have identity-sensitive synchronization rather than indiscriminate replacement. Success retains intended data; validation/write failures preserve prior records and files. See synchronization design for the distinction.

## UC-003 — Read/download a protected public resume

Find active resume by public link. If protected and no current grant, redirect to password form. Correct password establishes a session grant; wrong/limited attempts do not. Rendering records a view. Downloads separately recheck grant and mode; missing upload is 404, disabled mode is 403. Direct file routes return 403 for absent grant rather than password redirect.

## UC-004 — Change public password

Precondition: owner. The dedicated password form requires a confirmed password of at least six characters. New hash changes the expected token and revokes grants bound to the old hash. This does not invalidate copies already downloaded. Initial create/update validation is distinct from the dedicated confirmed-password flow.

## UC-005 — Remove account or resume

Precondition: authorized actor and administrator safeguards. Model hooks coordinate resume-related file cleanup with deletion. Verify database/file effects, including certificates. Cascading schema deletion is not by itself proof of filesystem cleanup. Failures must be observable to the operator.

## UC-006 — Use appearance and editor disclosure

Choose Light, Dark or System; reload and confirm preference. Open section by summary or navigation, add/change a row, collapse/reopen and verify values. Trigger validation in a hidden field and verify focus/reveal. This browser journey complements backend tests and must be recorded with viewport/browser details.
