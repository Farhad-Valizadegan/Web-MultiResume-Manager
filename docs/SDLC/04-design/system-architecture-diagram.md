# System Architecture

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

This is a monolith with server-rendered forms, not OmniDesk’s React/REST provider architecture. MySQL reflects the documented development environment; tests use SQLite. Web-server and PHP-FPM production choices are deployment configuration rather than verified infrastructure inventory.

```mermaid
flowchart TB
    Browser[Browser - HTML Forms and Alpine]
    Server[Web Server - public directory]
    Laravel[Laravel Routing Middleware Controllers]
    Views[Blade Templates]
    PDF[DOMPDF]
    DB[(MySQL Development Database)]
    Uploads[(Private Uploads)]
    Browser --> Server --> Laravel
    Laravel --> Views --> Browser
    Laravel --> PDF --> Browser
    Laravel --> DB
    Laravel --> Uploads
    Vite[Vite Build] --> Assets[public/build Assets]
    Assets --> Browser
```

Editable source: [system-architecture-diagram.mmd](diagrams/system-architecture-diagram.mmd).

## PlantUML view

This is a PlantUML rendering of the existing documented view. Read the accompanying document for the source references, constraints, and details omitted from this overview.

![System Architecture Diagram](diagrams/system-architecture-diagram.svg)

[Editable PlantUML source](diagrams/system-architecture-diagram.puml) · [Full-size diagram](diagrams/system-architecture-diagram.svg)
