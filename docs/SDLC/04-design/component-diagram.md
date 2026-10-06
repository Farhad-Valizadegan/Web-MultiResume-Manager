# Components and Responsibilities

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Ownership/role decisions remain server-side. ResumeFiles owns transactional file coordination. Templates render data; browser JavaScript improves interactions but does not authorize requests. Account authentication uses Breeze-derived controllers and Laravel session behavior.

```mermaid
flowchart LR
    Routes[Routes and Middleware] --> User[User Resume Controller]
    Routes --> Admin[Admin Controllers]
    Routes --> Public[Public Resume Controller]
    Routes --> File[Resume File Controller]
    User --> Service[ResumeFiles Service]
    Admin --> Service
    User --> Models[Eloquent Models]
    Public --> Models
    File --> Models
    Service --> Models
    Service --> Storage[Filesystem]
    Public --> Templates[Public HTML and PDF Templates]
    User --> Forms[Editor Partials and Dynamic Rows]
```

Editable source: [component-diagram.mmd](diagrams/component-diagram.mmd).
