@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@foreach ($result as $item)
 
				<div class="item">
					<h2 class="title"><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
					<?php echo $item->get_description(); ?>
				</div>
		 
			@endforeach
		 
		</div>
	</div>
</div>
@stop