<?php
header('Content-Type: application/rss+xml');
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
    <channel>
        <title>Once Upon A Time</title>
        <link>http://www.trancendances.fr/</link>
        <language>fr-FR</language>
        <copyright>Trancendances</copyright>
        <itunes:subtitle>Chaque mois, Stode vous raconte une nouvelle histoire musicale.</itunes:subtitle>
        <itunes:author>Stode</itunes:author>
        <itunes:summary>Chaque mois, Stode vous raconte une nouvelle histoire musicale.</itunes:summary>
        <description>Chaque mois, Stode vous raconte une nouvelle histoire musicale.</description>
        <itunes:owner>
            <itunes:name>Trancendances</itunes:name>
            <itunes:email>contact@trancendances.fr</itunes:email>
        </itunes:owner>
        <itunes:image href="http://www.trancendances.fr/themes/Trancendances/images/logo-onceuponatime.jpg" />
        <itunes:category text="Music" />
        <itunes:explicit>no</itunes:explicit>

        <image>
		<url>http://www.trancendances.fr/themes/Trancendances/images/logo-onceuponatime.jpg</url>
		<title>Retrouvez Stode chaque mois pour une heure, accompagné par les meilleurs DJs Trance !</title>
		<link>http://www.trancendances.fr/</link>
	</image>

	<?php $displayCats = array(11); ?>
	<?php while(post_list()): ?>
		<?php foreach($displayCats as $cat): ?>
			<?php if(article_category_id() == $cat): ?>

			<?php
				$url = article_custom_field("podcast_file");
				$type = get_headers($url, 1); ?>

			<item>
				<title><?php echo article_title(); ?></title>
				<description><?php echo preg_replace('/&/','&amp;',article_description()); ?>
			
				Tracklist &amp; Infos sur http://www.trancendances.fr/podcasts</description>
				<itunes:author>Evâa Pearl</itunes:author>
				<itunes:subtitle><?php echo article_title(); ?></itunes:subtitle>
				<itunes:summary><?php echo preg_replace('/&/','&amp;',article_description()); ?>
			
				Tracklist &amp; Infos sur http://www.trancendances.fr/podcasts</itunes:summary>
				<itunes:image href="http://www.trancendances.fr/themes/Trancendances/images/logo-onceuponatime.jpg" />
				<enclosure type="<?php echo $type['Content-Type']; ?>" url="<?php echo $url; ?>" length="<?php echo $type['Content-Length']; ?>" />
				<guid><?php echo $url; ?></guid>
				<pubDate><?php echo article_custom_field("podcast_date"); ?> +0200</pubDate>
				<itunes:duration><?php echo article_custom_field("podcast_length"); ?></itunes:duration>
				<itunes:keywords>Trancendances, Stode, Once Upon A Time, <?php echo article_title(); ?>, <?php echo article_custom_field("podcast_date"); ?></itunes:keywords>
			</item>
        <?php endif; ?>
		<?php endforeach; ?>
      <?php endwhile;?>

    </channel>
</rss>
