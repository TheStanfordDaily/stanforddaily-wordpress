<tr>
    <td class="status-title"><?php echo esc_html($title); ?></td>
    <td class="status-flag help">
        <?php if(isset($tooltip) && !empty($tooltip)) : ?>
            <i class="tooltip fa fa-question-circle" title="<?php echo esc_html($tooltip); ?>"></i>
        <?php endif; ?>
    </td>
    <td>
        <?php
        echo wp_kses($content, array(
            'strong' => array(),
            'a' => array(
                'href' => true
            ),
            'mark' => array(
                'class' => true
            )
        ));
        ?>
    </td>
</tr>