{!! HTML::style('plugins/select2/select2.css') !!}
{!! HTML::script('plugins/select2/select2.min.js') !!}

<script type="text/javascript">
	$(document).ready(function() {
		$('.select_tag_email').select2({
			placeholder: 'Tambah email teman',
			minimumResultsForSearch: Infinity,
			tags: true,
			tokenSeparators: [',', ' ', '\n', '\t', ';'],
			createTag: function(term, data) {
			    var value = term.term;
			    if(validateEmail(value)) {
			        return {
			          id: value,
			          text: value
			        };
			    }
			    return null;            
			}

		});	
		function validateEmail(email) {
		    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		    return re.test(email);
		}
	});
</script>