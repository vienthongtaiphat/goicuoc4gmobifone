<?php

$section_title     = get_option('options__home_banner__title', '');
$section_desc      = get_option('options__home_banner__desc', '');
$banner_text_1     = get_option('options__home_banner__text_1', '');
$banner_text_2     = get_option('options__home_banner__text_2', '');
$banner_text_count = get_option('options__home_banner__text_list', 0);
$background        = get_option('options__home_banner__background', 0);

?>

<section class="content-wrapper">
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
							<?php if ($banner_text_count > 0):
								for ($i = 0; $i < $banner_text_count; $i ++):?>
									<p><?= get_option("options__home_banner__text_list_{$i}__text", "") ?></p>
								<?php endfor;
							endif; ?>
							<h4 class="subtitle"><?= $banner_text_2 ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
