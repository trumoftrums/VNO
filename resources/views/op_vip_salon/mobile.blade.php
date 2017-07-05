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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="{!! asset('css/font-awesome.css') !!}">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	{{--<link rel="stylesheet" href="https://www.vietnamoto.net/css/style_vno.css?ver=1.1">--}}
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG_m7pyGlSJYAQppYJhF4JqcC2DAQZRSk&language=vi&libraries=places" type="text/javascript"></script>
	<script type="text/javascript">
		var iconMarker = "{!! asset('img/x.png') !!}";
	</script>
	<script type="text/javascript" src="{!! asset('js/gmaps.min.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('js/main.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('js/jquery-ui.min.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/jquery-ui.min.css') !!}" />
	
	<link rel="stylesheet" type="text/css" href="{!! asset('css/mobile.style.css') !!}" />
</head>
<body>
	<div class="container map-container">
		<div class="col-xs-12 map-search">
			<label class="hidden-xs">Tìm Kiếm: </label>
			<div class="clearfix"></div>
			<input type="search" class="map-in col-xs-7 form-control" name='search' id='searchInput' placeholder="Tìm kiếm" />
			<div class="col-xs-5">
				<button type="button" class="btn map-search-btn col-xs-4 col-sm-4" data-toggle="modal" data-target="#listModal"><i class="fa fa-search" aria-hidden="true"></i></button>
				<button type="button" class="btn map-search-btn col-xs-4 col-sm-4" data-toggle="modal" data-target="#menuModal"><i class="fa fa-list" aria-hidden="true"></i></button>
				<button type="button" class="btn map-search-btn col-xs-4 col-sm-4" data-toggle="modal" data-target="#configModal"><i class="fa fa-cog" aria-hidden="true"></i></button>
			</div>
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
		<div id="map" class="map-content"></div>
	</div>
	<div class="clearfix"></div>
	<!-- Modal -->
	<div id="listModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Danh Sách</h4>
		      	</div>
		      	<div class="modal-body">
		      	<?php foreach($data as $dataVal) { ?>
		        	<div class="item-support-page" style="width:100%!important;">
		        		<img src="http://vietnamoto.net/{!! $dataVal->thumb !!}" />
		        		<div class="cover-info-support">
		        			<h4>{!! $dataVal->title !!}</h4>
		        			<p>{!! $dataVal->address !!}</p>
		        			<p class="p-phone">
		        				<a href="tel:{!! $dataVal->phone !!}">{!! $dataVal->phone !!}</a>
		        			</p>
		        		</div>
		        	</div>
		        <?php } ?>
					<div class="clearfix"></div>
		      	</div>
		    </div>
	  	</div>
	</div>
	<div id="menuModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Danh Mục</h4>
		      	</div>
		      	<div class="modal-body">
		        	<p>
					  	<a href="{!! url('/op_vip_salon/mobile') !!}"><img style="width: 100%" src="{!! asset('img/mobile/x.png') !!}" /></a>
					</p>
					<p>
					  	<a href="{!! url('/op_bai_giu_xe/mobile') !!}"><img style="width: 100%" src="{!! asset('img/mobile/a.png') !!}" /></a>
					</p>
					<p>
					  	<a href="{!! url('/op_accessary_car/mobile') !!}"><img style="width: 100%" src="{!! asset('img/mobile/f.png') !!}" /></a>
					</p>
					<p>
					  	<a href="{!! url('/op_design_car/mobile') !!}"><img style="width: 100%" src="{!! asset('img/mobile/q.png') !!}" /></a>
					</p>
					<p>
					  	<a href="{!! url('/op_support_car/mobile') !!}"><img style="width: 100%" src="{!! asset('img/mobile/r.png') !!}" /></a>
					</p>
					<p>
					  	<a href="{!! url('/op_lend_car/mobile') !!}"><img style="width: 100%" src="{!! asset('img/mobile/v.png') !!}" /></a>
					</p>
					<div class="clearfix"></div>
		      	</div>
		    </div>
	  	</div>
	</div>
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
							<option value="ha-noi" >Hà Nội</option>
                            <option value="hai-phong" >Hải Phòng</option>
                            <option value="bac-giang" >Bắc Giang</option>
                            <option value="bac-kan" >Bắc Kạn</option>
                            <option value="bac-ninh" >Bắc Ninh</option>
                            <option value="cao-bang" >Cao Bằng</option>
                            <option value="dien-bien" >Điện Biên</option>
                            <option value="hoa-binh" >Hòa Bình</option>
                            <option value="hai-duong" >Hải Dương</option>
                            <option value="ha-giang" >Hà Giang</option>
                            <option value="ha-nam" >Hà Nam</option>
                            <option value="hung-yen" >Hưng Yên</option>
                            <option value="lao-cai" >Lào Cai</option>
                            <option value="lai-chau" >Lai Châu</option>
                            <option value="lang-son" >Lạng Sơn</option>
                            <option value="ninh-binh" >Ninh Bình</option>
                            <option value="nam-dinh" >Nam Định</option>
                            <option value="phu-tho" >Phú Thọ</option>
                            <option value="quang-ninh" >Quảng Ninh</option>
                            <option value="son-la" >Sơn La</option>
                            <option value="thai-binh" >Thái Bình</option>
                            <option value="thai-nguyen" >Thái Nguyên</option>
                            <option value="tuyen-quang" >Tuyên Quang</option>
                            <option value="vinh-phuc" >Vĩnh Phúc</option>
                            <option value="yen-bai" >Yên Bái</option>
                            <option value="da-nang" >Đà Nẵng</option>
                            <option value="thua-thien-hue" >Thừa Thiên Huế</option>
                            <option value="khanh-hoa" >Khánh Hòa</option>
                            <option value="lam-dong" >Lâm Đồng</option>
                            <option value="binh-dinh" >Bình Định</option>
                            <option value="binh-thuan" >Bình Thuận</option>
                            <option value="dak-lak" >Đắk Lắk</option>
                            <option value="dak-nong" >Đắk Nông</option>
                            <option value="gia-lai" >Gia Lai</option>
                            <option value="ha-tinh" >Hà Tĩnh</option>
                            <option value="kon-tum" >Kon Tum</option>
                            <option value="nghe-an" >Nghệ An</option>
                            <option value="ninh-thuan" >Ninh Thuận</option>
                            <option value="phu-yen" >Phú Yên</option>
                            <option value="quang-binh" >Quảng Bình</option>
                            <option value="quang-nam" >Quảng Nam</option>
                            <option value="quang-ngai" >Quảng Ngãi</option>
                            <option value="quang-tri" >Quảng Trị</option>
                            <option value="thanh-hoa" >Thanh Hóa</option>
                            <option value="tphcm" >TP.HCM</option>
                            <option value="binh-duong" >Bình Dương</option>
                            <option value="ba-ria-vung-tau" >Bà Rịa Vũng Tàu</option>
                            <option value="can-tho" >Cần Thơ</option>
                            <option value="an-giang" >An Giang</option>
                            <option value="bac-lieu" >Bạc Liêu</option>
                            <option value="binh-phuoc" >Bình Phước</option>
                            <option value="ben-tre" >Bến Tre</option>
                            <option value="ca-mau" >Cà Mau</option>
                            <option value="dong-thap" >Đồng Tháp</option>
                            <option value="dong-nai" >Đồng Nai</option>
                            <option value="hau-giang" >Hậu Giang</option>
                            <option value="kien-giang" >Kiên Giang</option>
                            <option value="long-an" >Long An</option>
                            <option value="soc-trang" >Sóc Trăng</option>
                            <option value="tien-giang" >Tiền Giang</option>
                            <option value="tay-ninh" >Tây Ninh</option>
                            <option value="tra-vinh" >Trà Vinh</option>
                            <option value="vinh-long" >Vĩnh Long</option>
						</select>
					</p>
					<div class="clearfix"></div>
					<p>
						<label>Quận Huyên:</label>
						<select class="form-control" id="city" style="width: 100%">
							<option>--Quận Huyện--</option>
						</select>
					</p>
		      	</div>
		      	<div class="modal-footer">
		      		<button type="button" class="btn btn-default" id="change" data-dismiss="modal">Ok</button>
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
		      	</div>
		    </div>
	  	</div>
	</div>
</body>
</html>