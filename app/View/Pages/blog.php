<?php
use Core\HTML;
?>

<link rel="stylesheet" href="<?php echo HTML::style("blog.css")?>">
<!-------------------------Poster----------------------------------------------------------------------------------------------->

<section class="poster">
    <img src="<?php echo HTML::image("breadcrumb-bg.jpg")?>" alt="Poster">
</section>

<!-------------------------Blogs----------------------------------------------------------------------->
<section class="blogs">
    <div class="blogs-list">
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-1.jpg")?>" alt="blog 1">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 16 February 2022
                </span>
                <h5>What Culling Irons Are The Best Ones</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-2.jpg")?>" alt="blog 2">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 21 February 2022
                </span>
                <h5>Eternity Bands Do Last Forever</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-3.jpg")?>" alt="blog 3">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 28 February 2022
                </span>
                <h5>The Health Benefits Of Sunglasses</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-4.jpg")?>" alt="blog 4">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 16 February 2022
                </span>
                <h5>Aiming For Higher The Mastopexy</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-5.jpg")?>" alt="blog 5">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 21 February 2022
                </span>
                <h5>Wedding Rings A Gift For A Lifetime</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-6.jpg")?>" alt="blog 6">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 28 February 2022
                </span>
                <h5>The Different Methods Of Hair Removal</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-7.jpg")?>" alt="blog 7">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 16 February 2022
                </span>
                <h5>Hoop Earrings A Style From History</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-8.jpg")?>" alt="blog 8">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 21 February 2022
                </span>
                <h5>Lasik Eye Surgery Are You Ready</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
        <div class="blogs-list__item">
            <img src="<?php echo HTML::image("blog/blog-9.jpg")?>" alt="blog 9">
            <div class="blogs-list__item-text">
                <span>
                    <img src="<?php echo HTML::image("icon/calendar.png")?>" alt=""> 28 February 2020
                </span>
                <h5>Lasik Eye Surgery Are You Ready</h5>
                <a href="#">READ MORE</a>
            </div>
        </div>
    </div>
</section>
<script>
    const menuBlog = document.querySelector(".menu__blog");
    menuBlog.classList.add("menu__item__underline");
</script>