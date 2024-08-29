<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}

function lien_admin($items) {
    if (is_user_logged_in()) {
        // Création du lien Admin
        $lien_admin = '<li class="lienAdmin"><a href="'. get_admin_url() .'">Admin</a></li>';

        // Séparation des éléments du menu
        $items_array = explode('</li>', $items);

        // Définition de la position où insérer le lien (après le 2ème élément par exemple)
        $position = 1; // Modifier cette valeur selon la position souhaitée

        // Insertion du lien Admin à la position désirée
        array_splice($items_array, $position, 0, $lien_admin);

        // Reconstitution du menu avec le lien Admin ajouté
        $items = implode('</li>', $items_array);
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'lien_admin');