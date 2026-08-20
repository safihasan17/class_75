<!-- <h1>index</h1> -->


<?php get_header(); ?>
<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="exampleModalLabel">Search by keyword</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->

<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="bg-breadcrumb-single"></div>
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Blogs</h4>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-primary">Blog</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
            <h4 class="text-primary">Our Blogs</h4>
            <h2 class="display-4">Latest Articles & News from the Blogs</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            // $blogs = new WP_Query(array(
            //     'post_type' => 'post',
            //     'posts_per_page' => 10,
            // ));

            // $posts = $blogs->posts;
            // echo "<pre>";
            // print_r($blogs->posts);
            // echo "</pre>";

            while(have_posts()):
                the_post();
            ?>

                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item bg-light rounded p-4" style="background-image: url(img/bg.png);">
                        <div class="mb-4">
                            <h4 class="text-primary mb-2"><?php the_category( ', ' );?></h4>
                            <div class="d-flex justify-content-between">
                                <p class="mb-0"><span class="text-dark fw-bold">On</span> <?php echo get_the_date('j F Y')?></p>
                                <p class="mb-0"><span class="text-dark fw-bold">By</span> <?php the_author_posts_link(  );?></p>
                            </div>
                        </div>
                        <div class="project-img">
                            <img src="<?php echo get_the_post_thumbnail_url( ) ?>" class="img-fluid w-100 rounded" alt="Image">
                            <div class="blog-plus-icon">
                                <a href="<?php the_permalink();?>" data-lightbox="blog-1" class="btn btn-primary btn-md-square rounded-pill"><i class="fas fa-plus fa-1x"></i></a>
                            </div>
                        </div>
                        <div class="my-4">
                            <a href="<?php the_permalink();?>" class="h4"><?php the_title( )?></a>
                        </div>
                        <a class="btn btn-primary rounded-pill py-2 px-4" href="<?php the_permalink();?>">Explore More</a>
                    </div>
                </div>

            <?php endwhile; ?>
            <!-- pagination -->
            <div class="d-flex gap-2 fw-semibold fs-5"><?= paginate_links() ?></div>

        </div>
    </div>
</div>
<!-- Blog End -->


<?php get_footer(); ?>