<?php

$general_settings = get_field('_theme_general_settings', 'option');
$slider           = $general_settings['_vina_slider'];

if (!empty($slider)): ?>
	<section class="slider-wrapper vina-slider-wrapper">
		<div class="container">
			<div class="primary-slick-slider-wrapper">
				<div class="primary-slick-slider">
					<?php foreach ($slider as $slide): ?>
						<div class="slide-item-wrapper">
							<div class="slide-item">
								<a href="<?= $slide['_url'] ?>">
									<?= wp_get_attachment_image($slide['_img'], 'full') ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;
