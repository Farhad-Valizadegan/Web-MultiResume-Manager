# Domain Model

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Conceptual cardinalities follow model relationships. The optional Profile cardinality describes the application relationship, not a guarantee of a database uniqueness constraint. Per-resume personal data belongs to Resume and must not silently fall back to the account profile.

```mermaid
classDiagram
    User "1" --> "0..1" Profile : account information
    User "1" --> "0..*" Resume : owns
    Resume "1" --> "0..*" ResumeSkill
    Resume "1" --> "0..*" ResumeLanguage
    Resume "1" --> "0..*" ResumeInterest
    Resume "1" --> "0..*" ResumeEducation
    Resume "1" --> "0..*" ResumeExperience
    Resume "1" --> "0..*" ResumeProject
    Resume "1" --> "0..*" ResumeCertificate
    Resume : public_link
    Resume : resume_password_hash
    Resume : status
    Resume : download_resume_type
```

Editable source: [domain-model.mmd](diagrams/domain-model.mmd).

## PlantUML view

This is a PlantUML rendering of the existing documented view. Read the accompanying document for the source references, constraints, and details omitted from this overview.

![Domain Model](diagrams/domain-model.svg)

[Editable PlantUML source](diagrams/domain-model.puml) · [Full-size diagram](diagrams/domain-model.svg)
