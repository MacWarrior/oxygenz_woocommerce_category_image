<?php
/*
Plugin Name: Oxygenz - Woocommerce : Category image
Description : Create a shortcode to display main product category images with direct link to category
Version: 1.0
Author: Oxygenz
*/

function OxygenzCategorieImage(): void
{
    $catTerms = get_terms([
        'taxonomy' => 'product_cat',
        'parent' => null
    ]);

    echo "<div class='OxygenzCategorieImageContainer'>";
    foreach ($catTerms as $catTerm) {
        // get the thumbnail id using the queried category term_id
        $thumbnail_id = get_term_meta($catTerm->term_id, 'thumbnail_id', true);

        // get the image URL
        $image = wp_get_attachment_url($thumbnail_id);

        // get the category link
        $link = get_category_link($catTerm);

        // print the IMG HTML
        if ($image && $link) {
            echo '<a href="'.$link.'">
                    <img src="'.$image.'" alt="'.$catTerm->name.'" class="OxygenzCategorieImage" />
                  </a>';
        }
    }
    echo '</div>';
}

add_shortcode('OxygenzCategorieImage', 'OxygenzCategorieImage');
