# Deployment Boundaries

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

This is a deployment design boundary, not an assertion that a particular production machine has these controls configured. TLS, runtime/storage permissions, session persistence, mail and protected recovery must be verified in the chosen environment.

## PlantUML view

The diagram summarizes the documented view. The explanation above provides its context and limitations.

![Deployment Architecture](diagrams/deployment-architecture.svg)

[Editable PlantUML source](diagrams/deployment-architecture.puml) · [Full-size diagram](diagrams/deployment-architecture.svg)
