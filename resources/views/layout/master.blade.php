<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="baidu-site-verification" content="2qvzcodiFx">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('style/reset.css')}}">

    <link href="http://www.eshunter.com/favicon/favicon-16x16.png" rel="shortcut icon">
    <link media="all" href="{{asset('style/style.css?v=2.35')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('style/pub.css?v=2.33')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('style/webindex.css?v=2.35')}}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('style/iconfont.css')}}"/>
    <link href="{{asset('style/animation.css?v=2.32')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/style.css?v=2.43')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/base.css?v=2.39')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/style_qq.css?v=2.33')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" type="text/css" rel="stylesheet">

    <script src="{{asset('js/hm.js?e57ac2e0d645c16f50e241abc140f59f')}}"></script>
    <script src="{{asset('plugins/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/constants.js?v=2.32')}}" type="text/javascript"></script>
    <script src="{{asset('js/index_bo.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js?v=2.34')}}" type="text/javascript"></script>
    <script src="{{asset('js/json2.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/base.js?v=2.32')}}" type="text/javascript"></script>
    <script src="{{asset('js/choose.js?v=2.33')}}" type="text/javascript"></script>
    <script src="{{asset('js/placeholder.js?v=2.32')}}" type="text/javascript"></script>
    <script src="{{asset('js/san_index.js?v=1.02')}}" type="text/javascript"></script>

    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/master.js')}}" type="text/javascript"></script>
    <style>
        nav#page_tools ul li:hover,nav#page_tools ul li.active{
            background-color: #03A9F4;
            color: #fff!important;
        }
        nav#page_tools ul li:hover a{
            color: #fff!important;
        }
        nav#page_tools ul li a,nav#page_tools ul li span{
            display: inline-block;
            padding: 15px;
        }
        nav#page_tools ul li {
            display:inline-block;
            margin-bottom: 0px;
            cursor: pointer;
        }
        nav#page_tools{
            margin: 20px auto;
            text-align: center;
        }
    </style>

@section('custom-style')
    @show
    
</head>

<body>
	<div class='main-content'>
	  <div id='layout'>
	    <div id='header'>
	      	@section('header-nav')
		    @show

		    @section('header-tab')
		    @show
	    </div>

	    @section('content')
		@show

	    <div id='layout_footer'></div>
	  </div>

	  <div id='footer'>
	    @section('footer')
            @show
	  </div>
	</div>

<script type="text/javascript">
        $("*[to]").click(function () {
            self.location = $(this).attr('to');
        });
        window.onload = function(){
            var userAgentInfo = navigator.userAgent;
            var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
            for (var v = 0; v < Agents.length; v++) {
                if (userAgentInfo.indexOf(Agents[v]) > 0) {
                    top.location='/m';
                    break;
                }
            }
        }
</script>
@section('custom-script')
@show
</body>
</html>
