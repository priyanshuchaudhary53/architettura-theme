<?php
/**
 * Includes helpers function used by the theme
 * 
 * @package Architettura WordPress theme
 */

/**
 * Minify CSS
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_minify_css' ) ) {

	function architettura_minify_css( $css = '' ) {

		// Return if no CSS
		if ( ! $css ) {
			return;
		}

		// Normalize whitespace
		$css = preg_replace( '/\s+/', ' ', $css );

		// Remove ; before }
		$css = preg_replace( '/;(?=\s*})/', '', $css );

		// Remove space after , : ; { } */ >
		$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

		// Remove space before , ; { }
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

		// Strips leading 0 on decimal values (converts 0.5px into .5px)
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

		// Strips units if value is 0 (converts 0px to 0)
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		// Trim
		$css = trim( $css );

		// Return minified CSS
		return $css;
	}
}

/**
 * Filter the excerpt `read more` string.
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_excerpt_more' ) ) {

	function architettura_excerpt_more() {
		
		return '...';
	}

	add_filter( 'excerpt_more', 'architettura_excerpt_more' );
}

/**
 * Filter the excerpt length
 * 
 */
if ( ! function_exists( 'architettura_excerpt_length' ) ) {

	function architettura_excerpt_length( $length ) {
		
		if ( is_search() ) {
			return 30;
		} 
		else {
			
			if ( 'grid' == get_theme_mod( 'architettura_blog_style', 'large-image' ) ) {
				return 40;
			}
			else {
				return 55;
			}
		}
	}

	add_filter( 'excerpt_length', 'architettura_excerpt_length', 999 );
}

