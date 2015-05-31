<div class="sharing">
	<h3><?php _e('Please Share', 'observo'); ?></h3>
	<div class="share-link facebook">
		<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink(); ?>&t=<?php the_title(); ?>">
			<i class="fa fa-fw fa-facebook"></i>
		</a>
	</div>
	<div class="share-link twitter">
		<a target="_blank" href="https://twitter.com/share?url=<?php echo get_the_permalink(); ?>&text=<?php the_title(); echo " " . get_the_permalink();?>">
			<i class="fa fa-fw fa-twitter"></i>
		</a>
	</div>
	<div class="share-link google-plus">
		<a target="_blank" href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>&t=<?php the_title(); ?>">
			<i class="fa fa-fw fa-google-plus"></i>
		</a>
	</div>
	<div class="share-link linkedin">
		<a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo get_the_permalink(); ?>&title=<?php the_title(); ?>">
			<i class="fa fa-fw fa-linkedin"></i>
		</a>
	</div>
</div>