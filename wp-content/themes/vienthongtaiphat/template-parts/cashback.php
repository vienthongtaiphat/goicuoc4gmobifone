<section class="cashback-wrapper">
	<div class="container">
		<h1 class="cashback-title">Tra cứu thông tin hoàn tiền</h1>
		<p class="desc">Quý khách vui lòng nhập đúng số thuê bao mà quý khách đã đăng ký gói cước 4G!</p>
		<form action="<?= get_the_permalink() ?>" class="cashback-form" method="get">
			<div class="search-input-wrapper">
				<input name="phone" type="text" class="search-input" placeholder="Nhập số điện thoại của bạn" aria-label="Nhập số điện thoại của bạn" value="<?= $_GET['phone'] ?? '' ?>">
			</div>
			<button type="submit">Tra cứu</button>
		</form>

		<?php if (isset($_GET['phone']) && $_GET['phone'] != ''):
			if (!preg_match("/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/", $_GET['phone'])): ?>
				<div class="alert alert-danger mt-3" role="alert">
					Số điện thoại không hợp lệ!
				</div>
			<?php else:
				$date = date('Y-m-d', strtotime('-30 days')) . " 00:00";

				$args = [
					'post_type'      => 'cashback',
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
					'meta_query'     => [
						'relation' => 'AND',
						[
							'key'     => '_cashback_phone',
							'value'   => $_GET['phone'],
							'compare' => 'LIKE',
						],
						[
							'key'     => '_cashback_package_date',
							'value'   => $date,
							'type'    => 'DATE',
							'compare' => '>=',
						]
					]
				];

				$loop = new WP_Query($args);

				?>
				<div class="result-wrapper">
					<h2 class="result-title">Tra cứu thông tin hoàn tiền cho số thuê bao: <span><?= $_GET['phone'] ?></span></h2>
					<?php if ($loop->have_posts()):
						while ($loop->have_posts()):
							$loop->the_post();
							$cashback_id       = get_the_ID();
							$package           = get_post_meta($cashback_id, '_cashback_package', true);
							$amount            = get_post_meta($cashback_id, '_cashback_amount', true);
							$amount_real       = get_post_meta($cashback_id, '_cashback_amount_real', true);
							$amount_processing = get_post_meta($cashback_id, '_cashback_amount_processing', true);
							$status            = get_post_meta($cashback_id, '_cashback_status', true);
							$amount            = intval($amount);
							$amount_real       = intval($amount_real);
							$amount_processing = intval($amount_processing);
							?>

							<div class="alert alert-success" role="alert">
								<strong>Gói cước đã đăng ký: <?= $package ?></strong> <br>
								<?php if ($amount == 0):
									echo "Gói cước quý khách đăng ký không được áp dụng chương trình hoàn tiền. Chi tiết liên hệ: <a href='https://zalo.me/4054682374558282299' target='_blank' class='link-danger alert-link'>Zalo</a>";
								else:
									if ($amount == $amount_real):
										echo "Quý khách đã được hoàn thành công số tiền " . number_format($amount_real, 0, '.', '.') . "đ vào tài khoản chính, quý khách vui lòng kiểm tra lại số dư. Xin cảm ơn!";
									elseif ($amount_real > 0 && $amount_processing > 0):
										echo "Quý khách đang được hoàn số tiền " . number_format($amount_real, 0, '.', '.') . "đ vào tài khoản chính, quý khách vui lòng tiếp tục theo dõi. Xin cảm ơn!";
									elseif ($amount_real == 0 && $amount_processing > 0):
										echo "Số thuê bao đang được xử lý, Quý khách vui lòng tra cứu hoàn tiền sau 72h đăng ký thành công gói cước. <br> Nếu Quý khách chưa nhận được tiền hoàn sau 72h đăng ký thành công, Quý khách vui lòng liên hệ với chúng tôi qua <a href='https://zalo.me/4054682374558282299' target='_blank' class='link-danger alert-link'>Zalo</a> để được hỗ trợ. Xin cảm ơn!";
									else:
										echo "Hệ thống đang bận, vui lòng quay lại sau!";
									endif;
								endif; ?>
							</div>
						<?php endwhile;
					else: ?>
						<div class="alert alert-danger" role="alert">
							Số thuê bao <strong><?= $_GET['phone'] ?></strong> của quý khách không có trong lịch sử đăng ký của chúng tôi, quý khách vui lòng kiểm tra lại cú pháp đăng ký hoặc liên hệ: <a href='https://zalo.me/4054682374558282299' target='_blank' class='link-primary alert-link'>Zalo</a>!
						</div>
					<?php endif;
					wp_reset_postdata(); ?>
				</div>
			<?php
			endif;
		endif; ?>
	</div>
</section>
