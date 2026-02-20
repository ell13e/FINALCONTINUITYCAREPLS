<?php
/**
 * Breadcrumb output. Used by templates via ccs_breadcrumbs().
 */

function ccs_breadcrumbs() {
    if (!function_exists('yoast_breadcrumb')) {
        ccs_render_breadcrumbs();
    } else {
        yoast_breadcrumb('<nav class="breadcrumbs" aria-label="Breadcrumb">', '</nav>');
    }
}

function ccs_render_breadcrumbs() {
    $sep   = ' <span class="breadcrumb-sep" aria-hidden="true">/</span> ';
    $items = array();

    $items[] = '<a href="' . esc_url(home_url('/')) . '">Home</a>';

    if (is_singular()) {
        $post = get_queried_object();
        if ($post->post_type !== 'page' && $post->post_type !== 'post') {
            $pto = get_post_type_object($post->post_type);
            if ($pto && $pto->public) {
                $items[] = '<a href="' . esc_url(get_post_type_archive_link($post->post_type)) . '">' . esc_html($pto->labels->name) . '</a>';
            }
        }
        if (is_singular() && get_the_title()) {
            $items[] = '<span class="breadcrumb-current" aria-current="page">' . esc_html(get_the_title()) . '</span>';
        }
    } elseif (is_post_type_archive()) {
        $pto = get_queried_object();
        $items[] = '<span class="breadcrumb-current" aria-current="page">' . esc_html($pto->labels->name) . '</span>';
    } elseif (is_archive()) {
        $items[] = '<span class="breadcrumb-current" aria-current="page">' . get_the_archive_title() . '</span>';
    } elseif (is_search()) {
        $items[] = '<span class="breadcrumb-current" aria-current="page">Search results</span>';
    } elseif (is_404()) {
        $items[] = '<span class="breadcrumb-current" aria-current="page">Page not found</span>';
    }

    if (count($items) <= 1) {
        return;
    }

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb"><p class="breadcrumb-list">' . implode($sep, $items) . '</p></nav>';
}

/**
 * Return breadcrumb trail as list of name/url for schema. Last item has no url (current page).
 *
 * @return array<int, array{name: string, url: string|null}>
 */
function ccs_get_breadcrumb_items() {
    $list = array();

    $list[] = array('name' => 'Home', 'url' => home_url('/'));

    if (is_singular()) {
        $post = get_queried_object();
        if ($post->post_type !== 'page' && $post->post_type !== 'post') {
            $pto = get_post_type_object($post->post_type);
            if ($pto && $pto->public) {
                $archive_link = get_post_type_archive_link($post->post_type);
                if ($archive_link) {
                    $list[] = array('name' => $pto->labels->name, 'url' => $archive_link);
                }
            }
        }
        if (get_the_title()) {
            $list[] = array('name' => get_the_title(), 'url' => null);
        }
    } elseif (is_post_type_archive()) {
        $pto = get_queried_object();
        $list[] = array('name' => $pto->labels->name, 'url' => null);
    } elseif (is_archive()) {
        $list[] = array('name' => get_the_archive_title(), 'url' => null);
    } elseif (is_search()) {
        $list[] = array('name' => 'Search results', 'url' => null);
    } elseif (is_404()) {
        $list[] = array('name' => 'Page not found', 'url' => null);
    } elseif (is_home() && !is_front_page()) {
        $list[] = array('name' => 'Blog', 'url' => null);
    }

    return $list;
}
