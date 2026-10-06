# Test Strategy

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Selection by risk

Use feature tests for request validation, ownership, public grants, download mode, nested persistence and file cleanup. Exercise real controllers/models with isolated database/storage collaborators. Pure helper behavior can use unit coverage when it adds meaningful protection. Avoid tests that simply restate class names or snapshot implementation formatting.

## Environment

phpunit.xml configures in-memory SQLite, array session/cache/mail and synchronous queue. Local image fixtures require GD; use the explicit XAMPP PHP command in [testing](testing.md). Real SMTP, production MySQL locking, real uploads and browser rendering require additional controlled checks. Never point destructive test preparation at production data.

## Layers and gaps

Request tests prove server contracts; browser checks prove navigation, invalid-field focus, dynamic labels and unsaved edits; PDF rendering proves layout/link output; operational drills prove deployment/recovery. Each layer is different. Record absent evidence instead of treating a passing suite as a substitute.

## Failure triage

Classify assertion defect, source regression, environment problem, stale generated assets, external dependency or CI runner delay. Read logs and actual executed steps. A cancelled predecessor workflow is not the latest commit’s failure. Re-run only when a cause or fresh change justifies it.
