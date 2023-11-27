<?php

$phone = get_option('options__theme_general_settings__fab__call', '');
$zalo  = get_option('options__theme_general_settings__fab__zalo', '');

?>

<div class="fab-wrap">
	<a href="<?= get_permalink('929') ?>" class="fab-btn fab-cashback">
		<img src="<?= get_theme_file_uri('assets/images/icon-cashback.png') ?>" alt="Tra cứu hoàn tiền">
	</a>
	<a href="tel:<?= $phone ?>" class="fab-btn fab-call"><i class="fa-solid fa-phone"></i></a>
</div>
