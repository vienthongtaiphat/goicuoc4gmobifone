<section class="search-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<aside class="primary-sidebar">
					<div class="sidebar-widget sidebar-search">
						<form action="<?php echo home_url('/'); ?>" class="advanced-search-form">
							<div class="search-input-wrapper">
								<input name="s" type="text" class="search-input" placeholder="Tìm tên gói cước" aria-label="Tìm gói cước" value="<?php the_search_query(); ?>">
							</div>
							<div class="search-checkbox-wrapper">
								<div class="row">
									<div class="col-12 checkbox-col">
										<h4 class="checkbox-title">Loại gói cước</h4>
										<div class="checkbox-wrapper">
											<label class="checkbox-container">Data
												<input type="checkbox" name="package_data" value="yes" <?= isset($_GET['package_data']) && $_GET['package_data'] == 'yes' ? 'checked' : '' ?>>
												<span class="checkmark"></span>
											</label>
										</div>
										<div class="checkbox-wrapper">
											<label class="checkbox-container">Thoại
												<input type="checkbox" name="package_call" value="yes" <?= isset($_GET['package_call']) && $_GET['package_call'] == 'yes' ? 'checked' : '' ?>>
												<span class="checkmark"></span>
											</label>
										</div>
										<div class="checkbox-wrapper">
											<label class="checkbox-container">Tin nhắn
												<input type="checkbox" name="package_sms" value="yes" <?= isset($_GET['package_sms']) && $_GET['package_sms'] == 'yes' ? 'checked' : '' ?>>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<div class="col-12 checkbox-col">
										<h4 class="checkbox-title">Chu kỳ</h4>
										<div class="checkbox-wrapper">
											<label class="checkbox-container">Gói ngày
												<input type="checkbox" name="package_day" value="yes" <?= isset($_GET['package_day']) && $_GET['package_day'] == 'yes' ? 'checked' : '' ?>>
												<span class="checkmark"></span>
											</label>
										</div>
										<div class="checkbox-wrapper">
											<label class="checkbox-container">Gói tháng
												<input type="checkbox" name="package_month" value="yes" <?= isset($_GET['package_month']) && $_GET['package_month'] == 'yes' ? 'checked' : '' ?>>
												<span class="checkmark"></span>
											</label>
										</div>
										<div class="checkbox-wrapper">
											<label class="checkbox-container">Gói năm
												<input type="checkbox" name="package_year" value="yes" <?= isset($_GET['package_year']) && $_GET['package_year'] == 'yes' ? 'checked' : '' ?>>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<div class="col-12">
										<div class="widget-price-filter">
											<ul class="list-dots" id="list-dots">
												<li><span>0đ</span></li>
												<li><span>50k</span></li>
												<li><span>100k</span></li>
												<li><span>200k</span></li>
												<li><span>1tr</span></li>
												<li><span>Trên 1tr</span></li>
											</ul>
											<div id="price-filter" data-min="0" data-max="5" data-min-value="<?= isset($_GET['price']) && $_GET['price'] > 0 ? $_GET['price'] : 0 ?>" data-max-value="<?= isset($_GET['price']) && $_GET['price'] > 0 ? $_GET['price'] : 5 ?>" data-price-sign="đ" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"></div>
											<div class="price-range">
												<input type="hidden" name="price" id="price">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="submit-wrapper">
								<button type="submit">Tìm kiếm</button>
							</div>
							<input type="hidden" name="post_type" value="package">
						</form>
					</div>
				</aside>
			</div>
			<div class="col-lg-8">
				<div class="search-results">
					<?php if (is_search() && isset($_GET['s']) && $_GET['s'] != ''):
						global $wp_query; ?>
						<p class="search-results-text"><?= $wp_query->found_posts ?> Kết quả tìm kiếm <span>“<?= $_GET['s'] ?>”</span></p>
					<?php endif; ?>

					<?php if (have_posts()): ?>
						<div class="row">
							<?php while (have_posts()): the_post(); ?>
								<div class="col-md-6">
									<?php get_template_part('template-parts/content/content-package'); ?>
								</div>
							<?php endwhile; ?>
						</div>
					<?php else: ?>
						<div class="alert alert-danger" role="alert">
							Không tìm thấy gói cước phù hợp!
						</div>
					<?php endif; ?>
				</div>
				<div class="pagination-wrapper">
					<?php _n_pagination([
						'prev' => '<',
						'next' => '>',
					]) ?>
				</div>
			</div>
		</div>
	</div>
</section>
