<?php

$packages_count = get_option('options__home_packages', 0);

if ($packages_count > 0):
	for ($i = 0; $i < $packages_count; $i ++):

		if (get_option("options__home_packages_{$i}__package_type", "") == '_package_reasonable_price'):
			$meta_query   = [
				'key'     => '_package_price',
				'value'   => 100000,
				'compare' => '<=',
			];
			$search_query = '?s=&cheap=yes&post_type=package&mno=mobifone';
		else:
			$meta_query   = [
				'relation' => 'OR',
				[
					'key'     => get_option("options__home_packages_{$i}__package_type", ""),
					'value'   => 'yes',
					'compare' => '=',
				],
				[
					'key'     => get_option("options__home_packages_{$i}__package_type", ""),
					'value'   => "1",
					'compare' => '=',
				],
			];
			$search_query = '?s=&' . substr(get_option("options__home_packages_{$i}__package_type", ""), 1) . '=yes&post_type=package&mno=mobifone';
		endif;

		$args = [
			'post_type'      => 'package',
			'posts_per_page' => 6,
			'meta_query'     => [
				'relation' => 'AND',
				$meta_query,
				[
					'key'     => '_mno',
					'value'   => 'mobifone',
					'compare' => '=',
				]
			]
		];

		$loop = new WP_Query($args);

		if ($loop->have_posts()): ?>
			<section class="package-wrapper">
				<div class="container">
					<h2 class="section-title"><?= get_option("options__home_packages_{$i}__title", "") ?></h2>
					<div class="row">
						<?php while ($loop->have_posts()) : $loop->the_post(); ?>
							<div class="col-md-6">
								<?php get_template_part('template-parts/content/content-package') ?>
							</div>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</div>
					<div class="package-more">
						<a href="<?= home_url($search_query) ?>" class="more-btn">Xem thêm <i class="fa-solid fa-angles-right"></i></a>
					</div>
				</div>
			</section>
		<?php endif;
	endfor;
endif;
