<div class="postbox">
    <h3 class="hndle">
        <p style="padding: 10px;margin:0"><?php _e( 'HTML CONTENT', CONTOVER_SLUG ) ?></p>
    </h3>
    <div class="inside">
        <p><?php _e( 'Paste here the code you wish to appear in the overlay.', CONTOVER_SLUG ) ?></p>
        <textarea name="content_overlay_settings[content_overlay]" id="content_overlay_settings_code" cols="100" rows="13">
            <?php echo isset( $options['content_overlay'] ) ? $options['content_overlay'] : ''; ?>
        </textarea>
    </div>
</div>

<div class="postbox">
    <h3 class="hndle">
        <p style="padding: 10px; margin: 0"><?php _e( 'SETTINGS', CONTOVER_SLUG ) ?></p>
    </h3>
    <div class="inside">
        <table class="table-form" width="100%">
            <tr>
                <td width="20%"><?php _e( 'Plugin Status', CONTOVER_SLUG ) ?></td>
                <td>
                    <select name="content_overlay_settings[status]" id="content_overlay_settings_status">
                        <option value="active" <?php echo $options['status'] == 'active' ? 'selected' : '' ?>><?php _e( 'Active', CONTOVER_SLUG ) ?></option>
                        <option value="inactive" <?php echo $options['status'] == 'inactive' ? 'selected' : '' ?>><?php _e( 'Inactive', CONTOVER_SLUG ) ?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <td width="20%"><?php _e( 'Repeat every:', CONTOVER_SLUG ) ?></td>
                <td>
                    <select name="content_overlay_settings[interval]" id="content_overlay_settings_interval">
                        <option value="day" <?php echo $options['interval'] == 'day' ? 'selected' : '' ?>><?php _e( 'Day', CONTOVER_SLUG ) ?></option>
                        <option value="week" <?php echo $options['interval'] == 'week' ? 'selected' : '' ?>><?php _e( 'Week', CONTOVER_SLUG ) ?></option>
                        <option value="month" <?php echo $options['interval'] == 'month' ? 'selected' : '' ?>><?php _e( 'Month', CONTOVER_SLUG ) ?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <td width="20%"><?php _e( 'Popup width:', CONTOVER_SLUG ) ?></td>
                <td>
                    <input type="text" name="content_overlay_settings[width]" id="content_overlay_settings_width" value="<?php echo isset( $options['width'] ) ? $options['width'] : '' ?>"/>
                </td>
            </tr>

            <tr>
                <td width="20%"><?php _e( 'Popup height:', CONTOVER_SLUG ) ?></td>
                <td>
                    <input type="text" name="content_overlay_settings[height]" id="content_overlay_settings_height" value="<?php echo isset( $options['height'] ) ? $options['height'] : '' ?>"/>
                </td>
            </tr>

            <tr>
                <td width="20%"><?php _e( 'Popup delay:', CONTOVER_SLUG ) ?></td>
                <td>
                    <input type="number" name="content_overlay_settings[delay]" id="content_overlay_settings_delay" value="<?php echo isset( $options['delay'] ) ? $options['delay'] : '1' ?>"/>
                    <label for="">Seconds</label><br>
                    <small style="color:#888"><?php _e( 'Set the estimated time that the popup will wait before it shows up.', CONTOVER_SLUG ) ?></small>
                </td>
            </tr>
        </table>
    </div>
</div>