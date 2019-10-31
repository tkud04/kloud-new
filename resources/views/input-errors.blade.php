 
<script>
let nl = '\n';
let text = 
Swal.fire({
  position: 'top',
  type: 'error',
  title: `<strong>Whoops!</strong> ${nl} There were some problems with your input. ${nl}`,
  text: `                     	
                       	@foreach ($errors->all() as $error)
                              @if($error == "The g-recaptcha-response field is required.")
							    You must fill the captcha to continue
						      @elseif($error == "The selected sz is invalid." || $error == "The sz field is required.")
							    You must select a size to continue
						      @else
						        {{ $error }}
						      @endif 
							  ${nl}
						   @endforeach
         `,
  showConfirmButton: false,
  timer: 3000
});
</script>
	