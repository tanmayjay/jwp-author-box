<div class="wrap jwp-ab-enquiry-form" id="jwp-ab-enquiry-form">

    <form action="" method="post">

        <div class="form-row">
            <label for="name"><?php _e( 'Name', 'jwp-author-box' ); ?></label>

            <input type="text" name="name" id="name" required />
        </div>

        <div class="form-row">
            <label for="email"><?php _e( 'Email', 'jwp-author-box' ); ?></label>

            <input type="email" name="email" id="email" required />
        </div>

        <div class="form-row">
            <label for="message"><?php _e( 'Message', 'jwp-author-box' ); ?></label>

            <textarea name="message" id="message" cols="30" rows="10" required ></textarea>
        </div>

        <div class="form-row">
            <?php wp_nonce_field( "jwp-ab-enquiry-form" ); ?>

            <input type="hidden" name="action" value="jwp_ab_enquiry">
            <input type="submit" name="send_enquiry" value="<?php esc_attr_e( 'Send', 'jwp-author-box' ); ?>">
        </div>
    </form>
</div>