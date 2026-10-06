# Journeys and Business Rules

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

The main owner journey is administrator-provisioned account → sign in → create/edit resume → select access/download settings → share public link → inspect aggregate views. The visitor journey is public link → password challenge when configured → readable resume → permitted download. Administrators manage users and platform resumes in a separate workspace.

Business rules include owner-only resume editing; active resume requirement for public access; hashed employer passwords; password-derived session grants; download-mode enforcement; and related-file cleanup. Account activation and resume activation are separate states and should be analyzed separately when modifying access behavior.

Experience and education are edited by month. Employment dates cannot be future dates, while expected education completion may be future-dated. Month inputs normalize to the first day for storage; this is a representation convention, not a claim of an exact real-world day.

Skills and projects have optional external evidence links. These destinations are supplied by owners, and the application does not verify their external content. View counts represent accesses, not deduplicated people.

Open analysis questions: appropriate analytics retention; agreed accessibility and performance targets; and recovery expectations. Track work in the [backlog](../../Project-Management/product-backlog.md), not as completed controls.

## Detailed analysis

See the [analysis index](README.md) for business rules, domain/data flow, resume state, lifecycle classification, threats and open decisions.
