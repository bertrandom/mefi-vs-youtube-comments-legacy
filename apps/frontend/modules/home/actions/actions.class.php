<?php

/**
 * home actions.
 *
 * @package    comments
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class homeActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

		$cache = new sfArrayCache(sfConfig::get('sf_cache_dir'));
		$cache->setLifeTime(86400); // convert to seconds
		
		$this->feeds = $cache->get('feeds', 'my_cache_dir');
		
		// test for empty or timed out cache
		if ($this->feeds === null)
		{
		    // rebuild the cache

			$this->feeds = array(
				'metafilter' => array(),
				'youtube' => array()					
			);

		    $youtubefeed = sfFeedPeer::createFromWeb('http://pipes.yahoo.com/pipes/pipe.run?_id=65f6799934bcd1d35e84c0f6eab9984f&_render=rss');
				
			foreach ($youtubefeed->getItems() as $item) {
				$this->feeds['youtube'][] = $item->getDescription();
			}

            $posts = array();
            
            $metafilterfeed = sfFeedPeer::createFromWeb('http://feeds2.feedburner.com/Metafilter');
            foreach ($metafilterfeed->getItems() as $item) {
            	$posts[] = $item->getLink() . '/rss';
            }
            
            foreach ($posts as $post) {

                try {

                    $feed = sfFeedPeer::createFromWeb($post);
                
                    foreach ($feed->getItems() as $item) {
        				$this->feeds['metafilter'][] = $item->getDescription();
                    }

                } catch (Exception $e) {
                    // Looks like the feed doesn't exist yet / couldn't be retrieved, ignoring...
                }
            
            }    

		    // set the cache
		    $cache->set('feeds', 'my_cache_dir', $this->feeds);
		}
		
		shuffle($this->feeds['metafilter']);
		shuffle($this->feeds['youtube']);

  }

}