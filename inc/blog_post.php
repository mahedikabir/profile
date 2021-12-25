<?php
if (isset($_GET['post'])){
    $slug_url = $_GET['post'];
    $get_slug = "select * from posts where title_slug = '$slug_url';";
    $run_slug = mysqli_query($con,$get_slug);
    $row_slug = mysqli_fetch_array($run_slug);
    $category = $row_slug['category_id'];
    $date=date_create($row_slug['created_at']);
    $date=date_format($date,"d M Y, h:s:i A");

    $get_cat = "select name, slug from categories where id = '$category'";
    $run_cat = mysqli_query($con,$get_cat);
    $row_cat = mysqli_fetch_array($run_cat);
}
?>

<div id="main" class="site-main">
    <div id="main-content" class="single-page-content">
        <div id="primary" class="content-area">
            <div id="content" class="page-content site-content" role="main">

                <article class="post">

                    <header class="entry-header">
                        <div class="entry-meta entry-meta-top">
                            <span><a href="blog?category=<?php echo $row_cat['slug']; ?>" rel="category tag" title="View all posts in<?php echo $row_cat['name']; ?>"><?php echo $row_cat['name']; ?></a></span>
                        </div><!-- .entry-meta -->

                        <h2 class="entry-title"><?php echo $row_slug['title'] ?></h2>
                        <div><?php echo $date?> , &nbsp; &nbsp;
                            <span class="author vcard">
                            <i class="fas fa-user"></i>
                            <span> Hasan Mahedi</span>
                        </span>
                        </div>
                        <div class="post-tags">
                      <span class="tags">
                          <?php
                          $slug_id = $row_slug['id'];
                          $get_tags = "select * From tags where post_id = '$slug_id'";
                          $run_tags = mysqli_query($con,$get_tags);
                          while($row_tags = mysqli_fetch_array($run_tags)){
                              $tag = $row_tags['tag'];
                              $tag_slug = $row_tags['tag_slug'];
                              echo "<a href='blog?tag=$tag_slug' rel='tag'>$tag</a>";
                          }
                          ?>

                      </span>
                        </div>
                    </header><!-- .entry-header -->

                    <div class="post-thumbnail">
                        <img class="mx-auto d-block" src="blogger/<?php echo $row_slug['image_big']; ?>" alt="<?php echo $row_slug['title'] ?>"  />
                    </div>

                    <div class="post-content">
                        <div class="entry-content">

                            <div class="row">
                                <div class=" col-xs-12 col-sm-12 ">
                                    <?php echo $row_slug['content'];
                                    ?>

                                </div>
                            </div>

                        </div><!-- .entry-content -->

                        <div class="entry-meta entry-meta-bottom">
                            <div class="date-author">

                        <span class="entry-date">
                          <a href="#" rel="bookmark">
                            <i class="far fa-clock"></i>
                            <time class="entry-date" datetime="2020-04-04T08:29:37+00:00"> <?php echo $date?></time>
                          </a>
                        </span>

                                <span class="author vcard">
                          <a class="url fn n" href="#" rel="author">
                            <i class="fas fa-user"></i>
                            <span> Hasan Mahedi</span>
                          </a>
                        </span>
                            </div>

                            <!-- Share Buttons -->
                            <div class="entry-share btn-group share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="btn" target="_blank" title="Share on Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>

                                <a href="https://twitter.com/share?url=<?php echo $actual_link; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" class="btn" target="_blank" title="Share on Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $actual_link; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn" title="Share on LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>

                                <a href="http://www.digg.com/submit?url=<?php echo $actual_link; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="btn" title="Share on Digg">
                                    <i class="fab fa-digg"></i>
                                </a>
                            </div>
                            <!-- /Share Buttons -->
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>