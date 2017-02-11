<?php theme_include("header"); ?>
<section role="content" class="content">
<article>
<header class="nude-header">
  <h2>Dernier podcast &raquo;</h2>
</header>
<?php $displayCats = array(2,5,8,9,11,12); ?>
<?php $count = 0; ?>
<?php while(post_list()): ?>
    <?php foreach($displayCats as $cat): ?>
        <?php if(article_category_id() == $cat && $count == 0): ?>
        <?php $count++; ?>
        <article class="podcast-case">
        	<iframe width="100%" height="180" src="//www.mixcloud.com/widget/iframe/?feed=<?php echo urlencode(article_custom_field('podcast_url')); ?>&hide_cover=1&light=1" frameborder="0"></iframe>
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
