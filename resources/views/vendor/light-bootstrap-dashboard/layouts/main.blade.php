<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'en'))">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="viewport" content="width=device-width" />

	<title>HOMIFY @yield('title')</title>

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Styles -->
	@section('styles')
		<link href="{{ env('APP_URL') }}{{ mix('/css/light-bootstrap-dashboard.css') }}" rel="stylesheet">
		<link href="{{ env('APP_URL') }}/css/things.css" rel="stylesheet">
	@show
	@stack('head')
</head>
<body>
<div id="app" class="wrapper">
@include('light-bootstrap-dashboard::layouts.sidebar.main')

@unless(\Route::current()->getName() == 'automation')
	<!-- Modal -->
		<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h4 class="modal-title"><b>Add Thing</b></h4>
					</div>
					<div class="modal-body">
						<form id="addThing-form" action="{{ url('thing/create') }}" method="POST">
							{{ csrf_field() }}
							<label for="thingname">Thing name:</label>
							<input name="thingname"></input><br><br>

							<label for="binding">Binding:</label>
							<select name="binding">
								@php
									$modules = Module::all();
									foreach($modules as $module){
										echo '<option value="'.$module->name.'">'.$module->name.'</option>';
									}
								@endphp
							</select><br><br>


							<label for="json">Optional (JSON):</label>
							<input name="json" placeholder=""></input>

							<input style="display: none;" name="room" value="{{ $currentRoom->id }}"></input>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" onclick="event.preventDefault();document.getElementById('addThing-form').submit();" class="btn btn-primary">Add Thing</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	@endunless
	@include('light-bootstrap-dashboard::layouts.main-panel.main')

</div>

@section('scripts')
	<script src="{{ env('APP_URL') }}{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
	<script src="{{ env('APP_URL') }}{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
	<script src="{{ env('APP_URL') }}/js/jquery.js" charset="utf-8"></script>
	<script src="{{ env('APP_URL') }}/js/thing.js" charset="utf-8"></script>
	<script src="{{ env('APP_URL') }}{{ mix('/js/light-bootstrap-dashboard.js') }}" charset="utf-8"></script>

	@if(!empty( $errors->first('thingname') ))
		<script>
            $.notify({
                icon: "pe-7s-info",
                message: "{{ $errors->first('thingname') }}<br>"
            },{
                type: "danger",
                timer: 4000,
                placement: {
                    from: 'top',
                    align: 'right'
                }
            });
		</script>
	@endif

@show
@stack('body')
</body>
</html>
