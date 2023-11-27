<?php

$general_settings = get_field('_theme_general_settings', 'option');
$vina_packages    = $general_settings['_vina_packages'];

if (!empty($vina_packages)):
	foreach ($vina_packages as $package):
		if ($package['_package_type'] == '_package_reasonable_price'):
			$meta_query   = [
				'key'     => '_package_price',
				'value'   => 100000,
				'compare' => '<=',
			];
			$search_query = '?s=&cheap=yes&post_type=package&mno=vinaphone';
		else:
			$meta_query   = [
				'relation' => 'OR',
				[
					'key'     => $package['_package_type'],
					'value'   => 'yes',
					'compare' => '=',
				],
				[
					'key'     => $package['_package_type'],
					'value'   => "1",
					'compare' => '=',
				],
			];
			$search_query = '?s=&' . substr($package['_package_type'], 1) . '=yes&post_type=package&mno=vinaphone';
		endif;

		$args = [
			'post_type'      => 'package',
			'posts_per_page' => 6,
			'meta_query'     => [
				'relation' => 'AND',
				$meta_query,
				[
					'key'     => '_mno',
					'value'   => 'vinaphone',
					'compare' => '=',
				]
			]
		];

		$loop = new WP_Query($args);

		if ($loop->have_posts()): ?>
			<section class="package-wrapper vina-package-wrapper">
				<div class="container">
					<h2 class="section-title"><?= $package['_title'] ?></h2>
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
	endforeach;
endif;
