<?php 
/**
 * The Footer for the theme.
 * 
 * @package Architettura WordPress theme
 */
?>

<footer class="main-footer">
    <div class="auto-container">

        <?php if ( get_theme_mod( 'architettura_footer_widgets_enable', true ) ) : ?>
        
            <div class="widgets-section">
                <div class="row clearfix">

                    <div class="big-column col-lg-6 col-md-12 col-sm-12">
                        <div class="row clearfix">
                            
                            <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                <?php dynamic_sidebar( 'footer-1' ); ?>
                            </div>

                            <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                <?php dynamic_sidebar( 'footer-2' ); ?>
                            </div>
                            
                        </div>
                    </div>

                    <div class="big-column col-lg-6 col-md-12 col-sm-12">
                        <div class="row clearfix">

                            <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                <?php dynamic_sidebar( 'footer-3' ); ?>
                            </div>

                            <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                <?php dynamic_sidebar( 'footer-4' ); ?>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>

        <?php endif; ?>

        <?php do_action( 'architettura_footer_copyright' ); ?>
        
    </div>
</footer>

</div>

<?php do_action( 'architettura_scroll_to_top' ); ?>

<?php do_action( 'architettura_search_popup' ); ?>

<?php wp_footer(); ?>

</body>

</html>