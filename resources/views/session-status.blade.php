  <?php
  $signal = $signals['okays'];
   $class = "alert-warning";   
           
   if($val == "error"){
   	$signal = $signals['errors'];
   	$class = "alert-danger";         
       $pop .= "-error";
   } 
  ?>                
  
  <script>
Swal.fire({
  position: 'top-end',
  type: '{{$class}}',
  title: '@if($val == "error")<strong>Whoops!</strong> @else Success! @endif',
  text: '{{$signal[$pop]}}',
  showConfirmButton: false,
  timer: 1500
});
</script>
	