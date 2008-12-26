<?php

class Feed {
	function getArticles($blog_url) {
		$ns = array
		(
						'content' => 'http://purl.org/rss/1.0/modules/content/',
						'wfw' => 'http://wellformedweb.org/CommentAPI/',
						'dc' => 'http://purl.org/dc/elements/1.1/'
		);

		// obtain the articles in the feeds, and construct an array of articles

		$articles = array();

		// step 1: get the feed
		$rawFeed = file_get_contents($blog_url);
		$xml = new SimpleXmlElement($rawFeed);

		// step 2: extract the channel metadata

		$channel = array();
		$channel['title']       = $xml->channel->title;
		$channel['link']        = $xml->channel->link;
		$channel['description'] = $xml->channel->description;
		$channel['pubDate']     = $xml->pubDate;
		$channel['timestamp']   = strtotime($xml->pubDate);
		$channel['generator']   = $xml->generator;
		$channel['language']    = $xml->language;

		// step 3: extract the articles

		foreach ($xml->channel->item as $item)
		{
			$article = array();
			$article['channel'] = $blog;
			$article['title'] = $item->title;
			$article['link'] = $item->link;
			$article['comments'] = $item->comments;
			$article['pubDate'] = $item->pubDate;
			$article['timestamp'] = strtotime($item->pubDate);
			$article['description'] = (string) trim($item->description);
			$article['isPermaLink'] = $item->guid[‘isPermaLink’];

			// get data held in namespaces
			$content = $item->children($ns['content']);
			$dc      = $item->children($ns['dc']);
			$wfw     = $item->children($ns['wfw']);

			$article['creator'] = (string) $dc->creator;
			foreach ($dc->subject as $subject)
							$article['subject'][] = (string)$subject;

			$article['content'] = (string)trim($content->encoded);
			$article['commentRss'] = $wfw->commentRss;

			// add this article to the list
			$articles[$article['timestamp']] = $article;
		}
		
		return array($channel, $articles)
	}
}

?>
