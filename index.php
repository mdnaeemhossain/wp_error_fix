/* wp memory extend 
Add to wp-config.php: */

define( 'WP_MAX_MEMORY_LIMIT' , '512M' );
define( 'WP_MEMORY_LIMIT' , '512M' );

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
