# Environment and Configuration

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

## Environment boundaries

Development uses Windows/XAMPP and the folder Web-MultiResume-Manager. CI uses PHP 8.2/Node.js 22 on a hosted Ubuntu runner. Production topology is not inferred from development or README examples. Requirements and installed versions are recorded in [dependency baseline](../05-implementation/dependency-baseline.md).

## Configuration inventory

APP_NAME sets visible branding to MultiResume Manager. APP_URL defines links; APP_KEY must be retained on upgrades/restores. Database, session/cache, filesystem and mail values must match the deployment. APP_ENV/APP_DEBUG, session cookie security and proxy trust need operator review. Private disk points at storage/app/private; public link targets storage/app/public.

Keep .env outside source control and outside the web-server document root. Serve only public/. Restrict storage/bootstrap cache write access to the needed runtime identity. Configure TLS and upload/resource limits in the actual web server and PHP runtime. Avoid copying production credentials into commands or screenshots.

Initial key generation belongs to a new installation. Re-generating a key on an existing system can invalidate sessions/grants and encrypted application data. Source display-name changes also require existing deployments to set APP_NAME and clear stale configuration; changing a folder/repository name does not rename MySQL data or domains.
