# Deployment Boundaries

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

This is a deployment design boundary, not an assertion that a particular production machine has these controls configured. TLS, runtime/storage permissions, session persistence, mail and protected recovery must be verified in the chosen environment.

```mermaid
flowchart LR
    Client[HTTPS Browser] --> Web[Web Server - public Root]
    Web --> PHP[PHP Runtime - Laravel]
    PHP --> DB[(Configured Database)]
    PHP --> Private[(Private Upload Volume)]
    PHP --> Session[Configured Session Store]
    PHP --> Mail[Configured Mail Delivery]
    Operator[Operator] --> Backup[(Protected Coordinated Backups)]
    DB -. Backup .-> Backup
    Private -. Backup .-> Backup
```

Editable source: [deployment-architecture.mmd](diagrams/deployment-architecture.mmd).
