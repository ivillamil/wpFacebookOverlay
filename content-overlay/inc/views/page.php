<div class="wrap">
    <div class="icon32 icon-settings"></div>
    <h2>Content Overlay Settings</h2>

    <?php settings_errors() ?>

    <form action="options.php" method="post" style="margin-top: 30px">
        <?php
            settings_fields('content_overlay_settings');
            do_settings_sections('content_overlay_settings');
            submit_button();
        ?>
    </form>
</div>