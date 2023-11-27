<?php

$text = get_option('options__theme_header_settings__text_marquee', '');

?>

<div class="header">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-1 col-md-2 col-3">
				<div class="logo-wrapper">
					<?php _n_logo() ?>
				</div>
			</div>
			<div class="col-lg-8 navigation-col">
				<?php if (has_nav_menu('primary-menu')):
					wp_nav_menu([
						'theme_location'  => 'primary-menu',
						'container_class' => 'navigation',
						'menu_class'      => 'navigation-menu',
						'menu_id'         => 'navigation-menu',
					]);
				endif; ?>

				<div class="text-marquee"><p><?= $text ?></p></div>
			</div>
			<div class="col-lg-3 col-md-10 col-9">
				<div class="header-left">
					<div class="search-form-wrapper">
						<form action="<?= home_url() ?>" class="search-form">
							<input name="s" type="text" class="search-input" placeholder="Tìm gói cước" aria-label="Tìm gói cước" value="<?php the_search_query(); ?>">
							<input type="hidden" name="post_type" value="package">
							<button type="submit">Tìm kiếm</button>
						</form>
					</div>
					<div class="toggle-mobile-menu">
						<a href="javascript:;" id="toggle-mobile-menu-button"><i class="fa-solid fa-bars"></i></a>
					</div>
				</div>
			</div>
			<div class="col-12 text-mobile">
				<div class="text-marquee"><p><?= $text ?></p></div>
			</div>
		</div>
	</div>
	<div id="navigation-mobile-menu"></div>
</div>
