<?php
declare(strict_types=1); // must be first line


namespace kdaviesnz\newsfeed;


use GuzzleHttp\Client;

class Newsfeed implements INewsfeed
{

    private $items = array();

    /**
     * Newsfeed constructor.
     * @param string $items
     */
    public function __construct()
    {
        $items = array();

        // NZ Herald top stories
        $NZHeraldTopStoriesfeed = new \SimplePie();
        $NZHeraldTopStoriesfeed->set_feed_url("feed://rss.nzherald.co.nz/rss/xml/nzhtsrsscid_000000698.xml");
        $NZHeraldTopStoriesfeed->init();
        $NZHeraldTopStoriesfeed->handle_content_type();
        $items["NZHerald"] = array();
        $items["NZHerald"]["top_stories"] = $this->getItems($NZHeraldTopStoriesfeed);

        // NZ Herald NZ news
        $NZHeraldNZNewsfeed = new \SimplePie();
        $NZHeraldNZNewsfeed->set_feed_url("feed://rss.nzherald.co.nz/rss/xml/nzhrsscid_000000001.xml");
        $NZHeraldNZNewsfeed->init();
        $NZHeraldNZNewsfeed->handle_content_type();
        $items["NZHerald"]["NZNews"] = $this->getItems($NZHeraldNZNewsfeed);

        // NZ Herald business news
        $NZHeraldNZBusinessNewsfeed = new \SimplePie();
        $NZHeraldNZBusinessNewsfeed->set_feed_url("feed://rss.nzherald.co.nz/rss/xml/nzhrsscid_000000003.xml");
        $NZHeraldNZBusinessNewsfeed->init();
        $NZHeraldNZBusinessNewsfeed->handle_content_type();
        $items["NZHerald"]["NZBusinessNews"] = $this->getItems($NZHeraldNZBusinessNewsfeed);

        // NZ Herald entertainment news
        $NZHeraldNZEntertainmentNewsfeed = new \SimplePie();
        $NZHeraldNZEntertainmentNewsfeed->set_feed_url("feed://rss.nzherald.co.nz/rss/xml/nzhrsscid_001501119.xml");
        $NZHeraldNZEntertainmentNewsfeed->init();
        $NZHeraldNZEntertainmentNewsfeed->handle_content_type();
        $items["NZHerald"]["NZEntertainmentNews"] = $this->getItems($NZHeraldNZEntertainmentNewsfeed);

        // NZ Herald world news
        $NZHeraldNZWorldNewsfeed = new \SimplePie();
        $NZHeraldNZWorldNewsfeed->set_feed_url("feed://rss.nzherald.co.nz/rss/xml/nzhrsscid_000000002.xml");
        $NZHeraldNZWorldNewsfeed->init();
        $NZHeraldNZWorldNewsfeed->handle_content_type();
        $items["NZHerald"]["NZWorldNews"] = $this->getItems($NZHeraldNZWorldNewsfeed);

        // NZ Herald technology news
        $NZHeraldNZTechnologyNewsfeed = new \SimplePie();
        $NZHeraldNZTechnologyNewsfeed->set_feed_url("feed://rss.nzherald.co.nz/rss/xml/nzhrsscid_000000005.xml");
        $NZHeraldNZTechnologyNewsfeed->init();
        $NZHeraldNZTechnologyNewsfeed->handle_content_type();
        $items["NZHerald"]["NZTechnologyNews"] = $this->getItems($NZHeraldNZTechnologyNewsfeed);

        // NZ Herald lifestyle news
        $NZHeraldNZLifestyleNewsfeed = new \SimplePie();
        $NZHeraldNZLifestyleNewsfeed->set_feed_url("feed://rss.nzherald.co.nz/rss/xml/nzhrsscid_000000006.xml");
        $NZHeraldNZLifestyleNewsfeed->init();
        $NZHeraldNZLifestyleNewsfeed->handle_content_type();
        $items["NZHerald"]["NZLifestyleNews"] = $this->getItems($NZHeraldNZLifestyleNewsfeed);

        // Breitbart
        $breitbartItems = new \SimplePie();
        $breitbartItems->set_feed_url("http://feeds.feedburner.com/breitbart");
        $breitbartItems->init();
        $breitbartItems->handle_content_type();
        $items["Breitbart"] = $this->getItems($breitbartItems);

        // The Guardian
        $GuardianNewsfeed = new \SimplePie();
        $GuardianNewsfeed->set_feed_url("https://www.theguardian.com/uk/rss");
        $GuardianNewsfeed->init();
        $GuardianNewsfeed->handle_content_type();
        $items["theGuardian"] = $this->getItems($GuardianNewsfeed);

        // BBC
        $BBCNewsfeed = new \SimplePie();
        $BBCNewsfeed->set_feed_url("http://feeds.bbci.co.uk/news/rss.xml?edition=int");
        $BBCNewsfeed->init();
        $BBCNewsfeed->handle_content_type();
        $items["BBC"] = $this->getItems($BBCNewsfeed);

        // Frontpagemag
        $FrontpageMagfeed = new \SimplePie();
        $FrontpageMagfeed->set_feed_url("feed://www.frontpagemag.com/fpm/rss.xml");
        $FrontpageMagfeed->init();
        $FrontpageMagfeed->handle_content_type();
        $items["frontpagemag"] = $this->getItems($FrontpageMagfeed);

        // Kiwiblog
        $kiwiblogfeed = new \SimplePie();
        $kiwiblogfeed->set_feed_url("https://www.kiwiblog.co.nz/feed");
        $kiwiblogfeed->init();
        $kiwiblogfeed->handle_content_type();
        $items["kiwiblog"] = $this->getItems($kiwiblogfeed);


        // TheStandard
        $theStandardfeed = new \SimplePie();
        $theStandardfeed->set_feed_url("http://feeds.feedburner.com/org/KRXy");
        $theStandardfeed->init();
        $theStandardfeed->handle_content_type();
        $items["theStandard"] = $this->getItems($theStandardfeed);

        // Karl
        $karlfeed = new \SimplePie();
        $karlfeed->set_feed_url("http://karldufresne.blogspot.com/feeds/posts/default");
        $karlfeed->init();
        $karlfeed->handle_content_type();
        $items["karl"] = $this->getItems($karlfeed);

        // Stuff
        $stuffFeed = new \SimplePie();
        $stuffFeed->set_feed_url("https://www.stuff.co.nz/rss/");
        $stuffFeed->init();
        $stuffFeed->handle_content_type();
        $items["stuff"] = $this->getItems($stuffFeed);

        // Radio NZ
        $radioNZFeed = new \SimplePie();
        $radioNZFeed->set_feed_url("http://www.radionz.co.nz/rss/news");
        $radioNZFeed->init();
        $radioNZFeed->handle_content_type();
        $items["radioNZ"] = $this->getItems($radioNZFeed);

        $this->items = $items;

        // http://www.newshub.co.nz/home/latest-news.html
        // http://www.newshub.co.nz/home.include.L2NvbnRlbnQvbmV3c2h1Yi9iZWx0cy9zaW5nbGUvYWxsL2xhdGVzdC1uZXdzLWJlbHQtNDAtbGltaXQvamNyOmNvbnRlbnQvYmVsdC5kaXJlY3REcmF3.html
    }

    public function __toString():string
    {
        return json_encode($this->items);
    }

    private function getItems(\SimplePie $feed):array
    {
        $items = array();
        foreach ($feed->get_items() as $item) {
            $items[] = array(
                "link" =>  str_replace("&amp;", "&", $item->get_permalink()),
                "title" => $item->get_title(),
                "description" => $item->get_description(),
                "date" => $item->get_date('Y-m-d H:i:s')
            );
        }
        return $items;

    }


}