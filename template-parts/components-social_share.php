<ul class="social_icons flush_left social_share">
    <li class="fb_share" data-url="<?php the_permalink(); ?>">
        <i class="fab fa-facebook-f"></i>
    </li>
    <li class="twitter_share" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="RowNewYork">
        <i class="fab fa-twitter"></i>
    </li>
    <li class="linkedin_share" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
        <i class="fab fa-linkedin-in"></i>
    </li>
    <li class="pinterest_share" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" data-media="<?php the_post_thumbnail_url(); ?>">
        <i class="fab fa-pinterest"></i>
    </li>
    <li>
        <a href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>" target="_blank">
            <i class="fal fa-envelope"></i>
        </a>
    </li>
</ul>