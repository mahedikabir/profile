
<div id="main" class="site-main">
    <div id="main-content" class="single-page-content">
        <div id="primary" class="content-area">

            <div class="page-title">
                <h1>Blog</h1>
                <div class="page-subtitle">
                    <h4> My Diary</h4>
                </div>
            </div>

            <div id="content" class="page-content site-content single-post" role="main">

                <div class="row">
                    <div class=" col-xs-12 col-sm-12 ">

                        <div class="blog-masonry three-columns clearfix lazy">
                            <!-- Blog Post 1 -->
                            <?php
                            if (isset($_GET['category'])){
                                $get_category_slug = $_GET['category'];
                                $get_items = "select * from posts right join categories c on posts.category_id = c.id where c.slug = '$get_category_slug' order by posts.id desc ";

                            } elseif (isset($_GET['tag'])){
                                $get_tag_item = $_GET['tag'];
                                $get_items = "select * from posts right join tags t on posts.id = t.post_id where t.tag = '$get_tag_item'";
                            }
                            else{
                                $get_items = "select * from posts order by id desc";
                            }
                            $run_items = mysqli_query($con,$get_items);
                            while($row_items = mysqli_fetch_array($run_items)){
                                $item_id = $row_items['id'];
                                $date=date_create($row_items['created_at']);
                                $date=date_format($date,"d M Y");
                                $category = $row_items['category_id'];

                                $get_cat = "select name, slug from categories where id = '$category'";
                                $run_cat = mysqli_query($con,$get_cat);
                                $row_cat = mysqli_fetch_array($run_cat);
                                ?>

                                <div class="item">
                                    <div class="blog-card">
                                        <div class="media-block">
                                            <div class="category">
                                                <a href="blog?category=<?php echo $row_cat['slug']; ?>" title="View all posts in<?php echo $row_cat['name']; ?>"><?php echo $row_cat['name']; ?></a>
                                            </div>
                                            <a href="blog?post=<?php echo $row_items['title_slug']; ?>">
                                                <img src="blogger/<?php echo $row_items['image_mid']; ?>" alt="<?php echo $row_items['title']; ?>" title="" />
                                                <div class="mask"></div>
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <div class="post-date"><?php echo $date; ?></div>
                                            <a href="blog?post=<?php echo $row_items['title_slug']; ?>">
                                                <h4 class="blog-item-title"><?php echo $row_items['title']; ?></h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                            <!-- End of Blog Post 1 -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>