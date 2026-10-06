# Backlog Refinement

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Each proposed item needs a problem, expected observable outcome, requirement references, scope/exclusions, risk/constraints, affected source, acceptance checks, evidence and dependencies. Split items when they contain independently reviewable outcomes. Do not mark a document, source file or passing unrelated test as acceptance of a whole feature.

Use Proposed → Ready → In progress → Review → Accepted, with Blocked used for a specific dependency. This is a recommended tracking workflow, not a claim that a tool enforces it. Owner decides priority and commitment; estimates/dates remain absent until agreed.

Refinement should clarify unknowns before implementation: for example account deactivation/public exposure, URL scheme consistency, PDF fixtures and restore goals. Close delivered items with code/PR and checks, move residual work explicitly, and avoid a second competing backlog inside sprint or design documents.
