<?php
header('Content-Type: application/rss+xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
    <channel>
        <title>Past &amp; Present</title>
        <link>http://www.trancendances.fr/</link>
        <language>fr-FR</language>
        <copyright>Trancendances</copyright>
        <itunes:subtitle>Voyagez dans le temps</itunes:subtitle>
        <itunes:author>Agerius</itunes:author>
        <itunes:summary>Chaque mois, Agerius prend les platines pour vous faire découvrir, ou redécouvrir, des classiques de la trance aux côtés des tendances actuelles.</itunes:summary>
        <description>Retrouvez Agerius tous les mois pour un voyage dans le temps à la découverte des classiques de la trance.</description>
        <itunes:owner>
            <itunes:name>Trancendances</itunes:name>
            <itunes:email>contact@trancendances.fr</itunes:email>
        </itunes:owner>
        <itunes:image href="http://www.trancendances.fr/themes/Trancendances/images/logo-pastpresent.jpg" />
        <itunes:category text="Music" />
        <itunes:explicit>no</itunes:explicit>

	<?php while(podcasts_posts()):?>
	<?php if(article_category_slug() == "past-present"):
	$url = article_custom_field("podcast_file");
	$type = get_headers($url, 1); ?>

        <item>
            <title><?php echo article_title(); ?></title>
            <description><?php echo preg_replace('/&/','&amp;',article_description()); ?></description>
            <itunes:author>Trancendances</itunes:author>
            <itunes:subtitle><?php echo article_title(); ?></itunes:subtitle>
            <itunes:summary><?php echo preg_replace('/&/','&amp;',article_description()); ?></itunes:summary>
            <itunes:image href="http://www.trancendances.fr/themes/Trancendances/images/logo-pastpresent.jpg" />
            <?php if(!empty($type['Content-Length'])) { ?>
            <enclosure type="<?php echo $type['Content-Type']; ?>" url="<?php echo $url; ?>" length="<?php echo $type['Content-Length']; ?>" />
            <?php } ?>
            <guid><?php echo $url; ?></guid>
            <pubDate><?php echo article_custom_field("podcast_date"); ?> +0200</pubDate>
            <itunes:duration><?php echo article_custom_field("podcast_length"); ?></itunes:duration>
            <itunes:keywords>Trancendances, <?php echo article_title(); ?>, <?php echo article_custom_field("podcast_date"); ?></itunes:keywords>
        </item>
        <?php endif; ?>
      <?php endwhile;?>

    </channel>
</rss>
