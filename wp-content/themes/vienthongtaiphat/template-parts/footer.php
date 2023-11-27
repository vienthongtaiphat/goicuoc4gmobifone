<?php

$footer_settings = get_field('_theme_footer_settings', 'option');
$social          = $footer_settings['_social'];
$contact         = $footer_settings['_contact'];
$address         = $footer_settings['_address'];
$contact_info    = $contact['_contact_info'];

?>

<div class="footer">
	<div class="container">
		<div class="row footer-widgets">
			<div class="col-lg-3 footer-widget footer-widget-1">
				<div class="logo">
					<?= wp_get_attachment_image($footer_settings['_logo']) ?>
					<div class="desc">
						<?= wpautop($footer_settings['_desc']) ?>
					</div>
				</div>
				<?php if ($social): ?>
					<div class="social">
						<?php foreach ($social as $social_item): ?>
							<a href="<?= $social_item['_url'] ?>" target="_blank">
								<?= wp_get_attachment_image($social_item['_icon']) ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-4 footer-widget footer-widget-2">
				<?php if ($contact_info): ?>
					<h6 class="widget-title"><?= $contact['_title'] ?></h6>
					<?php foreach ($contact_info as $contact_info_item): ?>
						<p><?= $contact_info_item['_text'] ?></p>
					<?php endforeach;
				endif; ?>
			</div>
			<div class="col-lg-5 footer-widget footer-widget-3">
				<?php if ($address['_address']): ?>
					<h6 class="widget-title"><?= $address['_title'] ?></h6>
					<?php foreach ($address['_address'] as $address_item): ?>
						<p><strong><?= $address_item['_title'] ?></strong> <?= $address_item['_content'] ?></p>
					<?php endforeach;
				endif; ?>
			</div>
		</div>
	</div>
</div>
