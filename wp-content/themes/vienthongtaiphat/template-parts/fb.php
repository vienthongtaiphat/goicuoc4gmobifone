<?php

$home_fb = get_field('_home_fb', 'option');

?>

<section class="fb-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="fb-page-wrapper">
					<div class="fb-page" data-href="<?= $home_fb ?>" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
						<blockquote cite="<?= $home_fb ?>" class="fb-xfbml-parse-ignore"><a href="<?= $home_fb ?>">Facebook</a></blockquote>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="fb-comments-wrapper">
					<div class="fb-comments" data-href="<?= get_home_url() ?>" data-width="" data-numposts="5"></div>
				</div>
			</div>
		</div>
	</div>
</section>
