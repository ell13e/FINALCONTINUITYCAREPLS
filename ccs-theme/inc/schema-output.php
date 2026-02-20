<?php
/**
 * Schema Markup Output for All Page Types
 * Contact details from BRAND-REFERENCE.md.
 */

function ccs_output_schema() {

    ccs_organization_schema();

    if (is_front_page()) {
        ccs_local_business_schema();
    }

    if (is_page('contact')) {
        ccs_contact_page_schema();
    }

    $breadcrumb_items = ccs_get_breadcrumb_items();
    if (count($breadcrumb_items) > 1) {
        ccs_breadcrumb_list_schema($breadcrumb_items);
    }

    if (is_singular('service')) {
        ccs_service_schema();
    } elseif (is_singular('condition')) {
        ccs_condition_schema();
    } elseif (is_singular('location')) {
        ccs_location_schema();
    } elseif (is_singular('guide')) {
        ccs_guide_schema();
    } elseif (is_singular('process')) {
        ccs_process_schema();
    } elseif (is_page('pricing')) {
        ccs_pricing_schema();
    }
}
add_action('wp_head', 'ccs_output_schema');

/**
 * Organization contact (BRAND-REFERENCE.md)
 */
function ccs_schema_contact() {
    return array(
        'phone'   => '+44 1622 809881',
        'email'   => 'office@continuitycareservices.co.uk',
        'address' => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'The Maidstone Studios, New Cut Road',
            'addressLocality' => 'Maidstone',
            'addressRegion'   => 'Kent',
            'postalCode'      => 'ME14 5NZ',
            'addressCountry'  => 'GB'
        ),
        'sameAs' => array(
            'https://m.me/821174384562849',
            'https://www.instagram.com/continuityofcareservices/',
            'https://www.linkedin.com/company/continuitycareservices',
            'https://www.threads.com/@continuityofcareservices'
        )
    );
}

/**
 * Organization Schema (all pages)
 */
