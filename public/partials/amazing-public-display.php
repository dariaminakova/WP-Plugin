<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       dream.team
 * @since      1.0.0
 *
 * @package    Amazing
 * @subpackage Amazing/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<section id='project' class='btnCntrPosition'>
	<div class='prev' onclick="plusSlides(-1)">
		<span class="arrow arrow-left">&#8592;</span>
	</div>
	<div class='slideShow-container'>
    <?php 
	  global $wpdb;
    foreach(Amazing_Admin::displaySlider($wpdb) as $item):
			 $img_path = $item->img_path;
			 $website = $item->website;
			 $description = $item->description;
			 $new_date = $item->new_date;
      ?>
				<div class="slides">
					<div>
						<img class="img" src="<?= $img_path;?>" alt="">
					</div>
					<a class="web-site" href="https://<?= $website; ?>" target="_blank">
            <?php echo $item->website; ?>
        	</a>
					<p class="partners-title"><?= $description; ?></p>
					<p class="date"><?= $new_date; ?></p>
				</div>
				<?php endforeach ?>
	</div>
	<div class='next' onclick="plusSlides(1)">
		<span class="arrow arrow-left">&#8594;</span>
	</div>
</section>