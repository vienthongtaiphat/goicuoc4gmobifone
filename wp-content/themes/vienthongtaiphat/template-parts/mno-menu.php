<section class="mno-menu-wrapper">
	<div class="container">
		<ul class="mno-menu">
			<li class="mobi">
				<a href="<?= home_url('/') ?>" class="<?= is_page_template('page-templates/mobi.php') ? 'active' : '' ?>">
					<img src="<?= get_theme_file_uri('assets/images/mobi.png') ?>" alt="MobiFone">
				</a>
			</li>
			<li class="vina">
				<a href="<?= home_url('/vinaphone') ?>" class="<?= is_page_template('page-templates/vina.php') ? 'active' : '' ?>">
					<img src="<?= get_theme_file_uri('assets/images/vina.png') ?>" alt="VinaPhone">
				</a>
			</li>
		</ul>
	</div>
</section>
