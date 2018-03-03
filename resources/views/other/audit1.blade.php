@extends('layout.master')
@section('title', '企业审核1')

@section('custom-style')
	<link media="all" href="{{asset('../style/app.css')}}" type="text/css" rel="stylesheet">
	<style type="text/css">
	    	#app {width: 100%;margin: 0 auto;}
	    	#app #personalInfo .table-layout tr td .comp-wrap .vue-error {bottom: 0px;}
	    	.user_userinfo_content1{margin-left: 15px;}
	    </style>
@endsection
{{--@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection--}}
@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 10,'type' =>0])
@endsection

@section('content')
   <div id="banner">
        		<h1>加入公司，开始招聘</h1>
    		</div>
    		<div id="app">
    			<div id="appMainContent">
    				<div id="step">
    					<div id="step_1" class="step_num">
    						<span>完善个人信息</span>
    					</div> 
    					<div class="step_line"></div> 
    					<div id="step_2" class="step_num step_disable">
    						<span>确认公司信息</span>
    					</div>
    				</div> 
    				<form id="personalInfo" action="javascript:;" autocomplete="off" class="content_container no_label">
    					<table class="table-layout">
    						<tbody>
    							<tr>
    								<td class="title">
    									<span class="required">头像</span>
    								</td> 
    								<td>
    									<div class="upload-area">
    										<input type="file" name="headPic" class="img-box"> 
    											<div class="img-hover-tips img-box">
    												<i class="icon-glyph-upload"></i>上传头像
                                				</div> 
                                			<input type="text" name="personalPic"> 
                                				<img src="" alt="用户头像" class="img-box" style="display: none;">
    									</div> 
                                		<span class="tips">建议使用招聘者真实头像提升真实性、专业性
                                			<br>支持jpg、jpeg、gif、png，小于10MB
                                		</span> 
                                		<span class="vue-error" style="display: none;">
                                			<i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空
                                		</span>
    								</td>
    							</tr> 
    							<tr>
    								<td class="title">
    									<span class="required">姓名</span>
    								</td> 
    								<td>
    									<input type="text" class="input_one" placeholder="请填写你工作中的姓名，用于向求职者展示" name="userName"> 
    									<span class="vue-error vue-error-1" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>	
    								</td>
    							</tr> 
    							<tr>
    								<td class="title">
    									<span class="required">职位</span>
    								</td> 
    								<td>
    									<div need-validate="true" class="comp-wrap vue-input-suggest" scope="props">
    										<input name="positionName" class="input_two" placeholder="请填写当前公司的任职职位" type="text"> 
    										<span class="vue-error vue-error-2" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>	
    										<ul class="suggests" style="display: none;">
    												
    										</ul>
    									</div>
    								</td>
    							</tr> 
    							<tr>
    								<td class="title">
    									<span>接收简历邮箱</span>
    								</td> 
    								<td>
    									<input type="text" class="input_mail" placeholder="请填写常用邮箱，支持招聘设置中修改" name="receiveEmail"> 
    										<span class="vue-error" style="display: none;">
    											<i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 
    										</span>
    								</td>
    							</tr> 
    							<tr>
    								<td class="title">
    									<span class="required">公司全称</span>
    								</td> 
    								<td class="company-name-td">
    									<div need-validate="true" class="comp-wrap vue-input-suggest" scope="props">
    										<input name="companyName" class="input_three" placeholder="请填写与营业执照/劳动合同一致的全称，不可随便修改" type="text"> 
    										<span class="vue-error vue-error-3" style="display: none"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span> 
    											<ul class="suggests" style="display: none;">
    												
    											</ul>
    									</div>
    								</td>
    							</tr>
    						</tbody>
    					</table> 
    					<input type="submit" value="下一步" class="submit"> 
    					<div class="preview">
    						<p class="top">
    							<img src="images/1.gif" alt="用户头像" width="80" height="80"> 
    								<img src="" alt="用户头像" width="80" height="80" style="display: none;"> 
    									<span class="userName">姓名</span> 
    									<span class="positionName">职位</span>
    						</p> 
    						<p class="bottom">
    							<span class="receiveMail">接收简历邮箱</span> 
    							<span class="companyFullName">公司全称</span>
    						</p> 
    						<span class="tail">示例</span>
    					</div>
    				</form> 
    			</div>
    		</div>
@endsection

@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
   
@endsection
