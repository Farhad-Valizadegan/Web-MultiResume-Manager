# Stakeholders and External Systems

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| Actor | Goal | Permissions and constraints |
| --- | --- | --- |
| Owner/user | Build, tailor and share resumes | Manage own resumes and profile; cannot administer other accounts |
| Administrator | Provision accounts and manage platform records | Separate admin routes; safeguards prevent removal of the last active administrator |
| Employer/visitor | Read professional information and download enabled files | Only active public resumes; current grant required when password-protected |
| Maintainer/operator | Deliver and recover the application | Configuration, releases and backups; operational privileges are outside application role design |

Database and filesystem store different parts of a resume. Composer/npm registries supply software, GitHub supplies source history and CI, and configured mail infrastructure handles account messages. External websites host evidence, demos, professional profiles and Google Maps.

Following an external link leaves the application boundary. Maps links may disclose the displayed address to the destination. External content is not validated for accuracy, availability or privacy by this application. Those URLs are user-provided references rather than provider synchronization integrations.

Ownership of product scope and release acceptance remains with the project owner. Reviewers provide evidence and findings. Document authoring does not assign new employees, invent stakeholders or establish legal approval.
