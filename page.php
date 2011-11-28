	<?php get_header(); ?>
	
	<div class="row">
		<div class="nine columns">
		
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="row">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="post-header">
							<h3 class="post-title"><?php the_title(); ?></h3>
						</header>
						<div class="post-content">
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>
					</article>
				</div>
			<?php endwhile; ?>
			
		</div>
		
		<div class="three columns">
			<?php get_sidebar(); ?>
		</div>
		
	</div>
	<?php get_footer(); ?>