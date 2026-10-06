# Problem Statement

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Problem and affected users

Applicants need tailored versions of their professional information. Maintaining independent documents makes contact information, evidence links and work dates inconsistent. Sending a static attachment also provides little control over future availability and no platform-level indication that the online resume was opened.

MultiResume Manager addresses these problems with structured per-resume information, unique public links, optional password access, configurable downloads and aggregate views. Administrators provision accounts and maintain platform records. Employers are visitors, not account holders in the current product.

## Desired outcomes

An owner can reuse the application for several resume versions without exposing another owner's information. A visitor can read the selected version and retrieve an allowed PDF. The maintainer can trace behavior to source and tests and understand migrations before upgrading.

## Limits

The product does not guarantee hiring outcomes, verify external evidence, prevent screenshots, revoke files already downloaded, or measure unique employers. Password protection controls subsequent application access; it cannot recover an already shared copy.

Validate future improvements against observable workflows rather than assuming a larger feature set is inherently better. The authoritative product boundaries remain in [scope and stakeholders](scope-and-stakeholders.md).
