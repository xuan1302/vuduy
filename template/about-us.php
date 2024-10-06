<?php
//Template Name: About us
get_header();
$brand_story_title = get_field( "brand_story_title" );
$brand_story_description = get_field("brand_story_description");
$milestones_branding = get_field("milestones_branding");
$vision_mission_main_title = get_field("vision_mission_main_title");
$vision_mission_content = get_field("vision_mission_content");
$vision_mission_image = get_field("vision_mission_image");
$our_service_title = get_field("our_service_title");
$list_our_service = get_field("list_our_service");
$slide_image_about_us = get_field("slide_image_about_us");

?>
<div class="template-about-us">
    <div class="content-about-us">
        <section class="section-branding-stories">
            <div class="container branding-stories-title-contain">
                <div class="row">
                    <div class="col-12 col-xl-4 branding-stories-title">
                        <h2 class="main-title"><?php echo $brand_story_title ?></h2>
                    </div>
                    <div class="col-12 col-xl-8 branding-stories-description">
                        <p><?php echo $brand_story_description ?></p>
                    </div>
                </div>
            </div>
            <?php
            if($milestones_branding){ ?>
                <div class="container milestones_branding_contain">
                    <div class="row">
                        <?php
                            foreach($milestones_branding as $key => $item){?>
                                <div class="col-12 col-xl-3 milestones_branding_item_<?php echo $key; ?>">
                                    <div class="milestones_image position-relative">
                                        <img src="<?php echo $item['image']['url']; ?>" alt=""/>
                                        <div class="milestones_year position-absolute">
                                            <span><?php echo $item['year'] ?></span>
                                        </div>
                                    </div>
                                    <div class="milestones_description">
                                        <p><?php echo $item['description'] ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </section>
        <section class="section-vision-mission">
            <div class="container">
                <div class="vision-mission-title-contain">
                    <h1 class="main-title"><?php echo $vision_mission_main_title ?></h1>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-5">
                        <div class="vision_mission_content">
                            <p><?php echo $vision_mission_content ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7">
                        <div class="vision_mission_image">
                            <img src="<?php echo $vision_mission_image['url'] ?>" alt/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-our-service">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="our-service-title">
                            <h1 class="main-title"><?php echo $our_service_title ?></h1>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="features-container">
                            <?php
                                if($list_our_service){
                                    foreach($list_our_service as $item){?>
                                        <div class="featured-box">
                                            <div class="icon-box-img">
                                                <img src="<?php echo $item['image']['url'] ?>" alt=""/>
                                            </div>
                                            <div class="icon-box-text">
                                                <h3><?php echo $item['title'] ?></h3>
                                                <p><?php echo $item['description'] ?></p>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-slide-image">
            <div class="swiper slide-image-about-us">
                <div class="swiper-wrapper">
                    <?php if($slide_image_about_us){
                        foreach($slide_image_about_us as $item){ ?>
                            <div class="swiper-slide">
                                <img class="image" src="<?php echo $item['image']['url']?>" alt=""/>
                            </div>
                        <?php }
                    }?>
                </div>
            </div>
            <div class="slide-image-pagination"></div>
        </section>
    </div>
</div>
<?php get_footer();