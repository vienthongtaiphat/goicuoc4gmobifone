<?php

$general_settings = get_field('_theme_general_settings', 'option');
$banner           = $general_settings['_vina_banner'];

$section_title    = $banner['_title'];
$section_desc     = $banner['_desc'];
$banner_text_1    = $banner['_text_1'];
$banner_text_2    = $banner['_text_2'];
$banner_text_list = $banner['_text_list'];
$background       = $banner['_background'];

?>

<section class="content-wrapper vina-content-wrapper">
	<div class="container">
		<h2 class="section-title"><?= $section_title ?></h2>
	</div>
	<div class="user-manual-wrapper" style="background-image: url(<?= wp_get_attachment_image_url($background, 'full') ?>)">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-7">
					<div class="entry-content">
						<div class="desc">
							<?= wpautop($section_desc) ?>
						</div>
						<div class="user-manual">
							<h3 class="title"><?= $banner_text_1 ?></h3>
							<?php if (!empty($banner_text_list)):
								foreach ($banner_text_list as $text): ?>
									<p><?= $text['_text'] ?></p>
								<?php endforeach;
							endif; ?>
							<h4 class="subtitle"><?= $banner_text_2 ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
