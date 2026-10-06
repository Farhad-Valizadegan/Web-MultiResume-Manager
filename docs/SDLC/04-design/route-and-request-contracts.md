# Routes and Request Contracts

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

This application exposes browser-oriented Laravel routes, not a separately versioned public JSON API. [routes/web.php](../../../application/routes/web.php) and [routes/auth.php](../../../application/routes/auth.php) are authoritative.

| Route family | Contract | Gate / result |
| --- | --- | --- |
| /user/resumes | GET list/create; POST create; PUT update; DELETE delete | auth, verified, user; controller ownership |
| /user/resumes/{resume}/password | GET form; PUT confirmed password | owner and user route gate |
| /admin/users and /admin/resumes | Provision/manage users; inspect/delete platform resumes | auth, verified, admin; self/last-admin safeguards |
| /profile | GET/PATCH/DELETE | auth plus global active-account middleware; deletion safeguards |
| /resume/{publicLink} | GET password form; POST password | active resume; POST throttle:10,1; validation/session grant |
| /resume/{publicLink}/view | GET HTML | active; protected visitors redirected; records view |
| /resume/{publicLink}/download-generated-pdf | GET generated PDF | active, grant, generated/both mode |
| /resume/{publicLink}/download-uploaded-pdf | GET uploaded PDF | active, grant, uploaded/both mode and existing file |
| /resume-files/{resume}/{type}/{certificate?} | GET photo/uploaded/certificate | owner/admin or visitor gate; certificate scoped to resume |

Invalid form data redirects with errors and old input. Missing/inactive public resume is 404. Disabled download mode is 403. No current grant redirects in public HTML/PDF controllers but is 403 in the direct file controller. CSRF-invalid submissions are rejected by web middleware. Generated filenames derive from resume name/title; uploaded file contents are not regenerated.

Do not introduce an API contract merely by documenting these routes. Any future external API needs versioning, authentication, rate-limit, serialization and compatibility decisions.
