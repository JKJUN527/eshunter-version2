@extends('layout.master')
@section('title', '企业审核')

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
    						<span>完善基础信息</span>
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
    									<span class="required">企业logo</span>
    								</td> 
    								<td>
    									<div class="upload-area">
    										<input type="file" name="head-img" id="input-head--img" class="img-box" onchange="showPreview(this)">
    											<div class="img-hover-tips img-box">
    												<i class="icon-glyph-upload">
														@if($data['enterprise']->elogo == null || $data['enterprise']->elogo == "")
															上传企业logo
														@endif
													</i>
                                				</div> 
                                			<input type="text" name="personalPic">
											@if($data['enterprise']->elogo != null && $data['enterprise']->elogo != "")
												<img  id="head-img" class="img-box" style="display: block;" src="{{$data['enterprise']->elogo}}"><br>
											@else
												<img  id="head-img" class="img-box" style="display: block;" src="{{asset('images/default-img.png')}}">
												<br>
											@endif
    									</div> 
                                		<span class="tips">建议使用招聘者真实头像提升企业真实性、专业性
                                			<br>支持jpg、jpeg、png，小于5MB
											<br>分辨率最大支持 1000像素 * 1000像素
                                		</span> 
                                		<span class="vue-error" style="display: none;">
                                			<i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空
                                		</span>
    								</td>
    							</tr> 
    							<tr>
    								<td class="title">
    									<span>职位发布显示名称</span>
    								</td> 
    								<td>
    									<input type="text" class="input_one" placeholder="请填写你公司别名，用于向求职者展示。Ex: XXX俱乐部" id="by_name" name="byname"
											   value="{{$data['enterprise']->byname}}">
    									<span class="vue-error vue-error-1" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>	
    								</td>
    							</tr> 
    							{{--<tr>--}}
    								{{--<td class="title">--}}
    									{{--<span class="required">职位</span>--}}
    								{{--</td> --}}
    								{{--<td>--}}
    									{{--<div need-validate="true" class="comp-wrap vue-input-suggest" scope="props">--}}
    										{{--<input name="positionName" class="input_two" placeholder="请填写当前公司的任职职位" type="text"> --}}
    										{{--<span class="vue-error vue-error-2" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>	--}}
    										{{--<ul class="suggests" style="display: none;">--}}
    												{{----}}
    										{{--</ul>--}}
    									{{--</div>--}}
    								{{--</td>--}}
    							{{--</tr> --}}
    							<tr>
    								<td class="title">
    									<span class="required" >接收简历邮箱</span>
    								</td> 
    								<td>
    									<input type="text" class="input_mail" placeholder="请填写常用邮箱，支持招聘设置中修改Ex: example@example.com"
											   id="enterprise-email" name="email" value="{{$data['enterprise']->email}}">
    										<span class="vue-error" style="display: none;">
    											<i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 
    										</span>
    								</td>
    							</tr>
								<tr>
									<td class="title">
										<span class="required" >公司联系电话</span>
									</td>
									<td>
										<input type="text" class="input_mail" id="enterprise-phone" name="etel"
											   placeholder="必填，Ex: (999)999999"
											   value="{{$data['enterprise']->etel}}">
										<span class="vue-error" style="display: none;">
    											<i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 
    										</span>
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="required" >公司全称</span>
									</td>
									<td>
										<input type="text" class="input_mail" id="ename" name="ename"
											   placeholder="请填写与营业执照/劳动合同一致的全称，不可随便修改"
											   value="{{$data['enterprise']->ename}}">
										<span class="vue-error" style="display: none;">
    											<i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 
    										</span>
									</td>
								</tr>
    						</tbody>
    					</table> 
    					<input type="submit" id="next-step" value="下一步" class="submit">
    					<div class="preview">
    						<p class="top">
    							<img src="http://www.eshunter.com/storage/profiles/2017-11-15-11-39-21-5a0bb6e9b09afelogo.jpg" alt="用户头像" width="80" height="80">
    								{{--<img src="" alt="用户头像" width="80" height="80" style="display: none;"> --}}
    									<span class="userName">电竞猎人</span>
    									<span class="positionName">上海汉竞信息科技有限公司</span>
    						</p> 
    						<p class="bottom">
    							<span class="receiveMail">kefu@eshunter.com</span>
    							<span class="companyFullName">(86)021-63339866</span>
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
   <script>
	   var isCorrect;
	   var isChangeHeadImg = false;
	   var originalHeadImg;
	   function showPreview(element) {
		   isCorrect = true;

		   var file = element.files[0];
		   var anyWindow = window.URL || window.webkitURL;
		   var objectUrl = anyWindow.createObjectURL(file);
		   window.URL.revokeObjectURL(file);

		   console.log(objectUrl);


		   var headImagePath = $("input[name='head-img']").val();

		   console.log(headImagePath);


		   if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(headImagePath)) {
			   isCorrect = false;
			   swal({
				   title: "错误",
				   type: "error",
				   text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
				   cancelButtonText: "关闭",
				   showCancelButton: true,
				   showConfirmButton: false
			   });
		   } else {
			   var size = file.size;
			   console.log(size);

			   if (size > 5 * 1024 * 1024) {
				   swal({
					   title: "错误",
					   type: "error",
					   text: "图片文件最大支持：5MB",
					   cancelButtonText: "关闭",
					   showCancelButton: true,
					   showConfirmButton: false
				   });
			   } else {
				   var reader = new FileReader();
				   reader.onload = function (e) {
					   var data = e.target.result;
					   //加载图片获取图片真实宽度和高度
					   var image = new Image();
					   image.onload = function () {
						   var width = image.width;
						   var height = image.height;
						   console.log(width + "//" + height);

						   if (width > 1000 || height > 1000) {
							   isCorrect = false;

							   swal({
								   title: "错误",
								   type: "error",
								   text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n图片分辨率最大支持 1000像素 * 1000像素",
								   cancelButtonText: "关闭",
								   showCancelButton: true,
								   showConfirmButton: false
							   });
						   } else if (isCorrect) {
							   originalHeadImg = $("#head-img").attr("src");
							   $("#head-img").attr("src", objectUrl);
							   $(".icon-glyph-upload").html("");
							   isChangeHeadImg = true;
						   }
					   };
					   image.src = data;
				   };
				   reader.readAsDataURL(file);
			   }
		   }
	   }
	   $("#next-step").click(function (event) {
		   event.preventDefault();
		   var file = $("#input-head--img");

		   var ename = $("#ename");
		   var byname = $("input[name='byname']");
		   var etel = $("input[name='etel']");
		   var email = $("input[name='email']");

		   if (ename.val() === "") {
			   swal("","公司名称不能为空","error");
			   return;
		   }

		   if (etel.val() === "") {
			   swal("","公司电话不能为空","error");
			   return;
		   }

		   if (email.val() === "") {
			   swal("","公司邮箱不能为空","error");
			   return;
		   } else {
			   var re=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			   if (re.test(email.val()) != true) {
				   swal("","邮箱格式不正确","error");
				   return;
			   }
		   }

		   var formData = new FormData();

		   formData.append("byname", byname.val());
		   formData.append("ename", ename.val());
		   formData.append("email", email.val());
		   formData.append("etel", etel.val());

		   if (file.prop("files")[0] === undefined) {
			   console.log("file is empty");
			   //formData.append('photo', "");
		   } else {
			   formData.append('elogo', file.prop("files")[0]);
		   }

		   $.ajax({
			   url: "/account/enprinfo/edit",
			   type: 'post',
			   dataType: 'text',
			   cache: false,
			   contentType: false,
			   processData: false,
			   data: formData,
			   success: function (data) {
//                console.log(data);
				   var result = JSON.parse(data);
				   if(result.status == 200){
					   self.location='/account/enterpriseVerify/2';
				   }else{
					   checkResult(result.status, "资料已修改", result.msg, null);
				   }

			   }
		   })
	   });

   </script>
@endsection
