<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JNews_Split_Tool
 */
Class JNews_Split_Tool
{
    private $tag_begin;
    private $tag_end;
    private $cache_content;
    private $result;
    private $sequence;
    public static $split_begin_flag = 'split_content';

    public function __construct($content, $begin, $end)
    {
        $this->cache_content = $content;
        $this->tag_begin = $begin;
        $this->tag_end = $end;
        $this->sequence = -1;

        $this->result = array(
            'before_content'    => '',
            'content'           => '',
            'after_content'     => ''
        );

        $this->start_split();
    }

    /**
     * Start Split Content
     */
    public function start_split()
    {
        $contents = preg_split('/(<' . $this->tag_begin . '.*?>)|(<\/' . $this->tag_end . '>)/', $this->cache_content, null, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $contents = array_map('trim', $contents);
        $contents = array_filter( $contents, 'strlen');

        $next_title = $next_content = false;
        $this->result['content'] = array();

        foreach($contents as $id => $content)
        {
            /** save content to appropriate location */
            if($next_title)
            {
                $this->result['content'][$this->sequence]['title'] = $content;
                $next_title = false;
            }

            if($next_content)
            {
                $this->result['content'][$this->sequence]['description'] = $content;
                $next_title = $next_content = false;
            }

            /** check tag */

            if($this->check_open_tag($content))
            {
                $next_title = true;
                $next_content = false;
                $this->sequence++;
            }

            if($this->check_close_tag($content))
            {
                $next_title = false;
                $next_content = true;
            }

            /** save before & after content split */

            if(!$next_title && !$next_content && $this->sequence === -1)
            {
                $this->result['before_content'] = $content;
            }

            if(!$next_title && !$next_content && $this->sequence > -1)
            {
                $this->result['after_content'] = $content;
            }
        }
    }

    /**
     * Check if tag is currently open
     *
     * @param $content
     * @return bool
     */
    public function check_open_tag($content)
    {
        preg_match('/(<' . $this->tag_begin . '.*?>)/', $content, $matches);
        return !empty($matches);
    }

    /**
     * Check if tag is closed
     *
     * @param $content
     * @return bool
     */
    public function check_close_tag($content)
    {
        preg_match('/(<\/' . $this->tag_end . '>)/', $content, $matches);
        return !empty($matches);
    }

    /**
     * Get All Result Including Before, after, and everything
     *
     * @return array
     */
    public function get_all_result()
    {
        return $this->result;
    }

    /**
     * Get All Current Title
     *
     * @return array
     */
    public function get_all_title()
    {
        $title = array();

        foreach($this->result['content'] as $content) {
            $title[] = $content['title'];
        }

        return $title;
    }

    /**
     * Get Content Before Splitting content
     *
     * @return mixed
     */
    public function get_before_content()
    {
        return $this->result['before_content'] .
            "<div id='" . self::$split_begin_flag . "'></div>";
    }

    /**
     * Get content on defined page
     *
     * @param $page
     * @return mixed
     */
    public function get_paged_content($page)
    {
        $max_size = $this->get_total_split();
        if($page > $max_size) $page = $max_size;

        return $this->result['content'][$page];
    }

    /**
     * Get total content
     *
     * @return int
     */
    public function get_total_split()
    {
        return sizeof($this->result['content']) - 1;
    }

    /**
     * Get current page title
     *
     * @param $page
     * @return mixed
     */
    public function get_current_title($page)
    {
        $content = $this->get_paged_content($page);
        return $content['title'];
    }

    /**
     * Check if content have split content
     *
     * @return bool
     */
    public function have_split_content()
    {
        return !empty($this->result['content']);
    }
}

