# Project Planning Overview

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Inputs and decisions

Planning consumes the product definition, current implementation, known defects, operational constraints and [backlog](../../Project-Management/product-backlog.md). It produces a bounded goal, acceptance criteria, dependencies and verification plan. Dates and staffing are only recorded when actually agreed.

## Change workflow

Inspect the working tree and relevant source. Clarify the observable behavior, preserve unrelated changes, choose the smallest useful increment, and link it to requirements. Add or identify meaningful regression coverage. Review the complete diff and build/test evidence before integration. Verify integrated main before tagging.

Documentation responsibilities are shared across the change: requirement changes belong in requirements; technical trade-offs in design decisions; scope/status in the backlog; iteration outcomes in sprint records; delivered version details in releases. This avoids separate, contradictory status lists.

## Completion criteria

Acceptance criteria are met; required checks have fresh results; unresolved limitations are recorded; upgrade/recovery implications are understood; and the reviewer can locate code and evidence. A green workflow alone does not establish that an untested visual or operational requirement is complete.
