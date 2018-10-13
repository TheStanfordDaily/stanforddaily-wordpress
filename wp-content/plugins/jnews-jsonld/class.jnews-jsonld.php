<?php
/**
 * @author : Jegtheme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JNews
 */
Class JNews_JSONLD
{
    private static $instance;
    private $json_header = array();
    private $json_archive = array();
    private $archive_id = array();

    /**
     * @return JNews_JSONLD
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct()
    {
        add_action('wp_head', array($this, 'build_json_header'), 20);
        add_action('wp_head', array($this, 'render_head'), 80);
        add_action('wp_footer', array($this, 'render_foot'), 80);
        add_action('jnews_json_archive_push', array($this, 'push_archive'), null, 1);
    }

    public function push_archive($post_id)
    {
        if(is_front_page())
        {
            $item = array(
                '@type' => 'ListItem',
                'position' => sizeof($this->json_archive) + 1,
                'item' => array(
                    'name' => get_the_title($post_id),
                    '@id' => get_the_permalink($post_id),
                    'url' => get_post_permalink($post_id)
                )
            );

            if(has_post_thumbnail($post_id))
            {
                $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                $image_size = wp_get_attachment_image_src($post_thumbnail_id, $post_id);
                $item['item']['image'] = $image_size[0];
            }

            if(!in_array($post_id, $this->archive_id))
            {
                array_push($this->json_archive, $item);
                $this->archive_id[] = $post_id;
            }
        }
    }

    public function build_json_header()
    {
        if(is_front_page())
        {
            $scheme_type = jnews_get_option('main_schema_type', 'organization');

            if($scheme_type === 'organization')
            {
                $organization = array(
                    '@context' => 'http://schema.org',
                    '@type' => 'Organization',
                    '@id' => site_url('/#organization'),
                    'url' => site_url('/'),
                    'name' => jnews_get_option('main_schema_organization_name', ''),
                    'logo' => jnews_get_option('main_schema_logo', ''),
                    'sameAs' => apply_filters('jnews_json_ld_social', array())
                );

                // contact
                $telephone = jnews_get_option('main_scheme_telp', '');
                if(!empty($telephone))
                {
                    $contact = array();
                    $contact['@type'] = 'ContactPoint';
                    $contact['telephone'] = $telephone;
                    $contact['contactType'] = jnews_get_option('main_scheme_contact_type', 'Customer Service');

                    $area = jnews_get_option('main_scheme_area', '');
                    if (!empty($area)) {
                        $contact['areaServed'] = explode(',', $area);
                    }

                    $organization['contactPoint'] = $contact;
                }

                array_push($this->json_header, $organization);

            } else if($scheme_type === 'person')
            {
                $person = array(
                    '@context' => 'http://schema.org',
                    '@type' => 'Person',
                    'url' => site_url('/'),
                    'name' => jnews_get_option('main_schema_person_name', ''),
                    'sameAs' => apply_filters('jnews_json_ld_social', array())
                );

                $country = jnews_get_option('main_scheme_person_address', '');
                if($country) {
                    $person['homeLocation'] = array(
                        '@type' => 'Place',
                        'address' => array(
                            '@type' => 'PostalAddress',
                            'addressCountry' => jnews_get_option('main_scheme_person_address', ''),
                        )
                    );
                }

                array_push($this->json_header, $person);
            }
        }

        $organization = array(
            '@context' => 'http://schema.org',
            '@type' => 'WebSite',
            '@id' => site_url('/#website'),
            'url' => site_url('/'),
            'name' => jnews_get_option('main_schema_organization_name', ''),
            'potentialAction' => array(
                '@type'         => 'SearchAction',
                'target'        => site_url('/?s={search_term_string}'),
                'query-input'   => 'required name=search_term_string',
            )
        );

        array_push($this->json_header, $organization);
    }

    public function render_head()
    {
        if($this->json_header)
        {
            foreach($this->json_header as $id => $json_ld)
            {
                $this->print_json_ld($json_ld);
                unset($this->json_header[$id]);
            }
        }
    }

    public function get_author_social_url($author_id){
        $socials = array("url","facebook","twitter","googleplus","linkedin","pinterest","behance","github","flickr","tumblr","dribbble","soundcloud","instagram","vimeo","youtube","vk","reddit","weibo","rss");
        $social_url = array();
        foreach($socials as $social) {
            if(get_the_author_meta( $social, $author_id )) {
                $social_url[] = get_the_author_meta( $social, $author_id );
            }
        }

        return $social_url;
    }

    public function render_foot()
    {
        global $wp;
        $current_url = add_query_arg( $wp->query_string, '', home_url() );

        // render archive
        $this->json_archive = apply_filters('jnews_json_archive', $this->json_archive);

        if(!empty($this->json_archive))
        {
            $archive = array(
                '@context' => 'http://schema.org',
                '@type' => 'ItemList',
                'url' => $current_url,
                'itemListElement' => $this->json_archive
            );

            $this->print_json_ld($archive);
        }

        // render post
        global $wp_query;

        if(isset($wp_query->post->ID))
        {
            $post_id = $wp_query->post->ID;
            $post = get_post($post_id);
            $author_id = $post->post_author;

            if(is_single() && get_post_type($post_id) === 'post')
            {
                $single = array(
                    '@context' => 'http://schema.org',
                    '@type' => jnews_get_option('article_schema_type', 'article'),
                    'mainEntityOfPage' => array(
                        '@type' => 'WebPage',
                        '@id' => get_the_permalink($post)
                    ),
                    'dateCreated' => get_the_date('Y-m-d H:i:s', $post),
                    'datePublished' => get_the_date('Y-m-d H:i:s', $post),
                    'dateModified' => get_post_modified_time('Y-m-d H:i:s', $post),
                    'url' => get_the_permalink($post),
                    'headline' => get_the_title($post),
                    'name' => get_the_title($post),
                    'articleBody' => $post->post_content,
                    'author' => array(
                        '@type' => 'Person',
                        'name' => get_the_author_meta('display_name', $author_id),
                        'url' => get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ),
                    ),
                );

                $author_social = $this->get_author_social_url($author_id);
                if(!empty($author_social)) {
                    $single['author']['sameAs'] = $author_social;
                }


                $categories = get_the_category($post_id);
                if(!empty($categories))
                {
                    $single['articleSection'] = array();
                    foreach($categories as $category){
                        $single['articleSection'][] = $category->name;
                    }
                }

                // Post thumbnail
                if(has_post_thumbnail())
                {
                    $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                    $image_size = wp_get_attachment_image_src($post_thumbnail_id, $post_id);

                    $single['image'] = array(
                        '@type' => 'ImageObject',
                        'url' => $image_size[0],
                        'width' => $image_size[1],
                        'height' => $image_size[2],
                    );
                }

                // Publisher
                $scheme_type = jnews_get_option('main_schema_type', 'organization');

                if($scheme_type === 'organization') {
                    $name = jnews_get_option('main_schema_organization_name', '');
                } else {
                    $name = jnews_get_option('main_schema_person_name', '');
                }

                $single['publisher'] = array(
                    '@type' => 'Organization',
                    'name'  => $name,
                    'url'   => home_url(),
                    'logo'  => array(
                        '@type' => 'ImageObject',
                        'url' => jnews_get_option('main_schema_logo', '')
                    ),
                    'sameAs' => apply_filters('jnews_json_ld_social', array())
                );

                $logo = jnews_get_option('main_schema_logo', '');

                if(!empty($logo)) {
                    $single['publisher']['logo'] = array(
                        '@type' => 'ImageObject',
                        'url' => $logo
                    );
                }

                // review
                if(vp_metabox('jnews_review.enable_review', false, $post_id))
                {
                    $single['@type'] = 'Review';
                    $single['itemReviewed'] = array(
                        '@type' => 'Product',
                        'name' => vp_metabox('jnews_review.name', null, $post_id),
                    );
                    $single['reviewRating'] = array(
                        '@type' => 'Rating',
                        'worstRating' => 1,
                        'bestRating' => 10,
                        'ratingValue' => get_post_meta($post_id, 'jnew_rating_mean', true)
                    );
                    $single['reviewBody'] = $single['articleBody'];
                    unset($single['articleBody']);
                    unset($single['articleSection']);
                }

                $this->print_json_ld($single);
            }


            // is page
            if(get_post_type($post_id) === 'page')
            {
                $single = array(
                    '@context' => 'http://schema.org',
                    '@type' => 'Webpage',
                    'headline' => get_the_title($post),
                    'url' => get_the_permalink($post),
                );

                // Post thumbnail
                if(has_post_thumbnail())
                {
                    $post_thumbnail_id = get_post_thumbnail_id( $post_id );
                    $image_size = wp_get_attachment_image_src($post_thumbnail_id, $post_id);

                    $single['image'] = array(
                        '@type' => 'ImageObject',
                        'url' => $image_size[0],
                        'width' => $image_size[1],
                        'height' => $image_size[2],
                    );
                }

                $this->print_json_ld($single);
            }
        }

        // render breadcrumb
        $breadcrumb = apply_filters('jnews_breadcrumb_schema', array());

        if(is_array($breadcrumb) && !empty($breadcrumb))
        {
            $breadcrumb_array = array();
            foreach($breadcrumb as $key => $trail)
            {
                if(empty($trail['url'])) {
                    $trail['url'] = $current_url;
                }
                $breadcrumb_array[] = array(
                    '@type' => 'ListItem',
                    'position' => sizeof($breadcrumb_array) + 1,
                    'item' => array(
                        '@id' => $trail['url'],
                        'name' => $trail['title'],
                    )
                );
            }

            $breadcrumb_schema = array(
                '@context' => 'http://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => $breadcrumb_array
            );

            $this->print_json_ld($breadcrumb_schema);
        }
    }

    public function print_json_ld($json)
    {
        if(jnews_get_option('enable_schema', 1)) {
            echo "<script type='application/ld+json'>" . wp_json_encode($json) . "</script>\n";
        }
    }

}