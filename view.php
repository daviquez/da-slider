<div class="modal fade" id="createModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?=admin_url('admin-post.php')?>" method="POST">
				<input type="hidden" name="action" value="create_slide">
				<div class="modal-header">
					<h3 class="modal-title">New</h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="file">Image</label>
						<div class="input-group">
							<input type="hidden" name="img" id="img">
							<input type="text" readonly class="form-control" name="file" id="file">
							<div class="input-group-append">
								<button class="btn btn-primary btn-upload">Select</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" class="form-control" name="title" id="title">
					</div>
					<div class="form-group">
						<label for="content">Content</label>
						<input type="text" class="form-control" name="content" id="content">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container">
<h1 class="h1 font-weight-light">My Slider</h1>



	<h2 class="text-center">Preview</h2>
	
	<?php
		include 'code.php';
	?>
	<hr>

	<h2>Slides</h2>
	
	<div class="card-deck">
		<?php foreach ($slider as $slide) {?>
			
			<div class="modal fade" id="updateModal<?=$slide->id?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action="<?=admin_url('admin-post.php')?>?action=update_slide&id=<?=$slide->id?>" method="POST">
							<div class="modal-header">
								<h3 class="modal-title">Update</h3>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="update_file<?=$slide->id?>">Image</label>
									<div class="input-group">
										<input type="hidden" name="update_img" id="update_img<?=$slide->id?>" value="<?=$slide->img?>">
										<input type="text" readonly class="form-control" name="update_file" id="update_file<?=$slide->id?>">
										<div class="input-group-append">
											<button class="btn btn-primary btn-update" data-id="<?=$slide->id?>">Select</button>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="update_title<?=$slide->id?>">Title</label>
									<input type="text" class="form-control" name="update_title" id="update_title<?=$slide->id?>" value="<?=$slide->title?>">
								</div>
								<div class="form-group">
									<label for="update_content<?=$slide->id?>">Content</label>
									<input type="text" class="form-control" name="update_content" id="update_content<?=$slide->id?>" value="<?=$slide->content?>">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="card text-center" style="background: url(<?=$slide->img?>);background-size: cover;">
				<div class="card-body">
					<h4 class="text-light"><?=$slide->title?></h4>
					<p class="text-light"><?=$slide->content?></p>
				</div>
				<div class="card-footer">
					<a href="#!" class="btn btn-outline-light m-1" data-toggle="modal" data-target="#updateModal<?=$slide->id?>">Update</a>
					<a href="<?=admin_url('admin-post.php')?>?action=delete_slide&id=<?=$slide->id?>" class="btn btn-outline-light m-1">Delete</a>
				</div>
			</div>

		<?php } ?>

		<div class="card">
			<div class="card-body d-flex justify-content-center">
				<button class="btn btn-outline-primary" data-toggle="modal" data-target="#createModal">Add Slide</button>
			</div>
		</div>

	</div>
	<p class="text-center mt-4">Use this shortcode to add this slider: <strong>['my-slider']</strong></p>

</div>
<script>
	
	

</script>