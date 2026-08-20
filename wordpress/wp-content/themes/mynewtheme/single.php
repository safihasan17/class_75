<?php get_header(); ?>

<style>
    .single-post-content img {
         width: 100%;
    }
    .single-post-content p {
        margin-bottom: 1.5rem;
    }

    .single-post-content blockquote {
        background: #F7F4F1;
        border-left: 5px solid var(--bs-primary, #3F73F3);
        padding: 30px;
        margin: 30px 0;
        font-size: 18px;
        font-style: italic;
        color: #333;
        border-radius: 0 10px 10px 0;
    }

    .post-tags a,
    .post-share a {
        display: inline-block;
        margin: 0 5px 5px 0;
    }

    .sidebar-widget {
        background: #F7F4F1;
        border-radius: 10px;
        padding: 30px;
    }

    .sidebar-cat-list a {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0, 0, 0, .07);
        color: #333;
    }

    .sidebar-cat-list a:last-child {
        border-bottom: none;
    }

    .sidebar-cat-list a:hover {
        color: var(--bs-primary, #3F73F3) !important;
    }

    .recent-post-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .tag-cloud a {
        border: 1px solid rgba(0, 0, 0, .1);
        border-radius: 30px;
        padding: 6px 18px;
        margin: 0 6px 10px 0;
        display: inline-block;
        color: #333;
        font-size: 14px;
    }

    .tag-cloud a:hover {
        background: var(--bs-primary, #3F73F3);
        border-color: var(--bs-primary, #3F73F3);
        color: #fff !important;
    }

    .comment-item img {
        width: 65px;
        height: 65px;
        object-fit: cover;
    }

    .comment-item .reply-btn {
        font-size: 13px;
        font-weight: 600;
    }


    .recent-post{
        top: 25%;
    }
</style>
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
<div class="container-fluid bg-breadcrumb" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>');">
    <div class="bg-breadcrumb-single"></div>
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s"><?php the_title(); ?></h4>

    </div>
</div>
<!-- Header End -->

<!-- Single Post Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="row g-5">

            <!-- Main Content -->
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">

                <!-- Post Meta -->
                <div class="mb-4">
                    <h4 class="text-primary mb-2"><?php the_category(', ') ?></h4>
                    <div class="d-flex flex-wrap justify-content-between">
                        <p class="mb-0"><span class="text-dark fw-bold">On</span> <?php echo get_the_date('j F Y') ?></p>
                        <p class="mb-0"><span class="text-dark fw-bold">By</span> <?php the_author_posts_link() ?> </p>

                    </div>
                </div>

                <!-- Featured Image -->
                <!-- <div class="project-img mb-4">
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" class="img-fluid w-100 rounded" alt="Image">
                </div> -->

                <!-- Post Title -->


                <!-- Post Content -->
                <div class="single-post-content">

                    <?php the_content() ?>



                </div>

                <!-- Tags & Share -->
                <div class="row g-4 align-items-center border-top border-bottom py-4 my-4">
                    <div class="col-md-6 post-tags">
                        <span class="text-dark fw-bold me-2">Tags:</span>
                        <a href="#" class="btn btn-light btn-sm rounded-pill px-3">Finance</a>
                        <a href="#" class="btn btn-light btn-sm rounded-pill px-3">Investment</a>
                        <a href="#" class="btn btn-light btn-sm rounded-pill px-3">Business</a>
                    </div>
                    <div class="col-md-6 text-md-end post-share">
                        <span class="text-dark fw-bold me-2">Share:</span>
                        <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                
                

                <!-- Comments Start -->
                <!-- <div class="mb-5">
                    <h4 class="mb-4">3 Comments</h4>

                    <div class="d-flex comment-item mb-4">
                        <img src="img/customer-img-1.jpg" class="rounded-circle me-3" alt="Image">
                        <div class="bg-light rounded p-4 w-100">
                            <div class="d-flex justify-content-between flex-wrap">
                                <h6 class="mb-1">Sarah Johnson</h6>
                                <small class="text-muted">Mar 15, 2024</small>
                            </div>
                            <p class="mb-2">Great insights! This really helped me rethink my long-term distribution strategy.</p>
                            <a href="#" class="reply-btn text-primary"><i class="fas fa-reply me-1"></i>Reply</a>
                        </div>
                    </div>

                    <div class="d-flex comment-item mb-4 ms-md-5">
                        <img src="img/customer-img-2.jpg" class="rounded-circle me-3" alt="Image">
                        <div class="bg-light rounded p-4 w-100">
                            <div class="d-flex justify-content-between flex-wrap">
                                <h6 class="mb-1">David Miller</h6>
                                <small class="text-muted">Mar 16, 2024</small>
                            </div>
                            <p class="mb-2">Agreed, especially the point about revisiting goals annually rather than letting them sit static.</p>
                            <a href="#" class="reply-btn text-primary"><i class="fas fa-reply me-1"></i>Reply</a>
                        </div>
                    </div>

                    <div class="d-flex comment-item mb-4">
                        <img src="img/customer-img-3.jpg" class="rounded-circle me-3" alt="Image">
                        <div class="bg-light rounded p-4 w-100">
                            <div class="d-flex justify-content-between flex-wrap">
                                <h6 class="mb-1">Emily Carter</h6>
                                <small class="text-muted">Mar 17, 2024</small>
                            </div>
                            <p class="mb-2">Thanks for sharing, would love to see a follow up post on tax-efficient distribution methods.</p>
                            <a href="#" class="reply-btn text-primary"><i class="fas fa-reply me-1"></i>Reply</a>
                        </div>
                    </div>
                </div> -->
                <!-- Comments End -->

                <!-- Comment Form Start -->
                <!-- <div class="bg-light rounded p-4 p-md-5" style="background-image: url(img/bg.png);">
                    <h4 class="mb-4">Leave a Comment</h4>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control border-0 py-3" placeholder="Your Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control border-0 py-3" placeholder="Your Email">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0 py-3" rows="5" placeholder="Your Comment"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary rounded-pill py-3 px-5">Post Comment</button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <!-- Comment Form End -->

            </div>
            <!-- Main Content End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">

                <!-- Search Widget -->
                <div class="sidebar-widget mb-4">
                    <div class="position-relative">
                        <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="search" placeholder="Search Keyword">
                        <button type="submit" class="btn btn-primary btn-md-square rounded-circle position-absolute top-0 end-0 me-2 mt-1"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="sidebar-widget mb-4">
                    <h5 class="mb-3">Categories</h5>
                    <div class="sidebar-cat-list">
                        <!-- <a href="#">Investment <span>(6)</span></a>
                        <a href="#">Business <span>(4)</span></a>
                        <a href="#">Consulting <span>(3)</span></a> -->



                        <ul class="wp-generated-list list-unstyled">
                            <?php
                            // Output formatted list items
                            wp_list_categories(array(
                                'orderby'    => 'name',
                                'show_count' => true,  // Displays the number of posts next to the name
                                'title_li'   => '',    // Removes the default "Categories" column header text
                            ));
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Recent Posts Widget -->
                <div class="sidebar-widget mb-4 position-sticky recent-post">
                    <h5 class="mb-3">Recent Posts</h5>

                    <?php
                    $recent = new WP_Query(array('posts_per_page' => 5));
                    while ($recent->have_posts()) : $recent->the_post(); ?>
                        <div class="recent-post-item" style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumb">
                                    <?php the_post_thumbnail(array(50, 50), array('style' => 'object-fit: cover; border-radius: 8px;')); ?>
                                </div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" style="line-height: 1.4; color: #00bcd4; text-decoration: none;">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>


                    <!-- <div class="d-flex recent-post-item align-items-center mb-3">
                        <img src="" class="me-3" alt="Image">
                        <div>
                            <p class="text-uppercase text-primary mb-1" style="font-size: 12px;">Investment</p>
                            <a href="single-post.html" class="text-dark d-block">Revisiting Your Investment & Distribution Goals</a>
                        </div>
                    </div>
                    <div class="d-flex recent-post-item align-items-center mb-3">
                        <img src="" class="me-3" alt="Image">
                        <div>
                            <p class="text-uppercase text-primary mb-1" style="font-size: 12px;">Business</p>
                            <a href="single-post.html" class="text-dark d-block">Dimensional Fund Advisors Interview with Director</a>
                        </div>
                    </div>
                    <div class="d-flex recent-post-item align-items-center">
                        <img src="img/blog-3.jpg" class="me-3" alt="Image">
                        <div>
                            <p class="text-uppercase text-primary mb-1" style="font-size: 12px;">Consulting</p>
                            <a href="single-post.html" class="text-dark d-block">Interested in Giving Back this Year? Here are Some Tips</a>
                        </div>
                    </div> -->
                </div>

                <!-- Tags Widget -->
                <!-- <div class="sidebar-widget mb-4">
                    <h5 class="mb-3">Popular Tags</h5>
                    <div class="tag-cloud">
                        <a href="#">Finance</a>
                        <a href="#">Investment</a>
                        <a href="#">Business</a>
                        <a href="#">Consulting</a>
                        <a href="#">Insurance</a>
                        <a href="#">Banking</a>
                    </div>
                </div> -->

                <!-- Newsletter Widget -->
                <!-- <div class="sidebar-widget">
                    <h5 class="mb-3">Newsletter</h5>
                    <p class="mb-3">Subscribe to our newsletter and receive the latest investment tips and news directly in your inbox.</p>
                    <div class="position-relative mx-auto rounded-pill">
                        <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                        <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                    </div>
                </div> -->

            </div>
            <!-- Sidebar End -->

        </div>
    </div>
</div>
<!-- Single Post End -->


<?php get_footer(); ?>