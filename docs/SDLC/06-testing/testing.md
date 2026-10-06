# Testing and Verification

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

## Automated checks

The [CI workflow](../../../.github/workflows/tests.yml) runs on main pushes, ci/** pushes, and pull requests targeting main. It installs locked Composer/npm dependencies, audits them, builds assets and runs Laravel tests with PHP 8.2 / Node.js 22. The PHPUnit configuration uses SQLite :memory:, array-backed cache/session/mail and synchronous queues.

From the repository root on Windows:

```powershell
C:\xampp\php\php.exe -d extension=gd vendor\phpunit\phpunit\phpunit
npm.cmd run build
C:\xampp\php\php.exe artisan view:cache
git diff --check
```

Use the explicit GD flag where local image-related tests need it. php artisan test is the CI entry point. Audit commands are composer audit and npm.cmd audit --audit-level=high. Tests must run against their isolated configuration, never by resetting the development or production database.

## Recorded baseline and limits

The v1.2.1 work recorded 142 tests / 748 assertions locally and a successful main CI run. This is historical evidence, not a fresh run for this documentation change. Test counts can change. Relevant suites cover ownership, public access, file handling, nested sections, evidence/demo links and date editing. See [traceability](../../Project-Management/traceability.md).

Before a visual release manually inspect both editors, empty/populated sections, validation feedback, keyboard operation, narrow screens, Light/Dark/System, public resumes and generated PDFs. Check that links retain labels and that long content does not overflow. Record browser, viewport, sample data and commit. Existing suite success does not establish complete PDF pagination or accessibility conformance.
