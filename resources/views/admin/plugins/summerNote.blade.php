{!! HTML::style('plugins/admin/summernote/summernote.css') !!}
{!! HTML::style('plugins/admin/summernote/summernote-bs3.css') !!}
{!! HTML::script('plugins/admin/summernote/summernote.min.js') !!}

public\plugins\admin\summernote

<script>
	$(document).ready(function(){
      $('.summernote').summernote();
	});
</script>