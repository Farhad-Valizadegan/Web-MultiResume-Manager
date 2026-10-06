# Release Pipeline

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

1. Confirm intended scope and acceptance criteria.
2. Review/integrate the change without unrelated work.
3. Run required tests, dependency audits and production asset build on the selected revision.
4. Check relevant manual/PDF/accessibility and migration/operational evidence.
5. Resolve blockers or explicitly defer non-blocking issues with owner acceptance.
6. Prepare factual release notes, upgrade steps and rollback decision.
7. Verify the final main commit, choose a version and tag that exact commit.
8. Record release URL, target hash and validation evidence; verify deployed environment separately.

A green pull-request run does not necessarily prove a later merge commit; a queued/cancelled runner is not a passed test. Do not retarget old tags to include later fixes. A repository/name change does not change earlier tagged source. Documentation structure alone does not authorize a new release.
