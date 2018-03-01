<?php
header('Content-Type: application/rss+xml');
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
	<channel>
		<title>Past &amp; Present</title>
		<link>https://www.trancendances.fr/</link>
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
		<itunes:image href="http://files.trancendances.fr/logos/logo-pastpresent.jpg" />
		<itunes:category text="Music" />
		<itunes:explicit>no</itunes:explicit>

		<image>
			<url>http://files.trancendances.fr/logos/logo-pastpresent.jpg</url>
			<title>Chaque mois, Agerius prend les platines pour vous faire découvrir, ou redécouvrir, des classiques de la trance aux côtés des tendances actuelles.</title>
			<link>https://www.trancendances.fr/</link>
		</image>

		<?php $displayCats = array(9); ?>
		<?php while(post_list()): ?>
			<?php foreach($displayCats as $cat): ?>
				<?php if(article_category_id() == $cat): ?>

					<?php
						$url = article_custom_field("podcast_file");
						$type = get_headers($url, 1); ?>

					<item>
						<title><?php echo article_title(); ?></title>
						<description><?php echo preg_replace('/&/','&amp;',article_description()); ?>

						Tracklist &amp; Infos sur https://www.trancendances.fr/podcasts</description>
						<itunes:author>Stode</itunes:author>
						<itunes:subtitle><?php echo article_title(); ?></itunes:subtitle>
						<itunes:summary><?php echo preg_replace('/&/','&amp;',article_description()); ?>

						Tracklist &amp; Infos sur https://www.trancendances.fr/podcasts</itunes:summary>
						<itunes:image href="http://files.trancendances.fr/logos/logo-pastpresent.jpg" />
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
