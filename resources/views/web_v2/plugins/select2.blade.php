{!! HTML::style('plugins/select2/select2.css') !!}
{!! HTML::style('plugins/select2/select2-bootstrap.css') !!}
{!! HTML::script('plugins/select2/select2.min.js') !!}

<script type="text/javascript">
	$('.select_tag_email').select2({
		placeholder: 'Tambah email',
		tags: true,
		tokenSeparators: [",", " "]
	});	
	// $('.select-tag').select2('data', preload_data_tag);
</script>