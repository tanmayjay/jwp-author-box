<?php

namespace JWP\JAB\Frontend;

/**
 * Author box handler class
 */
class Author_Box {

    /**
     * CLass constructor
     */
    function __construct() {
        add_filter( 'the_content', [ $this, 'author_bio' ] );
    }

    public function author_bio( $content ) {
        global $post;

        $author   = get_user_by( 'ID', $post->post_author );
        
        $bio      = get_user_meta( $author->ID, 'description', true );
        $github   = get_user_meta( $author->ID, 'github', true );
        $linkedin = get_user_meta( $author->ID, 'linkedin', true );
        $twitter  = get_user_meta( $author->ID, 'twitter', true );
        $facebook = get_user_meta( $author->ID, 'facebook', true );
        
        ob_start();
        ?>
        <div class="jwp-ab-box">

            <div class="jwp-ab-content">

                <div class="jwp-ab-avatar">
                    <?php echo get_avatar( $author->ID, 70 ); ?>
                </div>
                
                <div class="jwp-ab-info">
                    <div class="jwp-ab-name"><a href="<?php echo get_author_posts_url( $author->ID ); ?>"><?php echo $author->display_name; ?></a></div>
                    
                    <div class="jwp-ab-bio"><?php echo wpautop( wp_kses_post( $bio ) ); ?></div>
                    
                    <ul class="jwp-ab-contacts">
                        <?php if ( $linkedin ) : ?>
                        <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer"><img class="jwp-ab-icon" src="<?php echo JWP_AB_ASSETS ?>/icons/linkedin.svg" alt=""></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $github ) : ?>
                        <li><a href="<?php echo esc_url( $github ); ?>" target="_blank" rel="noopener noreferrer"><img class="jwp-ab-icon" src="<?php echo JWP_AB_ASSETS ?>/icons/github.svg" alt=""></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $twitter ) : ?>
                        <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer"><img class="jwp-ab-icon" src="<?php echo JWP_AB_ASSETS ?>/icons/twitter.svg" alt=""></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $facebook ) : ?>
                        <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer"><img class="jwp-ab-icon" src="<?php echo JWP_AB_ASSETS ?>/icons/facebook.svg" alt=""></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>
        </div>
        <?php
        $bio_content = ob_get_clean();

        if( 'post' == $post->post_type ) {
            $this->enqueue_scripts();
            $content .= $bio_content;
        }

        return $content;
    }

    private function enqueue_scripts() {
        wp_enqueue_style( 'jwp-ab-style' );
    }
}