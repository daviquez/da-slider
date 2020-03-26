jQuery(function($){
	$('.btn-upload').on('click', function(e){
		e.preventDefault();

		var uploader = wp.media({
			title: 'Image',
			library:{
				type: 'image'
			},
			multiple: false
		});
		uploader.open();

		uploader.on('select', function(){
			var selection = uploader.state().get('selection');
			selection.map(function(data){
				var item = data.toJSON();
				url = new URL(item.url);

				$('#img').val(url.pathname);
				$('#file').val(item.filename);
			});
		});
	});
	$('.btn-update').on('click', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var uploader = wp.media({
			title: 'Image',
			library:{
				type: 'image'
			},
			multiple: false
		});
		uploader.open();

		uploader.on('select', function(){
			var selection = uploader.state().get('selection');
			selection.map(function(data){
				item = data.toJSON();
				url = new URL(item.url);

				$('#update_img'+id).val(url.pathname);
				$('#update_file'+id).val(item.filename);
			});
		});
	});
});