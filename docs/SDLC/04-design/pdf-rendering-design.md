# PDF Rendering Design

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

DOMPDF loads resources/views/public/resume-pdf.blade.php and uses A4 portrait. The generated download independently verifies active resume, current grant and generated/both mode. Uploaded PDFs are delivered separately from private storage and preserve uploaded content. Both paths choose filenames from resume identity/title.

PDF content includes structured sections and named skill/project/demo links. Public HTML and PDF templates share data but not identical rendering engines or CSS support. Month/year formatting affects dates at presentation time; it does not repair stored years. Certificate issue dates remain date inputs in the editor.

Design goals are readable hierarchy, correct links, no clipped text, reasonable section/page breaks and consistent data. Those goals need long and short fixture rendering. Image availability, fonts, large descriptions and link wrapping can materially affect output. Browser CSS screenshots are not PDF evidence. Use isolated fixtures for rendering rather than publishing private resume samples.

Before altering fonts, remote-resource behavior or rendering limits inspect package configuration and operational resource needs. No broad claim of remote resource safety or tagged-PDF accessibility is made by this document.
