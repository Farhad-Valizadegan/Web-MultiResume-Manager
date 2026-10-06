# Validation and Acceptance Matrix

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| Input/setting | Server rule at baseline | Boundary cases |
| --- | --- | --- |
| Resume title | Required string, max 255 | Missing, whitespace handling, max/over-max |
| Personal contact email | Optional valid email, max 255 | Empty, invalid syntax, long value |
| Resume photo | Image JPG/JPEG/PNG/WebP, max 2048 KB | Disguised non-image, limit, replacement |
| Uploaded resume | PDF, max 5120 KB | Missing when required; mode switch; corrupt/disguised file |
| Certificate file | PDF/JPG/JPEG/PNG/WebP, max 4096 KB | Replacement, removal, foreign certificate ID |
| Download mode | generated / uploaded / both | Unknown value; absent uploaded PDF |
| Skill style | compact / cards | Unknown/absent value |
| Resume theme | professional_blue / dark_modern / minimal_light | Unknown/absent value |
| Evidence/demo URL | Optional HTTP/HTTPS URL, max 2048 | Unsafe scheme, malformed URL, absent label |
| Project URL | Optional HTTP/HTTPS URL, max 255 | Overlength; label absent |
| Link labels | Optional string, max 100 | HTML-like content escaped; overlength |
| Employment dates | Optional dates, no future, month order | Invalid month; equal month; ongoing entry |
| Education dates | Optional dates, month order | Future completion allowed; reversed range fails |
| Certificate issue date | Optional date | Remains a date input, not month editor |

Website/social/certificate URL fields use their own url rules; do not generalize evidence/demo protocol restrictions to every field. HTTP upload ceilings also depend on PHP/web-server settings, which can reject a request before Laravel validation.

Acceptance record should name requirement, sample, expected result, actual result, commit, environment and verifier. Automated assertions are authoritative for their exercised boundary; manual checks are needed for rendered layout and keyboard flow.