function ccs_organization_schema() {
    $contact = ccs_schema_contact();
    $schema  = array(
        '@context'     => 'https://schema.org',
        '@type'        => 'Organization',
        'name'         => 'Continuity Care Services',
        'url'          => home_url(),
        'logo'         => get_template_directory_uri() . '/assets/images/logo.png',
        'description'  => 'Home care across Maidstone and Kent for adults and children. Domiciliary, complex, respite, and palliative care services.',
        'address'      => $contact['address'],
        'telephone'    => $contact['phone'],
        'email'        => $contact['email'],
        'sameAs'       => $contact['sameAs']
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * BreadcrumbList schema (all pages with trail). Last item has no url per Google.
 *
 * @param array<int, array{name: string, url: string|null}> $items From ccs_get_breadcrumb_items().
 */
function ccs_breadcrumb_list_schema($items) {
    $list = array();
    $pos  = 1;
    foreach ($items as $item) {
        $entry = array(
            '@type'    => 'ListItem',
            'position' => $pos,
            'name'     => wp_strip_all_tags($item['name'])
        );
        if (!empty($item['url'])) {
            $entry['item'] = $item['url'];
        }
        $list[] = $entry;
        $pos++;
    }

    $schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $list
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * ContactPage + Organization contact (contact page only)
 */
function ccs_contact_page_schema() {
    $contact = ccs_schema_contact();
    $schema  = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'ContactPage',
        'name'        => 'Get in Touch',
        'description' => 'Contact Continuity Care Services for care enquiries, careers, or general questions.',
        'url'         => home_url('/contact'),
        'mainEntity'  => array(
            '@type'       => 'Organization',
            'name'        => 'Continuity Care Services',
            'telephone'   => $contact['phone'],
            'email'       => $contact['email'],
            'address'     => $contact['address'],
            'url'         => home_url()
        )
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * LocalBusiness on front page (aggregate)
 */
function ccs_local_business_schema() {
    $contact = ccs_schema_contact();
    $schema  = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => 'Continuity Care Services',
        'description' => 'Home care across Maidstone and Kent for adults and children. Domiciliary, complex, respite, and palliative care services.',
        'url'         => home_url(),
        'telephone'   => $contact['phone'],
        'email'       => $contact['email'],
        'address'     => $contact['address'],
        'sameAs'      => $contact['sameAs']
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Service Schema
 */
function ccs_service_schema() {
    global $post;

    $pricing       = get_post_meta($post->ID, '_ccs_pricing_range', true);
    $service_types = wp_get_post_terms($post->ID, 'service-type', array('fields' => 'names'));
    $towns         = wp_get_post_terms($post->ID, 'town', array('fields' => 'names'));
    $contact       = ccs_schema_contact();

    $schema = array(
        '@context'     => 'https://schema.org',
        '@type'        => 'MedicalBusiness',
        'name'         => get_the_title(),
        'description'  => get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30),
        'url'          => get_permalink(),
        'address'      => $contact['address'],
        'telephone'    => $contact['phone']
    );

    if (!empty($service_types)) {
        $schema['serviceType'] = $service_types[0];
    }
    if (!empty($towns)) {
        $schema['areaServed'] = array('@type' => 'City', 'name' => $towns[0]);
    }
    if ($pricing) {
        $schema['priceRange'] = $pricing;
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Condition Schema
 */
function ccs_condition_schema() {
    global $post;

    $schema_code = get_post_meta($post->ID, '_ccs_schema_code', true);
    $alt_names   = get_post_meta($post->ID, '_ccs_alt_names', true);

    $schema = array(
        '@context'     => 'https://schema.org',
        '@type'        => 'MedicalCondition',
        'name'         => get_the_title(),
        'description'  => get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30),
        'url'          => get_permalink()
    );

    if ($schema_code) {
        $schema['code'] = array(
            '@type'        => 'MedicalCode',
            'code'         => $schema_code,
            'codingSystem' => 'ICD-10'
        );
    }
    if ($alt_names) {
        $schema['alternateName'] = array_map('trim', explode(',', $alt_names));
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Location Schema
 */
function ccs_location_schema() {
    global $post;

    $location_type = get_post_meta($post->ID, '_ccs_location_type', true);
    $coordinates   = get_post_meta($post->ID, '_ccs_coordinates', true);
    $postal_codes  = get_post_meta($post->ID, '_ccs_postal_codes', true);
    $contact       = ccs_schema_contact();

    $schema = array(
        '@context'     => 'https://schema.org',
        '@type'        => 'LocalBusiness',
        'name'         => 'Continuity Care Services - ' . get_the_title(),
        'description'  => get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30),
        'url'          => get_permalink(),
        'telephone'    => $contact['phone']
    );

    if ($location_type === 'County') {
        $child_locations = get_posts(array(
            'post_type'      => 'location',
            'posts_per_page' => -1,
            'post_parent'   => $post->ID,
            'fields'        => 'post_title'
        ));
        if (!empty($child_locations)) {
            $schema['areaServed'] = array();
            foreach ($child_locations as $child) {
                $schema['areaServed'][] = array('@type' => 'City', 'name' => $child->post_title);
            }
        }
    } else {
        $schema['address'] = array(
            '@type'           => 'PostalAddress',
            'addressLocality' => get_the_title(),
            'addressRegion'   => 'Kent',
            'addressCountry'  => 'GB'
        );
        if ($postal_codes) {
            $codes = array_map('trim', explode(',', $postal_codes));
            $schema['address']['postalCode'] = $codes[0];
        }
    }

    if ($coordinates) {
        $parts = array_map('trim', explode(',', $coordinates));
        if (count($parts) >= 2) {
            $schema['geo'] = array(
                '@type'     => 'GeoCoordinates',
                'latitude'  => $parts[0],
                'longitude' => $parts[1]
            );
        }
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Guide Schema (Article + FAQPage)
 */
function ccs_guide_schema() {
    global $post;

    $last_reviewed        = get_post_meta($post->ID, '_ccs_last_reviewed', true);
    $author_credentials  = get_post_meta($post->ID, '_ccs_author_credentials', true);
    $faqs                = get_post_meta($post->ID, '_ccs_faqs', true);

    $schema = array(
        '@context'     => 'https://schema.org',
        '@type'        => 'Article',
        'headline'     => get_the_title(),
        'description'  => get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30),
        'url'          => get_permalink(),
        'datePublished' => get_the_date('c'),
        'dateModified'  => get_the_modified_date('c'),
        'publisher'    => array(
            '@type' => 'Organization',
            'name'  => 'Continuity Care Services',
            'logo'  => array(
                '@type' => 'ImageObject',
                'url'   => get_template_directory_uri() . '/assets/images/logo.png'
            )
        )
    );

    if ($author_credentials) {
        $schema['author'] = array(
            '@type'    => 'Person',
            'name'     => get_the_author(),
            'jobTitle' => $author_credentials
        );
    }
    if ($last_reviewed) {
        $schema['reviewedBy'] = array('@type' => 'Person', 'name' => get_the_author());
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";

    if (!empty($faqs) && is_array($faqs)) {
        $faq_schema = array(
            '@context'    => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array()
        );
        foreach ($faqs as $faq) {
            $faq_schema['mainEntity'][] = array(
                '@type'          => 'Question',
                'name'           => $faq['question'],
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => $faq['answer']
                )
            );
        }
        echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}

/**
 * Process Schema (HowTo)
 */
function ccs_process_schema() {
    global $post;

    $step_number = get_post_meta($post->ID, '_ccs_step_number', true);
    $duration    = get_post_meta($post->ID, '_ccs_duration', true);

    $schema = array(
        '@context'     => 'https://schema.org',
        '@type'        => 'HowTo',
        'name'         => get_the_title(),
        'description'  => get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30),
        'url'          => get_permalink()
    );
    if ($duration) {
        $schema['totalTime'] = $duration;
    }
    if ($step_number) {
        $schema['step'] = array(
            '@type'    => 'HowToStep',
            'position' => (int) $step_number,
            'name'     => get_the_title(),
            'text'     => get_the_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30)
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

/**
 * Pricing Schema
 */
function ccs_pricing_schema() {
    $schema = array(
        '@context'  => 'https://schema.org',
        '@type'     => 'Product',
        'name'      => 'Home Care Services',
        'description' => 'Domiciliary, complex, and respite care services in Kent',
        'offers'    => array(
            array(
                '@type'           => 'Offer',
                'priceCurrency'   => 'GBP',
                'price'           => '28-38',
                'priceSpecification' => array(
                    '@type'       => 'PriceSpecification',
                    'price'       => '28-38',
                    'priceCurrency' => 'GBP',
                    'unitText'    => 'per hour'
                ),
                'availability' => 'https://schema.org/InStock',
                'url'          => home_url('/pricing')
            )
        )
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
