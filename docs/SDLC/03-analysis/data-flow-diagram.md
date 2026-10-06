# Data Flow and Trust Boundaries

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

The private file boundary is distinct from record access. Counts are stored internally and not exposed as employer-facing analytics. Read authorization happens again on downloads/files; permission to read an HTML page is not a bypass for direct file paths.

```mermaid
flowchart LR
    User[Authenticated Owner] -->|Validated form| Controller[Resume Controller]
    Controller -->|Transaction| DB[(Resume Records)]
    Controller -->|Upload and cleanup| Files[(Private Files)]
    Visitor[Visitor] -->|Link and optional password| Gate[Public Access Gate]
    Gate -->|Authorized read| DB
    Gate --> View[HTML or PDF]
    View --> Visitor
    Visitor --> FileGate[File Authorization]
    FileGate --> Files
    DB -->|Aggregate counts| Dashboard[Owner Dashboard]
```

Editable source: [data-flow-diagram.mmd](diagrams/data-flow-diagram.mmd).

## PlantUML view

This is a PlantUML rendering of the existing documented view. Read the accompanying document for the source references, constraints, and details omitted from this overview.

![Data Flow Diagram](diagrams/data-flow-diagram.svg)

[Editable PlantUML source](diagrams/data-flow-diagram.puml) · [Full-size diagram](diagrams/data-flow-diagram.svg)
