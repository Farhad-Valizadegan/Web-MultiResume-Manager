# Data Classification and Lifecycle

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| Category | Storage/use | Exposure and lifecycle |
| --- | --- | --- |
| Account identity/password hash | users; authentication | Account/admin paths; never expose hash; deletion governed by safeguards |
| Account profile | profiles and public account photo | Different policy from resume files; clarify chosen public exposure |
| Resume content/contact details | resumes and detail tables | Visible to authorized visitors when active; owner chooses content |
| Resume photos, uploaded PDF, certificate files | storage/app/private | File gate; replacement/deletion cleanup; backups may retain copies |
| Employer password hash | resumes | Hash only; hash change alters grants |
| Visitor grant | Session | Bound to resume/hash; lifetime follows configured session policy |
| Aggregate view count/time | resumes | Internal owner/admin statistics; no event-level visitor identity claimed |
| Logs and backups | Environment-dependent | Sensitive retention/access policy must be established by operator |

## Lifecycle

Validate before persistence. Related data remains with its owning resume. File replacement defers obsolete-file deletion until commit; failure compensates new uploads. Deleting a resume/account should remove related live files through hooks/service, while backup copies follow a separate retention policy.

## Outstanding privacy decisions

No numeric retention periods, lawful-processing determination, consent mechanism or production deletion SLA are established here. Define backup expiry, log minimization, administrator access reviews and visitor notice with the owner. A private disk means access-controlled storage; it does not prove encryption at rest. Maps/evidence links cross external boundaries when followed.
