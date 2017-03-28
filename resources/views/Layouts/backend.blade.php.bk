<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VietNamOTO.Net - @yield('title')</title>

    <!-- Mainly scripts -->
    <script src="../backend/js/jquery-2.1.1.js"></script>
    <script src="../backend/js/bootstrap.min.js"></script>
    <script src="../backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../backend/js/formtoken.js"></script>

    <link href="../backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="../backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../backend/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="../backend/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="../backend/css/animate.css" rel="stylesheet">
    <link href="../backend/css/style.css" rel="stylesheet">

</head>

<body>
<div id="wrapper">
    <nav id="menu-left" class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{URL::asset($user->avatar)}}" width="50px" height="50px" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs"> <strong class="font-bold">{{$user->username}}</strong>
                             </span> </a>
                        {{--<ul class="dropdown-menu animated fadeInRight m-t-xs">--}}
                            {{--<li><a href="profile.html">Profile</a></li>--}}
                            {{--<li><a href="contacts.html">Contacts</a></li>--}}
                            {{--<li><a href="mailbox.html">Mailbox</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li><a href="../logout">Logout</a></li>--}}
                        {{--</ul>--}}
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li>
                    <a href="/admin/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Tổng quan</span> <span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="/admin/users"><i class="fa fa-th-large"></i> <span class="nav-label">Quản lý user</span> <span class="fa arrow"></span></a>
                </li>

                <li <?php if($name=="posts") echo 'class="active"';?> >
                    <a href="/admin/posts"><i class="fa fa-magic"></i> <span class="nav-label">Quản lý bài viết </span><span class="label label-info pull-right">{{$tt_baiviet}}</span></a>
                </li>
                <li>
                    <a href="/admin/news"><i class="fa fa-star"></i> <span class="nav-label">Quản lý tin tức</span> <span class="label label-warning pull-right">{{$tt_news}}</span></a>
                </li>
                <li>
                    <a href="/admin/salons"><i class="fa fa-database"></i> <span class="nav-label">Quản lý salon</span></a>
                </li>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" style="height: 500px !important;" class="gray-bg dashbard-1">
        <div id="toolbar_top" class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to <a href="/" target="_blank"><strong>VNO</strong></a></span>
                    </li>
                    <li>
                        <a href="../logout">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
        </div>

        @yield('content')

    </div>

</div>



<!-- Flot -->
<script src="../backend/js/plugins/flot/jquery.flot.js"></script>
<script src="../backend/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="../backend/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="../backend/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="../backend/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="../backend/js/plugins/peity/jquery.peity.min.js"></script>
<script src="../backend/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="../backend/js/inspinia.js"></script>
<script src="../backend/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="../backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- GITTER -->
<script src="../backend/js/plugins/gritter/jquery.gritter.min.js"></script>

<!-- Sparkline -->
<script src="../backend/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="../backend/js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="../backend/js/plugins/chartJs/Chart.min.js"></script>

<!-- Toastr -->
<script src="../backend/js/plugins/toastr/toastr.min.js"></script>


<script>
    $(document).ready(function() {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success('Last login: 2017-01-07 22:01:00', 'Welcome to VNO');

        }, 1300);


        var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis:{
                },
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );

        var doughnutData = [
            {
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 50,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 100,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var doughnutOptions = {
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            percentageInnerCutout: 45, // This is 0 for Pie charts
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };

//        var ctx = document.getElementById("doughnutChart").getContext("2d");
//        var DoughnutChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);

        var polarData = [
            {
                value: 300,
                color: "#a3e1d4",
                highlight: "#1ab394",
                label: "App"
            },
            {
                value: 140,
                color: "#dedede",
                highlight: "#1ab394",
                label: "Software"
            },
            {
                value: 200,
                color: "#A4CEE8",
                highlight: "#1ab394",
                label: "Laptop"
            }
        ];

        var polarOptions = {
            scaleShowLabelBackdrop: true,
            scaleBackdropColor: "rgba(255,255,255,0.75)",
            scaleBeginAtZero: true,
            scaleBackdropPaddingY: 1,
            scaleBackdropPaddingX: 1,
            scaleShowLine: true,
            segmentShowStroke: true,
            segmentStrokeColor: "#fff",
            segmentStrokeWidth: 2,
            animationSteps: 100,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false
        };
//        var ctx = document.getElementById("polarChart").getContext("2d");
//        var Polarchart = new Chart(ctx).PolarArea(polarData, polarOptions);



    });
</script>
</body>
</html>
