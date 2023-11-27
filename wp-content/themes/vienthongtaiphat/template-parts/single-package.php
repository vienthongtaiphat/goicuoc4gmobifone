<?php

$package_name             = get_post_meta(get_the_ID(), '_package_name', true);
$package_price            = get_post_meta(get_the_ID(), '_package_price', true);
$package_refund           = get_post_meta(get_the_ID(), '_package_refund', true);
$package_cycle            = get_post_meta(get_the_ID(), '_package_cycle', true);
$package_preferential_row = get_post_meta(get_the_ID(), '_package_preferential', true);
$register_syntax          = get_option('options__theme_general_settings__syntax__register__syntax', '');
$register_send            = get_option('options__theme_general_settings__syntax__register__send', '');
$cancel_syntax            = get_option('options__theme_general_settings__syntax__cancel__syntax', '');
$cancel_send              = get_option('options__theme_general_settings__syntax__cancel__send', '');

?>

	<section class="single-package-wrapper">
		<div class="container">
			<div class="content-wrapper">
				<div class="row">
					<div class="col-lg-6">
						<div class="featured-image">
							<?php if (has_post_thumbnail()):
								the_post_thumbnail('large');
							else:
								echo "<img src='" . get_theme_file_uri('assets/images/package-thumbnail.jpg') . "'>";
								?>
								<div class="featured-content">
									<p class="package-name"><?= $package_name ?></p>
								</div>
								<div class="mobile-screen">
									<p class="text-2"><?= $register_syntax . " " . $package_name ?></p>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="package-details">
							<?php the_title('<h1 class="entry-title">', '</h1>') ?>
							<ul class="info-list">
								<?php if ($package_price > 0): ?>
									<li><i class="fa-solid fa-dollar-sign"></i> Giá gói: <strong><?= number_format($package_price, 0, '.', '.') ?>đ</strong></li>
								<?php endif; ?>
								<li><i class="fa-solid fa-clock"></i> Thời gian sử dụng: <?= $package_cycle ?> ngày</li>
								<?php if ($package_refund > 0): ?>
									<li><i class="fa-solid fa-gift"></i> Tặng ngay <?= number_format($package_refund, 0, '.', '.') ?>đ vào TK chính trong vòng 48 tiếng kể từ khi đăng ký thành công. Chi tiết LIÊN HỆ HOTLINE 0767.858.858</li>
								<?php endif; ?>
								<li><i class="fa-solid fa-pen"></i> Cú pháp đăng ký: <strong><?= $register_syntax . " " . $package_name ?></strong> gửi <strong><?= $register_send ?></strong></li>
								<li><i class="fa-solid fa-clipboard"></i> <strong>Lưu ý:</strong> Quý khách vui lòng hủy gói cước đang sử dụng và tắt 4G để tránh phát sinh chi phí</li>

								<?php
								$cancel_send_args = explode(', ', $cancel_send);
								if (!empty($cancel_send_args)):
									if (count($cancel_send_args) == 1): ?>
										<li><i class="fa-solid fa-circle-xmark"></i> Cú pháp hủy: <strong><?= $cancel_syntax . " " . $package_name ?></strong> gửi <span><?= $cancel_send_args[0] ?></span></li>
									<?php else:
										foreach ($cancel_send_args as $key => $cancel_send_item): ?>
											<li><i class="fa-solid fa-circle-xmark"></i> Cú pháp hủy cách <?= ++ $key ?>: <strong><?= $cancel_syntax . " " . $package_name ?></strong> gửi <span><?= $cancel_send_item ?></span></li>
										<?php endforeach;
									endif;
								endif;
								?>

								<?php if ($package_preferential_row > 0):
									for ($i = 0; $i < $package_preferential_row; $i ++): ?>
										<li><i class="fa-solid fa-gift"></i> <?= get_post_meta(get_the_ID(), "_package_preferential_{$i}__text", true) ?></li>
									<?php endfor;
								endif; ?>
							</ul>

							<div class="action-buttons">
								<div class="row">
									<div class="col-6">
										<?php if (wp_is_mobile()): ?>
											<a href="sms:<?= $register_send ?>&body=<?= $register_syntax . " " . $package_name ?>" class="action-btn-solid single-package-sms-btn single-package-sms-btn-mobile">ĐK QUA TIN NHẮN</a>
										<?php else: ?>
											<a href="javascript:;" class="action-btn-solid single-package-sms-btn-desktop" data-package-name="<?= $package_name ?>" data-package-syntax="<?= $register_syntax . " " . $package_name ?>" data-package-send="<?= $register_send ?>">ĐK QUA TIN NHẮN</a>
										<?php endif; ?>
									</div>
									<div class="col-6">
										<a href="javascript:;" class="action-btn-outline single-package-otp-btn" data-package-name="<?= $package_name ?>" data-package-syntax="<?= $register_syntax . " " . $package_name ?>" data-package-send="<?= $register_send ?>">Đăng ký nhanh</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php

$videos_counts = get_option('options__theme_general_settings__videos', 0);

if ($videos_counts > 0):?>
	<section class="videos-wrapper">
		<div class="container">
			<h2 class="section-title">Thông tin thêm</h2>
			<div class="row">
				<?php for ($i = 0; $i < $videos_counts; $i ++): ?>
					<div class="col-lg-6">
						<div class="video-item">
							<div class="video-content">
								<?= get_option("options__theme_general_settings__videos_{$i}__iframe", "") ?>
							</div>
							<h3 class="video-title"><?= get_option("options__theme_general_settings__videos_{$i}__title", '') ?></h3>
						</div>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>
<?php

endif;

$prefix = substr($package_name, 0, 2);

$args = [
	'post_type'      => 'package',
	'posts_per_page' => 8,
	'post__not_in'   => [get_the_ID()],
	'meta_query'     => [
		'relation' => 'AND',
		[
			'key'     => '_package_name',
			'value'   => '^' . $prefix,
			'compare' => 'REGEXP',
		],
		[
			'key'     => '_package_price',
			'value'   => $package_price,
			'compare' => '>=',
			'type'    => 'NUMERIC'
		]
	]
];

$loop = new WP_Query($args);

if ($loop->have_posts()): ?>
	<section class="package-wrapper">
		<div class="container">
			<h2 class="section-title">Gói cước liên quan</h2>
			<div class="packages-related-wrapper">
				<div class="packages-related">
					<?php while ($loop->have_posts()) : $loop->the_post(); ?>
						<div class="package-related">
							<?php get_template_part('template-parts/content/content-package') ?>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>
<?php endif;
