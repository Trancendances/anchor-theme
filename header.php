<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
<?php 
	$current_url = current_url();
	$status = "";
	$category = "";
	$webpage_title = NULL;
	if(preg_match("/category\/(.*)/", $current_url, $cut_url)): // Catégorie
		$category = Category::slug($cut_url[1]);
		$status = "cat";
		if(!empty($category)):
			$webpage_description = $category->description;
			$webpage_name = $category->title;
			$webpage_title = $webpage_name;
	  	else:
	  		$webpage_description = NULL;
			$webpage_name = NULL;
	  	endif;
	elseif(preg_match("/news\/(.*)/", $current_url, $cut_url)): // Post
	  	$post = Post::slug($cut_url[1]);
		$status = "post";
		if(!empty($post)):
			$category = $post->category;
			
			$webpage_picture = article_custom_field('post_picture', '/themes/Trancendances/images/website-thumbnail-default.jpg'); 

			if($category == "4") {
		  		$webpage_description = $post->description;
				$webpage_name = $post->title;
		  		$webpage_author = "Trancendances";
			} else {
		  		if(!empty($post)):
			  		$webpage_description = $post->description;
					$webpage_name = $post->title;
	  				$author['id'] = $post->author;
	 		 		$post_author = User::search($author);
	 	 			if(!empty($post_author)):
	 	 				$webpage_author = $post_author->real_name;
	 	 			endif;
	 	 		else:
	  				$webpage_description = NULL;
	  			endif;
			}
		endif;
	elseif($current_url != "/"): // Page
		$page = Page::slug($current_url);
		$status = "page";
		if(!empty($page)){
			if(page_custom_field('description')):
				$webpage_description = page_custom_field('description');
			endif;
			$webpage_name = $page->name;
		} else {
			$webpage_description = NULL;
	  	}
	endif;

?>
  <title><?php if(!empty($webpage_title)): echo $webpage_title; else:echo page_title('Adresse invalide'); endif; ?> - <?php echo site_name(); ?></title>


  <link rel="shortcut icon" href="themes/Trancendances/favicon.ico">
  <link rel="stylesheet" href="<?php echo theme_url('stylesheets/app.css'); ?>">
  <link rel="stylesheet" href="<?php echo theme_url('stylesheets/form.css'); ?>">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,900,100italic,100,300italic,400italic,500,500italic,700italic,900italic' rel='stylesheet' type='text/css'>
  <meta name="description" content="<?php if(!empty($webpage_description)): echo htmlspecialchars($webpage_description); else: echo "La Trance, vous connaissez ? Redécouvrez la musique électronique en compagnie de passionnés du genre !"; endif; ?>" />
  <meta name="author" content="<?php if(!empty($webpage_author)): echo $webpage_author; else: echo "Trancendances"; endif; ?>" />
  <meta name="identifier-url" content="http://www.trancendances.fr/" />
  <meta property="og:description" content="<?php if(!empty($webpage_description)): echo $webpage_description; else: echo "La Trance, vous connaissez ? Redécouvrez la musique électronique en compagnie de passionnés du genre !"; endif; ?>" />
  <meta property="og:url" content="https://www.trancendances.fr/<?php if($current_url != "/"): echo current_url(); endif; ?>" />
  <meta property="og:site_name" content="Trancendances"/>
  <meta property="og:image" content="https://www.trancendances.fr<?php if($category == "4") { echo article_custom_field('soiree_affiche', '/themes/Trancendances/images/website-thumbnail-default.jpg'); } else if(!empty($webpage_picture)) { echo $webpage_picture; } else { ?>/themes/Trancendances/images/website-thumbnail-default.jpg<?php } ?>" />
  <meta property="og:title" content="<?php if(!empty($webpage_name)): echo $webpage_name." - "; endif; ?>Trancendances" />
  <link rel="alternate" type="application/rss+xml"  href="https://files.trancendances.fr/podcasts.xml" title="Trancendances : L'émission">
<?php 
	/*if($category == "2"):
  ?>
	<meta property="og:type" content="movie">
        <meta property="og:video" content="https://www.mixcloud.com/media/swf/player/mixcloudLoader.swf?feed=<?php echo urlencode(article_custom_field('podcast_url')); ?>&amp;embed_uuid=51122040-3345-438e-ba4c-dec8a3bf8706&amp;replace=0&amp;hide_cover=1&amp;embed_type=widget_standard&amp;hide_tracklist=1&amp;autoplay=1"> 
        <meta property="og:video:type" content="application/x-shockwave-flash">
        <meta property="og:video:width" content="660">
        <meta property="og:video:height" content="230">
  <?php
	endif;*/
	if($status == "post"): ?>
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@Trancendances">
  <meta name="twitter:title" content="<?php if(!empty($post)): echo $post->title; elseif(!empty($category)): echo $category->title; endif; ?>">
  <meta name="twitter:description" content="<?php if(!empty($webpage_description)): echo $webpage_description; endif; ?>">
  <meta name="twitter:creator" content="@<?php if(!empty($post)): if($post->author == "1"): echo "BrenAbolivier"; elseif($post->author == "3"): echo "Supra263"; elseif($post->author == "4"): echo "StodeSound"; elseif($post->author == "6"): echo "AgeriusMusic"; else: echo "Trancendances"; endif; else: echo "Trancendances"; endif; ?>">
  <meta name="twitter:domain" content="www.trancendances.fr">
  <meta name="twitter:image:src" content="http://www.trancendances.fr/themes/Trancendances/images/casque.jpg" />

