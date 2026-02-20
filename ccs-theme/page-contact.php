<?php
/**
 * Template Name: Contact Page
 * Two columns: contact block | form. Form POSTs to backend ccs_contact_form (contact-name, contact-email, contact-phone, contact-subject, contact-message, nonce, page_url).
 * Enquiry type map: care_consultation→care-enquiry, care_question→general, career|professional|other→other.
 */
get_header();

$prefill_name    = isset($_GET['name']) ? sanitize_text_field(wp_unslash($_GET['name'])) : '';
$prefill_phone   = isset($_GET['phone']) ? sanitize_text_field(wp_unslash($_GET['phone'])) : '';
$prefill_message = isset($_GET['message']) ? sanitize_textarea_field(wp_unslash($_GET['message'])) : '';
?>

<div class="container contact-page">

    <?php ccs_breadcrumbs(); ?>

    <article class="page-contact">
        <header class="page-header">
            <h1>Get in Touch</h1>
            <p class="lead">We're here to answer your questions about care or careers. Call us or send a message.</p>
        </header>

        <div class="contact-two-col">
            <div class="contact-block">
                <h2>Contact Details</h2>
                <p class="contact-phone">
                    <strong>Phone</strong><br>
                    <a href="tel:01622809881">01622 809881</a><br>
                    <span class="contact-hours">Mon–Fri 8am–6pm, Sat 9am–1pm, Sun closed</span>
                </p>
                <p class="contact-email">
                    <strong>Email</strong><br>
                    <a href="mailto:office@continuitycareservices.co.uk">office@continuitycareservices.co.uk</a>
                </p>
                <p class="contact-address">
                    <strong>Address</strong><br>
                    The Maidstone Studios, New Cut Road, Maidstone, Kent ME14 5NZ
                </p>
                <div class="contact-social">
                    <a href="https://m.me/821174384562849" target="_blank" rel="noopener noreferrer" aria-label="Message Continuity's Facebook">Facebook Messenger</a>
                    <a href="https://www.instagram.com/continuityofcareservices/" target="_blank" rel="noopener noreferrer" aria-label="Find Continuity on Instagram">Instagram</a>
                    <a href="https://www.linkedin.com/company/continuitycareservices" target="_blank" rel="noopener noreferrer" aria-label="Find Continuity on LinkedIn">LinkedIn</a>
                    <a href="https://www.threads.net/@continuityofcareservices" target="_blank" rel="noopener noreferrer" aria-label="Find Continuity on Threads">Threads</a>
                </div>
            </div>

            <div class="contact-form-wrap">
                <form id="ccs-contact-form" class="contact-form" method="post" action="" novalidate>
                    <p>
                        <label for="contact-name">Name <span class="required">*</span></label>
                        <input type="text" id="contact-name" name="contact-name" value="<?php echo esc_attr($prefill_name); ?>" required>
                        <span class="form-error" data-for="contact-name" aria-live="polite"></span>
                    </p>
                    <p>
                        <label for="contact-email">Email <span class="required">*</span></label>
                        <input type="email" id="contact-email" name="contact-email" required>
                        <span class="form-error" data-for="contact-email" aria-live="polite"></span>
                    </p>
                    <p>
                        <label for="contact-phone">Phone <span class="required">*</span></label>
                        <input type="tel" id="contact-phone" name="contact-phone" value="<?php echo esc_attr($prefill_phone); ?>" required>
                        <span class="form-error" data-for="contact-phone" aria-live="polite"></span>
                    </p>
                    <p>
                        <label for="contact-location">Location <span class="optional">(optional)</span></label>
                        <input type="text" id="contact-location" name="contact-location">
                    </p>
                    <p>
                        <label for="contact-subject">Enquiry type <span class="required">*</span></label>
                        <select id="contact-subject" name="contact-subject" required>
                            <option value="care-enquiry">Care consultation / I need care</option>
                            <option value="general">General care question</option>
                            <option value="request-callback">Request a callback</option>
                            <option value="other">Career / professional / other</option>
                        </select>
                        <span class="form-error" data-for="contact-subject" aria-live="polite"></span>
                    </p>
                    <p>
                        <label for="contact-message">Message <span class="required">*</span></label>
                        <textarea id="contact-message" name="contact-message" rows="5" required><?php echo esc_textarea($prefill_message); ?></textarea>
                        <span class="form-error" data-for="contact-message" aria-live="polite"></span>
                    </p>
                    <p>
                        <input type="hidden" name="nonce" id="contact-nonce" value="">
                        <input type="hidden" name="page_url" id="contact-page-url" value="">
                    </p>
                    <p class="form-actions">
                        <button type="submit" class="btn btn-primary" id="contact-submit">Send message</button>
                    </p>
                </form>
                <div id="contact-form-success" class="contact-form-message success-message" role="alert" hidden>
                    <p>Thank you for your message. We will be in touch soon.</p>
                </div>
                <div id="contact-form-error" class="contact-form-message error-message" role="alert" hidden>
                    <p></p>
                </div>
            </div>
        </div>

        <section class="what-happens-next">
            <h2>What Happens Next?</h2>
            <ol class="steps-list">
                <li><strong>We call you</strong> — Usually within one working day</li>
                <li><strong>Book a consultation</strong> — Free, no obligation, at your home or ours</li>
                <li><strong>We write the plan</strong> — A care plan tailored to you</li>
                <li><strong>Care starts</strong> — Same carers, every time</li>
            </ol>
        </section>
    </article>

