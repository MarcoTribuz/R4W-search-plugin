<?php

/*** Child Theme Function  ***/

if (!function_exists('succulents_qodef_child_theme_enqueue_scripts')){

	function succulents_qodef_child_theme_enqueue_scripts() {

		$parent_style = 'succulents_qodef_default_style';

		wp_enqueue_style('succulents_qodef_child_style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
	}

	add_action( 'wp_enqueue_scripts', 'succulents_qodef_child_theme_enqueue_scripts' );
}

include_once( get_stylesheet_directory() . '/includes/enqueue-scripts.php' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Difficulties.
	 */

	$labels = [
		"name"          => esc_html__( "Difficulties", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Difficulty", "custom-post-type-ui" ),
	];


	$args = [
		"label"                 => esc_html__( "Difficulties", "custom-post-type-ui" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'difficulty', 'with_front' => true, ],
		"show_admin_column"     => false,
		"show_in_rest"          => false,
		"show_tagcloud"         => false,
		"rest_base"             => "difficulty",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace"        => "wp/v2",
		"show_in_quick_edit"    => true,
		"sort"                  => false,
		"show_in_graphql"       => false,
	];
	register_taxonomy( "difficulty", [ "post" ], $args );

	/**
	 * Taxonomy: Durations.
	 */

	$labels = [
		"name"          => esc_html__( "Durations", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Duration", "custom-post-type-ui" ),
	];


	$args = [
		"label"                 => esc_html__( "Durations", "custom-post-type-ui" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'duration', 'with_front' => true, ],
		"show_admin_column"     => false,
		"show_in_rest"          => false,
		"show_tagcloud"         => false,
		"rest_base"             => "duration",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace"        => "wp/v2",
		"show_in_quick_edit"    => true,
		"sort"                  => false,
		"show_in_graphql"       => false,
	];
	register_taxonomy( "duration", [ "post" ], $args );

	/**
	 * Taxonomy: Servings.
	 */

	$labels = [
		"name"          => esc_html__( "Servings", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Serving", "custom-post-type-ui" ),
	];


	$args = [
		"label"                 => esc_html__( "Servings", "custom-post-type-ui" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'serving', 'with_front' => true, ],
		"show_admin_column"     => false,
		"show_in_rest"          => false,
		"show_tagcloud"         => false,
		"rest_base"             => "serving",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace"        => "wp/v2",
		"show_in_quick_edit"    => true,
		"sort"                  => false,
		"show_in_graphql"       => false,
	];
	register_taxonomy( "serving", [ "post" ], $args );

	/**
	 * Taxonomy: Ecologies.
	 */

	$labels = [
		"name"          => esc_html__( "Ecologies", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Ecology", "custom-post-type-ui" ),
	];


	$args = [
		"label"                 => esc_html__( "Ecologies", "custom-post-type-ui" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'ecology', 'with_front' => true, ],
		"show_admin_column"     => false,
		"show_in_rest"          => false,
		"show_tagcloud"         => false,
		"rest_base"             => "ecology",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace"        => "wp/v2",
		"show_in_quick_edit"    => true,
		"sort"                  => false,
		"show_in_graphql"       => false,
	];
	register_taxonomy( "ecology", [ "post" ], $args );

	/**
	 * Taxonomy: Domains.
	 */

	$labels = [
		"name"          => esc_html__( "Domains", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Domain", "custom-post-type-ui" ),
	];


	$args = [
		"label"                 => esc_html__( "Domains", "custom-post-type-ui" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'domain', 'with_front' => true, ],
		"show_admin_column"     => false,
		"show_in_rest"          => false,
		"show_tagcloud"         => false,
		"rest_base"             => "domain",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace"        => "wp/v2",
		"show_in_quick_edit"    => true,
		"sort"                  => false,
		"show_in_graphql"       => false,
	];
	register_taxonomy( "domain", [ "post" ], $args );

	/**
	 * Taxonomy: Skills.
	 */

	$labels = [
		"name"          => esc_html__( "Skills", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Skill", "custom-post-type-ui" ),
	];


	$args = [
		"label"                 => esc_html__( "Skills", "custom-post-type-ui" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'skill', 'with_front' => true, ],
		"show_admin_column"     => false,
		"show_in_rest"          => false,
		"show_tagcloud"         => false,
		"rest_base"             => "skill",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace"        => "wp/v2",
		"show_in_quick_edit"    => true,
		"sort"                  => false,
		"show_in_graphql"       => false,
	];
	register_taxonomy( "skill", [ "post" ], $args );

	/**
	 * Taxonomy: Extras.
	 */

	$labels = [
		"name"          => esc_html__( "Intersections", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Intersection", "custom-post-type-ui" ),
	];


	$args = [
		"label"                 => esc_html__( "Intersections", "custom-post-type-ui" ),
		"labels"                => $labels,
		"public"                => true,
		"publicly_queryable"    => true,
		"hierarchical"          => false,
		"show_ui"               => true,
		"show_in_menu"          => true,
		"show_in_nav_menus"     => true,
		"query_var"             => true,
		"rewrite"               => [ 'slug' => 'extra', 'with_front' => true, ],
		"show_admin_column"     => false,
		"show_in_rest"          => false,
		"show_tagcloud"         => false,
		"rest_base"             => "extra",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace"        => "wp/v2",
		"show_in_quick_edit"    => true,
		"sort"                  => false,
		"show_in_graphql"       => false,
	];
	register_taxonomy( "intersection", [ "post" ], $args );
}

add_action( 'init', 'cptui_register_my_taxes' );

// Redirection logout
add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
         wp_redirect( 'https://recipesforwellbeing.org' );
         exit();
}

function taxonomyListFn( $atts ) {
	global $post;
	$default   = array(
		'tag' => '#',
	);
	$listOfTaxonomies = '';
	$tagToShow = shortcode_atts( $default, $atts );
	$term_list = wp_get_post_terms( $post->ID, $tagToShow['tag'], array( 'fields' => 'all' ) );
	foreach ( $term_list as $key => $term ) {
		if ( $key == count( $term_list ) - 1 ) {
			$listOfTaxonomies .= "<a target='_blank' rel='noopener' href='/{$tagToShow['tag']}/{$term->slug}'>{$term->name}</a>";
		} else {
			$listOfTaxonomies .= "<a target='_blank' rel='noopener' href='/{$tagToShow['tag']}/{$term->slug}'>{$term->name}</a>, ";
		}
	}
	return $listOfTaxonomies;
}

add_shortcode( 'taxonomyList', 'taxonomyListFn' );