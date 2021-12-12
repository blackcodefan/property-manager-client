<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title())?></h1>

    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"  autocomplete="off">
        <input type="hidden" name="action" value="save_setting_hook"/>
        <div id="universal-message-container">
            <div class="options">
                <p>
                    <label>Username: </label>
                    <input type="text" name="pmc_u" value="<?php echo $username;?>" required  autocomplete="off"/>
                </p>
            </div>
            <div class="options">
                <p>
                    <label>Password: </label>
                    <input type="password" name="pmc_p" value="<?php echo $password;?>" required  autocomplete="off"/>
                </p>
            </div>
        </div>
        <?php
        wp_nonce_field( 'setting_save_nonce', 'setting_save_nonce' );
        submit_button('Save');
        ?>
    </form>
</div>