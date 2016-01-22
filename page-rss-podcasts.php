<?php
header('Content-Type: application/rss+xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
    <channel>
        <title>Trancendances</title>
        <link>http://www.trancendances.fr/</link>
        <language>fr-FR</language>
        <copyright>Trancendances</copyright>
        <itunes:subtitle>Podcast officiel de Trancendances</itunes:subtitle>
        <itunes:author>Trancendances</itunes:author>
        <itunes:summary>La Trance, vous connaissez ? Si vous pensez que la musique électronique s'arrête à ce que vous entendez sur les grandes antennes, alors pensez autrement ! Une équipe de bénévoles passionnés vous fait découvrir ce genre trop peu connu en France.</itunes:summary>
        <description>Découvrez ou redécouvrez les épisodes de Trancendances en téléchargement gratuit !</description>
        <itunes:owner>
            <itunes:name>Trancendances</itunes:name>
            <itunes:email>contact@trancendances.fr</itunes:email>
        </itunes:owner>
        <itunes:image href="http://www.trancendances.fr/themes/Trancendances/images/casque.jpg" />
        <itunes:category text="Music" />
        <itunes:explicit>no</itunes:explicit>

	<?php while(podcasts_posts()):?>
	<?php if(article_category_slug() == "podcasts"):
	$url = article_custom_field("podcast_file");
	$type = get_headers($url, 1); ?>

        <item>
            <title><?php echo article_title(); ?></title>
            <description><?php echo preg_replace('/&/','&amp;',article_description()); ?></description>
            <itunes:author>Trancendances</itunes:author>
            <itunes:subtitle><?php echo article_title(); ?></itunes:subtitle>
            <itunes:summary><?php echo preg_replace('/&/','&amp;',article_description()); ?></itunes:summary>
            <itunes:image href="http://www.trancendances.fr/themes/Trancendances/images/casque.jpg" />
            <enclosure type="<?php echo $type['Content-Type']; ?>" url="<?php echo $url; ?>" length="<?php echo $type['Content-Length']; ?>" />
            <guid><?php echo $url; ?></guid>
            <pubDate><?php echo article_custom_field("podcast_date"); ?> +0200</pubDate>
            <itunes:duration><?php echo article_custom_field("podcast_length"); ?></itunes:duration>
            <itunes:keywords>Trancendances, <?php echo article_title(); ?>, <?php echo article_custom_field("podcast_date"); ?></itunes:keywords>
        </item>
        <?php endif; ?>
      <?php endwhile;?>

    </channel>
</rss>