/**
 * Display categories without the link
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_category_without_link' ) ) {

	function architettura_category_without_link() {

		if ( get_post_type() == 'post' ) {

			$cat_count = count( get_the_terms( $post->ID, 'category' ) );
			$i = 0;
			foreach ( ( get_the_category( $post->ID ) ) as $cat ) {
				
				$i = $i + 1;
				while ( $i < $cat_count ) {

					echo $cat->name . ', ';
					break;
				}
			}
			echo $cat->name;
		}
	}
}

/**
 * Create custom post pagination
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_pagination' ) ) {

	function architettura_pagination( $pages = '', $range = 1 ) {

		$showitems = ( $range * 2 ) + 1;

		global $paged;
		if ( empty( $paged ) ) $paged = 1;

		if ( $pages == '' ) {
			
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {

				$pages = 1;
			}
		}

		if ( $pages != 1 ) {

			echo '<ul class="styled-pagination">';
			
			if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) echo '<li><a href="' . get_pagenum_link( 1 ) . '"><span class="fa fa-angle-double-left"></span></a></li>';
			if( $paged > 1 ) echo '<li><a href="' . get_pagenum_link( $paged - 1 ) . '"><span class="fa fa-angle-left"></span></a></li>';

			for ( $i = 1; $i <= $pages; $i++ ) {

				if ( $pages != 1 && ( ! ( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {

					echo ( $paged == $i ) ? '<li><a href="' . get_pagenum_link($i) . '" class="active">' . $i . '</a></li>' : '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
				}
			}

			if ( $paged < $pages ) echo '<li><a href="' . get_pagenum_link( $paged + 1 ) . '"><span class="fa fa-angle-right"></span></a></li>';
			if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) echo '<li><a href="' . get_pagenum_link( $pages ) . '"><span class="fa fa-angle-double-right"></span></a></li>';
			
			echo '</ul>';

		}
	}
}

/**
 * Display numbers of comments
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_comments_number' ) ) {

	function architettura_comments_number() {
		$count = get_comments_number();
		if ( $count == 1 ) {
			echo 'Comment: ' . $count;
		} else {
			echo 'Comments: ' . $count;
		}
	}

	add_action( 'architettura_comments_count', 'architettura_comments_number' );
}

/**
 * Comments
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_comment' ) ) {

	function architettura_comment( $comment, $args, $depth ) {
		
		global $post;
		?>

		<li id="comment-<?php comment_ID(); ?>" class="comment-container">
			
			<div <?php comment_class( 'comment-body' ); ?>>

				<div class="author-thumbnail"><?php echo get_avatar( $comment, '150' ); ?></div>

				<div class="comment-inner">
					<span class="comment-link"><?php printf( '%s ', sprintf( '%s', get_comment_author_link() ) ); ?></span>
					<div class="comment-text">
						<?php 
						
						if ( '0' == $comment->comment_approved ) :
							echo '<p class="comment-awaiting">Your comment is awaiting moderation.</p>';
						endif;
						comment_text(); 
						
						?>
					</div>
					<span class="comment-meta">
						<span class="comment-date"><?php comment_date( 'j M Y' ); ?></span>
						<span class="comment-reply">
							<?php
								comment_reply_link(
									array_merge(
										$args,
										array(
											'depth'     => $depth,
											'max_depth' => $args['max_depth'],
										)
									)
								);
							?>
						</span>
						<span class="comment-edit"><?php edit_comment_link( 'edit' ); ?></span>
					</span>
				</div>

			</div>
		<?php
	}
}

/**
 * Check `Classic` Style Header Selected
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_classic_header_selected' ) ) {
	
	function architettura_classic_header_selected( $control ) {
		
		return ( 'classic' == $control->manager->get_setting( 'architettura_header_style' )->value() );
	}

}

/**
 * Check `Modern` Style Header Selected
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_modern_header_selected' ) ) {
	
	function architettura_modern_header_selected( $control ) {
		
		return ( 'classic' !== $control->manager->get_setting( 'architettura_header_style' )->value() );
	}
}

/**
 * Display Topbar Icon
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_topbar_icon_template' ) ) {

	function architettura_topbar_icon_template() {
		if ( 'no-icon' == get_theme_mod( 'architettura_header_topbar_icon', 'no-icon' ) ) {
			return;
		} else { 
			$class_suffix = get_theme_mod( 'architettura_header_topbar_icon' ); ?>
			<span class="icon flaticon-<?php echo $class_suffix; ?>"></span>
		<?php }
	}

	add_action( 'architettura_topbar_icon', 'architettura_topbar_icon_template' );
}

/**
 * Display header logo
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_header_logo_template' ) ) {

	function architettura_header_logo_template() { ?>
		
		<div class="logo-outer">
            <div class="logo">
				<a href="<?php echo get_site_url(); ?>">
					<?php if ( get_theme_mod( 'architettura_header_logo_image' ) ) : ?>
						<img src="<?php echo wp_get_attachment_url( get_theme_mod('architettura_header_logo_image') ); ?>" alt="" title="">
					<?php else: 
					echo get_bloginfo( 'name' );
					endif; ?>
				</a>
			</div>
    	</div>

	<?php }

	add_action( 'architettura_header_logo', 'architettura_header_logo_template' );
}

/**
 * Display header menu
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_main_menu_walker' ) ) {

	function architettura_main_menu_walker() {

		$main_menu = wp_nav_menu(
			array(
				'theme_location'    => 'main_menu',
				'depth'				=> 3,
				'container'         => 'div',
				'container_id'      => 'navbarSupportedContent',
				'container_class'   => 'collapse navbar-collapse clearfix',
				'items_wrap'        => '<ul class="navigation clearfix">%3$s</ul>',
				'fallback_cb'		=> 'architettura_main_menu_fallback',
				'echo'				=> false,
				'walker'            => new Architettura_Custom_Menu_Walker(),
			)
		);

		echo $main_menu;
	}

	add_action( 'architettura_main_menu', 'architettura_main_menu_walker' );
}

/**
 * Header Search Icon
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_header_search_template' ) ) {

	function architettura_header_search_template() {

		if ( 'hidden' == get_theme_mod( 'architettura_header_search_icon','show' ) ) {
			return;
		} else { ?>
			<div class="outer-box clearfix">
				<div class="search-box-btn"><span class="icon flaticon-magnifying-glass-1"></span></div>
			</div>
		<?php }
	}

	add_action( 'architettura_header_search', 'architettura_header_search_template' );
}

/**
 * Main menu fallback
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_main_menu_fallback' ) ) {

	function architettura_main_menu_fallback( $args ) { 
		
		$output = '';

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$output .= '<div id="navbarSupportedContent" class="collapse navbar-collapse clearfix">';
		$output .= '<ul class="navigation clearfix">';
		$output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
		$output .= '</ul>';
		$output .= '</li>';

		if ( $echo ) {
			echo $output;
		}
		
		return $output;
	}
}

/**
 * Display Mobile Menu Social Link
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_mobile_social_link_template' ) ) {

	function architettura_mobile_social_link_template() {

		if ( get_theme_mod( 'architettura_header_mobile_social_menu', true ) ) {
			?>

			<div class="social-links">
                <ul class="clearfix">
					<?php
					if ( get_theme_mod( 'architettura_social_twitter' ) ) {
						echo '<li><a href="' . get_theme_mod( 'architettura_social_twitter' ) . '"><span class="fab fa-twitter"></span></a></li>';
					}
					if ( get_theme_mod( 'architettura_social_facebook' ) ) {
						echo '<li><a href="' . get_theme_mod( 'architettura_social_facebook' ) . '"><span class="fab fa-facebook-square"></span></a></li>';
					}
					if ( get_theme_mod( 'architettura_social_pinterest' ) ) {
						echo '<li><a href="' . get_theme_mod( 'architettura_social_pinterest' ) . '"><span class="fab fa-pinterest-p"></span></a></li>';
					}
					if ( get_theme_mod( 'architettura_social_instagram' ) ) {
						echo '<li><a href="' . get_theme_mod( 'architettura_social_instagram' ) . '"><span class="fab fa-instagram"></span></a></li>';
					}
					if ( get_theme_mod( 'architettura_social_youtube' ) ) {
						echo '<li><a href="' . get_theme_mod( 'architettura_social_youtube' ) . '"><span class="fab fa-youtube"></span></a></li>';
					}
					?>
                </ul>
            </div>

			<?php
		}
	}

	add_action( 'architettura_mobile_social_link', 'architettura_mobile_social_link_template' );
}

/**
 * Store current post ID
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_post_id' ) ) {

    function architettura_post_id() {

        // Default value.
		$id = '';

		// If singular get_the_ID.
		if ( is_singular() ) {
			$id = get_the_ID();
		}

        // Posts page.
		elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
			$id = $page_for_posts;
		}

        // Apply filters.
		$id = apply_filters( 'architettura_post_id', $id );

		// Sanitize.
		$id = $id ? $id : '';

		// Return ID.
		return $id;
    }
}

/**
 * Return the title
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_has_page_title' ) ) {

    
    function architettura_has_page_title() {

        // Default title is null
		$title = null;

		// Get post ID
		$post_id = architettura_post_id();

        // Homepage - display blog description if not a static page
		if ( is_front_page() && ! is_singular( 'page' ) ) {

			if ( get_bloginfo( 'description' ) ) {
				$title = get_bloginfo( 'description' );
			} else {
				$title = 'Recent Posts';
			}

			// Homepage posts page
		} elseif ( is_home() && ! is_singular( 'page' ) ) {

			$title = get_the_title( get_option( 'page_for_posts', true ) );

		}

		// Search needs to go before archives
		elseif ( is_search() ) {
			global $wp_query;
			$title = $wp_query->found_posts . ' Search Results Found';
		}

        // Archives
		elseif ( is_archive() ) {

			// Author
			if ( is_author() ) {
				$title = get_the_archive_title();
			}

			// Post Type archive title
			elseif ( is_post_type_archive() ) {
				$title = post_type_archive_title( '', false );
			}

			// Daily archive title
			elseif ( is_day() ) {
				$title = sprintf( 'Daily Archives: %s', get_the_date() );
			}

			// Monthly archive title
			elseif ( is_month() ) {
				$title = sprintf( 'Monthly Archives: %s', get_the_date( 'F Y' ) );
			}

			// Yearly archive title
			elseif ( is_year() ) {
				$title = sprintf( 'Yearly Archives: %s', get_the_date( 'Y' ) );
			}

			// Categories/Tags/Other
			else {

				// Get term title
				$title = single_term_title( '', false );

				// Fix for plugins that are archives but use pages
				if ( ! $title ) {
					global $post;
					$title = get_the_title( $post_id );
				}
			}
		} // End is archive check

        // 404 Page
		elseif ( is_404() ) {

			$title = '404: Page Not Found';

		}

        // Anything else with a post_id defined
		elseif ( $post_id ) {

			// Single Pages
			if ( is_singular( 'page' ) || is_singular( 'attachment' ) ) {
				$title = get_the_title( $post_id );
			}

			// Single blog posts
			elseif ( is_singular( 'post' ) ) {

				if ( 'post-title' == get_theme_mod( 'architettura_blog_single_page_header_title', 'blog' ) ) {
					$title = get_the_title();
				} else {
					$title = 'Blog';
				}
			}

			// Other posts
			else {

				$title = get_the_title( $post_id );

			}
		}

		// Last check if title is empty
		$title = $title ? $title : get_the_title();

		// Apply filters and return title
		return apply_filters( 'architettura_has_page_title', $title );
    }
}

/**
 * Page header template
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_page_header_template' ) ) {

    function architettura_page_header_template () {

        get_template_part( 'partials/page-header' );

    }

    add_action( 'architettura_page_header', 'architettura_page_header_template' );
}

/**
 * Checks if the page header is enabled
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_has_page_header' ) ) {

    function architettura_has_page_header() {

        // Define vars
        $return = true;

        // Check if page header
		if ( 'hidden' == get_theme_mod( 'architettura_page_title_visibility', 'show' ) ) {

			$return = false;
		}

        // Apply filters and return
        return apply_filters( 'architettura_has_page_header', $return );
    }
}

/**
 * Checks if the sidebar is enabled.
 * 
 */
