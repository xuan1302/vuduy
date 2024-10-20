<?php
//Template Name: Contact us
get_header();
$tru_so = get_field( "tru_so" );
$showroom = get_field( "showroom" );
$hotline = get_field( "hotline" );
$email = get_field( "email" );
$web = get_field( "web" );
$time = get_field( "time" );
$iframe_google_map = get_field( "iframe_google_map" );
$contact_form = get_field( "contact_form" );

?>
    <div class="template-contact-us">
        <div class="container">
            <h2>Liên hệ với chúng tôi</h2>
            <div class="content-contact-us">
                <div class="content-left">
                    <div class="top-lh">
                        <div class="left-lh">
                            <div class="item">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/map-ft.svg" alt="">
                                <span><?php echo $tru_so; ?></span>
                            </div>
                            <div class="item">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/map-ft.svg" alt="">
                                <span><?php echo $showroom; ?></span>
                            </div>
                        </div>
                        <div class="right-lh">
                            <div class="item">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/phone-ft.svg" alt="">
                                <span><?php echo $hotline; ?></span>
                            </div>
                            <div class="item">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/mail-ft.svg" alt="">
                                <span><?php echo $email; ?></span>
                            </div>
                            <div class="item">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/web-ft.svg" alt="">
                                <span><?php echo $web; ?></span>
                            </div>
                            <div class="item">
                                <img class="icon" src="<?php bloginfo('template_url'); ?>/asset/icons/icon-time.svg" alt="">
                                <span><?php echo $time; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-lh">
                        <h4 class="title-f">Gửi thắc mắc cho chúng tôi</h4>
                        <p class="des">Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.</p>
                        <div class="form-lh-b">
                            <?php echo do_shortcode($contact_form); ?>
                        </div>
                    </div>
                </div>
                <div class="content-right">
                    <?php echo $iframe_google_map; ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();