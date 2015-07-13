<?php namespace app\Repositories;

use app\Post;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;

/**
 * Class PostRepository
 * @author Petross Simon <ssemwezi.s@gmail.com>
 * @package app\Repositories
 */
class PostRepository
{

    public function __construct(
        Post $post,
        Dispatcher $event,
        PhotoRepositoryInterface $photoRepositoryInterface,
        ConnectionRepository $connectionRepository,
        NotificationReceiverRepository $notificationReceiverRepository,
        NotificationRepository $notificationRepository,
        Repository $cache,
        HashtagRepository $hashtagRepository,
        Filesystem $filesystem
    )
    {
        $this->model = $post;
        $this->event = $event;
        $this->photoRepository = $photoRepositoryInterface;
        $this->connectionRepository = $connectionRepository;
        $this->notificationReceiver = $notificationReceiverRepository;
        $this->notification = $notificationRepository;
        $this->hashtagRepository = $hashtagRepository;
        $this->cache = $cache;
        $this->file = $filesystem;
    }

    /**
     * Method to find a post by its ID
     *
     * @param int $id
     * @return \app\Models\Post
     */
    public function findById($id)
    {
        return $this->model->with('user')->where('id', '=', $id)->first();
    }

    /**
     * Method to links from a text
     *
     * @param string $text
     * @return array
     */
    public function getLinks($text)
    {
        $links = array();

        $text = preg_replace("#www\.#", "http://www.", $text);
        $text = preg_replace("#http://http://www\.#", "http://www.", $text);
        $text = preg_replace("#https://http://www\.#", "https://www.", $text);
        $reg_url = "!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i";

        if (preg_match_all($reg_url, $text, $aMatch)) {
            $match = $aMatch[0];
            foreach ($match as $url) {
                $links[] = $url;
            }
        }

        return $links;
    }

    public function turnLinks($text)
    {
        return AutoLinkUrls($text);
        //return preg_replace('@(http)?(s)?(://)?(([-\w]+\.)+([^\s]+)+[^,\s])@', '<a onclick=\'return window.open("http$2://$4")\' href="javascript:void(0)">$1$2$3$4</a>', $text);
    }

    /**
     * Method to get url details
     *
     * @param string $link
     * @param bool $doImage
     * @return array
     */
    public function getLinkDetails($link, $doImage = false)
    {
        $result = [
            'title' => '',
            'description' => '',
            'image' => '',
            'link' => $link
        ];

        try {
            $urlContent = @file_get_contents($link);
            ///$urlContent = iconv("Windows-1252","UTF-8",$urlContent);
            $dom = new \DOMDocument("4.01", 'UTF-8');
            @$dom->loadHTML('<meta http-equiv="content-type" content="text/html; charset=utf-8">' . $urlContent);
            $title = $dom->getElementsByTagName('title');


            //once the page does not have title the url is invalid from here
            if ($title->length < 1) return $result;

            $result['title'] = $title->item(0)->nodeValue;
            $description = null;
            $metas = $dom->getElementsByTagName('meta');
            for ($i = 0; $i < $metas->length; $i++) {
                $meta = $metas->item($i);
                if ($meta->getAttribute('name') == 'description') {
                    $result['description'] = $meta->getAttribute('content');
                }
            }

            if (empty($result['description'])) {
                //lets try the facebook
                preg_match('#<meta property="og:description" content="(.*?)" \/>|<meta content="(.*?)" property="og:description" \/>#',
                    $urlContent, $matches);
                if ($matches) {
                    if (isset($matches[1]) and $matches[1]) {
                        $result['description'] = $matches[1];
                    } else {
                        $result['description'] = $matches[2];
                    }
                }

            }

            //images
            $image = null;
            $result['image'] = null;

            if ($doImage) {
                $images = [];

                if (preg_match('#google\.com#', $link)) {
                    //$images[] = 'http://www.google.com.ng/images/google_favicon_128.png';
                }

                //lets first get site that favour facebook because the images are gooder
                preg_match('#<meta property="og:image" content="(.*?)" \/>|<meta content="(.*?)" property="og:image" \/>#',
                    $urlContent, $matches);

                if ($matches) {
                    if (isset($matches[1]) and $matches[1] and preg_match('#http://|https://#', $matches[1])) {
                        if ($this->checkRemoteFile($matches[1])) $images[] = $matches[1];
                    } else {
                        if (preg_match('#http://|https://#', $matches[2]) and $this->checkRemoteFile($matches[2])) $images[] = $matches[2];
                    }
                }

                //now lets search for more images through there <img element
                $imgElements = $dom->getElementsByTagName('img');
                for ($i = 0; $i < $imgElements->length; $i++) {
                    $cImg = $imgElements->item($i);
                    if (count($images) <= 5 and preg_match("#http:\/\/|https:\/\/#", $cImg->getAttribute('src'))) {
                        if ($this->checkRemoteFile($cImg->getAttribute('src'))) $images[] = $cImg->getAttribute('src');
                    }
                }

                $result['image'] = array_reverse($images);
            }


        } catch (Exception $e) {
            ///silent ignore it
        }
        return $result;

    }


    /**
     * Method to update post text
     *
     * @param $id
     * @param $text
     * @return Post|bool
     */
    public function updateText($id, $text)
    {
        $post = $this->findById($id);

        if ($post->user_id != \Auth::user()->id) {
            if (!\Auth::user()->isAdmin()) return false;
        }

        if ($post) {
            if ($post->text != $text) {
                $post->edited = 1;
            }
            $post->text = sanitizeText($text);

            $post->save();

            $this->event->fire('post.edit', [$post]);

            return $post;
        }

        return false;
    }

}