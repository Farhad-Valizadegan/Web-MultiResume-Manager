# Manual Acceptance Checklist

Status: Procedure — execution evidence must be recorded
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Use synthetic content with no private contact data. Record commit, browser/version, viewport, appearance, database and result. A checklist is a procedure until its result is recorded.

| Check | Expected behavior |
| --- | --- |
| Empty create form | Collapsed sections; required title error reveals/focuses field |
| Repeatable sections | Add/remove rows; values/labels retained on validation failure |
| Edit saved resume | Existing content/files survive unchanged submission |
| Section navigation | Target opens; keyboard can expand/collapse; values remain |
| Unsaved changes | Relevant field edits warn on leaving; successful submit clears warning |
| Appearance | Light/Dark/System persists; focus/text/input contrast readable |
| Narrow viewport | Navigation, long brand, cards and actions remain usable without clipping |
| Public access | Password-free/protected/inactive states match contracts |
| Downloads | generated/uploaded/both enforced even through direct URL |
| Evidence/demo | Correct custom labels, safe navigation and wrapping |
| Month dates | Equal/ongoing/future-education cases; invalid ranges fail |
| PDF short/long fixtures | Readable font, no lost sections, links work, page breaks acceptable |
| Account deactivation | Existing authenticated session blocked; separately record public resume behavior |

For accessibility inspect labels, heading order, keyboard reachability, visible focus, error announcement, zoom and contrast. Agree target standard/level separately; do not mark conformance based on this checklist alone. Record failures in backlog with reproduction evidence.
