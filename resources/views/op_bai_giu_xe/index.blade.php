<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Page Title</title>
	<!-- Latest compiled and minified CSS -->
	{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
	<link rel="stylesheet" href="{!! asset("/css/font-awesome.css")!!}">
	<!-- Optional theme -->
	{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">--}}

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG_m7pyGlSJYAQppYJhF4JqcC2DAQZRSk&language=vi&libraries=places" type="text/javascript"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="{!! asset('map-icons/css/map-icons.min.css') !!}">
	<script type="text/javascript" src="{!! asset('map-icons/js/map-icons.min.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('js/gmaps.min.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('js/main.js') !!}"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}" />
</head>
<body>
	<div class="container map-container">
		<div class="col-xs-12 map-search">
			<label class="hidden-xs">Tìm Kiếm: </label>
			<div class="clearfix"></div>
			<input type="search" class="map-in col-xs-10 form-control" name='search' id='searchInput' placeholder="Tìm kiếm" />
			<button type="button" class="btn map-search-btn col-xs-2"" data-toggle="modal" data-target="#configModal">Nâng Cao</button>
		</div>
		<div class="col-xs-12 map-button">
			<div class="col-xs-6">
				<button class="btn map-btn" id="direction">Dẫn Đường</button>
			</div>
			<div class="col-xs-6">
				<button class="btn map-btn" id="findNearLocation">Tìm Vị Trí Gần Nhất</button>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-xs-12 ">
			<div id="map" class="map-content"></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div id="showDirection" class="col-xs-12">
		<div id="route" style="overflow-x: auto;"></div>
	</div>
	<!-- Modal -->
	<div id="configModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Tìm Kiếm Nâng Cao</h4>
		      	</div>
		      	<div class="modal-body">
		        	<p>
					  	<label for="amount">Phạm Vi:</label>
					  	<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
					</p>
					<div id="slider"></div>
					<div class="clearfix"></div>
					<p>
						<label>Thành Phố:</label>
						<select class="form-control" id="city" style="width: 100%">
							<option>--Thành Phố--</option>
						</select>
					</p>
		      	</div>
		      	<div class="modal-footer">
		      		<button type="button" class="btn btn-default" id="change" data-dismiss="modal">Submit</button>
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      	</div>
		    </div>
	  	</div>
	</div>
</body>
</html>