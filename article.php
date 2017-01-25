<?php
include("capcha.php");
$_SESSION['captcha'] = generateRandomString(4,'1234567890');
theme_include("header");

?>
<section role="content" class="content">
      <article>
        <header>
		  <?php
            // Determine if podcast
            $isPodcast = true;
            switch(article_category_slug()) {
                case "podcasts":
                    $itunesUrl = "https://itunes.apple.com/fr/podcast/trancendances/id520888552";
                    break;
                case "dark-side":
                    $itunesUrl = "https://itunes.apple.com/fr/podcast/dark-side/id912453530";
                    break;
                case "stode-friends-arena":
                    $itunesUrl = "https://itunes.apple.com/fr/podcast/stode-friends-arena/id920121670";
                    break;
                case "past-present":
                    $itunesUrl = "https://itunes.apple.com/fr/podcast/past-present/id975869214";
                    break;
                case "once-upon-a-time":
                    $itunesUrl = "https://itunes.apple.com/fr/podcast/once-upon-a-time/id1168657936";
                    break;
                case "french-touch":
                    $itunesUrl = "javascript:alert('Bientot !');";
                    break;
                default:
                    $isPodcast = false;
                    break;
            }

            if($isPodcast) {
                $fileUrl = article_custom_field("podcast_file");
                preg_match('/\/([^\/]+)$/', $fileUrl, $matches);
                $fileName = $matches[1];
				?>
				<div style="float:right">
					<a href="<?php echo $fileUrl; ?>" title="Clic-droit sur l'icône, puis faites 'Enregistrer sous'" download="<?php echo $fileName; ?>"><img style="margin-right:10px;border:none" src="https://www.trancendances.fr/themes/Trancendances/images/download-97607_640.png"></a>
					<a href="<?php echo $itunesUrl; ?>" target="_blank"><img style="border:none" src="https://www.trancendances.fr/themes/Trancendances/images/itunes-icon.png"></a>
				</div>
				<?php
            }
		  ?>
          <h2><?php echo article_title(); ?></h2>
		  <?php if(article_category_slug() === "soirees"):
			$party_time = article_custom_field('heure');
			if(empty($party_time)) {
				$party_time = "23:59";
			}
			$date = strtotime(article_custom_field('date')." ".$party_time);
			//if($date = strtotime(article_custom_field('date')." ".$party_time) > time()):
			if($party_time == "00:00") {
				$date = $date - 86400;
			}
		  ?>
		  <p class="auteur-news">Le <?php echo date('j/m/Y', $date); ?> (d&eacute;but à <?php echo date('G\hi', $date); ?>)</p>
		  <?php else: ?>
          <p class="auteur-news">Par <?php echo article_author(); ?> le <?php echo article_date(); ?></p>
		  <?php endif; ?>
        </header>
        <section class="content-news">
        <?php if($isPodcast) { ?>
        	<iframe width="100%" height="180" src="//www.mixcloud.com/widget/iframe/?feed=<?php echo urlencode(article_custom_field('podcast_url')); ?>&mini=&stylecolor=&hide_artwork=1&embed_type=widget_standard&embed_uuid=7b610803-1e1b-48bd-a518-d63e3cb18216&hide_tracklist=1&hide_cover=&autoplay=" frameborder="0"></iframe>
        <?php
			} else if(article_category_slug() === "soirees") {
				?>
				<div style="float:right;margin-left:10px;"><img src="<?php echo article_custom_field('soiree_affiche', '/themes/Trancendances/images/agenda-default.jpg'); ?>" /></div>
				<?php
			}?>
          <?php echo article_markdown(); ?>
        </section>
      </article>
    <?php if(comments_open()): ?>
      <hr>
      <article class="comments">
      <header>
        <h2>Envoyer un commentaire !</h2>
      </header>
        <?php if(has_comments()): ?>
        <ul class="commentlist">
          <?php $i = 0; while(comments()): $i++; ?>
          <?php if(total_comments() > 1 && $i > 1) :?>
            <hr>
          <?php endif; ?>
          <li class="comment" id="comment-<?php echo comment_id(); ?>">
            <div class="wrap">
              <h2><?php echo comment_name(); ?> <time><?php echo date("d/m/Y @ H:i:s",comment_time()); ?></time></h2>

              <div class="content">
                <?php echo comment_text(); ?>
              </div>
            </div>
          </li>
          <?php endwhile; ?>
        </ul>
        <?php endif; ?>
        <hr>
        <form id="comment" class="commentform wrap" method="post" action="<?php echo comment_form_url(); ?>#comment">
          <?php echo comment_form_notifications(); ?>

          <p class="name">
            <label for="name">Votre nom :</label>
            <?php echo comment_form_input_name('placeholder="Votre nom/pseudonyme"'); ?>
          </p>

          <p class="email">
            <label for="email">Votre adresse email :</label>
            <?php echo comment_form_input_email('placeholder="Votre e-mail (ne sera pas publié)"'); ?>
          </p>

          <p class="textarea">
            <label for="text">Votre commentaire :</label>
            <?php echo comment_form_input_text('placeholder="Votre commentaire"'); ?>
          </p>

          <?php /* <p class="captcha">
            <img src="http://www.trancendances.fr/themes/Trancendances/capcha.php?printpic"  />
            <input type="text" id="captchatext" name="captcha" placeholder="Merci de rentrer le nombre affiché sur l'image"/>
            </p> */
          ?>

          <p class="submit">
            <?php echo comment_form_button("Envoyer le commentaire"); ?>
          </p>
        </form>

      </article>
    <?php endif; ?>
</section>
<?php theme_include("footer"); ?>
