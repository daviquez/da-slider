<div id="da-slider" class="slideshow-container">

    <div class="da-slider-container">

        <?php 
            $i = 1;
            foreach ($slider as $slide => $v) { ?>
                <div class="da-slide <?= $slide == $i-1 ? 'show' : '' ?> fade">
                <img src="<?= esc_url($v->img); ?>" style="width:100%">
                <div class="da-slide-text">
                    <div class="da-slide__numbertext"> <?= $i; ?> / 3</div>
                    <h2 class="da-slide__title"><?= esc_html($v->title); ?></h2>
                    <p class="da-slide__content"><?= esc_html($v->content); ?></p>
                </div>
                </div>
            <?php $i++; }
        ?>
            <a href="#da-slider" class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a href="#da-slider" class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <div class="da-dots">
        <ul>
            <?php
                $i = 1;
                foreach ($slider as $dot) { ?>
                    <li class="dot" onclick="currentSlide(<?= $i; ?>)"></li>
                <?php $i++; }
            ?>
        </ul>
    </div>

</div>