<?php
/**
 * Displays header/footer for previous/next article
 *
 * @param int  $post_id post ID of the current article
 * @param bool $next    optional - toggles title/link display to the next article,
 *                      default is current article title with link to the previous article.
 *
 * @return void
 */
function _s_pageloop( $post_id, $next = false ) {

	$next_id   = $prev_id = null;

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations['why_scale'] ) ) {
		$menu = wp_get_nav_menu_object( $locations['why_scale'] );

		$menu_items = wp_get_nav_menu_items( $menu->term_id );

		$menu_ids = array();
		foreach ( $menu_items as $menu_item ) {
			$menu_ids[] = $menu_item->object_id;
		}

		if ( in_array( $post_id, $menu_ids ) ) {
			$current = array_search( $post_id, $menu_ids );
			$prev_id = $current > 0 ? (int) $menu_ids[ $current - 1 ] : null;
			$next_id = $current < ( count( $menu_ids ) - 1 ) ? (int) $menu_ids[ $current + 1 ] : null;
			/**
			 * Return the resources page if we are on
			 * the page of the last item in the menu
			 */
			if ( $next && $next_id === null && $current == ( count( $menu_ids ) - 1 ) ) {
				$resources_page = get_page_by_path( 'resources' );
				if ( $resources_page !== null ) {
					_s_pageloop_by_id( $resources_page->ID );

					return;
				}
			}
		} else {
			/**
			 * bail if current post ID is not in the why_scale menu
			 * and we are printing a footer
			 */
			if ( $next ) {
				return;
			}
		}

	} else {
		/**
		 * bail if the why_scale menu is not set
		 * and we are printing a footer
		 */
		if ( $next ) {
			return;
		}
	}

	if ( $next && $next_id !== null ):
		$feat_img = get_the_post_thumbnail_url( $next_id, 'full' );
		$style = ( $feat_img !== false ) ? 'style="background-image:url(\'' . $feat_img . '\');"' : '';
		$link  = esc_url( get_permalink( $next_id ) );
		$title = get_the_title( $next_id );
		if ( $next_id !== null && $link !== false ):
			?>
			<a class="pageloop next" <?php echo $style; ?> href="<?php echo $link; ?>" title="<?php echo $title; ?>">
				<div class="circle">
					<span class="icon-angle-down"></span>
				</div>
				<h1 class="title">
					<?php echo $title; ?>
				</h1>
			</a>
			<?php
		else:
			?>
			<div class="pageloop next" <?php echo $style; ?>>
				<?php if ( $next_id !== null && $link !== false ): ?>
					<a class="circle" href="<?php echo $link; ?>" title="<?php echo $title; ?>">
						<span class="icon-angle-down"></span>
					</a>
				<?php endif; ?>
				<a href="<?php echo $link; ?>" class="title" title="<?php echo $title; ?>">
					<h1 class="title">
						<?php echo $title; ?>
					</h1>
				</a>
			</div>
			<?php
		endif;
	elseif ( ! $next ):
		$feat_img = get_the_post_thumbnail_url( $post_id, 'full' );
		$style = ( $feat_img !== false ) ? 'style="background-image:url(\'' . $feat_img . '\');"' : '';
		$link  = get_permalink( $prev_id );
		?>
		<div class="pageloop prev" <?php echo $style; ?>>
			<?php if ( $prev_id !== null && $link !== false ): ?>
				<a class="circle" href="<?php echo $link; ?>" title="<?php echo get_the_title( $prev_id ); ?>">
					<span class="icon-angle-left"></span>
				</a>
			<?php endif; ?>
			<h1 class="title">
				<?php echo get_the_title( $post_id ); ?>
			</h1>
		</div>
		<?php
	endif;
}

function _s_pageloop_by_id( $post_id, $link = true ) {
	$feat_img  = get_the_post_thumbnail_url( $post_id, 'full' );
	$style     = ( $feat_img !== false ) ? 'style="background-image:url(\'' . $feat_img . '\');"' : '';
	$permalink = esc_url( get_permalink( $post_id ) );
	$title     = get_the_title( $post_id );

	if ( $link ):
		?>
		<a class="pageloop next" <?php echo $style; ?> href="<?php echo $permalink; ?>" title="<?php echo $title; ?>">
			<div class="circle">
				<span class="icon-angle-down"></span>
			</div>
			<h1 class="title">
				<?php echo $title; ?>
			</h1>
		</a>
		<?php
	else:
		?>
		<div class="pageloop next" <?php echo $style; ?>>
			<div class="circle">
				<span class="icon-angle-down"></span>
			</div>
			<h1 class="title">
				<?php echo $title; ?>
			</h1>
		</div>
		<?php
	endif;
}