if ( ! function_exists( 'architettura_has_sidebar' ) ) {

	function architettura_has_sidebar() {

		// Define vars
        $return = true;

		// Singular Page
		if ( is_page() ) {
			if ( 'full-width' == get_theme_mod( 'architettura_page_layout' ) ) {
				$return = false;
			}
		}

		// Home
		elseif ( is_home()
			|| is_category()
			|| is_tag()
			|| is_date()
			|| is_author() ) {
				if ( 'full-width' == get_theme_mod( 'architettura_blog_archive_layout' ) ) {
					$return = false;
				}
		}

		// Singular Post
		elseif ( is_singular( 'post' ) ) {
			if ( 'full-width' == get_theme_mod( 'architettura_blog_single_layout' ) ) {
				$return = false;
			}
		}

		// Search Page
		elseif ( is_search() ) {
			if ( 'full-width' == get_theme_mod( 'architettura_search_layout' ) ) {
				$return = false;
			}
		}

		// 404 page
		elseif ( is_404() ) {
			$return = false;
		}

		// All else
		else {
			return true;
		}

		// Apply filters and return
		return apply_filters( 'architettura_has_sidebar', $return );

	}
}

/**
 * Sidebar order
 * 
 */
if ( ! function_exists( 'architettura_sidebar_order' ) ) {

	function architettura_sidebar_order() {

		// Define vars
		$class = '';

		// Singular Page
		if ( is_page() ) {
			if ( 'left-sidebar' == get_theme_mod( 'architettura_page_sidebar_order' ) ) {
				$class = ' order-first';
			}
		}

		// Home
		elseif ( is_home()
			|| is_category()
			|| is_tag()
			|| is_date()
			|| is_author() ) {
				if ( 'left-sidebar' == get_theme_mod( 'architettura_blog_sidebar_order' ) ) {
					$class = ' order-first';
				}
		}

		// Singular Post
		elseif ( is_singular( 'post' ) ) {
			if ( 'left-sidebar' == get_theme_mod( 'architettura_blog_single_sidebar_order' ) ) {
				$class = ' order-first';
			}
		}

		// Search Page
		elseif ( is_search() ) {
			if ( 'left-sidebar' == get_theme_mod( 'architettura_search_sidebar_order' ) ) {
				$class = ' order-first';
			}
		}

		// All else
		else {
			$class = '';
		}

		// Apply filters and return
		return apply_filters( 'architettura_sidebar_order', $class );

	}
}

