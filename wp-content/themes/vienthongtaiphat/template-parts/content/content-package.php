<?php

$package_name             = get_post_meta(get_the_ID(), '_package_name', true);
$package_price            = get_post_meta(get_the_ID(), '_package_price', true);
$package_refund           = get_post_meta(get_the_ID(), '_package_refund', true);
$package_cycle            = get_post_meta(get_the_ID(), '_package_cycle', true);
$package_preferential_row = get_post_meta(get_the_ID(), '_package_preferential', true);
$register_syntax          = get_option('options__theme_general_settings__syntax__register__syntax', '');
$register_send            = get_option('options__theme_general_settings__syntax__register__send', '');

?>

<div class="package-item" data-package-name="<?= $package_name ?>" data-package-syntax="<?= $register_syntax . " " . $package_name ?>" data-package-send="<?= $register_send ?>">
	<div class="package-header">
		<h4 class="package-name"><?php the_title() ?></h4>
	</div>
	<div class="package-body">
		<div class="package-content">
			<div class="label">Giá gói</div>
			<div class="content">
				<?php if ($package_price > 0): ?>
					<?= number_format($package_price, 0, '.', '.') ?>đ/<?= $package_cycle ?> ngày
				<?php endif; ?>
			</div>
		</div>
		<div class="package-content">
			<div class="label">Cú pháp</div>
			<div class="content">
				<strong><?= $register_syntax . " " . $package_name ?></strong> gửi <strong><?= $register_send ?></strong>
			</div>
		</div>
		<div class="package-content refund">
			<div class="label">Hoàn tiền</div>
			<div class="content">
				<?php if ($package_refund > 0): ?>
					<?= number_format($package_refund, 0, '.', '.') ?>đ
				<?php else: ?>
					0đ
				<?php endif; ?>
			</div>
		</div>
		<div class="package-content package-preferential">
			<div class="label">Ưu đãi</div>
			<div class="content">
				<ul>
					<?php if ($package_preferential_row > 0):
						for ($i = 0; $i < $package_preferential_row; $i ++): ?>
							<li><?= get_post_meta(get_the_ID(), "_package_preferential_{$i}__text", true) ?></li>
						<?php endfor;
					endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="package-footer">
		<div class="row">
			<div class="col-6">
				<?php if (wp_is_mobile()): ?>
					<a href="sms:<?= $register_send ?>&body=<?= $register_syntax . " " . $package_name ?>" class="register-package-mobile package-btn-solid">ĐK qua tin nhắn</a>
				<?php else: ?>
					<a href="javascript:;" class="register-package-desktop package-btn-solid">ĐK qua tin nhắn</a>
				<?php endif; ?>
			</div>
			<div class="col-6">
				<a href="javascript:;" class="register-package-otp package-btn-solid">Đăng ký nhanh</a>
			</div>
			<div class="col-12">
				<a href="<?php the_permalink(); ?>" class="package-btn-outline">Hướng dẫn chi tiết đăng ký</a>
			</div>
		</div>
	</div>
</div>
