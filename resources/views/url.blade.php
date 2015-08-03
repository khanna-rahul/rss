@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">RSS Feed URL</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">URL</label>
							<div class="col-md-6">
								<input type="url" class="form-control" name="url" value="{{ old('url') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary" name="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr />
		<div class="col-md-8 col-md-offset-2">
			<h1>RSS Feed URLs</h1>
			@if(count($url))
				<ul>
				@foreach($url as $path)
				<li><code>{{ $path['url'] }}</code> -- <a href="#" class="removeUrl" data-id="{{ $path['id'] }}"><i class="fa fa-times"></i></a></li>
				@endforeach
				</ul>
			@else
				No Urls in database
			@endif
		</div>
	</div>
</div>
@stop

@section('custom_js')
<script>
	$(document).ready(function() {
		$('.removeUrl').off('click').on('click', function(e){
			var that = this;
			e.preventDefault();
			var data = {'id':$(this).attr('data-id')};
			var promise = $.ajax({'url':'/deleteUrl', data:data, dataType: 'json'});
			promise.done(function(){
				that.parent().remove();
			});
			promise.fail(function(){
				alert('Something went wrong.');
			})
		});
	});
</script>
@stop