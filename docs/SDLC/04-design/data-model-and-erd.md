# Data Model and ERD

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

The ERD focuses on product entities and key relationships. Profile optionality describes model semantics and is not a substitute for schema uniqueness inspection. Framework infrastructure tables are cataloged separately. [Schema evidence](schema-reference.md) records migration operations, including later alterations; the initial create migration alone is not the final schema.

```mermaid
erDiagram
    users ||--o| profiles : has
    users ||--o{ resumes : owns
    resumes ||--o{ resume_skills : contains
    resumes ||--o{ resume_languages : contains
    resumes ||--o{ resume_interests : contains
    resumes ||--o{ resume_educations : contains
    resumes ||--o{ resume_experiences : contains
    resumes ||--o{ resume_projects : contains
    resumes ||--o{ resume_certificates : contains
    users {
        bigint id PK
    }
    resumes {
        bigint id PK
        bigint user_id FK
        string public_link UK
        string resume_password_hash
        string status
        string download_resume_type
    }
    resume_projects {
        bigint id PK
        bigint resume_id FK
        string project_link
        string project_link_label
        string demo_url
        string demo_label
    }
```

Editable source: [data-model-and-erd.mmd](diagrams/data-model-and-erd.mmd).
