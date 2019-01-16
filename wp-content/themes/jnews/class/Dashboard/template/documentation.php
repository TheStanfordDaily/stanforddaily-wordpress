<?php
$videos = array(
    array(
        'id' => '1Yl_cAe2Egk',
        'name'  => esc_html__('How to Install JNews via WordPress', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/1Yl_cAe2Egk/hqdefault.jpg',
    ),
    array(
        'id' => 'FP3gq-DbdoQ',
        'name' => esc_html__('How to Install JNews via FTP', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/FP3gq-DbdoQ/hqdefault.jpg',
    ),
    array(
        'id' => 'JO6N-CCrw2k',
        'name'  => esc_html__('How to Update JNews via WordPress', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/JO6N-CCrw2k/hqdefault.jpg',
    ),
    array(
        'id' => 'aIX6N4E9a5A',
        'name'  => esc_html__('How to Update JNews via FTP', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/aIX6N4E9a5A/hqdefault.jpg',
    ),
    array(
        'id' => 'HSwh51SKBRo',
        'name'  => esc_html__('JNews System Status', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/HSwh51SKBRo/hqdefault.jpg',
    ),
    // array(
    //     'id' => 'ky2PhVM_jJA',
    //     'name'  => 'How to Install Plugin with JNews',
    //     'thumb' => 'https://i.ytimg.com/vi/ky2PhVM_jJA/hqdefault.jpg',
    // ),
    array(
        'id' => 'bNfdYHJ4Hw4',
        'name'  => esc_html__('How to Setup JNews Translation', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/bNfdYHJ4Hw4/hqdefault.jpg',
    ),
    array(
        'id' => 'sCr8KohYmxQ',
        'name'  => esc_html__('How to Setup JNews Font', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/sCr8KohYmxQ/hqdefault.jpg',
    ),
    array(
        'id' => '2eIhfdD9uJU',
        'name'  => esc_html__('How to Setup Comments', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/2eIhfdD9uJU/hqdefault.jpg',
    ),
    array(
        'id' => '1dmOsQTW9Vo',
        'name'  => esc_html__('How to Setup JNews Split Post', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/1dmOsQTW9Vo/hqdefault.jpg',
    ),
    // array(
    //     'id' => 'OvBhTVAhRwE',
    //     'name'  => 'How to Setup JNews Breadcrumb',
    //     'thumb' => 'https://i.ytimg.com/vi/OvBhTVAhRwE/hqdefault.jpg',
    // ),
    // array(
    //     'id' => 'R-rL2FIrQVg',
    //     'name'  => 'How to Setup JNews Auto Load Post',
    //     'thumb' => 'https://i.ytimg.com/vi/R-rL2FIrQVg/hqdefault.jpg',
    // ),
    // array(
    //     'id' => 'oo0hsUJrtHU',
    //     'name'  => 'How to Setup JNews Like Post',
    //     'thumb' => 'https://i.ytimg.com/vi/oo0hsUJrtHU/hqdefault.jpg',
    // ),
    // array(
    //     'id' => 'GXMvvZDM50E',
    //     'name'  => 'How to Setup JNews Review Post',
    //     'thumb' => 'https://i.ytimg.com/vi/GXMvvZDM50E/hqdefault.jpg',
    // ),
    array(
        'id' => 'd5rNUB6qDu0',
        'name'  => esc_html__('How to Setup JNews Page Loop', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/d5rNUB6qDu0/hqdefault.jpg',
    ),
    array(
        'id' => 'mldLr8W5m7U',
        'name'  => esc_html__('How to Manage JNews Widget', 'jnews'),
        'thumb' => 'https://i.ytimg.com/vi/mldLr8W5m7U/hqdefault.jpg',
    ),
    // array(
    //     'id' => 'DskABsDtVi0',
    //     'name'  => 'How to Setup JNews Gallery',
    //     'thumb' => 'https://i.ytimg.com/vi/DskABsDtVi0/hqdefault.jpg',
    // ),
    // array(
    //     'id' => 'Z5pI6ReOqlM',
    //     'name'  => 'How to Manage JNews Menu Locations',
    //     'thumb' => 'https://i.ytimg.com/vi/Z5pI6ReOqlM/hqdefault.jpg',
    // ),
    // array(
    //     'id' => 'BGoIxGggsfc',
    //     'name'  => 'JNews Import Demo & Style',
    //     'thumb' => 'https://i.ytimg.com/vi/BGoIxGggsfc/hqdefault.jpg',
    // )
);
?>
<div class="jnews-wrap wrap about-wrap jnews-documentation jnews-video-documentation about-wrap">

    <h1 class="jnews-title"><?php esc_html_e('Video Documentation', 'jnews'); ?></h1>

    <div class="about-text">
        <?php echo wp_kses(__('We would like to thank you for purchasing JNews! Before you get started, please be sure to always take a look at our Documentation and also watch our integrated Video Tutorials.', 'jnews'),wp_kses_allowed_html()) ?>
    </div>

    <div class="video-holder">
        <div class="video-container">
            <div class="video-container-holder"></div>
        </div>
    </div>

    <div class="video-wrapper">
        <?php
            $videos = array_chunk($videos, 3);
            $video_html = '';
            foreach($videos as $chunk)
            {
                $video_html .= "<div class='jnews_video_block three-col'>";

                foreach($chunk as $video)
                {
                    $video_html .=
                    "<div class='col'>
                        <div class='video-item' data-video='" . esc_attr($video['id']) . "'>
                            <div class='video-play'>
                                <i class='fa'></i>
                            </div>                            
                            {$video['name']}
                        </div>                        
                    </div>";
                }

                $video_html .= "</div>";
            }

            echo jnews_sanitize_output($video_html);
        ?>
    </div>

</div>