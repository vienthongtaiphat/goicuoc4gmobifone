<?php

$args = [
	'post_type'      => 'package',
	'posts_per_page' => 6,
	'meta_query'     => [
		'relation' => 'AND',
		[
			'key'     => '_package_recommend',
			'value'   => 'yes',
			'compare' => '=',
		],
	]
];

$loop = new WP_Query($args);

if ($loop->have_posts()): ?>

	<section class="package-wrapper package-recommend-wrapper">
		<div class="container">
			<h2 class="section-title">Gói cước đề xuất theo thuê bao</h2>
			<div class="row">
				<?php while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="col-md-6">
						<?php get_template_part('template-parts/content/content-package') ?>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		</div>
	</section>

<?php endif;
