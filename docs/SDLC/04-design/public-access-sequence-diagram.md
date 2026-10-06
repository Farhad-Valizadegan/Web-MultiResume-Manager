# Public Access Sequence

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Separate requests recheck access. Incorrect passwords do not establish a grant. Uploaded/download file paths do not become publicly accessible merely because a visitor has previously seen HTML. See route contracts for redirect versus HTTP denial differences.

```mermaid
sequenceDiagram
    actor Visitor
    participant Public as PublicResumeController
    participant Resume
    participant Session
    Visitor->>Public: GET public view
    Public->>Resume: Find active public_link
    Public->>Resume: allowsPublicAccess
    Resume->>Session: Read grant
    alt No current grant and password protected
        Public-->>Visitor: Redirect password form
        Visitor->>Public: POST password (throttled)
        Public->>Resume: Check password hash
        Public->>Session: Store current token
        Public-->>Visitor: Redirect public view
    else Access permitted
        Public->>Resume: Increment count / last_viewed_at
        Public-->>Visitor: Render HTML
    end
    Visitor->>Public: GET PDF
    Public->>Resume: Recheck active state, grant and mode
    Public-->>Visitor: PDF or denial
```

Editable source: [public-access-sequence-diagram.mmd](diagrams/public-access-sequence-diagram.mmd).

## PlantUML view

This is a PlantUML rendering of the existing documented view. Read the accompanying document for the source references, constraints, and details omitted from this overview.

![Public Access Sequence Diagram](diagrams/public-access-sequence-diagram.svg)

[Editable PlantUML source](diagrams/public-access-sequence-diagram.puml) · [Full-size diagram](diagrams/public-access-sequence-diagram.svg)
