# Non-functional Requirements

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| ID | Attribute | Requirement and acceptance evidence | Current qualification |
| --- | --- | --- | --- |
| NFR-001 | Confidentiality | Private resume uploads must cross authorization checks | Implemented; route regressions exist |
| NFR-002 | Reproducibility | Locked install, audits, build and tests on reviewed commit | CI configured; inspect each run |
| NFR-003 | Usability/accessibility | Labels, keyboard controls, errors and responsive layout | Partial evidence; full conformance unverified |
| NFR-004 | Integrity | Failed writes preserve old records/files; obsolete files cleaned | ResumeFiles plus regression coverage; cleanup failures reported |
| NFR-005 | Maintainability | Source, requirements, decisions and evidence remain traceable | Documentation baseline now exists; reviewer acceptance pending |
| NFR-006 | Recoverability | Restore database/files/configuration consistently | Procedure documented; production restore not executed |
| NFR-007 | Performance | Establish budgets for editing/public/PDF generation using realistic fixtures | Proposed; no latency or capacity guarantees |
| NFR-008 | Privacy | Avoid leaking credentials or unnecessary personal data in logs/docs | Engineering expectation; deployed logging/retention review pending |

Agree measurable targets before adding pass/fail claims. Proposed measurements include representative viewport task completion, PDF page-break/readability results, response percentiles under declared load, restore duration and recoverable data window. None is a committed service-level objective yet.