<?php endif; ?>
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDomains", ["*.www.trancendances.fr"]]);
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://analytics.trancendances.fr/piwik/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "2"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
  <script src="<?php echo theme_url("javascripts/vendor/custom.modernizr.js"); ?>"></script>


</head>
<body>
<header>
	<div>
		<a href="<?php echo base_url(); ?>" id="logo"></a>
	</div>
</header>
<nav class="top-bar">
  <ul class="title-area">
    <!-- Title Area -->
    <li class="name">
      <h1><a href="#"><?php echo site_name(); ?></a></h1>
    </li>
    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
  </ul>

<section class="top-bar-section">
    <!-- Left Nav Section -->
    <?php if(has_menu_items()): ?>
      <ul class="left">
        <?php while(menu_items()): ?>
        <?php if( (strpos(current_url(), "category/releases-reports") !== false && menu_name() == "Releases Report") || (strpos(current_url(), "news/releases-rep") !== false && menu_name() == "Releases Report") 
					|| (menu_name() == "Podcasts" && strpos(current_url(), "podcasts") !== false) || category_slug() == "podcasts" && menu_name() == "Podcasts" 
						|| (menu_name() == "Podcasts" && strpos(current_url(), "dark-side") !== false) || category_slug() == "dark-side" && menu_name() == "Podcasts" 
							|| (menu_name() == "Podcasts" && strpos(current_url(), "stode-friends-arena") !== false) || category_slug() == "stode-friends-arena" && menu_name() == "Podcasts" 
								|| (menu_name() == "Podcasts" && strpos(current_url(), "past-present") !== false) || category_slug() == "past-present" && menu_name() == "Podcasts" 
								    || (menu_name() == "Podcasts" && strpos(current_url(), "once-upon-a-time") !== false) || category_slug() == "once-upon-a-time" && menu_name() == "Podcasts" 
									    || (menu_name() == "Rejoignez-nous" && strpos(current_url(), "recrutement") !== false) || article_slug() == "trancendances-recrute" && menu_name() == "Rejoignez-nous" 
										    || (menu_name() == "Reviews" && strpos(current_url(), "reviews") !== false) || category_slug() == "reviews" && menu_name() == "Reviews" 
											    || (strpos(current_url(), "/agenda") !== false && menu_name() == "Agenda") || ($category == "4" && menu_name() == "Agenda")):?>
        <li class="active"><a href="<?php echo menu_url(); ?>" title="<?php echo menu_title(); ?>"><?php echo menu_name(); ?></a></li>
        <?php else: ?>
        <li <?php echo (menu_active() ? 'class="active"' : ''); ?>><a href="<?php echo menu_url(); ?>" title="<?php echo menu_title(); ?>"><?php echo menu_name(); ?></a></li>
        <?php endif; ?>
        <?php endwhile; ?>

      </ul>
    <?php endif; ?>

    <!-- Right Nav Section -->

  </section>
</nav>

<?php
	$status = 0;
	if(!empty($_GET["email"])) {
		$exists = false;
		$dbh = new PDO('mysql:host=localhost;dbname=trancendances2', 'trancendances2', 'MJSH8ctxGAEdK3JX');
		foreach($dbh->query("SELECT * FROM  newsletter_emails") as $email) {
			if($email['email'] == $_GET['email']) {
				$exists = true;
				$status = 2;
			}
		}
		if(!$exists) {
			$stmt = $dbh->prepare("INSERT INTO newsletter_emails (email) VALUES (:email)");
			$stmt->bindParam(':email', $_GET["email"]);
			$stmt->execute();
			exec("php /var/www/newsletters-trancendances/send/confirm-sender.php ".$_GET['email']);
			$status = 1;
		}
	}
?>

<div id="newsletter" style="width:35%;margin:auto;margin-top:20px;"></div>

<script type="text/javascript">
	var newsletter_block = document.getElementById("newsletter");
	newsletter_block.innerHTML = '';
	<?php if($status == 1) {?>newsletter_block.innerHTML += '<p style="text-align:center">Abonnement enregistré. Vous allez recevoir un e-mail de confirmation.</p>';<?php } else if($status == 2) { ?>
		newsletter_block.innerHTML += '<p style="text-align:center">Adresse déjà inscrite</p>';<?php } if($status == 0 || $status == 2) { ?>
		newsletter_block.innerHTML += '<p style="text-align:center"><label for="subs">Abonnez-vous à la newsletter mensuelle de Trancendances :</label></p><form method="GET" action="" style="text-align:right"><input type="email" name="email" id="subs" placeholder="Votre adresse e-mail" style="width:100%;float:left;margin-right:10px"/><button class="btn" type="submit" style="height:42px;padding: 0.50em 0.7em 0.7em;">Abonnement</button></form>';
	<?php } ?>
</script>