/**
 * Footer copyright text
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_footer_copyright_template' ) ) {

	function architettura_footer_copyright_template() {

		if ( ! get_theme_mod( 'architettura_footer_bottom_enable', true ) ) {
			return;
		} ?>
		<div class="footer-bottom clearfix">
			<div class="copyright">
				<?php if ( 'Architettura Theme by Priyanshu' == get_theme_mod( 'architettura_footer_copyright', 'Architettura Theme by Priyanshu' ) ) : ?>
					Architettura Theme by <a href="https://github.com/priyanshuchaudhary53/">Priyanshu</a>
				<?php else: echo get_theme_mod( 'architettura_footer_copyright' ); endif; ?>
			</div>
		</div>
	<?php }

	add_action( 'architettura_footer_copyright', 'architettura_footer_copyright_template' );
}

/**
 * Scroll to top
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_scroll_to_top_template' ) ) {

	function architettura_scroll_to_top_template(){

		if ( ! get_theme_mod( 'architettura_scroll_to_top', true ) ){
			return;
		} 
		$class_suffix = get_theme_mod( 'architettura_scroll_to_top_icon', 'angle-up' ); ?>
		<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-<?php echo $class_suffix; ?>"></span></div>
	<?php }

	add_action( 'architettura_scroll_to_top', 'architettura_scroll_to_top_template' );
}

/**
 * Search Popup
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'architettura_search_popup_template' ) ) {

	function architettura_search_popup_template() {

		if ( 'hidden' == get_theme_mod( 'architettura_header_search_icon' ) ) {
			return;
		} ?>
		<div id="search-popup" class="search-popup">
			<div class="close-search theme-btn"><span class="flaticon-cancel"></span></div>
			<div class="popup-inner">
				<div class="overlay-layer"></div>
				<div class="search-form">
					<form method="get" action="<?php echo get_site_url(); ?>" role="search">
						<div class="form-group">
							<fieldset>
								<input type="search" class="form-control" name="s" value="" placeholder="Search Here" required >
								<input type="submit" value="Search Now!" class="theme-btn">
							</fieldset>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php }

	add_action( 'architettura_search_popup', 'architettura_search_popup_template' );
}

/**
 * 
 * [[ Before and After Templates ]]
 * 
 */

 /**
 * Before container template
 * 
 */
