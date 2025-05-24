/* wp memory extend 
Add to wp-config.php: */

define( 'WP_MAX_MEMORY_LIMIT' , '512M' );
define( 'WP_MEMORY_LIMIT' , '512M' );

/*{
Warning!!! Migration to PHP 8.1 - how to fix Deprecated Passing null to parameter error - rename build in functions
//Deprecated: rtrim(): Passing null to parameter #1 ($string) of type string is deprecated in G:\laragon\www\bdebest-wcl\wp-includes\formatting.php on line 2809

	return rtrim( $value ?? "", '/\\' );    // return rtrim( $value, '/\\' );

Warning!!! Deprecated: strpos(): Passing null to parameter #1 in php 8.1 SOLVED
//Deprecated: strpos(): Passing null to parameter #1 ($haystack) of type string is deprecated in G:\laragon\www\bdebest-wcl\wp-includes\functions.php on line 7053

	$scheme_separator = is_string($path)?strpos( $path, '://' ):false;    // $scheme_separator = strpos( $path, '://' );

Deprecated: str_replace(): Passing null to parameter #3 ($subject) of type array|string is deprecated in G:\laragon\www\bdebest-wcl\wp-includes\functions.php on line 2165
// Standardize all paths to use '/'.

	$path = $path?str_replace( '\\', '/', $path ):"";     // $path = str_replace( '\\', '/', $path );
} */

/* elementor mega menu outside click not working */
<script>
	document.body.addEventListener('click', function (event) {
		if ( ! event.target.closest('.e-n-menu') ) {
			let dropdowns = document.querySelectorAll('.e-n-menu-dropdown-icon-opened');
			dropdowns.forEach((el) => {
				let check_if_visible = window.getComputedStyle(el, null).display;
				if(check_if_visible == 'flex') {
					el.closest('li').click();
				}
			});
		}
	});
</script>

/* elementor mega menu active color not working stackoverflow solve */
<script>
	const megaMenuEdit = document.querySelectorAll('.e-click');
	megaMenuEdit.forEach(item => {
		const content = item.querySelector('.e-click');
		item.addEventListener('click', (event) => {
			const wasActive = item.classList.contains('e-current');
			megaMenuEdit.forEach(item => {
				item.classList.remove('e-current');
			});
			if (!wasActive) {
				item.classList.add('e-current');
			}
		});
	});
</script>
//Add this code in functions.php file
// Redirect 404 not found page to home page
if( !function_exists('redirect_404_to_homepage') ){

    add_action( 'template_redirect', 'redirect_404_to_homepage' );

    function redirect_404_to_homepage(){
       if(is_404()):
            wp_safe_redirect( home_url('/') );
            exit;
        endif;
    }
}


-----------------------------------
// Register Custom Post Type: Project
function create_projects_post_type() {
    $labels = array(
        'name' => 'Projects',
        'singular_name' => 'Project',
        'menu_name' => 'Projects',
        'name_admin_bar' => 'Project',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Project',
        'edit_item' => 'Edit Project',
        'new_item' => 'New Project',
        'view_item' => 'View Project',
        'all_items' => 'All Projects',
        'search_items' => 'Search Projects',
        'not_found' => 'No projects found.',
        'not_found_in_trash' => 'No projects found in Trash.'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'projects'),
        'show_in_rest' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies' => array('project_category'), // attach custom taxonomy
    );

    register_post_type('project', $args);
}
add_action('init', 'create_projects_post_type');

// Register Custom Taxonomy: Project Categories
function create_project_taxonomy() {
    register_taxonomy(
        'project_category',
        'project',
        array(
            'label' => 'Project Categories',
            'rewrite' => array('slug' => 'project-category'),
            'hierarchical' => true,
            'show_in_rest' => true
        )
    );
}
add_action('init', 'create_project_taxonomy');

function add_elementor_support_for_projects() {
    add_post_type_support( 'project', 'elementor' );
}
add_action( 'init', 'add_elementor_support_for_projects' );
----------------------------------------------------------------------
