# Theme / backend boundary

How the **ccs-theme** and **ccs-backend** plugin divide responsibility. The theme can run without the backend (templates and CPTs work); the backend adds contact form handling, form storage, and theme options.

---

## Theme provides

- **All page templates**: front-page, contact, pricing, about, 404, single-service, page-team, careers (CV Minder), etc.
- **All content CPTs** when theme is active: `service`, `condition`, `location`, `guide`, `process`, `team`. See `docs/CPT-ARCHITECTURE.md`.
- **Taxonomies**: `town`, `service-type` (and any others in theme).
- **Meta boxes** and custom rewrites.
- **Header, footer, navigation**, schema (Organization, BreadcrumbList, ContactPage, LocalBusiness, etc.), breadcrumbs.
- **Design and assets**: `style.css`, `assets/js/main.js`, brand tokens.

The theme **does not** implement the contact form server-side handler. It sends the form via AJAX to the backend when the backend is active.

---

## Backend provides

- **Contact form AJAX handler**: action `ccs_contact_form`, nonce action `ccs_contact_form`. Validates and stores submissions in the `form_submission` CPT; optionally sends notification email (enquiries address from theme options).
- **Theme options / Customizer**: e.g. enquiries email, phone, social links, CQC link (where implemented).
- **CPTs only when theme is not used**: the backend registers `service` (and its other CPTs) only when the active theme is *not* `ccs-theme`. With ccs-theme active, the theme is the single source of truth for `service` to avoid duplicate registration.

---

## Contact form contract

The theme’s contact page POSTs to `admin-ajax.php` with the following. The backend **must** receive these to process the form.

| POST key           | Required | Description |
|--------------------|----------|-------------|
| `action`           | Yes      | Must be `ccs_contact_form`. |
| `nonce`            | Yes      | `wp_create_nonce( 'ccs_contact_form' )`. |
| `contact-name`     | Yes      | Sanitized as text. |
| `contact-email`    | Yes      | Valid email. |
| `contact-phone`    | Yes      | Sanitized as text. |
| `contact-subject`  | Yes      | One of: `care-enquiry`, `general`, `request-callback`, `other`. Theme maps enquiry_type (care_consultation, care_question, career, professional, other) to these. |
| `contact-message`  | Yes      | Sanitized as textarea. |
| `page_url`         | No       | Current page URL for submission meta. |

**Theme localisation:** On the contact page, the theme localises `ccs_contact` (via `wp_localize_script`) with `ajaxurl` (`admin_url( 'admin-ajax.php' )`) and `nonce` so the inline contact script can POST to the backend. If the backend is not active, the form will fail at runtime (theme shows a fallback message: “Form is not configured. Please call …”).

**Response:** Backend returns JSON: `{ "success": true }` or `wp_send_json_error( array( 'message' => '…', 'errors' => array( 'contact-name' => '…' ) ) )`.

---

## Resolving the service CPT

- **When ccs-theme is active:** Only the theme registers `service`. Backend’s `ccs_register_service_post_type()` returns early when `get_template() === 'ccs-theme'`.
- **When another theme is active:** Backend registers `service` (and its other CPTs) so the site still has services if the theme is switched.

See `ccs-backend/inc/cpt-content.php` and `ccs-theme/inc/cpt-registration.php`.
