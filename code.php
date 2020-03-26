<section id="ws-slider" class="carousel slide w-100" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php for ($i=0; $i < count($slider); $i++) { ?>
			<li data-target="#ws-slider" data-slide-to="<?=$i?>" <?php if ($i==0)echo "class='active'";?>></li>
		<?php } ?>
	</ol>
	<div class="carousel-inner">
		<?php foreach ($slider as $key => $slide) {?>
			<div class="carousel-item <?php if($key==0) echo'active'?>">
				<div class="img" style="background: url(<?=$slide->img?>); background-size: cover; background-position: bottom"></div>
				<div class="carousel-caption">
					<h3><?=$slide->title?></h3>
					<p><?=$slide->content?></p>
				</div>
			</div>
		<?php } ?>
	</div>
	<a href="#ws-slider" class="control carousel-control-prev" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a href="#ws-slider" class="control carousel-control-next" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</section>