<?php
$plugin_instance = $instance->get_tgm_instance()->plugins[$plugin['slug']];
$plugin_activated = $instance->get_tgm_instance()->is_plugin_active($plugin['slug']);
$plugin_installed = $instance->get_tgm_instance()->is_plugin_installed($plugin['slug']);
$plugin_description = $plugin_author = $ribbon_text = '';
$require_update = false;
$current_version = '1.0.0';
$item_class = 'not-installed';

if($plugin_installed)
{
    $item_class = 'installed';
    $current_version = $instance->get_tgm_instance()->get_installed_version($plugin['slug']);
    $plugin_description = $instance->get_tgm_instance()->get_plugin_description($plugin['slug']);
    $plugin_author = $instance->get_tgm_instance()->get_plugin_author($plugin['slug']);
    $require_update = $instance->get_tgm_instance()->does_plugin_require_update($plugin['slug']);

    if($plugin_activated) {
        $item_class = 'activated';
    }

    if($require_update) {
        $item_class = 'need-update';
    }
}
?>
<div class="jnews-plugin-item plugin-<?php echo esc_attr($item_class); ?>" data-id="<?php echo esc_attr($plugin['slug']); ?>" data-path="<?php echo esc_attr($plugin_instance['file_path']); ?>">
    <input type="hidden" value="<?php echo wp_create_nonce('jnews_plugin'); ?>" class="nonce"/>

    <div class="jnews-plugin-image">
        <div class="jnews-plugin-notice"><?php esc_html_e('New Update Available', 'jnews'); ?></div>

        <?php
            if($plugin['detail']['image']) {
        ?>
                <img src="<?php echo esc_url($plugin['detail']['image']); ?>">
        <?php
            } else {
        ?>
                <div class="empty-image">
                    <span><?php echo esc_html($plugin['name']); ?></span>
                </div>
        <?php
            }
        ?>

    </div>

    <div class="jnews-item-description">
        <h3 class="jnews-item-title">
            <?php echo esc_html($plugin['name']); ?>
            <?php
                if(isset($plugin['link']))
                {
                    foreach($plugin['link'] as $link)
                    {
                        $target = $link['newtab'] ? 'target="_blank"' : '';
                        echo "[ <a href=" . $link['url'] . " {$target}>" . $link['title'] . " </a> ] ";
                    }
                }
            ?>
        </h3>

        <?php if($plugin_installed) : ?>
            <em><?php esc_html_e('by', 'jnews') ?> <strong><?php echo esc_html($plugin_author); ?></strong></em>
        <?php endif; ?>

        <?php
            if($plugin_installed || $plugin_activated ) {
                echo "<p>" . trim($plugin_description) . "</p>";
            } else {
                echo "<p>" . $plugin['description'] . "</p>";
            }
        ?>

        <?php if($plugin_installed || $plugin_activated) : ?>
            <div class="jnews-plugin-version">
                <ul>
                    <li>
                        <?php esc_html_e('Installed Version :', 'jnews') ?>
                        <strong><?php echo esc_html($current_version);  ?></strong>
                    </li>
                    <?php if(!empty($plugin['version'])) : ?>
                        <li>
                            <?php esc_html_e('Required Version :', 'jnews') ?>
                            <strong class="<?php echo esc_attr( $require_update ? "newversion" : "" ); ?>"><?php echo esc_html($plugin['version']); ?></strong>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div class="jnews-item-button">
        <a class="vp-button button button-secondary activated-button" href="<?php echo esc_url(apply_filters('jnews_plugin_action_url', $plugin['slug'], 'deactivate')); ?>">
            <?php esc_html_e('Deactivate', 'jnews'); ?>
        </a>
        <a class="vp-button button button-primary update-button" href="<?php echo esc_url(apply_filters('jnews_plugin_action_url', $plugin['slug'], 'update')); ?>">
            <?php esc_html_e('Update', 'jnews'); ?>
        </a>
        <a class="vp-button button button-primary activate-button" href="<?php echo esc_url(apply_filters('jnews_plugin_action_url', $plugin['slug'], 'activate')); ?>">
            <?php esc_html_e('Activate', 'jnews'); ?>
        </a>
        <a class="vp-button button button-primary install-button" href="<?php echo esc_url(apply_filters('jnews_plugin_action_url', $plugin['slug'], 'install')); ?>">
            <?php esc_html_e('Install', 'jnews'); ?>
        </a>
    </div>
    <div class="jnews-action-notice success">
        <span></span>
        <i class="fa fa-times"></i>
    </div>
    <div class="jeg-progress-bar">
        <div class="progress-line"><span class="progress"></span></div>
    </div>
    <div class="overlay"></div>
</div>