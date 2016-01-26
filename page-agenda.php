<?php theme_include("header"); ?>
<section role="content" class="content">
	  <p id="contactus">Envie de retrouver votre événement ici ?<br />
		<a href="http://www.trancendances.fr/contact">Contactez-nous !</a></p>
	<h2 class="events">Événements à venir &raquo;</h2>
      <?php sort_posts_by_date(FALSE, FALSE);
	  while(posts()):?>
        <?php
	$party_time = article_custom_field('heure');
	if(empty($party_time)) {
		$party_time = "23:59";
	}
	$date = strtotime(article_custom_field('date')." ".$party_time);
	if($date > time()): // Deux semaines de délai
		if($party_time == "00:00") {
			$date = $date - 86400;
		}
		?>
	        <article class="soiree-case">
		        <h4><a href="<?php echo article_url();?>"><?php echo article_title();?></h4>
			<img src="<?php echo article_custom_field('soiree_affiche', '/themes/Trancendances/images/agenda-default.jpg'); ?>" /></a>
			<p class="partytime">Le <?php echo date('d/m/Y', $date); ?> (d&eacute;but à <?php echo date('G\hi', $date); ?>)</p>
			<p class="location">Lieu : <?php echo article_custom_field('soiree_place'); ?></p>
			<p class="artists">Avec <?php echo article_custom_field('soiree_artistes'); ?></p>
			<p class="link"><a href="<?php echo article_url();?>">Plus d'infos</a></p>
		</article>
	<?php endif; ?>
	<?php endwhile;
	sort_posts_by_date(true, true);?>
</section>

<section class="content">
	<h2 class="events">Événements passés &raquo;</h2>
	<?php sort_posts_by_date(TRUE, FALSE);
	while(posts()):
        $party_time = article_custom_field('heure');
        if(empty($party_time)) {
                $party_time = "23:59";
        }
        $date = strtotime(article_custom_field('date')." ".$party_time);
        if($date < time()):
        //if($date > (time() - (604800*4)) && $date < time()): // Un mois de délai
                if($party_time == "00:00") {
                        $date = $date - 86400;
                }
                ?>
                <article class="soiree-case">
                        <h4><a href="<?php echo article_url();?>"><?php echo article_title();?></h4>
                        <img src="<?php echo article_custom_field('soiree_affiche', '/themes/Trancendances/images/agenda-default.jpg'); ?>" /></a>
                        <p class="partytime">Le <?php echo date('d/m/Y', $date); ?> (ouverture à <?php echo date('G\hi', $date); ?>)</p>
                        <p class="location">Lieu : <?php echo article_custom_field('soiree_place'); ?></p>
                        <p class="artists">Avec <?php echo article_custom_field('soiree_artistes'); ?></p>
                        <p class="link"><a href="<?php echo article_url();?>">Plus d'infos</a></p>
                </article>
        <?php endif; ?>
        <?php endwhile; ?>

</section>
<?php theme_include("footer"); ?>
