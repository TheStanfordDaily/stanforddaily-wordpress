<?php
/**
* @author : Jegtheme
*/
namespace JNews\Customizer;
use JNews\Archive\AuthorArchive;
use JNews\Archive\IndexArchive;
use JNews\Archive\NotFoundArchive;
use JNews\Archive\SearchArchive;
use JNews\Archive\SingleArchive;

/**
 * Class Theme JNews Customizer
 */
Class ArchiveOption extends CustomizerOptionAbstract
{
    public function set_option()
    {
        $this->set_panel();
        $this->set_section();
    }

    public function set_panel()
    {
        /** panel */
        $this->customizer->add_panel(array(
            'id'            => 'jnews_archive',
            'title'         => esc_html__( 'JNews : Other Template', 'jnews' ),
            'description'   => esc_html__( 'JNews template for archive, search and author.', 'jnews' ),
            'priority'      => $this->id
        ));
    }

    public function set_section()
    {
        $this->add_lazy_section('jnews_archive_index_section', esc_html__('Index Template','jnews'), 'jnews_archive');
        $this->add_lazy_section('jnews_archive_global_section', esc_html__('Archive Template','jnews'), 'jnews_archive');
        $this->add_lazy_section('jnews_archive_search_section', esc_html__('Search Template','jnews'), 'jnews_archive');
        $this->add_lazy_section('jnews_archive_author_section', esc_html__('Author Template','jnews'), 'jnews_archive');
        $this->add_lazy_section('jnews_archive_attachment_section', esc_html__('Attachment Template','jnews'), 'jnews_archive');
        $this->add_lazy_section('jnews_archive_notfound_section', esc_html__('404 (Not Found) Template','jnews'), 'jnews_archive');

        if(function_exists('is_woocommerce')){
            $this->add_lazy_section('jnews_archive_woocommerce_section', esc_html__('WooCommerce Template','jnews'), 'jnews_archive');
        }

        if(function_exists('is_bbpress')){
            $this->add_lazy_section('jnews_archive_bbpress_section', esc_html__('BBPress Template','jnews'), 'jnews_archive');
        }
    }
}