	<?php get_header(); ?>
	
	<div class="row">
		<div class="nine columns">
		
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="row">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="post-header">
							<?php if ( !is_single() ) { ?>
								<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( "Permalink to", "custom" ); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php } else { ?>
								<h3 class="post-title"><?php the_title(); ?></h3>
							<?php } ?>
						</header>
						<aside class="meta-content">
							<p><?php _e( "Written by", "custom" ); ?> <em><?php the_author_posts_link() ?></em> <?php _e( "the","custom") ;?> <em><?php the_time('j F, Y') ?></em>. <?php _e( "Filed as", "custom" ); ?> <em><?php the_category(', '); ?></em> <?php _e( "with", "custom" ); ?> <em><?php comments_popup_link( __( '0 comments', "custom" ), __( '1 comment', "custom" ), __( '% comments', "custom" ) ); ?></em></p>
						</aside>
						<div class="post-content">
							<?php the_content( __( 'Read more →', "custom" ) ); ?>
							<?php wp_link_pages(); ?>
						</div>
					</article>
				</div>
			<?php endwhile; ?>
			
			<div class="row">
				<nav id="custom-pagenavi">
					<?php if ( function_exists( 'bb_pagenavi' ) ) { ?>
						<ul class="pagination">
							<?php bb_pagenavi(); ?>
						</ul>
					<?php } else if ( function_exists( 'wp_pagenavi' ) ) { wp_pagenavi(); } else { ?>
						<div class="alignleft">
							<?php next_posts_link( __( '&laquo; Older entries', "custom" ) ); ?>
						</div>
						<div class="alignright">
							<?php previous_posts_link( __( 'Newer entries &raquo;', "custom" ) ); ?>
						</div>
					<?php } ?>
				</nav>
			
			</div>
		</div>
		
		<div class="three columns">
			<?php get_sidebar(); ?>
		</div>
		
	</div>
	
	<?php get_footer(); ?>