if ( ! function_exists( 'architettura_before_container_template' ) ) {

	function architettura_before_container_template() {

		echo '<div class="sidebar-page-container">';
		
	}

	add_action( 'architettura_before_container', 'architettura_before_container_template' );
}

/**
 * After container template
 * 
 */
if ( ! function_exists( 'architettura_after_container_template' ) ) {

	function architettura_after_container_template() {

		echo '</div>';
	}

	add_action( 'architettura_after_container', 'architettura_after_container_template' );
}

/**
 * Before container inner template
 * 
 */
if ( ! function_exists( 'architettura_before_container_inner_template' ) ) {

	function architettura_before_container_inner_template() {

		$class = '';
		if ( architettura_has_sidebar() ) {
			$class = ' col-xl-9 col-lg-8 col-md-12 col-sm-12';
		}
		elseif ( is_404() ) {
			$class = ' error-404-wrap';
		}
		echo '<div class="content-side' . $class . '">' ;
	}

	add_action( 'architettura_before_container_inner', 'architettura_before_container_inner_template' );
}

/**
 * After container inner template
 * 
 */
if ( ! function_exists( 'architettura_after_container_inner_template' ) ) {

	function architettura_after_container_inner_template() {

		echo '</div>';
	}

	add_action( 'architettura_after_container_inner', 'architettura_after_container_inner_template' );
}

/**
 * Before loop template
 * 
 */
