@extends('layout.master')
@section('title', '企业审核')

@section('custom-style')
	<link media="all" href="{{asset('../style/restrict.css')}}" type="text/css" rel="stylesheet">
@endsection

{{--@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection--}}

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 10,'type' =>0])
@endsection

@section('content')
   <div id="banner"><h1>招聘者身份审核</h1></div>
   @if($data['enterprise']['is_verification'] == 0)
	<div class="state-content" style="display: none;">
		<div class="file_content">
			<p class="file_success">
				<i class="iconfont icon-gou icon-glyph-success"></i>
			</p> 
			<ul class="file_check">
				<li class="file_line1">审核材料已提交，请等待审核结果</li> 
				<li class="file_line2" style="margin-top: 1rem;">我们将在收到材料的3个工作日内进行人工审核，审核结果会发送到你的站内信，请耐心等待...</li>
				<li>
					<p class="goto_back">
						<a href="/account"  class="btn">返回企业中心</a>
					</p>
				</li>
			</ul>  
			<p class="question_tip" style="text-align: center;">
				如有任何问题可工作日联系客服:021-63339866（9:00-18:00）
			</p>
		</div>
	</div>
	@elseif($data['enterprise']['is_verification'] == 1)
	<div class="state-content" style="display: block;">
		<div class="file_content"> 
			<p class="file_success">
				<i class="icon-glyph-success iconfont icon-popfailure"></i>
			</p> 
			<ul class="file_check">
				<li class="file_line1">招聘者身份审核已审核通过</li>
				<li class="file_line2" style="margin-top: 1rem;">无需重复提交
					<span>赶快登录官网，发布职位吧！</span>
				</li> 
				<li>
					<p class="goto_back">
						<a href="/position/publish"  class="btn">发布招聘</a>
					</p>
				</li>
			</ul> 
			<p class="question_tip">如公司全/简称有问题您有以下两个解决办法：</p> 
			<p class="question_tip">1、用户使用企业邮箱发送邮件至 kefu@eshunter.com，提供企业营业执照即可修改；</p> 
			<p class="question_tip">2、拨打客服服务热线：021-63339866 (9:00 -18:00)；</p>
		</div>
	</div>
   @elseif($data['enterprise']['is_verification'] == 2)
	   <div class="state-content" style="display: block;">
		   <div class="file_content">
			   <p class="file_success">
				   <i class="icon-glyph-fail iconfont icon-popfailure"></i>
			   </p>
			   <ul class="file_check">
				   <li class="file_line1">招聘者身份审核未通过</li>
				   <li class="file_line2" style="margin-top: 1rem;">拒绝原因：
					   <span>公司全称不符合规范（需在企业信息网可查备案信息）,公司营业执照不符合规范,请上传本人正确手持身份证照片</span>
				   </li>
				   <li>
					   <p class="goto_back">
						   <a href="/account"  class="btn">返回修改</a>
					   </p>
				   </li>
			   </ul>
			   <p class="question_tip">如公司全/简称有问题您有以下两个解决办法：</p>
			   <p class="question_tip">1、用户使用企业邮箱发送邮件至 kefu@eshunter.com，提供企业营业执照即可修改；</p>
			   <p class="question_tip">2、拨打客服服务热线：021-63339866 (9:00 -18:00)；</p>
		   </div>
	   </div>
   @endif
@endsection

@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
   
@endsection
