# Maintenance Guide

Status: Documented baseline
Reviewed: 2026-10-06
Evidence baseline: local commit 0ca188f (merged project rename), with release history through v1.2.1.

Review dependency advisories and automated update pull requests regularly. Refresh stale branches, inspect lockfile changes and rerun current checks. Distinguish code failures from cancelled CI runs or unavailable hosted runners before changing workflow settings.

Review access boundaries whenever routes, files, account status or public-password logic change. Confirm upload cleanup and avoid deleting files needed by existing resumes. Review backup restore evidence, mail delivery, logs and resource usage in the actual deployment environment; avoid logging secrets or private resume contents.

Keep documentation aligned with implementation, update the [backlog](../../Project-Management/product-backlog.md), and record release evidence in [Releases](../../Releases/README.md). Revisit performance/accessibility targets when real usage or defects justify them. Production support contacts, retention periods and recovery objectives need explicit owner decisions and should not be invented in documentation.
