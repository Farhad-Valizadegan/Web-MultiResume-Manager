# Interface and Accessibility Design

Status: Documented current implementation
Reviewed: 2026-10-06 (Europe/Berlin)
Source baseline: 0ca188f. This is documentation evidence, not production certification.

The editor has Basic Information, Display Settings and seven detail-section disclosures. Native details/summary preserves mounted form fields and browser keyboard semantics. Appearance.js builds navigation from section titles and opens a destination before navigating. Workspace.js associates labels with repeatable fields, tracks dirty edits and opens ancestor disclosures on invalid events.

All sections normally begin collapsed. Collection server errors open the related section. Basic Information currently opens for any server error, a documented UX-001 improvement opportunity. Disclosure state is not a saved record value and should not mark the form dirty on its own. The unsaved-change warning is a browser prompt, not autosave or recovery after a crash.

Browser preference is Light/Dark/System; the current storage key is multiresume-manager.appearance. Theme initialization migrates the legacy key to preserve existing preference. Resume template choice is a separate setting from global appearance. Theme controls must remain readable at narrow widths with the longer display name.

Public layout uses a portrait/information header, section navigation, vertically stacked projects and adjacent repository/demo actions that can wrap on small screens. Address links use Google Maps. Accessible labels, keyboard reachability, focus visibility, contrast and error announcement must be verified on actual output; native disclosure alone does not establish complete accessibility compliance.

See [Editor sections, validation and unsaved changes](editor-interaction-flow.md) for the corresponding PlantUML view.
