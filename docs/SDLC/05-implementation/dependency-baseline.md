# Dependency Baseline

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

| Dependency | Locked version / runtime contract | Source |
| --- | --- | --- |
| PHP | >=8.2 requirement; CI 8.2 | composer.json / workflow |
| laravel/framework | v12.69.3 | composer.lock |
| laravel/breeze | v2.4.2 | composer.lock |
| barryvdh/laravel-dompdf | v3.1.2 | composer.lock |
| phpunit/phpunit | 11.5.56 | composer.lock |
| laravel/pint | v1.30.4 | composer.lock |
| laravel/sail | v1.68.0 | composer.lock |
| mockery/mockery | 1.6.15 | composer.lock |
| @tailwindcss/forms | 0.5.11 | package-lock.json |
| @tailwindcss/vite | 4.3.3 | package-lock.json |
| alpinejs | 3.16.2 | package-lock.json |
| axios | 1.20.0 | package-lock.json |
| concurrently | 10.0.5 | package-lock.json |
| laravel-vite-plugin | 3.2.0 | package-lock.json |
| tailwindcss | 4.3.3 | package-lock.json |
| vite | 8.2.2 | package-lock.json |

This inventory reads current lockfiles, not an online latest-version recommendation. Runtime, lockfile and manifest constraints serve different purposes. Node.js 22 is the CI runtime; the local installed runtime can differ. Audit evidence must be obtained with the actual chosen lockfiles. Do not replace dependencies merely to make documented versions newer.
