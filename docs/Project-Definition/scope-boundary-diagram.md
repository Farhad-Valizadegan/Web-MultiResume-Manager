# Scope Boundary

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

The boundary separates delivered functionality from possible future products. Excluded items are not committed roadmap work. Altering the boundary requires requirement, risk and design review.

```mermaid
flowchart TB
    subgraph Current[Current Application Scope]
        Accounts[Admin Provisioning and Authentication]
        Editor[Owned Resume Editing]
        Sharing[Public Access and Download Controls]
        Presentation[HTML and PDF Presentation]
        Analytics[Aggregate Views]
    end
    subgraph Excluded[Outside Current Baseline]
        Hiring[Applicant Tracking and Hiring Decisions]
        Payments[Subscriptions and Payments]
        Collaboration[Collaborative Editing]
        AI[AI Content Generation]
    end
```

Editable source: [scope-boundary-diagram.mmd](diagrams/scope-boundary-diagram.mmd).
