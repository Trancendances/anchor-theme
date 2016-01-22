<?php theme_include("header"); ?>
<section role="content" class="content">
<script type="text/javascript">
	function Rebour() {
		var countdown = document.getElementById('countdown');
		var today = new Date();
		var bday = new Date(2015,7,17,12);
		var journee = 24*3600; // Un jour en secondes
		var sec = (bday - today)/1000; // Intervalle en secondes
		if(sec > 0) {
			var j = Math.floor(sec / journee); // Nombre de jours
			var h = Math.floor((sec - j*journee)/3600); // Nombre d'heures
			var mn = Math.floor((sec - (j*journee + h*3600))/60); // Nombre de minutes
			var s = Math.floor(sec - (j*journee + h*3600 + mn*60)); // Nombre de secondes
			if(j < 10) {
				j = "0"+j;
			}
			if(h < 10) {
				h = "0"+h;
			}
			if(mn < 10) {
				mn = "0"+mn;
			}
			if(s < 10) {
				s = "0"+s;
			}
			countdown.innerHTML = "D&eacute;but du troisi&egrave;me anniversaire de Trancendances dans :<br />"+j+"j "+h+"h "+mn+"mn "+s+"s<br /><a href=\"https://www.facebook.com/events/630215123741664/\">Rejoindre l'&eacute;v&eacute;nement</a>";
		} else {
			countdown.innerHTML = '<iframe src="http://www.trancendances.fr/themes/Trancendances/assets/tr.html" width="100%" height="77px" style="border:none" scrolling="no"></iframe>';
		}
	}
	Rebour();
</script>
<article>
<header class="nude-header">
  <h2>Dernier podcast &raquo;</h2>
</header>
<?php $displayCats = array(2,5,8,9); ?>
<?php $count = 0; ?>
<?php while(post_list()): ?>
    <?php foreach($displayCats as $cat): ?>
        <?php if(article_category_id() == $cat && $count == 0): ?>
        <?php $count++; ?>
        <article class="podcast-case">
	        <iframe width="100%" height="180" src="//www.mixcloud.com/widget/iframe/?feed=<?php echo urlencode(article_custom_field('podcast_url')); ?>&mini=&stylecolor=&hide_artwork=1&embed_type=widget_standard&embed_uuid=7b610803-1e1b-48bd-a518-d63e3cb18216&hide_tracklist=1&hide_cover=&autoplay=" frameborder="0"></iframe>
	        <header>
	          <h4 style="text-align:right"><a href="<?php echo article_url();?>"><?php echo article_title();?></a></h4>
	        </header>
        </article>
          <?php endif; ?>
    <?php endforeach; ?>
<?php endwhile; ?>
</article>
<?php while(rwar_latest_posts(2)): ?>
      <article>
        <header>
          <h2><a href="<?php echo article_url(); ?>"><?php echo article_title(); ?> &raquo;</a></h2>
          <p class="auteur-news">Par <?php if(preg_match("/(.*)\/news\/(.*)/", article_url(), $cut_url)): 
          		$post = Post::slug($cut_url[2]); 
          		$author['id'] = $post->author;
	  		$post_author = User::search($author);
	  		echo $post_author->real_name;
          	endif; ?> le <?php echo article_date(); ?></p>
        </header>
        <section class="content-news">
          <?php echo article_markdown(); ?>
        </section>
      </article>
<?php endwhile; ?>

</section>
<?php theme_include("footer"); ?>
