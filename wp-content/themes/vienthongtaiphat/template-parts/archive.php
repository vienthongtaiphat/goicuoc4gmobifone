<section class="blog-wrapper">
	<div class="container">
		<?php if (have_posts()) : ?>
			<div class="row">
				<?php while (have_posts()): the_post(); ?>
					<div class="col-lg-4 col-md-6 col-12">
						<?php get_template_part('template-parts/content/content'); ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">
				Nội dung đang được cập nhật, vui lòng quay lại sau!
			</div>
		<?php endif; ?>
		<div class="pagination-wrapper">
			<?php _n_pagination([
				'prev' => '<',
				'next' => '>',
			]) ?>
		</div>
	</div>
</section>
