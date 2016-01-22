      <article>
        <header>
          <h2><a href="<?php echo article_url(); ?>"><?php echo article_title(); ?> &raquo;</a></h2>
          <p class="auteur-news">Par <?php echo article_author(); ?> le <?php echo article_date(); ?></p>
        </header>
        <section class="content-news">
          <?php echo article_markdown(); ?>
        </section>
      </article>
