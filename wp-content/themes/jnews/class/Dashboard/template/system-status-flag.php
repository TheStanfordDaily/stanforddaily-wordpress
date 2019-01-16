<tr>
    <td class="status-title"><?php echo esc_html($title); ?></td>
    <td class="status-flag flag"> <?php echo wp_kses($self->system_status_flag($flag), array(
            'div' => array(
                'title' => true,
                'class' => true
            )
        )); ?> </td>
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
        if(isset($small)) {
            echo "<em>$small</em>";
        }
        ?>
    </td>
</tr>