# Completed-work delivery register — MultiResume Manager

Prepared retrospectively on 2026-10-20. Baseline: 3aca5e591eca3b4c65668daa2d4b25ee5376bc46.

[GitHub tracking register](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/63). This register covers 155 historical commits, including 86 non-merge implementation commits, 25 completed work areas, eight reconstructed sprint records and eight native milestones. Seven milestones are released and closed; unreleased maintenance remains open for future release publication.

Sprint identifiers group delivered work retrospectively. They do not assert original planning dates, ceremonies, estimates or velocity. Historical test outcomes belong to the existing release notes; application tests were not rerun for this administrative change.

## Milestones, sprints, tags, versions and releases

| Sprint | Milestone | Delivery | Tag commit |
|---|---|---|---|
| [RETRO-01 / #89](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/89) | [v1.0.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/1) | [Published v1.0.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/releases/tag/v1.0.0) | [cc6c88c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cc6c88c6163e000fcd9ea3a95236af5a4e2c2797) |
| [RETRO-02 / #90](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/90) | [v1.0.1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/2) | [Published v1.0.1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/releases/tag/v1.0.1) | [2177cc6](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2177cc62f143ba518e65eaec71b833601a0b01e1) |
| [RETRO-03 / #91](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/91) | [v1.0.2](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/3) | [Published v1.0.2](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/releases/tag/v1.0.2) | [2c17d93](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2c17d931a9cd2d6059a0085f1d8d553b423679a7) |
| [RETRO-04 / #92](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/92) | [v1.1.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/4) | [Published v1.1.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/releases/tag/v1.1.0) | [d261a27](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d261a2781014e55a6d2889fc96960e809314873d) |
| [RETRO-05 / #93](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/93) | [v1.2.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/5) | [Published v1.2.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/releases/tag/v1.2.0) | [004e508](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/004e508a022e268dc7db7234b026e315c86cbda3) |
| [RETRO-06 / #94](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/94) | [v1.2.1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/6) | [Published v1.2.1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/releases/tag/v1.2.1) | [d7dac7e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d7dac7e6606c945662cd984f5b3b8569271f35ee) |
| [RETRO-07 / #95](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/95) | [v1.3.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/7) | [Published v1.3.0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/releases/tag/v1.3.0) | [cf9f26b](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cf9f26b2f4d4f395da409fceb2315430c1dd7309) |
| [RETRO-08 / #96](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/96) | [Unreleased maintenance](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/milestone/8) | Delivered on main; unreleased | No new tag |

## Completed features, tasks, tests and documentation

Cross-version work-area issues use the latest represented milestone. Each checked task retains its own delivered version; sprint records group tasks by their actual version.

### Initial application and resume management

[Completed issue #64](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/64).

- [x] Initial commit for resume management system — [2e92b27](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2e92b27bddd51a3011393f43ddf4ad6bb5fec5a9) · v1.0.0

### Password security and plaintext password removal

[Completed issue #65](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/65).

- [x] Remove plain resume password column — [2403b2f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2403b2fd1b85b0c4b979efc3fea8d549ab913093) · v1.0.0
- [x] Fix resume password security — [f293137](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f29313771a29c7e39178c2d1f88cbf0b1bdd9191) · v1.0.0

### Authentication CAPTCHA and password visibility

[Completed issue #66](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/66).

- [x] Fix Turnstile local configuration — [fabc5a9](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/fabc5a96f0682248883f89257db394b79dfa91f6) · v1.0.0
- [x] Hide Turnstile widget when disabled — [cd0bf31](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cd0bf319e582e98531baeebbb4d77d8e48f1a525) · v1.0.0
- [x] Skip Turnstile validation when disabled — [bfb707b](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/bfb707b7b31f971c78270e57506c1889a49574e0) · v1.0.0
- [x] Allow disabling Turnstile locally — [f9c7f55](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f9c7f55da8225e1661d0fc98e84bc994f49ee503) · v1.0.0
- [x] Add password visibility toggle to login — [4bdc924](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/4bdc9248bf7a389c7552c7e7dfc9dc8ecec18788) · v1.0.0
- [x] Add Turnstile CAPTCHA to login — [f2e3add](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f2e3adde8360efc26e778f0e1fbcb6669297a048) · v1.0.0

### Public resume layout and downloads

[Completed issue #67](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/67).

- [x] Remove duplicate project button layout wrapper — [809e9fa](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/809e9fa9b41114e36278ea71b280be61f87d8763) · v1.2.0
- [x] Place project repository and demo buttons side by side — [091ba4d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/091ba4d88e4ab88ea0572a95bba293726bd76fc9) · v1.2.0
- [x] Redesign public resume layout and improve navigation and downloads — [0104cff](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0104cffe7e21a1d291bdc2b3a7bbc42f3aa4cd0f) · v1.1.0
- [x] test: add public resume access coverage — [13e40d4](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/13e40d44f68bca1fa124dd4e80bc9ababab78c4f) · v1.0.0
- [x] Improve public resume page design — [f344ed3](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f344ed36399a36e58f882d9ac43c61c7ad6f5be4) · v1.0.0
- [x] Clarify public resume PDF download labels — [9925188](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/9925188177be352f771a9b06d6752e771414715d) · v1.0.0
- [x] Improve public resume layout and section order — [3e29f16](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3e29f166a5053eba8f6cdf864e6df721851bb203) · v1.0.0
- [x] Improve public resume header design — [f89cb66](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f89cb6657e5f0ef845dbf50af89001a580e6af93) · v1.0.0

### Selectable skills display and resume themes

[Completed issue #68](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/68).

- [x] Add selectable resume theme options — [be6ca3a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/be6ca3a535368e36ae823ff81fb99d12253b0ab0) · v1.0.0
- [x] Remove seeder changes from skills style PR — [8206e20](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/8206e2043570d5c4a4a86d902174d8ee0fb1f2d8) · v1.0.0
- [x] Add selectable skills display style — [9795d4d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/9795d4d03a2aecf5b98fee9485c282e35d06f3d5) · v1.0.0
- [x] Improve skills section and add demo resume seed data — [e0a98ba](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e0a98ba810e7956e4506103649c889fdd0dac66d) · v1.0.0

### Resume forms and generic examples

[Completed issue #69](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/69).

- [x] Refine create resume form layout — [c9b7927](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c9b7927fe213ac0206e17b7135668030220d1558) · v1.0.0
- [x] Replace personal-looking placeholders with generic examples — [2039e03](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2039e036afa47805a1a2e8a91ad615b694f731d8) · v1.0.0

### Administrator account safeguards

[Completed issue #70](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/70).

- [x] fix: persist user status and add admin user tests — [695e601](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/695e6015e37a2a78070e9ecdb693f08847ea431d) · v1.0.0

### Certificate synchronization and file cleanup

[Completed issue #71](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/71).

- [x] Clean up certificate file handling on resume update — [f618477](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f618477e755d43fd9698b919189c96b05df8f0b5) · v1.0.0
- [x] fix: securely synchronize resume certificates — [a480d8e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a480d8e1cee7ea7f70d7bf72030bc6d30b1e42f6) · v1.0.0

### Personal information and profile photos

[Completed issue #72](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/72).

- [x] test: verify resume personal information and photo handling — [4cfde52](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/4cfde52e425617752e47b776259ab250553e9be4) · v1.0.0
- [x] feat: add resume personal information fields — [a586997](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a586997f3226d4be6d53358391128724a8a049d3) · v1.0.0

### Automated regression tests

[Completed issue #73](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/73).

- [x] test: add resume management feature tests — [793738d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/793738d2e920a962e61d9cab5c5caf27f8988f2b) · v1.0.0
- [x] test: add resume certificate creation coverage — [556f742](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/556f7424d889b69b687166bc440cf9c44a1e376a) · v1.0.0
- [x] test: add resume interest coverage — [3d3698d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3d3698d58b18b4ec2f328a149275b71fb271d508) · v1.0.0
- [x] test: add resume language coverage — [c9fb915](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c9fb9156ccc48659912d8675743548de5bd0b4eb) · v1.0.0
- [x] test: add resume skill coverage — [63e5a24](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/63e5a24437be7bb63280effb6787344d3d8e722a) · v1.0.0
- [x] test: add resume project coverage — [ebba6e4](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/ebba6e4b668a36d52a579d6f030fe7b0c737de72) · v1.0.0
- [x] test: add resume experience coverage — [3f3f30d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3f3f30d0f85af32a3b41491e494128b93faed141) · v1.0.0
- [x] test: add resume education coverage — [91459d9](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/91459d9c8dac0a9f552fd0b063e5c779d737af7f) · v1.0.0
- [x] Fix outdated tests — [f5af732](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f5af73213df3b12b1bbd55725ddffc05a52ad677) · v1.0.0

### Continuous integration and security audits

[Completed issue #74](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/74).

- [x] ci: configure Dependabot updates — [d2a863e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d2a863e96d5b4b7cc44c32eb3f70fe89dcf14656) · v1.0.0
- [x] ci: add dependency security audits — [086a7ac](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/086a7acbdeb95977c0276f3c773c0baa554677cc) · v1.0.0
- [x] ci: add GitHub Actions test workflow — [064c5d0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/064c5d04e065404e266c70ddead5dcf7560f3597) · v1.0.0

### Frontend framework and build tool upgrades

[Completed issue #75](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/75).

- [x] build: migrate to Tailwind CSS 4 (#25) — [7241da1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/7241da10b3ead8660578852a51544d9c3aa42ecd) · v1.0.0
- [x] build: upgrade Vite and Laravel Vite plugin — [efc1760](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/efc17601d00cf5e4c91cefb70d4ad081d3840371) · v1.0.0

### Security and dependency remediation

[Completed issue #76](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/76).

- [x] Update PHP dependencies to resolve security advisories — [2c17d93](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2c17d931a9cd2d6059a0085f1d8d553b423679a7) · v1.0.2
- [x] Fix resume security, file handling, validation, and vulnerable dependencies — [2177cc6](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2177cc62f143ba518e65eaec71b833601a0b01e1) · v1.0.1
- [x] security: update npm dependencies — [63c66c2](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/63c66c29c2237d149630c70427982f87605c157b) · v1.0.0
- [x] security: update Composer dependencies — [21adda1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/21adda12142ead9f794ad60245d2d762d0db596d) · v1.0.0

### Dependency maintenance

[Completed issue #77](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/77).

- [x] build(deps-dev): bump laravel/sail from 1.68.0 to 1.69.0 in /application — [73fe07c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/73fe07c7ca8fb48f7e8887602657635a8dc632b5) · Unreleased
- [x] build(deps-dev): bump vite from 8.3.2 to 8.3.4 in /application — [4fd1e06](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/4fd1e06e0f2daaab59894f50e50850341296e252) · Unreleased
- [x] build(deps-dev): bump concurrently from 10.0.5 to 10.0.6 in /application — [71dc2db](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/71dc2dbfc051b7f1acb97ad0f188a0fbf7d23f79) · Unreleased
- [x] build(deps-dev): bump alpinejs from 3.16.2 to 3.17.4 in /application — [77b7c1e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/77b7c1eb29de139e6f028935233b30c73892901e) · v1.3.0
- [x] build(deps-dev): bump vite from 8.2.2 to 8.3.2 in /application — [5beeecd](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/5beeecd660d17c7ef45cec0844802aff827240db) · v1.3.0
- [x] build(deps-dev): bump laravel/sail from 1.64.0 to 1.68.0 — [00ffc94](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/00ffc94e6992fa92170ef9653529b6c5af986177) · v1.2.0
- [x] build(deps-dev): bump alpinejs from 3.15.12 to 3.16.2 — [3e0ce7f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3e0ce7f4c57661c2a70e75c7eabc74dc26c7618d) · v1.2.0
- [x] build(deps-dev): bump vite from 8.1.5 to 8.2.2 — [069800c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/069800cc74656cca7a4e9ef8ec5b0de190e6a39e) · v1.2.0
- [x] build(deps-dev): bump concurrently from 10.0.4 to 10.0.5 — [668f6a6](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/668f6a6ef71a5ab642a1a25794772340e5a45356) · v1.2.0
- [x] build(deps-dev): bump mockery/mockery from 1.6.12 to 1.6.15 — [94e782e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/94e782ebeabaea86258e9a1cc8dfc4efdfec7958) · v1.2.0
- [x] build(deps-dev): bump laravel-vite-plugin from 3.1.3 to 3.2.0 — [df57b5f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/df57b5fdfe45b6a7fb79c54b62076dbd3710a255) · v1.2.0
- [x] build(deps-dev): bump laravel/pint from 1.29.3 to 1.30.4 — [7696f80](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/7696f80f68954ef1c1f808c83840f2954e36e977) · v1.2.0
- [x] build(deps-dev): bump concurrently from 9.2.4 to 10.0.4 — [850a2c1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/850a2c1b38b668a38d34fc21625969a393b69329) · v1.0.0
- [x] build(deps): bump laravel/tinker from 2.11.1 to 3.0.2 — [9a2e4ac](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/9a2e4acdad43670847dbd6b9297b344495fc0932) · v1.0.0
- [x] build(deps): bump actions/setup-node from 6 to 7 — [c036a0f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c036a0fac350d70b205d65bc1c43d06fb39ecd01) · v1.0.0
- [x] build(deps): bump actions/cache from 5 to 6 — [cf038de](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cf038de693ae8012706815092c1d176567a18cc8) · v1.0.0

### Light, dark and system appearance

[Completed issue #78](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/78).

- [x] Fix textarea backgrounds in dark mode — [6c0817e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/6c0817eedf62079251c02ef579da66c757ead3a4) · v1.1.0
- [x] Introduce light and dark modes and consistent interface styling — [be19180](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/be19180741ef9794eb2969cada9be23dc1d3089a) · v1.1.0

### Resume cards, sharing and accessibility

[Completed issue #79](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/79).

- [x] Improve resume cards, sharing controls, and editing accessibility — [b19ce23](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/b19ce236b8ccc514f374038af56bd7aae3205d69) · v1.1.0

### Resume month dates and validation

[Completed issue #80](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/80).

- [x] Add month-based resume date editing and validate date ranges — [3aaa8e3](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3aaa8e3c658da45670b70853cbb48a5085e3641d) · v1.2.1

### Collapsible resume editor sections

[Completed issue #81](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/81).

- [x] Organize resume editors into collapsible sections — [a3c9d36](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a3c9d367006cf5df16809846c56709926965a265) · v1.2.1

### Project naming and branding

[Completed issue #82](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/82).

- [x] Use Web-MultiResume-Manager repository and folder name — [0be0e22](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0be0e226edca9d0742d8dd125fa5570e7e5c5962) · v1.3.0
- [x] Rename project to MultiResume Manager — [da4c2b8](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/da4c2b8a871c3bc02d2cb7b09ff803d6c7f05c66) · v1.3.0

### Engineering and product documentation

[Completed issue #83](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/83).

- [x] Add visual architecture overview to project README — [102b098](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/102b098d43cb8e1c95c580713c4a3e3cd1d97529) · v1.3.0
- [x] Document authorization, file access, password changes and recovery flows — [e7cbd86](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e7cbd8675621428052f83aae3e091d4b7dd28242) · v1.3.0
- [x] Add PlantUML diagrams and rendered documentation previews — [1641c96](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/1641c96c6dac755182a5f527714bbc013719723e) · v1.3.0
- [x] Document product requirements, architecture, verification, operations and releases — [78aa833](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/78aa833b9d8d296093c4c880b449b5d79dcff10d) · v1.3.0
- [x] docs: prepare documentation for v1.0.0 — [cc6c88c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cc6c88c6163e000fcd9ea3a95236af5a4e2c2797) · v1.0.0
- [x] Update README with testing and security notes — [c1b7ea0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c1b7ea06e156c08c2b2923aa05c0ba8c8944870c) · v1.0.0
- [x] Update project documentaion — [268a35f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/268a35f75c7d0f22fb93c9cdcfd320d95f71dc65) · v1.0.0

### Proprietary notice metadata

[Completed issue #84](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/84).

- [x] Apply prospective proprietary software notice — [63b4e9e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/63b4e9e5f1053d5559ccf38f52ec1ae53f217bca) · Unreleased

### PlantUML diagrams and visual engineering guidance

[Completed issue #85](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/85).

- [x] Illustrate PDF rendering and uploaded delivery paths — [ca872da](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/ca872daf6cb1b39c76e8caaf61fe621f912a0f60) · v1.3.0
- [x] Visualize implementation status and evidence boundaries — [68e0869](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/68e086974e0fa6d05578deb4585e802159af62f0) · v1.3.0
- [x] Show PlantUML workflow directly in development guidance — [a85bb58](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a85bb586fe287bd6135ec3e498b3f5009685795c) · v1.3.0
- [x] Add PlantUML page navigation sitemap — [e5a4c04](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e5a4c04fd9e787a9ea9b646b482ef9341874ca95) · v1.3.0
- [x] Clarify roadmap outcomes with a PlantUML overview — [496fb8d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/496fb8d1b11162b31ad1de57f0ac4598bf2cf95e) · v1.3.0
- [x] Use PlantUML exclusively and remove duplicate Mermaid diagrams — [56b43bf](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/56b43bf709ef5532b96e8913878db1f01c9481ac) · v1.3.0

### Skill evidence and project demo links

[Completed issue #86](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/86).

- [x] Add skill evidence and project demo links and refine public resume layout — [cdcfb85](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cdcfb85c4f9d93e9f87b878ed3d0d8dcaa2e5384) · v1.2.0

### Application directory separation

[Completed issue #87](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/87).

- [x] Separate Laravel application from repository documentation — [1df5230](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/1df52308ab0d5be887f1b1adee1cdbd75ea9d662) · v1.3.0

### Public and PDF month-year date formatting

[Completed issue #88](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/issues/88).

- [x] Format public resume and PDF dates as abbreviated month and year — [500cd88](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/500cd88f61958a908ec995d8537860dd2a878f2d) · v1.2.1

## Labels and evidence limits

Issues use the existing bug, enhancement, documentation and dependencies labels, plus task, feature, testing, security, retrospective, sprint, milestone and release where applicable. Completed work-area and sprint issues are closed with reason completed. Existing version tags and published releases are preserved. No production deployment, restore drill, fresh test run or new software release is inferred.

## Complete commit index

Includes merge and integration commits to retain traceability. Commit dates are evidence timestamps, not reconstructed sprint dates.

| Commit | Recorded author timestamp | Subject |
|---|---|---|
| [2e92b27](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2e92b27bddd51a3011393f43ddf4ad6bb5fec5a9) | 2026-06-07T12:54:31Z | /I/n/i/t/i/a/l/ /c/o/m/m/i/t/ /f/o/r/ /r/e/s/u/m/e/ /m/a/n/a/g/e/m/e/n/t/ /s/y/s/t/e/m/ |
| [268a35f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/268a35f75c7d0f22fb93c9cdcfd320d95f71dc65) | 2026-06-07T14:08:44Z | /U/p/d/a/t/e/ /p/r/o/j/e/c/t/ /d/o/c/u/m/e/n/t/a/i/o/n/ |
| [d095d5c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d095d5c74ee5ac40dc74a39411489c14bbf9247e) | 2026-06-07T14:16:05Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///p/r/o/j/e/c/t/-/d/o/c/u/m/e/n/t/a/t/i/o/n/ |
| [f293137](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f29313771a29c7e39178c2d1f88cbf0b1bdd9191) | 2026-07-03T17:03:35Z | /F/i/x/ /r/e/s/u/m/e/ /p/a/s/s/w/o/r/d/ /s/e/c/u/r/i/t/y/ |
| [b89c1a2](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/b89c1a246d923aaed07c3f5daa97a32ab3cf1b25) | 2026-07-03T17:43:09Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/2/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///f/i/x/-/r/e/s/u/m/e/-/p/a/s/s/w/o/r/d/-/s/e/c/u/r/i/t/y/ |
| [2403b2f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2403b2fd1b85b0c4b979efc3fea8d549ab913093) | 2026-07-03T18:39:35Z | /R/e/m/o/v/e/ /p/l/a/i/n/ /r/e/s/u/m/e/ /p/a/s/s/w/o/r/d/ /c/o/l/u/m/n/ |
| [b7feac5](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/b7feac539996808a2af17e799c53bfecaa150ac5) | 2026-07-03T18:49:16Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/3/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///r/e/m/o/v/e/-/p/l/a/i/n/-/r/e/s/u/m/e/-/p/a/s/s/w/o/r/d/-/c/o/l/u/m/n/ |
| [f5af732](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f5af73213df3b12b1bbd55725ddffc05a52ad677) | 2026-07-03T19:01:13Z | /F/i/x/ /o/u/t/d/a/t/e/d/ /t/e/s/t/s/ |
| [bffa31d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/bffa31d137c95dc89118068d20fbb4bb1ad9917c) | 2026-07-03T19:04:20Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///f/i/x/-/o/u/t/d/a/t/e/d/-/t/e/s/t/s/ |
| [c1b7ea0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c1b7ea06e156c08c2b2923aa05c0ba8c8944870c) | 2026-07-03T19:29:57Z | /U/p/d/a/t/e/ /R/E/A/D/M/E/ /w/i/t/h/ /t/e/s/t/i/n/g/ /a/n/d/ /s/e/c/u/r/i/t/y/ /n/o/t/e/s/ |
| [fd5ec7f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/fd5ec7f992e90800838e1ed6308999ef34399d2e) | 2026-07-03T19:34:17Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///u/p/d/a/t/e/-/r/e/a/d/m/e/-/t/e/s/t/i/n/g/-/s/e/c/u/r/i/t/y/ |
| [f2e3add](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f2e3adde8360efc26e778f0e1fbcb6669297a048) | 2026-07-03T20:07:54Z | /A/d/d/ /T/u/r/n/s/t/i/l/e/ /C/A/P/T/C/H/A/ /t/o/ /l/o/g/i/n/ |
| [8af0718](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/8af0718212ba2ec53d8edc00e534503595482daa) | 2026-07-03T20:10:14Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/6/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///a/d/d/-/c/a/p/t/c/h/a/-/t/o/-/l/o/g/i/n/ |
| [4bdc924](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/4bdc9248bf7a389c7552c7e7dfc9dc8ecec18788) | 2026-07-03T20:22:15Z | /A/d/d/ /p/a/s/s/w/o/r/d/ /v/i/s/i/b/i/l/i/t/y/ /t/o/g/g/l/e/ /t/o/ /l/o/g/i/n/ |
| [0042445](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0042445df17acefd46698edbb8b5ab6a74084248) | 2026-07-03T20:23:40Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/7/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///a/d/d/-/p/a/s/s/w/o/r/d/-/v/i/s/i/b/i/l/i/t/y/-/t/o/g/g/l/e/ |
| [f89cb66](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f89cb6657e5f0ef845dbf50af89001a580e6af93) | 2026-07-04T08:57:07Z | /I/m/p/r/o/v/e/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /h/e/a/d/e/r/ /d/e/s/i/g/n/ |
| [3e29f16](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3e29f166a5053eba8f6cdf864e6df721851bb203) | 2026-07-04T10:20:39Z | /I/m/p/r/o/v/e/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /l/a/y/o/u/t/ /a/n/d/ /s/e/c/t/i/o/n/ /o/r/d/e/r/ |
| [99953b3](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/99953b37868847c6d15abad37d34fdab2ec0214f) | 2026-07-04T10:24:48Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/8/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///i/m/p/r/o/v/e/-/p/u/b/l/i/c/-/r/e/s/u/m/e/-/h/e/a/d/e/r/ |
| [e0a98ba](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e0a98ba810e7956e4506103649c889fdd0dac66d) | 2026-07-04T12:01:47Z | /I/m/p/r/o/v/e/ /s/k/i/l/l/s/ /s/e/c/t/i/o/n/ /a/n/d/ /a/d/d/ /d/e/m/o/ /r/e/s/u/m/e/ /s/e/e/d/ /d/a/t/a/ |
| [9795d4d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/9795d4d03a2aecf5b98fee9485c282e35d06f3d5) | 2026-07-04T14:50:19Z | /A/d/d/ /s/e/l/e/c/t/a/b/l/e/ /s/k/i/l/l/s/ /d/i/s/p/l/a/y/ /s/t/y/l/e/ |
| [8206e20](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/8206e2043570d5c4a4a86d902174d8ee0fb1f2d8) | 2026-07-04T15:03:24Z | /R/e/m/o/v/e/ /s/e/e/d/e/r/ /c/h/a/n/g/e/s/ /f/r/o/m/ /s/k/i/l/l/s/ /s/t/y/l/e/ /P/R/ |
| [444be54](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/444be54545680938e6bbba744e044f3f1d6af362) | 2026-07-04T15:04:13Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/9/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///i/m/p/r/o/v/e/-/s/k/i/l/l/s/-/s/e/c/t/i/o/n/-/s/t/y/l/e/ |
| [2039e03](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2039e036afa47805a1a2e8a91ad615b694f731d8) | 2026-07-04T16:17:47Z | /R/e/p/l/a/c/e/ /p/e/r/s/o/n/a/l/-/l/o/o/k/i/n/g/ /p/l/a/c/e/h/o/l/d/e/r/s/ /w/i/t/h/ /g/e/n/e/r/i/c/ /e/x/a/m/p/l/e/s/ |
| [f618477](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f618477e755d43fd9698b919189c96b05df8f0b5) | 2026-07-04T16:25:59Z | /C/l/e/a/n/ /u/p/ /c/e/r/t/i/f/i/c/a/t/e/ /f/i/l/e/ /h/a/n/d/l/i/n/g/ /o/n/ /r/e/s/u/m/e/ /u/p/d/a/t/e/ |
| [c9b7927](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c9b7927fe213ac0206e17b7135668030220d1558) | 2026-07-04T16:41:51Z | /R/e/f/i/n/e/ /c/r/e/a/t/e/ /r/e/s/u/m/e/ /f/o/r/m/ /l/a/y/o/u/t/ |
| [9925188](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/9925188177be352f771a9b06d6752e771414715d) | 2026-07-04T16:48:44Z | /C/l/a/r/i/f/y/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /P/D/F/ /d/o/w/n/l/o/a/d/ /l/a/b/e/l/s/ |
| [8eaa713](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/8eaa713a7e2c156223e7d3eda317873e921dffcc) | 2026-07-04T16:51:51Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/0/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///i/m/p/r/o/v/e/-/s/k/i/l/l/s/-/s/e/c/t/i/o/n/-/s/t/y/l/e/ |
| [f344ed3](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f344ed36399a36e58f882d9ac43c61c7ad6f5be4) | 2026-07-04T17:03:30Z | /I/m/p/r/o/v/e/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /p/a/g/e/ /d/e/s/i/g/n/ |
| [191c2f0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/191c2f0919beee4345a4e837880ff9ad2cc48b3b) | 2026-07-04T17:05:38Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/1/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///i/m/p/r/o/v/e/-/p/u/b/l/i/c/-/r/e/s/u/m/e/-/d/e/s/i/g/n/ |
| [be6ca3a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/be6ca3a535368e36ae823ff81fb99d12253b0ab0) | 2026-07-06T16:12:27Z | /A/d/d/ /s/e/l/e/c/t/a/b/l/e/ /r/e/s/u/m/e/ /t/h/e/m/e/ /o/p/t/i/o/n/s/ |
| [33ab52e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/33ab52e4fd34701e54fefe1f0f8a10b2d4aaa063) | 2026-07-06T16:16:18Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/2/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///a/d/d/-/r/e/s/u/m/e/-/t/h/e/m/e/-/o/p/t/i/o/n/s/ |
| [f9c7f55](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f9c7f55da8225e1661d0fc98e84bc994f49ee503) | 2026-07-06T21:48:18Z | /A/l/l/o/w/ /d/i/s/a/b/l/i/n/g/ /T/u/r/n/s/t/i/l/e/ /l/o/c/a/l/l/y/ |
| [bfb707b](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/bfb707b7b31f971c78270e57506c1889a49574e0) | 2026-07-06T21:48:51Z | /S/k/i/p/ /T/u/r/n/s/t/i/l/e/ /v/a/l/i/d/a/t/i/o/n/ /w/h/e/n/ /d/i/s/a/b/l/e/d/ |
| [cd0bf31](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cd0bf319e582e98531baeebbb4d77d8e48f1a525) | 2026-07-06T21:49:19Z | /H/i/d/e/ /T/u/r/n/s/t/i/l/e/ /w/i/d/g/e/t/ /w/h/e/n/ /d/i/s/a/b/l/e/d/ |
| [fabc5a9](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/fabc5a96f0682248883f89257db394b79dfa91f6) | 2026-07-06T22:03:52Z | /F/i/x/ /T/u/r/n/s/t/i/l/e/ /l/o/c/a/l/ /c/o/n/f/i/g/u/r/a/t/i/o/n/ |
| [695e601](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/695e6015e37a2a78070e9ecdb693f08847ea431d) | 2026-07-25T18:30:44Z | /f/i/x/:/ /p/e/r/s/i/s/t/ /u/s/e/r/ /s/t/a/t/u/s/ /a/n/d/ /a/d/d/ /a/d/m/i/n/ /u/s/e/r/ /t/e/s/t/s/ |
| [a480d8e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a480d8e1cee7ea7f70d7bf72030bc6d30b1e42f6) | 2026-07-25T19:05:44Z | /f/i/x/:/ /s/e/c/u/r/e/l/y/ /s/y/n/c/h/r/o/n/i/z/e/ /r/e/s/u/m/e/ /c/e/r/t/i/f/i/c/a/t/e/s/ |
| [a586997](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a586997f3226d4be6d53358391128724a8a049d3) | 2026-07-26T10:17:16Z | /f/e/a/t/:/ /a/d/d/ /r/e/s/u/m/e/ /p/e/r/s/o/n/a/l/ /i/n/f/o/r/m/a/t/i/o/n/ /f/i/e/l/d/s/ |
| [4cfde52](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/4cfde52e425617752e47b776259ab250553e9be4) | 2026-07-26T10:51:36Z | /t/e/s/t/:/ /v/e/r/i/f/y/ /r/e/s/u/m/e/ /p/e/r/s/o/n/a/l/ /i/n/f/o/r/m/a/t/i/o/n/ /a/n/d/ /p/h/o/t/o/ /h/a/n/d/l/i/n/g/ |
| [fa0e2b2](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/fa0e2b2e7485750e42c3dffadfd33b0c4b566da2) | 2026-07-26T10:54:02Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/t/e/s/t///r/e/s/u/m/e/-/p/e/r/s/o/n/a/l/-/i/n/f/o/r/m/a/t/i/o/n/'/ |
| [91459d9](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/91459d9c8dac0a9f552fd0b063e5c779d737af7f) | 2026-07-26T11:38:56Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /e/d/u/c/a/t/i/o/n/ /c/o/v/e/r/a/g/e/ |
| [3f3f30d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3f3f30d0f85af32a3b41491e494128b93faed141) | 2026-07-26T11:44:10Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /e/x/p/e/r/i/e/n/c/e/ /c/o/v/e/r/a/g/e/ |
| [ebba6e4](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/ebba6e4b668a36d52a579d6f030fe7b0c737de72) | 2026-07-26T11:50:54Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /p/r/o/j/e/c/t/ /c/o/v/e/r/a/g/e/ |
| [63e5a24](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/63e5a24437be7bb63280effb6787344d3d8e722a) | 2026-07-26T11:56:30Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /s/k/i/l/l/ /c/o/v/e/r/a/g/e/ |
| [c9fb915](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c9fb9156ccc48659912d8675743548de5bd0b4eb) | 2026-07-26T12:01:54Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /l/a/n/g/u/a/g/e/ /c/o/v/e/r/a/g/e/ |
| [3d3698d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3d3698d58b18b4ec2f328a149275b71fb271d508) | 2026-07-26T12:06:06Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /i/n/t/e/r/e/s/t/ /c/o/v/e/r/a/g/e/ |
| [556f742](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/556f7424d889b69b687166bc440cf9c44a1e376a) | 2026-07-26T12:10:50Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /c/e/r/t/i/f/i/c/a/t/e/ /c/r/e/a/t/i/o/n/ /c/o/v/e/r/a/g/e/ |
| [793738d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/793738d2e920a962e61d9cab5c5caf27f8988f2b) | 2026-07-26T12:31:40Z | /t/e/s/t/:/ /a/d/d/ /r/e/s/u/m/e/ /m/a/n/a/g/e/m/e/n/t/ /f/e/a/t/u/r/e/ /t/e/s/t/s/ |
| [c9eafaa](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c9eafaa456cc4fc08d95f0b535fbda31e5434f88) | 2026-07-26T12:35:53Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/t/e/s/t///r/e/s/u/m/e/-/s/e/c/t/i/o/n/s/'/ |
| [13e40d4](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/13e40d44f68bca1fa124dd4e80bc9ababab78c4f) | 2026-07-26T13:30:24Z | /t/e/s/t/:/ /a/d/d/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /a/c/c/e/s/s/ /c/o/v/e/r/a/g/e/ |
| [677f450](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/677f450434f5ffb736fb55a94e1c565d5553da22) | 2026-07-26T13:32:04Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/t/e/s/t///p/u/b/l/i/c/-/r/e/s/u/m/e/-/a/c/c/e/s/s/'/ |
| [064c5d0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/064c5d04e065404e266c70ddead5dcf7560f3597) | 2026-07-26T13:59:04Z | /c/i/:/ /a/d/d/ /G/i/t/H/u/b/ /A/c/t/i/o/n/s/ /t/e/s/t/ /w/o/r/k/f/l/o/w/ |
| [cd015dc](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cd015dc61621b6a5ed4fff42d2e8dcf0c30a7c92) | 2026-07-26T14:16:56Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/3/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///c/i///g/i/t/h/u/b/-/a/c/t/i/o/n/s/ |
| [21adda1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/21adda12142ead9f794ad60245d2d762d0db596d) | 2026-07-26T14:33:20Z | /s/e/c/u/r/i/t/y/:/ /u/p/d/a/t/e/ /C/o/m/p/o/s/e/r/ /d/e/p/e/n/d/e/n/c/i/e/s/ |
| [63c66c2](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/63c66c29c2237d149630c70427982f87605c157b) | 2026-07-26T14:37:12Z | /s/e/c/u/r/i/t/y/:/ /u/p/d/a/t/e/ /n/p/m/ /d/e/p/e/n/d/e/n/c/i/e/s/ |
| [d0b509e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d0b509e310cc225c0e2607caf7f60457ee89a787) | 2026-07-26T14:41:30Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/4/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///s/e/c/u/r/i/t/y///d/e/p/e/n/d/e/n/c/y/-/u/p/d/a/t/e/s/ |
| [086a7ac](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/086a7acbdeb95977c0276f3c773c0baa554677cc) | 2026-07-26T14:46:25Z | /c/i/:/ /a/d/d/ /d/e/p/e/n/d/e/n/c/y/ /s/e/c/u/r/i/t/y/ /a/u/d/i/t/s/ |
| [75acdde](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/75acdde76eedda106e9f7e394e88f11d5b3592e9) | 2026-07-26T14:51:47Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/5/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///c/i///s/e/c/u/r/i/t/y/-/a/u/d/i/t/s/ |
| [d2a863e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d2a863e96d5b4b7cc44c32eb3f70fe89dcf14656) | 2026-07-26T14:57:23Z | /c/i/:/ /c/o/n/f/i/g/u/r/e/ /D/e/p/e/n/d/a/b/o/t/ /u/p/d/a/t/e/s/ |
| [da0047a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/da0047a2ab8f0cceded5519d030e5c4a56fb7b1b) | 2026-07-26T15:05:54Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/6/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///c/i///d/e/p/e/n/d/a/b/o/t/ |
| [cf038de](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cf038de693ae8012706815092c1d176567a18cc8) | 2026-07-26T15:06:23Z | /b/u/i/l/d/(/d/e/p/s/)/:/ /b/u/m/p/ /a/c/t/i/o/n/s///c/a/c/h/e/ /f/r/o/m/ /5/ /t/o/ /6/ |
| [c036a0f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c036a0fac350d70b205d65bc1c43d06fb39ecd01) | 2026-07-26T15:06:24Z | /b/u/i/l/d/(/d/e/p/s/)/:/ /b/u/m/p/ /a/c/t/i/o/n/s///s/e/t/u/p/-/n/o/d/e/ /f/r/o/m/ /6/ /t/o/ /7/ |
| [3de47b8](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3de47b87f44ef77c6afc6e6b54a91053c87b1e7f) | 2026-07-26T15:10:35Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/7/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///g/i/t/h/u/b/_/a/c/t/i/o/n/s///a/c/t/i/o/n/s///c/a/c/h/e/-/6/ |
| [a18f78a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a18f78ab61b30dd8dee3f98e3f6867898df0521c) | 2026-07-26T15:13:33Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/8/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///g/i/t/h/u/b/_/a/c/t/i/o/n/s///a/c/t/i/o/n/s///s/e/t/u/p/-/n/o/d/e/-/7/ |
| [9a2e4ac](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/9a2e4acdad43670847dbd6b9297b344495fc0932) | 2026-07-26T15:17:00Z | /b/u/i/l/d/(/d/e/p/s/)/:/ /b/u/m/p/ /l/a/r/a/v/e/l///t/i/n/k/e/r/ /f/r/o/m/ /2/./1/1/./1/ /t/o/ /3/./0/./2/ |
| [251d4d8](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/251d4d854529b26496fde0920187208a98e87648) | 2026-07-26T15:18:38Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/2/3/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///l/a/r/a/v/e/l///t/i/n/k/e/r/-/3/./0/./2/ |
| [850a2c1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/850a2c1b38b668a38d34fc21625969a393b69329) | 2026-07-26T15:24:28Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /c/o/n/c/u/r/r/e/n/t/l/y/ /f/r/o/m/ /9/./2/./4/ /t/o/ /1/0/./0/./4/ |
| [1f3e230](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/1f3e230a5487fd4e0998174f425633e8b1145d01) | 2026-07-26T15:27:47Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/1/9/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///c/o/n/c/u/r/r/e/n/t/l/y/-/1/0/./0/./4/ |
| [efc1760](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/efc17601d00cf5e4c91cefb70d4ad081d3840371) | 2026-07-26T15:34:00Z | /b/u/i/l/d/:/ /u/p/g/r/a/d/e/ /V/i/t/e/ /a/n/d/ /L/a/r/a/v/e/l/ /V/i/t/e/ /p/l/u/g/i/n/ |
| [2a0ced0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2a0ced0286415736961c84934684bf7995274666) | 2026-07-26T15:38:02Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/2/4/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///c/h/o/r/e///v/i/t/e/-/8/-/u/p/g/r/a/d/e/ |
| [7241da1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/7241da10b3ead8660578852a51544d9c3aa42ecd) | 2026-07-26T16:08:31Z | /b/u/i/l/d/:/ /m/i/g/r/a/t/e/ /t/o/ /T/a/i/l/w/i/n/d/ /C/S/S/ /4/ /(/#/2/5/)/ |
| [cc6c88c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cc6c88c6163e000fcd9ea3a95236af5a4e2c2797) | 2026-07-26T17:53:09Z | /d/o/c/s/:/ /p/r/e/p/a/r/e/ /d/o/c/u/m/e/n/t/a/t/i/o/n/ /f/o/r/ /v/1/./0/./0/ |
| [7696f80](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/7696f80f68954ef1c1f808c83840f2954e36e977) | 2026-08-10T04:28:56Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /l/a/r/a/v/e/l///p/i/n/t/ /f/r/o/m/ /1/./2/9/./3/ /t/o/ /1/./3/0/./4/ |
| [df57b5f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/df57b5fdfe45b6a7fb79c54b62076dbd3710a255) | 2026-08-17T04:32:57Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /l/a/r/a/v/e/l/-/v/i/t/e/-/p/l/u/g/i/n/ /f/r/o/m/ /3/./1/./3/ /t/o/ /3/./2/./0/ |
| [94e782e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/94e782ebeabaea86258e9a1cc8dfc4efdfec7958) | 2026-08-24T04:25:57Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /m/o/c/k/e/r/y///m/o/c/k/e/r/y/ /f/r/o/m/ /1/./6/./1/2/ /t/o/ /1/./6/./1/5/ |
| [668f6a6](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/668f6a6ef71a5ab642a1a25794772340e5a45356) | 2026-08-24T04:33:59Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /c/o/n/c/u/r/r/e/n/t/l/y/ /f/r/o/m/ /1/0/./0/./4/ /t/o/ /1/0/./0/./5/ |
| [069800c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/069800cc74656cca7a4e9ef8ec5b0de190e6a39e) | 2026-08-24T04:34:13Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /v/i/t/e/ /f/r/o/m/ /8/./1/./5/ /t/o/ /8/./2/./2/ |
| [3e0ce7f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3e0ce7f4c57661c2a70e75c7eabc74dc26c7618d) | 2026-08-24T04:34:19Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /a/l/p/i/n/e/j/s/ /f/r/o/m/ /3/./1/5/./1/2/ /t/o/ /3/./1/6/./2/ |
| [2177cc6](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2177cc62f143ba518e65eaec71b833601a0b01e1) | 2026-10-05T18:36:42Z | /F/i/x/ /r/e/s/u/m/e/ /s/e/c/u/r/i/t/y/,/ /f/i/l/e/ /h/a/n/d/l/i/n/g/,/ /v/a/l/i/d/a/t/i/o/n/,/ /a/n/d/ /v/u/l/n/e/r/a/b/l/e/ /d/e/p/e/n/d/e/n/c/i/e/s/ |
| [2c17d93](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2c17d931a9cd2d6059a0085f1d8d553b423679a7) | 2026-10-05T18:44:36Z | /U/p/d/a/t/e/ /P/H/P/ /d/e/p/e/n/d/e/n/c/i/e/s/ /t/o/ /r/e/s/o/l/v/e/ /s/e/c/u/r/i/t/y/ /a/d/v/i/s/o/r/i/e/s/ |
| [00ffc94](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/00ffc94e6992fa92170ef9653529b6c5af986177) | 2026-10-05T18:47:03Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /l/a/r/a/v/e/l///s/a/i/l/ /f/r/o/m/ /1/./6/4/./0/ /t/o/ /1/./6/8/./0/ |
| [be19180](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/be19180741ef9794eb2969cada9be23dc1d3089a) | 2026-10-05T19:29:34Z | /I/n/t/r/o/d/u/c/e/ /l/i/g/h/t/ /a/n/d/ /d/a/r/k/ /m/o/d/e/s/ /a/n/d/ /c/o/n/s/i/s/t/e/n/t/ /i/n/t/e/r/f/a/c/e/ /s/t/y/l/i/n/g/ |
| [b19ce23](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/b19ce236b8ccc514f374038af56bd7aae3205d69) | 2026-10-05T19:30:56Z | /I/m/p/r/o/v/e/ /r/e/s/u/m/e/ /c/a/r/d/s/,/ /s/h/a/r/i/n/g/ /c/o/n/t/r/o/l/s/,/ /a/n/d/ /e/d/i/t/i/n/g/ /a/c/c/e/s/s/i/b/i/l/i/t/y/ |
| [6c0817e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/6c0817eedf62079251c02ef579da66c757ead3a4) | 2026-10-05T19:47:15Z | /F/i/x/ /t/e/x/t/a/r/e/a/ /b/a/c/k/g/r/o/u/n/d/s/ /i/n/ /d/a/r/k/ /m/o/d/e/ |
| [0104cff](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0104cffe7e21a1d291bdc2b3a7bbc42f3aa4cd0f) | 2026-10-05T19:59:36Z | /R/e/d/e/s/i/g/n/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /l/a/y/o/u/t/ /a/n/d/ /i/m/p/r/o/v/e/ /n/a/v/i/g/a/t/i/o/n/ /a/n/d/ /d/o/w/n/l/o/a/d/s/ |
| [d261a27](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d261a2781014e55a6d2889fc96960e809314873d) | 2026-10-05T20:10:56Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/1/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///f/e/a/t/u/r/e///u/i/-/l/i/g/h/t/-/d/a/r/k/ |
| [2ee5e34](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2ee5e34d72b3373e8599ca748db929fa4419f81f) | 2026-10-05T20:14:27Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/l/p/i/n/e/j/s/-/3/./1/6/./2/ |
| [5fef827](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/5fef82791658801b5604cbef8cfeaabd8e7fae8b) | 2026-10-05T21:09:23Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///c/o/n/c/u/r/r/e/n/t/l/y/-/1/0/./0/./5/ |
| [92f0a8d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/92f0a8d026cb8f8d52935ec6df76b84d722f45bb) | 2026-10-05T21:09:26Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///m/o/c/k/e/r/y///m/o/c/k/e/r/y/-/1/./6/./1/5/ |
| [752959a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/752959a7ab73b15a1cac9c61dcb94890cdfa73a1) | 2026-10-05T21:09:29Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///l/a/r/a/v/e/l/-/v/i/t/e/-/p/l/u/g/i/n/-/3/./2/./0/ |
| [122a0fe](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/122a0febeeb3fedeafa79ed757695929ede4781f) | 2026-10-05T21:09:32Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///l/a/r/a/v/e/l///p/i/n/t/-/1/./3/0/./4/ |
| [417d1f9](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/417d1f935f1443a8c83311e7adcad38f81ae3e86) | 2026-10-05T21:09:34Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///l/a/r/a/v/e/l///s/a/i/l/-/1/./6/8/./0/ |
| [71f3666](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/71f36661f1623ce4215f816c9ae480571ffbdc0d) | 2026-10-05T21:11:26Z | /R/e/s/o/l/v/e/ /V/i/t/e/ /u/p/d/a/t/e/ /l/o/c/k/f/i/l/e/ /c/o/n/f/l/i/c/t/ /w/i/t/h/ /c/u/r/r/e/n/t/ /s/e/c/u/r/i/t/y/ /f/i/x/e/s/ |
| [b0295b1](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/b0295b1c09794c9a34b6035f6ec6cee87f2e0818) | 2026-10-05T21:33:45Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/3/0/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///l/a/r/a/v/e/l///p/i/n/t/-/1/./3/0/./4/ |
| [0ef4cfa](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0ef4cfadc1e100ad26f0c0a0ece65ad8f723d2d8) | 2026-10-05T21:34:20Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///m/o/c/k/e/r/y///m/o/c/k/e/r/y/-/1/./6/./1/5/ |
| [e8509da](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e8509da28b807df4462e640cec547a7e776db953) | 2026-10-05T21:35:39Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/3/6/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///m/o/c/k/e/r/y///m/o/c/k/e/r/y/-/1/./6/./1/5/ |
| [c03e1e0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/c03e1e03db274429657092c1b8ae86ca1eb6e4c2) | 2026-10-05T21:35:55Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///l/a/r/a/v/e/l///s/a/i/l/-/1/./6/8/./0/ |
| [3b47b0a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3b47b0a8f94cc58d6bc5113cf6c3bbfd283f2343) | 2026-10-05T21:37:15Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/0/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///l/a/r/a/v/e/l///s/a/i/l/-/1/./6/8/./0/ |
| [e227eee](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e227eee6856225af7741225f8ddfcd3956e2dad8) | 2026-10-05T21:37:29Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/l/p/i/n/e/j/s/-/3/./1/6/./2/ |
| [6e0afb0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/6e0afb0d73c9fc571fe3f5dac5948159d2c23262) | 2026-10-05T21:38:37Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/3/9/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/l/p/i/n/e/j/s/-/3/./1/6/./2/ |
| [be4f22c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/be4f22cae7ea98dee7f44b6f9c48589d78bcae5d) | 2026-10-05T21:38:50Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///c/o/n/c/u/r/r/e/n/t/l/y/-/1/0/./0/./5/ |
| [bbb55dd](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/bbb55ddcd994f279bd049016ddb73fdba617442b) | 2026-10-05T21:39:57Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/3/7/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///c/o/n/c/u/r/r/e/n/t/l/y/-/1/0/./0/./5/ |
| [2bb4cdd](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/2bb4cdd506fc114a61b634f71fb36b54657fa6e8) | 2026-10-05T21:41:21Z | /R/e/s/o/l/v/e/ /p/l/u/g/i/n/ /u/p/d/a/t/e/ /c/o/n/f/l/i/c/t/s/ /w/i/t/h/ /m/e/r/g/e/d/ /d/e/p/e/n/d/e/n/c/y/ /u/p/d/a/t/e/s/ |
| [68563e3](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/68563e343fab0d18d11aa1892baba699ff10d8ad) | 2026-10-05T21:42:45Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/3/4/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///l/a/r/a/v/e/l/-/v/i/t/e/-/p/l/u/g/i/n/-/3/./2/./0/ |
| [16bda56](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/16bda565a8c85a44bc625c6355472c2624c94651) | 2026-10-05T21:43:43Z | /R/e/s/o/l/v/e/ /V/i/t/e/ /c/o/n/f/l/i/c/t/ /w/i/t/h/ /i/n/t/e/g/r/a/t/e/d/ /f/r/o/n/t/e/n/d/ /d/e/p/e/n/d/e/n/c/y/ /u/p/d/a/t/e/s/ |
| [4521d16](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/4521d16e11c05e0a459971dcf5686542f49b583c) | 2026-10-05T21:45:06Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/3/8/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///v/i/t/e/-/8/./2/./2/ |
| [cdcfb85](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cdcfb85c4f9d93e9f87b878ed3d0d8dcaa2e5384) | 2026-10-05T22:39:18Z | /A/d/d/ /s/k/i/l/l/ /e/v/i/d/e/n/c/e/ /a/n/d/ /p/r/o/j/e/c/t/ /d/e/m/o/ /l/i/n/k/s/ /a/n/d/ /r/e/f/i/n/e/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /l/a/y/o/u/t/ |
| [091ba4d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/091ba4d88e4ab88ea0572a95bba293726bd76fc9) | 2026-10-05T22:40:21Z | /P/l/a/c/e/ /p/r/o/j/e/c/t/ /r/e/p/o/s/i/t/o/r/y/ /a/n/d/ /d/e/m/o/ /b/u/t/t/o/n/s/ /s/i/d/e/ /b/y/ /s/i/d/e/ |
| [809e9fa](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/809e9fa9b41114e36278ea71b280be61f87d8763) | 2026-10-05T22:41:06Z | /R/e/m/o/v/e/ /d/u/p/l/i/c/a/t/e/ /p/r/o/j/e/c/t/ /b/u/t/t/o/n/ /l/a/y/o/u/t/ /w/r/a/p/p/e/r/ |
| [004e508](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/004e508a022e268dc7db7234b026e315c86cbda3) | 2026-10-05T22:48:50Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/2/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///f/e/a/t/u/r/e///r/e/s/u/m/e/-/e/v/i/d/e/n/c/e/-/l/i/n/k/s/ |
| [500cd88](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/500cd88f61958a908ec995d8537860dd2a878f2d) | 2026-10-05T22:52:30Z | /F/o/r/m/a/t/ /p/u/b/l/i/c/ /r/e/s/u/m/e/ /a/n/d/ /P/D/F/ /d/a/t/e/s/ /a/s/ /a/b/b/r/e/v/i/a/t/e/d/ /m/o/n/t/h/ /a/n/d/ /y/e/a/r/ |
| [f813f7a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f813f7ad1349d81aafd3eff7868d0dd4f41248ea) | 2026-10-05T22:55:48Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/3/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///f/i/x///r/e/s/u/m/e/-/d/a/t/e/-/f/o/r/m/a/t/ |
| [3aaa8e3](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3aaa8e3c658da45670b70853cbb48a5085e3641d) | 2026-10-05T22:59:49Z | /A/d/d/ /m/o/n/t/h/-/b/a/s/e/d/ /r/e/s/u/m/e/ /d/a/t/e/ /e/d/i/t/i/n/g/ /a/n/d/ /v/a/l/i/d/a/t/e/ /d/a/t/e/ /r/a/n/g/e/s/ |
| [a3c9d36](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a3c9d367006cf5df16809846c56709926965a265) | 2026-10-05T23:11:45Z | /O/r/g/a/n/i/z/e/ /r/e/s/u/m/e/ /e/d/i/t/o/r/s/ /i/n/t/o/ /c/o/l/l/a/p/s/i/b/l/e/ /s/e/c/t/i/o/n/s/ |
| [d7dac7e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d7dac7e6606c945662cd984f5b3b8569271f35ee) | 2026-10-05T23:13:50Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/4/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///f/i/x///r/e/s/u/m/e/-/m/o/n/t/h/-/e/d/i/t/o/r/ |
| [da4c2b8](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/da4c2b8a871c3bc02d2cb7b09ff803d6c7f05c66) | 2026-10-06T06:52:58Z | /R/e/n/a/m/e/ /p/r/o/j/e/c/t/ /t/o/ /M/u/l/t/i/R/e/s/u/m/e/ /M/a/n/a/g/e/r/ |
| [0be0e22](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0be0e226edca9d0742d8dd125fa5570e7e5c5962) | 2026-10-06T06:58:20Z | /U/s/e/ /W/e/b/-/M/u/l/t/i/R/e/s/u/m/e/-/M/a/n/a/g/e/r/ /r/e/p/o/s/i/t/o/r/y/ /a/n/d/ /f/o/l/d/e/r/ /n/a/m/e/ |
| [0ca188f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0ca188fa65b34f25692e1d35bcf4fa38e2d42e2f) | 2026-10-06T07:02:04Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/5/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///c/h/o/r/e///r/e/n/a/m/e/-/m/u/l/t/i/r/e/s/u/m/e/-/m/a/n/a/g/e/r/ |
| [78aa833](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/78aa833b9d8d296093c4c880b449b5d79dcff10d) | 2026-10-06T08:05:49Z | /D/o/c/u/m/e/n/t/ /p/r/o/d/u/c/t/ /r/e/q/u/i/r/e/m/e/n/t/s/,/ /a/r/c/h/i/t/e/c/t/u/r/e/,/ /v/e/r/i/f/i/c/a/t/i/o/n/,/ /o/p/e/r/a/t/i/o/n/s/ /a/n/d/ /r/e/l/e/a/s/e/s/ |
| [71bca2f](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/71bca2f93d96a2c7e97660eb466077f37a6fbbf5) | 2026-10-06T08:07:50Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/6/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///e/n/g/i/n/e/e/r/i/n/g/-/d/o/c/u/m/e/n/t/a/t/i/o/n/ |
| [1df5230](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/1df52308ab0d5be887f1b1adee1cdbd75ea9d662) | 2026-10-06T08:17:11Z | /S/e/p/a/r/a/t/e/ /L/a/r/a/v/e/l/ /a/p/p/l/i/c/a/t/i/o/n/ /f/r/o/m/ /r/e/p/o/s/i/t/o/r/y/ /d/o/c/u/m/e/n/t/a/t/i/o/n/ |
| [0aed931](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0aed9315233da3f56994a55f8276b545241698e1) | 2026-10-06T08:18:49Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/7/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///r/e/f/a/c/t/o/r///a/p/p/l/i/c/a/t/i/o/n/-/d/i/r/e/c/t/o/r/y/ |
| [5beeecd](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/5beeecd660d17c7ef45cec0844802aff827240db) | 2026-10-06T08:20:07Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /v/i/t/e/ /f/r/o/m/ /8/./2/./2/ /t/o/ /8/./3/./2/ /i/n/ ///a/p/p/l/i/c/a/t/i/o/n/ |
| [77b7c1e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/77b7c1eb29de139e6f028935233b30c73892901e) | 2026-10-06T08:20:15Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /a/l/p/i/n/e/j/s/ /f/r/o/m/ /3/./1/6/./2/ /t/o/ /3/./1/7/./4/ /i/n/ ///a/p/p/l/i/c/a/t/i/o/n/ |
| [1641c96](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/1641c96c6dac755182a5f527714bbc013719723e) | 2026-10-06T08:25:56Z | /A/d/d/ /P/l/a/n/t/U/M/L/ /d/i/a/g/r/a/m/s/ /a/n/d/ /r/e/n/d/e/r/e/d/ /d/o/c/u/m/e/n/t/a/t/i/o/n/ /p/r/e/v/i/e/w/s/ |
| [8e8014d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/8e8014d47e5cf879b62e5d6b27879185ea6e1b59) | 2026-10-06T08:28:14Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/0/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///p/l/a/n/t/u/m/l/-/d/i/a/g/r/a/m/s/ |
| [56b43bf](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/56b43bf709ef5532b96e8913878db1f01c9481ac) | 2026-10-06T08:32:42Z | /U/s/e/ /P/l/a/n/t/U/M/L/ /e/x/c/l/u/s/i/v/e/l/y/ /a/n/d/ /r/e/m/o/v/e/ /d/u/p/l/i/c/a/t/e/ /M/e/r/m/a/i/d/ /d/i/a/g/r/a/m/s/ |
| [0175b95](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/0175b95f6ab977e33b151d3df9685cb492f9bd50) | 2026-10-06T08:33:46Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/1/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///p/l/a/n/t/u/m/l/-/o/n/l/y/ |
| [e7cbd86](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e7cbd8675621428052f83aae3e091d4b7dd28242) | 2026-10-06T08:40:37Z | /D/o/c/u/m/e/n/t/ /a/u/t/h/o/r/i/z/a/t/i/o/n/,/ /f/i/l/e/ /a/c/c/e/s/s/,/ /p/a/s/s/w/o/r/d/ /c/h/a/n/g/e/s/ /a/n/d/ /r/e/c/o/v/e/r/y/ /f/l/o/w/s/ |
| [1d35037](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/1d3503767bded03a3c34ea5166ad479ae5575f28) | 2026-10-06T08:41:32Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/2/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///s/e/c/u/r/i/t/y/-/a/n/d/-/r/e/c/o/v/e/r/y/-/d/i/a/g/r/a/m/s/ |
| [496fb8d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/496fb8d1b11162b31ad1de57f0ac4598bf2cf95e) | 2026-10-06T08:49:51Z | /C/l/a/r/i/f/y/ /r/o/a/d/m/a/p/ /o/u/t/c/o/m/e/s/ /w/i/t/h/ /a/ /P/l/a/n/t/U/M/L/ /o/v/e/r/v/i/e/w/ |
| [f7f458d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f7f458df2111a3dcda9cc00e2f6f2f9d6fb3e187) | 2026-10-06T08:51:19Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/3/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///r/o/a/d/m/a/p/-/d/i/a/g/r/a/m/ |
| [a2a960a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a2a960a88cc1144bb8224f0afefce7f266d12c52) | 2026-10-06T08:53:09Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/p/p/l/i/c/a/t/i/o/n///a/l/p/i/n/e/j/s/-/3/./1/7/./4/ |
| [4468008](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/44680081809fa70c82edcde6d815962fd4082c43) | 2026-10-06T08:53:54Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/9/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/p/p/l/i/c/a/t/i/o/n///a/l/p/i/n/e/j/s/-/3/./1/7/./4/ |
| [51acc6d](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/51acc6d9e72ab3bdeff1cafd419cd7df8edb7563) | 2026-10-06T08:53:58Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/p/p/l/i/c/a/t/i/o/n///v/i/t/e/-/8/./3/./2/ |
| [40236ff](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/40236ffbf5f52672bcff21dcd0098b9f82a64a35) | 2026-10-06T08:55:02Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/4/8/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/p/p/l/i/c/a/t/i/o/n///v/i/t/e/-/8/./3/./2/ |
| [e5a4c04](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/e5a4c04fd9e787a9ea9b646b482ef9341874ca95) | 2026-10-06T09:03:01Z | /A/d/d/ /P/l/a/n/t/U/M/L/ /p/a/g/e/ /n/a/v/i/g/a/t/i/o/n/ /s/i/t/e/m/a/p/ |
| [5c52ee0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/5c52ee0fd0dee404f9e04f69392e55c37708c49a) | 2026-10-06T09:04:03Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/4/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///p/a/g/e/-/s/i/t/e/m/a/p/ |
| [a85bb58](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/a85bb586fe287bd6135ec3e498b3f5009685795c) | 2026-10-06T09:06:27Z | /S/h/o/w/ /P/l/a/n/t/U/M/L/ /w/o/r/k/f/l/o/w/ /d/i/r/e/c/t/l/y/ /i/n/ /d/e/v/e/l/o/p/m/e/n/t/ /g/u/i/d/a/n/c/e/ |
| [3a16147](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3a16147a6decfb817847f0da825d1167f9f1a341) | 2026-10-06T09:07:24Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/5/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///d/e/v/e/l/o/p/m/e/n/t/-/w/o/r/k/f/l/o/w/-/p/r/e/v/i/e/w/ |
| [68e0869](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/68e086974e0fa6d05578deb4585e802159af62f0) | 2026-10-06T09:09:02Z | /V/i/s/u/a/l/i/z/e/ /i/m/p/l/e/m/e/n/t/a/t/i/o/n/ /s/t/a/t/u/s/ /a/n/d/ /e/v/i/d/e/n/c/e/ /b/o/u/n/d/a/r/i/e/s/ |
| [d65d6db](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/d65d6dbda215d9618d449d58c7b9503996ba611c) | 2026-10-06T09:09:58Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/6/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///i/m/p/l/e/m/e/n/t/a/t/i/o/n/-/e/v/i/d/e/n/c/e/-/m/a/p/ |
| [ca872da](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/ca872daf6cb1b39c76e8caaf61fe621f912a0f60) | 2026-10-06T09:11:43Z | /I/l/l/u/s/t/r/a/t/e/ /P/D/F/ /r/e/n/d/e/r/i/n/g/ /a/n/d/ /u/p/l/o/a/d/e/d/ /d/e/l/i/v/e/r/y/ /p/a/t/h/s/ |
| [cfa9f0a](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cfa9f0a2db916e258190ac26cdf1eef2e468bb2a) | 2026-10-06T09:12:52Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/7/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///p/d/f/-/r/e/n/d/e/r/i/n/g/-/p/i/p/e/l/i/n/e/ |
| [102b098](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/102b098d43cb8e1c95c580713c4a3e3cd1d97529) | 2026-10-06T09:15:55Z | /A/d/d/ /v/i/s/u/a/l/ /a/r/c/h/i/t/e/c/t/u/r/e/ /o/v/e/r/v/i/e/w/ /t/o/ /p/r/o/j/e/c/t/ /R/E/A/D/M/E/ |
| [cf9f26b](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/cf9f26b2f4d4f395da409fceb2315430c1dd7309) | 2026-10-06T09:17:02Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/8/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/o/c/s///r/e/a/d/m/e/-/v/i/s/u/a/l/-/o/v/e/r/v/i/e/w/ |
| [71dc2db](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/71dc2dbfc051b7f1acb97ad0f188a0fbf7d23f79) | 2026-10-12T13:36:12Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /c/o/n/c/u/r/r/e/n/t/l/y/ /f/r/o/m/ /1/0/./0/./5/ /t/o/ /1/0/./0/./6/ /i/n/ ///a/p/p/l/i/c/a/t/i/o/n/ |
| [4fd1e06](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/4fd1e06e0f2daaab59894f50e50850341296e252) | 2026-10-12T13:36:27Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /v/i/t/e/ /f/r/o/m/ /8/./3/./2/ /t/o/ /8/./3/./4/ /i/n/ ///a/p/p/l/i/c/a/t/i/o/n/ |
| [f49801c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/f49801c555792c2b330858c03a0810ef9863e7b7) | 2026-10-12T17:57:52Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/5/9/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/p/p/l/i/c/a/t/i/o/n///c/o/n/c/u/r/r/e/n/t/l/y/-/1/0/./0/./6/ |
| [75db8f0](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/75db8f0ce8fcc0e542a45714110068984c8374be) | 2026-10-12T17:57:55Z | /M/e/r/g/e/ /b/r/a/n/c/h/ /'/m/a/i/n/'/ /i/n/t/o/ /d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/p/p/l/i/c/a/t/i/o/n///v/i/t/e/-/8/./3/./4/ |
| [780c955](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/780c95521234d963c9cb292cb47049dbc4cc2f59) | 2026-10-12T17:58:47Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/6/0/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///n/p/m/_/a/n/d/_/y/a/r/n///a/p/p/l/i/c/a/t/i/o/n///v/i/t/e/-/8/./3/./4/ |
| [63b4e9e](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/63b4e9e5f1053d5559ccf38f52ec1ae53f217bca) | 2026-10-12T18:03:39Z | /A/p/p/l/y/ /p/r/o/s/p/e/c/t/i/v/e/ /p/r/o/p/r/i/e/t/a/r/y/ /s/o/f/t/w/a/r/e/ /n/o/t/i/c/e/ |
| [8b5b167](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/8b5b1675f97dd03dd5186ce68e616e773e5d82bf) | 2026-10-12T18:04:46Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/6/1/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///c/h/o/r/e///p/r/o/p/r/i/e/t/a/r/y/-/n/o/t/i/c/e/ |
| [73fe07c](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/73fe07c7ca8fb48f7e8887602657635a8dc632b5) | 2026-10-19T04:37:13Z | /b/u/i/l/d/(/d/e/p/s/-/d/e/v/)/:/ /b/u/m/p/ /l/a/r/a/v/e/l///s/a/i/l/ /f/r/o/m/ /1/./6/8/./0/ /t/o/ /1/./6/9/./0/ /i/n/ ///a/p/p/l/i/c/a/t/i/o/n/ |
| [3aca5e5](https://github.com/Farhad-Valizadegan/Web-MultiResume-Manager/commit/3aca5e591eca3b4c65668daa2d4b25ee5376bc46) | 2026-10-20T11:33:07Z | /M/e/r/g/e/ /p/u/l/l/ /r/e/q/u/e/s/t/ /#/6/2/ /f/r/o/m/ /F/a/r/h/a/d/-/V/a/l/i/z/a/d/e/g/a/n///d/e/p/e/n/d/a/b/o/t///c/o/m/p/o/s/e/r///a/p/p/l/i/c/a/t/i/o/n///l/a/r/a/v/e/l///s/a/i/l/-/1/./6/9/./0/ |

