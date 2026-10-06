# PlantUML diagram guide

Start with project context, then system architecture, domain model and public access. Use the workflow diagrams for editing, upgrades and incident investigation. Arrows show direction or relationships; labels explain the operation; cardinalities show how many related records can exist.

SVG previews are committed so GitHub readers can see the diagrams without installing a renderer. Each preview has an editable .puml source. PlantUML is the single diagram format; each concept has one source and its rendered preview.

| View | Editable source | Rendered preview |
| --- | --- | --- |
| [Project Context Diagram](Project-Definition/project-context-diagram.md) | [Source](Project-Definition/diagrams/project-context-diagram.puml) | [Diagram](Project-Definition/diagrams/project-context-diagram.svg) |
| [Scope Boundary Diagram](Project-Definition/scope-boundary-diagram.md) | [Source](Project-Definition/diagrams/scope-boundary-diagram.puml) | [Diagram](Project-Definition/diagrams/scope-boundary-diagram.svg) |
| [Data Flow Diagram](SDLC/03-analysis/data-flow-diagram.md) | [Source](SDLC/03-analysis/diagrams/data-flow-diagram.puml) | [Diagram](SDLC/03-analysis/diagrams/data-flow-diagram.svg) |
| [Domain Model](SDLC/03-analysis/domain-model.md) | [Source](SDLC/03-analysis/diagrams/domain-model.puml) | [Diagram](SDLC/03-analysis/diagrams/domain-model.svg) |
| [Resume State Diagram](SDLC/03-analysis/resume-state-diagram.md) | [Source](SDLC/03-analysis/diagrams/resume-state-diagram.puml) | [Diagram](SDLC/03-analysis/diagrams/resume-state-diagram.svg) |
| [Component Diagram](SDLC/04-design/component-diagram.md) | [Source](SDLC/04-design/diagrams/component-diagram.puml) | [Diagram](SDLC/04-design/diagrams/component-diagram.svg) |
| [Data Model And Erd](SDLC/04-design/data-model-and-erd.md) | [Source](SDLC/04-design/diagrams/data-model-and-erd.puml) | [Diagram](SDLC/04-design/diagrams/data-model-and-erd.svg) |
| [Public Access Sequence Diagram](SDLC/04-design/public-access-sequence-diagram.md) | [Source](SDLC/04-design/diagrams/public-access-sequence-diagram.puml) | [Diagram](SDLC/04-design/diagrams/public-access-sequence-diagram.svg) |
| [Resume Update Sequence Diagram](SDLC/04-design/resume-update-sequence-diagram.md) | [Source](SDLC/04-design/diagrams/resume-update-sequence-diagram.puml) | [Diagram](SDLC/04-design/diagrams/resume-update-sequence-diagram.svg) |
| [System Architecture Diagram](SDLC/04-design/system-architecture-diagram.md) | [Source](SDLC/04-design/diagrams/system-architecture-diagram.puml) | [Diagram](SDLC/04-design/diagrams/system-architecture-diagram.svg) |
| [Deployment Architecture](SDLC/07-deployment/deployment-architecture.md) | [Source](SDLC/07-deployment/diagrams/deployment-architecture.puml) | [Diagram](SDLC/07-deployment/diagrams/deployment-architecture.svg) |
| [Roles and use cases](SDLC/02-requirements/roles-and-use-cases.md) | [Source](SDLC/02-requirements/diagrams/roles-and-use-cases.puml) | [Diagram](SDLC/02-requirements/diagrams/roles-and-use-cases.svg) |
| [Resume editing activity](SDLC/03-analysis/resume-editing-activity.md) | [Source](SDLC/03-analysis/diagrams/resume-editing-activity.puml) | [Diagram](SDLC/03-analysis/diagrams/resume-editing-activity.svg) |
| [Repository layout](SDLC/04-design/repository-layout.md) | [Source](SDLC/04-design/diagrams/repository-layout.puml) | [Diagram](SDLC/04-design/diagrams/repository-layout.svg) |
| [Public download decision](SDLC/04-design/download-decision.md) | [Source](SDLC/04-design/diagrams/download-decision.puml) | [Diagram](SDLC/04-design/diagrams/download-decision.svg) |
| [Change delivery](SDLC/05-implementation/change-delivery.md) | [Source](SDLC/05-implementation/diagrams/change-delivery.puml) | [Diagram](SDLC/05-implementation/diagrams/change-delivery.svg) |
| [Verification layers](SDLC/06-testing/verification-layers.md) | [Source](SDLC/06-testing/diagrams/verification-layers.puml) | [Diagram](SDLC/06-testing/diagrams/verification-layers.svg) |
| [Upgrade procedure](SDLC/07-deployment/upgrade-activity.md) | [Source](SDLC/07-deployment/diagrams/upgrade-activity.puml) | [Diagram](SDLC/07-deployment/diagrams/upgrade-activity.svg) |
| [Incident triage](SDLC/08-maintenance/incident-triage.md) | [Source](SDLC/08-maintenance/diagrams/incident-triage.puml) | [Diagram](SDLC/08-maintenance/diagrams/incident-triage.svg) |
| [Documentation traceability](Project-Management/documentation-traceability.md) | [Source](Project-Management/diagrams/documentation-traceability.puml) | [Diagram](Project-Management/diagrams/documentation-traceability.svg) |
| [Protected management-route authorization](SDLC/04-design/authorization-decision-flow.md) | [Source](SDLC/04-design/diagrams/authorization-decision-flow.puml) | [Diagram](SDLC/04-design/diagrams/authorization-decision-flow.svg) |
| [Private-file access sequence](SDLC/04-design/private-file-access-sequence.md) | [Source](SDLC/04-design/diagrams/private-file-access-sequence.puml) | [Diagram](SDLC/04-design/diagrams/private-file-access-sequence.svg) |
| [Resume password change and grant invalidation](SDLC/04-design/password-change-sequence.md) | [Source](SDLC/04-design/diagrams/password-change-sequence.puml) | [Diagram](SDLC/04-design/diagrams/password-change-sequence.svg) |
| [Resume deletion and file cleanup](SDLC/04-design/resume-deletion-sequence.md) | [Source](SDLC/04-design/diagrams/resume-deletion-sequence.puml) | [Diagram](SDLC/04-design/diagrams/resume-deletion-sequence.svg) |
| [Coordinated backup and recovery](SDLC/07-deployment/backup-recovery-activity.md) | [Source](SDLC/07-deployment/diagrams/backup-recovery-activity.puml) | [Diagram](SDLC/07-deployment/diagrams/backup-recovery-activity.svg) |
| [Editor sections, validation and unsaved changes](SDLC/04-design/editor-interaction-flow.md) | [Source](SDLC/04-design/diagrams/editor-interaction-flow.puml) | [Diagram](SDLC/04-design/diagrams/editor-interaction-flow.svg) |
| [Roadmap outcomes](Project-Management/roadmap.md) | [Source](Project-Management/diagrams/roadmap-outcomes.puml) | [Diagram](Project-Management/diagrams/roadmap-outcomes.svg) |
| [Page navigation sitemap](SDLC/04-design/site-map.md) | [Source](SDLC/04-design/diagrams/site-map.puml) | [Diagram](SDLC/04-design/diagrams/site-map.svg) |
| [Implementation status and evidence](SDLC/05-implementation/implementation-status.md) | [Source](SDLC/05-implementation/diagrams/implementation-evidence-map.puml) | [Diagram](SDLC/05-implementation/diagrams/implementation-evidence-map.svg) |

## Regenerate locally

Use Java and the official [PlantUML renderer](https://plantuml.com/download). From the repository root, with your downloaded JAR path:

```powershell
$plantUmlJar = 'C:\tools\plantuml.jar'
$diagrams = Get-ChildItem docs -Recurse -Filter '*.puml'
foreach ($diagram in $diagrams) {
    java -jar $plantUmlJar -checkonly $diagram.FullName
    if ($LASTEXITCODE -ne 0) { throw 'PlantUML syntax check failed.' }
    java -jar $plantUmlJar -tsvg $diagram.FullName
    if ($LASTEXITCODE -ne 0) { throw 'PlantUML rendering failed.' }
}
```

Sources use the built-in Smetana layout where applicable and contain no remote includes. See the official [layout documentation](https://plantuml.com/layout-engines) and [command-line reference](https://plantuml.com/command-line). Update source and rendered SVG together, inspect the visual result and check relative links before committing.
