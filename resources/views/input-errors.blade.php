 
<script>
let text = 
Swal.fire({
  position: 'top-end',
  type: 'error',
  title: '<strong>Whoops!</strong> There were some problems with your input.',
  text: `
   <ul>                       	
                       	@foreach ($errors->all() as $error)
                              @if($error == "The g-recaptcha-response field is required.")
							    <li>You must fill the captcha to continue.</li>
						      @elseif($error == "The selected sz is invalid." || $error == "The sz field is required.")
							    <li>You must select a size to continue.</li>
						      @else
						        <li>{{ $error }}</li>
						      @endif
						   @endforeach
                       </ul>
         `,
  showConfirmButton: false,
  timer: 2500
});
</script>
	