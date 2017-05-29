<?php
function podcasts_posts() {
      // only run on the first call
      if( ! Registry::has('trance_post_archive')) {
        // capture original article if one is set
        if($article = Registry::get('article')) {
          Registry::set('original_article', $article);
        }
      }
    
      if( ! $posts = Registry::get('trance_post_archive')) {
        $posts = Post::where('status', '=', 'published')->sort('created', 'desc')->get();
    
        Registry::set('trance_post_archive', $posts = new Items($posts));
      }
    
      if($result = $posts->valid()) {
        // register single post
        Registry::set('article', $posts->current());
    
        // move to next
        $posts->next();
      }
      else {
        // back to the start
        $posts->rewind();
    
        // reset original article
        Registry::set('article', Registry::get('original_article'));
    
        // remove items
        Registry::set('trance_post_archive', false);
      }
    
      return $result;
    }

/**
 * Sort posts by custom field 'date'
 * You have to call it 2 times: the first with param $end = FALSE
 * the second with param $end = TRUE
 * @param boolean $from_newest_to_oldest wheter should sort ascending or descending
 * @param booelan $end if true, resets the original order
 */
function sort_posts_by_date($from_newest_to_oldest = TRUE, $end = FALSE) {
    #restore old 'posts' value
    if ($end) {
        Registry::set('posts', Registry::get('old-posts'));
        Registry::set('old-posts', NULL);
    }
    #sort posts by 'date' custom field
    else {
		$soirees = Category::slug('soirees');
        list(, $posts) = Post::listing($soirees);

        usort($posts, function($a, $b) {
            $date_a = Extend::field('post', 'date', $a->data['id']);
            $date_b = Extend::field('post', 'date', $b->data['id']);

	    $hour_a = Extend::field('post', 'heure', $a->data['id']);
	    $hour_b = Extend::field('post', 'heure', $b->data['id']);

            #try to sort by date (from newest to oldest)
	    if (($date_a = $date_a->value->text." ".$hour_a->value->text) && ($date_b = $date_b->value->text." ".$hour_b->value->text)) {
		#uses American notation MM/DD/YYYY
		$date_a = strtotime($date_a);
		$date_b = strtotime($date_b);
		return $date_b > $date_a;
	    }
            #if at least one of the posts doesn't have a date, do nothing
            else return -1;
        });

        #if specified, reverse the order
        if (!$from_newest_to_oldest)
            $posts = array_reverse($posts);

        #lets you use 'posts()' as you normally would
        Registry::set('old-posts', Registry::get('posts')); 
        Registry::set('posts', new Items($posts));
    }
}
	
function rwar_latest_posts($limit = 3) {
    // only run on the first call
    if( ! Registry::has('rwar_latest_posts')) {
        // capture original article if one is set
        if($article = Registry::get('article')) {
            Registry::set('original_article', $article);
        }
    }

    if( ! $posts = Registry::get('rwar_latest_posts')) {
        $posts = Post::where('status', '=', 'published')
		->where('category', '<>', 4)
        ->sort('created', 'desc')
        ->take($limit)->get();

        Registry::set('rwar_latest_posts', $posts = new Items($posts));
    }

    if($result = $posts->valid()) {
        // register single post
        Registry::set('article', $posts->current());

        // move to next
        $posts->next();
    }
    else {
        // back to the start
        $posts->rewind();

        // reset original article
        Registry::set('article', Registry::get('original_article'));

        // remove items
        Registry::set('rwar_latest_posts', false);
    }


    return $result;
}

function rwar_posts_by_categories($slugs,$limit = 3) {
  // only run on the first call
  if( ! Registry::has('rwar_posts_by_categories')) {
    // capture original article if one is set
    if($article = Registry::get('article')) {
      Registry::set('original_article', $article);
    }
  }

  if( ! $posts = Registry::get('rwar_posts_by_categories')) {
    $posts = Post::where('status', '=', 'published');
    if (count($slugs) > 1) {
      foreach ($slugs as $slug) {
        $category = Category::slug($slug);
        $posts = $posts->or_where('category','=', $category->id);
      }
      $posts = $posts;
    } else {
      $category = Category::slug($slugs[0]);
      $posts = $posts->where('category','=', $category->id);
    }
    
    $posts = $posts->sort('created', 'desc')->take($limit)->get();
    Registry::set('rwar_posts_by_categories', $posts = new Items($posts));
  }

  if($result = $posts->valid()) {
    // register single post
    Registry::set('article', $posts->current());

    // move to next
    $posts->next();
  }
  else {
    // back to the start
    $posts->rewind();

    // reset original article
    Registry::set('article', Registry::get('original_article'));

    // remove items
    Registry::set('rwar_posts_by_categories', false);
  }

  return $result;
}

function post_list() {
  // only run on the first call
  if( ! Registry::has('rwar_post_archive')) {
    // capture original article if one is set
    if($article = Registry::get('article')) {
      Registry::set('original_article', $article);
    }
  }

  if( ! $posts = Registry::get('rwar_post_archive')) {
    $posts = Post::where('status', '=', 'published')->sort('created', 'desc')->get();

    Registry::set('rwar_post_archive', $posts = new Items($posts));
  }

  if($result = $posts->valid()) {
    // register single post
    Registry::set('article', $posts->current());

    // move to next
    $posts->next();
  }
  else {
    // back to the start
    $posts->rewind();

    // reset original article
    Registry::set('article', Registry::get('original_article'));

    // remove items
    Registry::set('rwar_post_archive', false);
  }

  return $result;
}

function article_category_id() {
  if($category = Registry::prop('article', 'category')) {
    $categories = Registry::get('all_categories');
    return $categories[$category]->id;
  }
}

/****************************************/
/*            FONCTIONS API             */
/****************************************/

function define_tab($element, $tab) {
	if($element == "podcasts") {
		while(podcasts_posts()) {
			if(article_category_slug() == "podcasts") {
				$url = article_custom_field("podcast_file");
				$type = get_headers($url, 1);
				$description = article_description();
		
				$titre = article_title();
				$description = article_description();
				$mimetype = $type['Content-Type'];
		
				libxml_use_internal_errors(true); // Désactive les erreurs dues à du HTML non valide
		
				$post = new DOMDocument();
				$post->loadHTML(article_markdown());
		
				$tracks = $post->getElementsByTagName('li');
				$tracklist = array(
					"length" => $tracks->length
				);
		
				for ($i = 0; $i < $tracks->length; $i++) { 
					$links = $tracks->item($i)->getElementsByTagName('a');
					$link = "";
					for ($j = 0; $j < $links->length; $j++) {
						$link = $links->item($j)->getAttribute('href');
					}
			
					$trackname = strtok($tracks->item($i)->nodeValue, "]"); 
					if($i != 0 && $i != ($tracks->length)-1){
						$trackname = $trackname."]";
					}
			
					$track = array(
						"trackname" => $trackname,
						"link" => $link
					);
			
					array_push($tracklist, $track);
				}
		
				$episode = array(
					"name" => $titre,
					"description" => $description,
					"tracklist" => $tracklist,
					"direct_link" => $url,
					"mimetype" => $mimetype
				);
		
				array_push($tab, $episode);
			}
		}
	}
	
	return $tab;
}

?>
