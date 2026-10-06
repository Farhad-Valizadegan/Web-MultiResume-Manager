# Versioning Strategy

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

Existing release history uses vMAJOR.MINOR.PATCH. Apply version choice to actual compatibility and user-visible scope: patch for compatible fixes, minor for compatible capability additions, major for intentional breaking contracts. Schema compatibility, installation/upgrade steps and public routes need explicit consideration; counting commits does not determine a version.

Tags identify exact delivered source and remain immutable in normal release management. Document target hash and validation evidence. Public/PDF/editor changes are part of behavior, not only internal implementation. A renamed repository preserves historical tags, commits, issues and PR references rather than reconstructing history under a new version.

Choose the next version only when scope is accepted and release gates pass. Current rename/documentation changes are after v1.2.1; this file does not assign them a release number.
