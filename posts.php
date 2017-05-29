<?php theme_include("header"); ?>
<section role="content" class="content">
<?php

$current_url = current_url();
$cat_page = str_replace("category/", "", $current_url);

?>
  <?php if(has_posts()): ?>
    <?php if(strpos($cat_page, "podcasts") !== false): ?>
		<p style="text-align:right;margin-top:20px;margin-right:15px;margin-bottom:-40px"><img src="https://www.trancendances.fr/themes/Trancendances/images/itunes-rss.png" usemap="#podcasts-header" /></p>
		<map name="podcasts-header">
			<area shape="rect" coords="0,0,35,35" href="https://itunes.apple.com/fr/podcast/trancendances/id520888552" target="_blank" />
			<area shape="rect" coords="45,0,80,35" href="http://files.trancendances.fr/podcasts.xml" target="_blank" />
		</map>
	<?php elseif(strpos($cat_page, "dark-side") !== false): ?>
		<p style="text-align:right;margin-top:20px;margin-right:15px;margin-bottom:-40px"><img src="https://www.trancendances.fr/themes/Trancendances/images/itunes-rss.png" usemap="#podcasts-header" /></p>
		<map name="podcasts-header">
			<area shape="rect" coords="0,0,35,35" href="https://itunes.apple.com/fr/podcast/dark-side/id912453530" target="_blank" />
			<area shape="rect" coords="45,0,80,35" href="http://files.trancendances.fr/darkside.xml" target="_blank" />
		</map>
	<?php elseif(strpos($cat_page, "stode-friends-arena") !== false): ?>
		<p style="text-align:right;margin-top:20px;margin-right:15px;margin-bottom:-40px"><img src="https://www.trancendances.fr/themes/Trancendances/images/itunes-rss.png" usemap="#podcasts-header" /></p>
		<map name="podcasts-header">
			<area shape="rect" coords="0,0,35,35" href="https://itunes.apple.com/fr/podcast/stode-friends-arena/id920121670" target="_blank" />
			<area shape="rect" coords="45,0,80,35" href="http://files.trancendances.fr/stodefriendsarena.xml" target="_blank" />
		</map>
	<?php elseif(strpos($cat_page, "past-present") !== false): ?>
		<p style="text-align:right;margin-top:20px;margin-right:15px;margin-bottom:-40px"><img src="https://www.trancendances.fr/themes/Trancendances/images/itunes-rss.png" usemap="#podcasts-header" /></p>
		<map name="podcasts-header">
			<area shape="rect" coords="0,0,35,35" href="https://itunes.apple.com/fr/podcast/past-present/id975869214" target="_blank" />
			<area shape="rect" coords="45,0,80,35" href="http://files.trancendances.fr/pastpresent.xml" target="_blank" />
		</map>
	<?php elseif(strpos($cat_page, "once-upon-a-time") !== false): ?>
		<p style="text-align:right;margin-top:20px;margin-right:15px;margin-bottom:-40px"><img src="https://www.trancendances.fr/themes/Trancendances/images/itunes-rss.png" usemap="#podcasts-header" /></p>
		<map name="podcasts-header">
			<area shape="rect" coords="0,0,35,35" href="https://itunes.apple.com/fr/podcast/once-upon-a-time/id1168657936" target="_blank" />
			<area shape="rect" coords="45,0,80,35" href="http://files.trancendances.fr/onceuponatime.xml" target="_blank" />
		</map>
	<?php elseif(strpos($cat_page, "french-touch") !== false): ?>
		<p style="text-align:right;margin-top:20px;margin-right:15px;margin-bottom:-40px"><img src="https://www.trancendances.fr/themes/Trancendances/images/itunes-rss.png" usemap="#podcasts-header" /></p>
		<map name="podcasts-header">
			<area shape="rect" coords="0,0,35,35" href="https://itunes.apple.com/fr/podcast/french-touch/id1224910540" target="_blank" />
			<area shape="rect" coords="45,0,80,35" href="http://files.trancendances.fr/frenchtouch.xml" target="_blank" />
		</map>
	<?php endif; ?>
    <?php while(posts()): ?>
	<?php
		$post = Post::slug(article_slug());
		$cat = $post->category;
		if($cat != "4"):
	?>
      <?php if(strpos($cat_page, "podcasts") !== false || strpos($cat_page, "dark-side") !== false || strpos($cat_page, "stode-friends-arena") !== false || strpos($cat_page, "past-present") !== false || strpos($cat_page, "once-upon-a-time") !== false || strpos($cat_page, "french-touch") !== false): ?>
        <article class="podcast-case">
        <iframe width="100%" height="180" src="//www.mixcloud.com/widget/iframe/?feed=<?php echo urlencode(article_custom_field('podcast_url')); ?>&mini=&stylecolor=&hide_artwork=1&embed_type=widget_standard&embed_uuid=7b610803-1e1b-48bd-a518-d63e3cb18216&hide_tracklist=1&hide_cover=&autoplay=" frameborder="0"></iframe>
        <header>
          <h4><a href="<?php echo article_url();?>"><?php echo article_title();?></a></h4>
        </header>
        </article>
    <?php else:?>
        <?php theme_include("loop"); ?>
      <?php endif; 
		endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>
  <?php if(has_pagination()): ?>
	<nav class="pagination" style="text-align:center">
        <?php echo posts_prev(); ?>
        <?php echo posts_next(); ?>
    </nav>
  <?php endif; ?>
</section>

<?php theme_include("footer"); ?>
