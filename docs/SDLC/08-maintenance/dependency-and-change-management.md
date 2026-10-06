# Dependency and Change Management

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Inspect Dependabot or manual update scope, package release impact and lockfile changes. Refresh branches against current main; resolve conflicts by preserving integrated requirements, not by choosing an obsolete lockfile wholesale. Install locked dependencies, audit, build and run affected tests. Verify the final integrated main commit before release.

CI uses composer audit and npm audit --audit-level=high; these are the actual gates, not a promise that every severity/policy is blocked identically. A package being a development dependency does not make its build/runtime impact irrelevant. Never hide advisories by weakening the audit gate solely to merge.

The repository rename changes remote URLs and setup paths; keep app display naming centralized. Compatibility-sensitive identifiers such as legacy browser preference keys may remain deliberately for migration. Database names, domains and historical tags do not automatically follow a product rename.

Review triggers include new auth/file endpoints, schema/data migrations, template/PDF changes, runtime upgrades, concurrency behavior, deployment topology and retention rules. Update requirements/decisions/traceability together with code and mark checks needing new evidence.
