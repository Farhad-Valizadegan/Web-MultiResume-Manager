# Analysis Decisions and Open Questions

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| Topic | Current interpretation | Decision still needed |
| --- | --- | --- |
| Resume vs account identity | Resume fields independent of profile | Whether an explicit copy-from-profile action is desirable |
| Public view metric | Aggregate accesses, not unique visitors | Any new event-level analytics requires privacy review |
| Month storage | First day represents a selected month | Whether legacy day precision should be preserved on unchanged edits |
| Account deactivation | Blocks authenticated use | Whether it must also unpublish active resumes |
| Error disclosure | Collection errors open related sections; Basic Information opens on any error | Section-specific basic error mapping (UX-001) |
| External URLs | Evidence/demo limited to HTTP/HTTPS | Consistent scheme policy for other URL fields |
| PDFs | Separate template, A4 portrait | Agreed pagination/readability criteria across long fixtures |
| Operations | Runbooks proposed | Backup frequency, retention, recovery goals and responsible operator |

Record answers with rationale, changed requirements, impacted design/tests and approval date. Do not convert questions into completed backlog work or quietly implement a different policy during documentation authoring.
