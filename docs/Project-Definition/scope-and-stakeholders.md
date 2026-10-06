# Scope and Stakeholders

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

## Current scope

Administrator-created accounts, login and account profile management; separate role-based workspaces; multiple resumes per user; resume sections and uploads; active/inactive resumes; password-protected public access; generated/uploaded PDF options; named skill evidence and project/demo links; month editing; display preferences; aggregate view counts.

Public self-registration is disabled in routes/auth.php. Registration templates and tests must not be treated as evidence of an enabled public registration feature.

## Outside the documented baseline

Payments, employer accounts, applicant tracking integrations, collaborative editing, AI-generated content and multilingual content management are not claimed as delivered features. Adding them requires explicit scope and acceptance decisions.

## Stakeholders and dependencies

Account owners edit and share resumes. Employers/visitors read permitted resumes and download enabled files. Administrators manage accounts and platform records. Maintainers operate releases and recovery. External dependencies include Composer/npm packages, database and web-server infrastructure, configured mail delivery, and visitor-selected external links. Google Maps and evidence/demo websites are destinations, not managed integrations.

Repository/folder identity is Web-MultiResume-Manager; the display name is MultiResume Manager. Package identifiers may use lowercase registry-compatible names. The existing deployment domain is distinct from repository identity.
