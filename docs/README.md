# MultiResume Manager Documentation

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

This documentation describes the existing Laravel application. It borrows OmniDesk's information architecture, not its product scope or technology choices. The folders organize engineering responsibilities; they do not impose a sequential development process.

| Area | Authoritative content |
| --- | --- |
| [Project Definition](Project-Definition/overview-and-goals.md) | Product purpose, boundaries, stakeholders and success criteria |
| [Planning](SDLC/01-planning/planning.md) | Working method and change process |
| [Requirements](SDLC/02-requirements/requirements.md) | Observable behavior and acceptance criteria |
| [Analysis](SDLC/03-analysis/analysis.md) | User journeys, business rules and risks |
| [Design](SDLC/04-design/design.md) | Architecture, model relationships and technical boundaries |
| [Implementation](SDLC/05-implementation/implementation.md) | Code entry points and development conventions |
| [Testing](SDLC/06-testing/testing.md) | Verification commands, coverage and evidence limits |
| [Deployment](SDLC/07-deployment/deployment.md) | Installation, upgrades and recovery |
| [Maintenance](SDLC/08-maintenance/maintenance.md) | Ongoing operations and review triggers |
| [Project Management](Project-Management/product-backlog.md) | Backlog, roadmap and traceability |
| [Sprints](Sprints/README.md) | Future iteration records |
| [Releases](Releases/README.md) | Historical tags and release evidence |

## Maintenance rules

Keep each topic in one authoritative document and link to it elsewhere. Change the relevant documents when behavior changes. Use **Proposed**, **Implemented**, and **Verified** accurately: source inspection supports implementation claims; verification needs a recorded check and environment. A passed automated suite does not demonstrate every user journey or production readiness. Never store credentials, private resumes or personal contact details here.

The root [README](../README.md) remains the quick-start guide. This map is the entry point for engineering documentation.

## Detailed area indexes

- [Project-Definition](Project-Definition/README.md)
- [SDLC/01-planning](SDLC/01-planning/README.md)
- [SDLC/02-requirements](SDLC/02-requirements/README.md)
- [SDLC/03-analysis](SDLC/03-analysis/README.md)
- [SDLC/04-design](SDLC/04-design/README.md)
- [SDLC/05-implementation](SDLC/05-implementation/README.md)
- [SDLC/06-testing](SDLC/06-testing/README.md)
- [SDLC/07-deployment](SDLC/07-deployment/README.md)
- [SDLC/08-maintenance](SDLC/08-maintenance/README.md)
- [Project-Management](Project-Management/README.md)
- [Sprints](Sprints/README.md)
- [Releases](Releases/README.md)

## Evidence and completion boundary

The detailed set covers product definition, requirements, analysis, architecture/design, implementation, testing, deployment, maintenance, management and release history. Diagram sources are editable PlantUML (.puml), with rendered SVG previews next to their explanatory documents. Migration, test and dependency inventories come from the inspected repository. Runbooks/checklists are complete procedures, not claims that a production drill or full accessibility review was executed. Historical releases retain their original scope; future sprint records remain prospective.

The [SDLC index](SDLC/README.md) explains the relationship between the eight engineering areas.

## Repository navigation

Documentation is under `docs/`; Laravel source and its local environment/dependencies are under `application/`. Run application commands from that directory. GitHub automation remains under `.github/` at the repository root. Source paths shown without an `application/` prefix in technical descriptions are relative to the application directory; linked source references point to their actual repository locations. Historical release diffs preserve their original paths.

## Visual documentation

[PlantUML diagram guide](diagram-guide.md) provides editable sources and GitHub-visible SVG previews for architecture, relationships, user workflows and operating procedures.

For an overview of the website pages and navigation, start with the [page sitemap](SDLC/04-design/site-map.md).
