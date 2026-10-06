# Resume Update Sequence

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

The transaction wrapper compensates filesystem changes, with reported cleanup failures. Exact controller exceptions may use Laravel’s error handling; the diagram does not promise that every storage failure has a custom friendly form message.

```mermaid
sequenceDiagram
    actor Owner
    participant Controller
    participant Files as ResumeFiles
    participant DB
    participant Disk
    Owner->>Controller: Submit owned resume form
    Controller->>Controller: Normalize and validate
    Controller->>Files: transaction(operation)
    Files->>DB: Begin transaction
    Controller->>Files: Store new / queue obsolete files
    Files->>Disk: Write new uploads
    Controller->>DB: Update resume / synchronize rows
    alt Operation succeeds
        Files->>DB: Commit
        Files->>Disk: Delete obsolete files
        Controller-->>Owner: Redirect success
    else Operation throws
        Files->>DB: Roll back
        Files->>Disk: Remove newly created files
        Controller-->>Owner: Failure response
    end
```

Editable source: [resume-update-sequence-diagram.mmd](diagrams/resume-update-sequence-diagram.mmd).
