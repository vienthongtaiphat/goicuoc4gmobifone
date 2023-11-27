<?php

$banner_counts = get_post_meta(get_the_ID(), '_about_banners', true);

?>

<section class="about-wrapper">
	<div class="container">
		<h1 class="entry-title"><?php the_title() ?></h1>
		<div class="entry-content">
			<?php the_content() ?>
		</div>

		<?php if ($banner_counts > 0): ?>
			<div class="banners-wrapper">
				<div class="row">
					<?php for ($i = 0; $i < $banner_counts; $i ++): ?>
						<div class="col-md-6">
							<div class="banner-item" style="background-image: url(<?= wp_get_attachment_image_url(get_post_meta(get_the_ID(), "_about_banners_{$i}__img", true), 'large') ?>)">
								<div class="title-wrapper">
									<h4 class="banner-title"><?= get_post_meta(get_the_ID(), "_about_banners_{$i}__title", true) ?></h4>
								</div>
								<a href="<?= get_post_meta(get_the_ID(), "_about_banners_{$i}__url", true) ?>">Khám phá ngay</a>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
