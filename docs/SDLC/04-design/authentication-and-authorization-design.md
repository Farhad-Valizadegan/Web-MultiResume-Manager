# Authentication and Authorization Design

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Boundaries

Laravel web sessions and CSRF protection support browser forms. Breeze-derived login/logout, verification, recovery and password controllers are present. Public registration endpoints are commented out. EnsureAccountIsActive runs in the web middleware stack and logs out/invalidate sessions for inactive authenticated accounts. AdminMiddleware/UserMiddleware enforce route roles; controller ownership checks govern resume operations.

## Public grants

Resume::publicAccessToken computes an HMAC using the password hash and application key. A successful public password check stores the token in session under a resume-specific key. allowsPublicAccess accepts password-free resumes or compares the current token in constant-time. Replacing a password hash invalidates earlier grants; changing APP_KEY also changes tokens and affects framework cryptography.

## Access matrix

| Operation | Owner | Admin | Other user / guest |
| --- | --- | --- | --- |
| User resume edit/delete | Owned records via user routes | Admin-specific management differs; do not imply user-route access | Denied |
| Admin user/resume management | Denied to ordinary user | Admin route permissions and safeguards | Denied |
| Public HTML/PDF endpoints | Visitor gates still apply | Visitor gates still apply | Active state and current grant; PDF mode |
| Private file route | Ownership permits file | Role permits file | Active resume, grant, uploaded-mode gate as applicable |

File-owner/admin bypass is specific to ResumeFileController, not a universal public-controller bypass. Certificate IDs are queried through the selected resume. Inactive-owner effects on public resumes remain a separate open product question. Deployment cookie flags, proxy handling and session persistence need environment-specific review.
