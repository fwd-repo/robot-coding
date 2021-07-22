<?php get_header(); 
	while(have_posts()) {
		the_post();
?>

		<h2 class="page-heading"><?php the_title(); ?></h2>
		<div id="post-container">
			<section id="blogpost">
				<div class="card">
					<div class="card-meta-blogpost">
						Posted by <?php the_author(); ?> on <?php the_time('F j, Y') ?> in <a href="#"><?php echo get_the_category_list(','); ?></a>
					</div>
					<div class="card-image">
						<img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="Card Image">
					</div>
					<div class="card-description">
						<?php the_content(); ?>
					</div>
				</div>
				<div id="comments-section">
					
					<?php comment_form();

					$comments_number = get_comments_number();
					if($comments_number != 0) {

					?>

					<div class="comments">
						<h3>What others say</h3>
						<ol class="all-comments">
							<?php
							$comments = get_comments(array(
								'post_id' => $post->ID,
								'status' => 'approve'
							));
							wp_list_comments(array(
								'per_page' => 15
							), $comments);
							?>
						</ol>
					</div>
					<?php
					}
					?>
				</div>
			</section>

		<?php } ?>

			<aside id="sidebar">
				<h3>Sidebar Heading</h3>
				<p>Sidebar Content</p>
			</aside>
		</div>

		<?php get_footer(); ?>