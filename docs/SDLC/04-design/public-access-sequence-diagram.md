# Public Access Sequence

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Separate requests recheck access. Incorrect passwords do not establish a grant. Uploaded/download file paths do not become publicly accessible merely because a visitor has previously seen HTML. See route contracts for redirect versus HTTP denial differences.

## PlantUML view

The diagram summarizes the documented view. The explanation above provides its context and limitations.

![Public Access Sequence Diagram](diagrams/public-access-sequence-diagram.svg)

[Editable PlantUML source](diagrams/public-access-sequence-diagram.puml) · [Full-size diagram](diagrams/public-access-sequence-diagram.svg)