</div>

<script>
(function() {
    var form = document.getElementById('ccs-contact-form');
    if (!form) return;
    var nonceEl = document.getElementById('contact-nonce');
    var pageUrlEl = document.getElementById('contact-page-url');
    var successEl = document.getElementById('contact-form-success');
    var errorEl = document.getElementById('contact-form-error');
    var errorParagraph = errorEl ? errorEl.querySelector('p') : null;
    var submitBtn = document.getElementById('contact-submit');

    if (typeof ccs_contact !== 'undefined') {
        if (ccs_contact.nonce) nonceEl.value = ccs_contact.nonce;
        if (ccs_contact.ajaxurl) pageUrlEl.value = window.location.href;
    }

    function showSuccess() {
        if (successEl) successEl.hidden = false;
        if (errorEl) errorEl.hidden = true;
        form.hidden = true;
        document.querySelectorAll('.form-error').forEach(function(el) { el.textContent = ''; });
    }
    function showError(msg) {
        if (errorEl && errorParagraph) {
            errorParagraph.textContent = msg || 'Something went wrong. Please try again or call 01622 809881.';
            errorEl.hidden = false;
        }
        if (successEl) successEl.hidden = true;
    }
    function setFieldErrors(errors) {
        document.querySelectorAll('.form-error').forEach(function(el) {
            var key = el.getAttribute('data-for');
            el.textContent = (errors && errors[key]) ? errors[key] : '';
        });
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (!ccs_contact || !ccs_contact.ajaxurl || !ccs_contact.nonce) {
            showError('Form is not configured. Please call 01622 809881.');
            return;
        }
        setFieldErrors({});
        if (submitBtn) submitBtn.disabled = true;

        var fd = new FormData(form);
        fd.set('page_url', window.location.href);
        fd.set('nonce', ccs_contact.nonce);
        fd.set('action', 'ccs_contact_form');

        fetch(ccs_contact.ajaxurl, {
            method: 'POST',
            body: fd,
            credentials: 'same-origin'
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                showSuccess();
            } else {
                if (data.data && data.data.errors) setFieldErrors(data.data.errors);
                showError(data.data && data.data.message ? data.data.message : 'Please correct the errors and try again.');
            }
        })
        .catch(function() {
            showError('Something went wrong. Please try again or call 01622 809881.');
        })
        .finally(function() {
            if (submitBtn) submitBtn.disabled = false;
        });
    });
})();
</script>

<?php get_footer(); ?>
