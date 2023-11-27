<?php

$slider_count = get_option('options__home_slider', 0);

if ($slider_count > 0): ?>
	<section class="slider-wrapper">
		<div class="container">
			<div class="primary-slick-slider-wrapper">
				<div class="primary-slick-slider">
					<?php for ($i = 0; $i < $slider_count; $i ++): ?>
						<div class="slide-item-wrapper">
							<div class="slide-item">
								<a href="<?= get_option("options__home_slider_{$i}__url", "") ?>">
									<?= wp_get_attachment_image(get_option("options__home_slider_{$i}__img", ""), 'full') ?>
								</a>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;
