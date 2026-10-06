# Product Backlog

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

This is the single list of proposed follow-up work. Priorities below are provisional, not an approved sprint commitment. Delivered features belong in requirements and release history.

| ID | Proposed outcome | Priority | Acceptance evidence | Status |
| --- | --- | --- | --- | --- |
| DOC-001 | Establish current engineering documentation | Current | Map, requirements, architecture, traceability and release records; internal links pass validation | Implemented locally; review pending |
| QA-001 | Record responsive and keyboard checks | High | Create/edit/public journeys checked in both appearances at agreed viewports; issues recorded | Proposed |
| PDF-001 | Verify and refine generated PDF layout | High | Representative short/long resumes render with readable sections, working links and acceptable page breaks | Proposed |
| OPS-001 | Demonstrate coordinated backup/restore | High | Isolated restore reproduces records and private files; steps and recovery expectations recorded | Proposed |
| UX-001 | Improve section-specific error disclosure | Medium | Only sections with relevant validation errors open; Basic Information does not open solely for unrelated errors | Proposed |
| DOC-002 | Expand historical release evidence | Medium | Older tag diffs and published notes reconciled; evidence gaps explicitly marked | Proposed |

UX-001 reflects current template behavior: Basic Information opens for any server validation error, while collection sections use their own error keys. This is documented as a follow-up rather than silently changing application code.

## Additional decisions discovered during detailed analysis

| ID | Outcome | Acceptance evidence | Status |
| --- | --- | --- | --- |
| SEC-013 | Decide inactive-owner effect on active public resumes | Owner-approved policy; requirement and view/download/file tests aligned | Proposed |
| SEC-014 | Review external URL scheme consistency | Inventory all URL rules; agree policy; negative tests for chosen behavior | Proposed |
| OPS-002 | Define operational privacy/monitoring controls | Approved retention/access/alerting decisions and environment evidence | Proposed |
| PERF-001 | Agree performance budgets | Declared fixtures/load/environment and measured results | Proposed |

These items record gaps honestly. This documentation request does not authorize implementation of new policies or operation of a production drill.