if ( ! function_exists( 'architettura_before_loop_template' ) ) {

	function architettura_before_loop_template() {

		$class = '';
		
		if ( architettura_has_sidebar() ) {

			// Singular Page
			if ( is_page() ) {
				if ( 'left-sidebar' == get_theme_mod( 'architettura_page_sidebar_order' ) ) {
					$class = ' padding-left';
				} else {
					$class = ' padding-right';
				}
			}

			// Home
			elseif ( is_home()
				|| is_category()
				|| is_tag()
				|| is_date()
				|| is_author() ) {
					if ( 'left-sidebar' == get_theme_mod( 'architettura_blog_sidebar_order' ) ) {
						$class = ' padding-left';
					} else {
						$class = ' padding-right';
					}
			}

			// Singular Post
			elseif ( is_singular( 'post' ) ) {
				if ( 'left-sidebar' == get_theme_mod( 'architettura_blog_single_sidebar_order' ) ) {
					$class = ' padding-left';
				} else {
					$class = ' padding-right';
				}
			}

			// Search page
			elseif ( is_search() ) {
				if ( 'left-sidebar' == get_theme_mod( 'architettura_search_sidebar_order' ) ) {
					$class = ' padding-left';
				} else {
					$class = ' padding-right';
				}
			}

			// All else
			else {
				$class = ' padding-right';
			}
		}

		if ( is_home() || is_archive() ) {
			if ( 'large-image' == get_theme_mod( 'architettura_blog_style', 'large-image' ) ) {

				echo '<div class="blog-classic' . $class . '">';
			} else {

				echo '<div class="blog-classic' . $class . '">';
				echo '<div class="row">';
			}
		}
		elseif ( is_search() ) {
			echo '<div class="blog-classic' . $class . '">';
		}
		elseif ( is_singular( 'page' ) || is_single() ) {
			echo '<div class="blog-single' . $class . '">';
		}
		else {
			echo '';
		}
	}

	add_action( 'architettura_before_loop', 'architettura_before_loop_template' );
}

/**
 * After loop template
 * 
 */
if ( ! function_exists( 'architettura_after_loop_template' ) ) {

	function architettura_after_loop_template() {

		if ( is_home() || is_archive() ) {
			if ( 'large-image' == get_theme_mod( 'architettura_blog_style', 'large-image' ) ) {

				echo '</div>';
			} else {

				echo '</div>';
				echo '</div>';
			}
		}
		elseif ( is_search() ) {
			echo '</div>';
		}
		elseif ( is_singular( 'page' ) || is_single() ) {
			echo '</div>';
		}
		else {
			echo '';
		}
	}

	add_action( 'architettura_after_loop', 'architettura_after_loop_template' );
}

/**
 * Before singular content template
 * 
 */
if ( ! function_exists( 'architettura_before_singular_content_template' ) ) {

	function architettura_before_singular_content_template() {

		echo '<div class="lower-box">';
	}

	add_action( 'architettura_before_singular_content', 'architettura_before_singular_content_template' );
}

/**
 * After singular content template
 * 
 */
if ( ! function_exists( 'architettura_after_singular_content_template' ) ) {

	function architettura_after_singular_content_template() {

		echo '</div>';
	}

	add_action( 'architettura_after_singular_content', 'architettura_after_singular_content_template' );
}

/**
 * Before pagination template
 * 
 */
if ( ! function_exists( 'architettura_before_pagination_template' ) ) {

	function architettura_before_pagination_template() {

		$class = '';
		
		if ( architettura_has_sidebar() ) {

			if ( is_home()
				|| is_category()
				|| is_tag()
				|| is_date()
				|| is_author() ) {
					if ( 'left-sidebar' == get_theme_mod( 'architettura_blog_sidebar_order' ) ) {
						$class = ' padding-left';
					} 
			} elseif ( is_search() ) {
				if ( 'left-sidebar' == get_theme_mod( 'architettura_search_sidebar_order' ) ) {
					$class = ' padding-left';
				}
			}

			// All else
			else {
				$class = ' padding-right';
			}
		}

		echo '<div class="pagination-container' . $class . '">';
	}

	add_action( 'architettura_before_pagination', 'architettura_before_pagination_template' );
}

/**
 * After pagination template
 * 
 */
if ( ! function_exists( 'architettura_after_pagination_template' ) ) {

	function architettura_after_pagination_template() {

		echo '</div>';
	}

	add_action( 'architettura_after_pagination', 'architettura_after_pagination_template' );
}


/**
 * Before sidebar template
 * 
 */
if ( ! function_exists( 'architettura_before_sidebar_template' ) ) {

	function architettura_before_sidebar_template() {

		$class = architettura_sidebar_order();
		echo '<div class="sidebar-side col-xl-3 col-lg-4 col-md-12 col-sm-12'. $class .'">';
	}

	add_action( 'architettura_before_sidebar', 'architettura_before_sidebar_template' );
}

/**
 * After sidebar template
 * 
 */
if ( ! function_exists( 'architettura_after_sidebar_template' ) ) {

	function architettura_after_sidebar_template() {

		echo '</div>';
	}

	add_action( 'architettura_after_sidebar', 'architettura_after_sidebar_template' );
}