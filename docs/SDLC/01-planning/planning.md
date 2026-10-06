# Planning and Working Method

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

Use small, reviewable changes based on the [backlog](../../Project-Management/product-backlog.md). Before implementation identify the outcome, acceptance criteria, affected code, data changes and verification required. Preserve unrelated local changes.

Use a feature/fix branch and a pull request for integration. Review the complete diff, run proportionate checks, and verify the integrated main commit before tagging a release. A sprint can include requirements, design, implementation and testing; it is not an SDLC phase and does not automatically produce a release.

The [roadmap](../../Project-Management/roadmap.md) identifies proposed outcomes without invented schedules. Prioritize access/privacy defects first, broken workflows next, then evidence and presentation improvements. The product owner approves scope and release decisions; CI supplies evidence rather than product approval.
