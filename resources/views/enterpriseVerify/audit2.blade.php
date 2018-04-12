@extends('layout.master')
@section('title', '企业审核')

@section('custom-style')
	<link media="all" href="{{asset('../style/app.css')}}" type="text/css" rel="stylesheet">
	<link media="all" href="{{asset('../style/user_style.css')}}" type="text/css" rel="stylesheet">
	<style type="text/css">
		.preview{
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			/*width: 260px;*/
			/*height: 260px;*/
			padding: 0 10px;
			background: #FFF;
			border: 1px solid #EAEDEC;
			box-shadow: 0 2px 4px 0 rgba(0,0,0,.07);
			border-radius: 3px;
			font-size: 14px;
		}
		.preview .top{
			text-align: center;
			border-bottom: 1px solid #F1F1F1;
		}
		.top img{
			margin-top: 20px;
			width: 80px;
			height: 80px;
			border-radius: 40px;
		}
		.top span{
			margin-top: 13px;
			font-size: 16px;
			color: #333;
			display: block;
			line-height: 22px;
			overflow: hidden;
		}
		.positionName{
			margin-top: 3px;
			margin-bottom: 12px;
			color: #555;
		}
		.preview .bottom{
			margin-top: 16px;
			font-size: 14px;
			color: #777;
			text-align: center;
		}
		.bottom span{
			display: block;
			line-height: 26px;
			overflow: hidden;
		}
		#app #personalInfo{
			margin-left: 10px !important;
		}
		#app #personalInfo .name{
			width: auto !important;
		}
		.input_box select{
			width: 446px;
			padding: 12px 16px;
			border: 1px solid #f8f8f8;
			border-radius: 2px;
			background-color: #f8f8f8;
			font-size: 14px;
			line-height: 20px;
			font-family: inherit;
		}
		.input_box textarea{
			display: block;
			box-sizing: border-box;
			width: 100%;
			height: 44px;
			margin-top: 0;
			padding: 12px 0;
			font-size: 14px;
			color: #555;
			border: 1px solid #f8f8f8;
			border-radius: 2px;
			background-color: #f8f8f8;
		}
		.form-group button{
			margin-top: 2rem;
			width: 10rem;
			height: 2.5rem;
			color: white;
			background-color: #00B38A;
		}
		.submit-btn{
			margin-top: 4rem;
		}
		.preview-img{
			margin-top: 2rem;
		}
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
						<div id="step_2" class="step_num">
							<span>确认公司信息</span>
						</div>
					</div>
					<div class="preview">
						<p class="top">
							<img src="http://www.eshunter.com/storage/profiles/2017-11-15-11-39-21-5a0bb6e9b09afelogo.jpg" alt="用户头像" width="80" height="80">
							{{--<img src="" alt="用户头像" width="80" height="80" style="display: none;"> --}}
							<span class="userName">{{$data['enterprise']->byname or 未填写公司别名}}</span>
							<span class="positionName">{{$data['enterprise']->ename}}</span>
						</p>
						<p class="bottom">
							<span class="receiveMail">{{$data['enterprise']->email}}</span>
							<span class="companyFullName">{{$data['enterprise']->etel}}</span>
						</p>

						<form id="personalInfo" action="javascript:;" autocomplete="off">
							<table class="table-layout">
								<tbody>
								<tr class="company-name">
									<td class="title">
										<span class="required title">公司全称</span>
									</td>
									<td>
										<span class="name">{{$data['enterprise']->ename}}</span>
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="required title">公司简称</span>
									</td>
									<td>
										<span class="name">{{$data['enterprise']->byname}}</span>
										{{--<input type="text" placeholder="请填写全称简写或主要产品名称，将展示在公司主页" name="companyShortName" class="inputer input_zore"> --}}
										{{--<span class="vue-error vue-error-0" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>--}}
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="required title">行业领域</span>
									</td>
									<td>
										<div class="username input_box">
											<select class="form-control show-tick selectpicker" id="enterprise-industry"
													name="enterprise-industry">
												<option value="0">请选择行业</option>
												@foreach($data['industry'] as $industry)
													<option value="{{$industry->id}}">{{$industry->name}}</option>
												@endforeach
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="required title">企业类型</span>
									</td>
									<td>
										<div class="username input_box">
											<select class="form-control show-tick selectpicker" id="enterprise-type"
													name="enterprise-type">
												<option value="0">请选择企业类型</option>
												<option value="1">国有企业</option>
												<option value="2">民营企业</option>
												<option value="3">中外合资企业</option>
												<option value="4">外资企业</option>
												<option value="5">社会团体</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="required title">企业规模</span>
									</td>
									<td>
										<div class="username input_box">
											<select class="form-control show-tick selectpicker" id="enterprise-scale"
													name="scale">
												<option value="0" @if($data['enterprise']->escale == null) selected @endif>
													请选择企业规模
												</option>
												<option value="1" @if($data['enterprise']->escale == 1) selected @endif>
													少于50人
												</option>
												<option value="2" @if($data['enterprise']->escale == 2) selected @endif>
													50人至200人
												</option>
												<option value="3" @if($data['enterprise']->escale == 3) selected @endif>
													200至500人
												</option>
												<option value="4" @if($data['enterprise']->escale == 4) selected @endif>
													500人至1000人
												</option>
												<option value="5" @if($data['enterprise']->escale == 5) selected @endif>
													1000人以上
												</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="title">
										<span class="required title">企业地址</span>
									</td>
									<td>
										<div class="username input_box">
										<textarea rows="3" class="form-control" name="enterprise-address"
												  id="enterprise-address"
												  placeholder="必填，Ex: xx省 xx市 xx区/县  xxx街道xxx号"
												  value="{{$data['enterprise']->address}}"></textarea>
										</div>
									</td>
								</tr>
								{{--<tr>--}}
								{{--<td class="title">--}}
								{{--<span class="required title">相关负责人手持身份证照片</span>--}}
								{{--</td>--}}
								{{--<td>--}}
								{{--<div class="form-group" id="id-card_holder" style="margin-top: 16px">--}}
								{{--<button id="id-card__upload-btn"--}}
								{{--class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">--}}
								{{--点击上传--}}
								{{--</button>--}}
								{{--</div>--}}

								{{--<div id="id-card__preview-holder">--}}
								{{--</div>--}}
								{{--</td>--}}
								{{--</tr>--}}
								</tbody>
							</table>
							<div class="form-group" id="id-card_holder" style="margin-top: 16px">
								<label for="enterprise-id__card">相关负责人手持身份证照片</label><br>
								<button id="id-card__upload-btn"
										class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
									点击上传
								</button>
							</div>
							<div id="id-card__preview-holder">
							</div>
							<div class="form-group" id="license_holder" style="margin-top: 16px">
								<label for="enterprise-license">企业营业执照</label><br>
								<button id="license__upload-btn"
										class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
									点击上传
								</button>
							</div>

							<div id="license__preview-holder">
							</div>
							<div class="submit-btn">
								<input type="submit" id="submit-verify" value="提交审核" class="submit">
								<a href="/account/enterpriseVerify/1" class="content-after-submit">返回上一步</a>
							</div>
						</form>
					</div>
    		</div>
	</div>
@endsection

@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
	<script type="text/javascript">
		var isUploadIdCard = false;
		var isUploadLicense = false;

		var idCardHolder = $("#id-card_holder");
		var licenseHolder = $("#license_holder");
		var idCardPreviewHolder = $("#id-card__preview-holder");
		var licensePreviewHolder = $("#license__preview-holder");

		$("#id-card__upload-btn").click(function (event) {
			event.preventDefault();
			swal({
				title: "要求",
				type: "info",
				text: "请相关负责人手持身份证，正面照相\n照相人免冠，五官应位于照片正中间\n身份证上字体清晰可辨",
				confirmButtonText: "知道了",
				closeOnConfirm: true
			}, function () {
				idCardHolder.append("<input type='file' name='id-card' hidden onchange='showIdCardPreview(this)'/>");
				$("input[name='id-card']").click();
			});
		});

		$("#license__upload-btn").click(function (event) {
			event.preventDefault();
			swal({
				title: "要求",
				type: "info",
				text: "营业执照干净，字迹清晰，没有涂改",
				confirmButtonText: "知道了",
				closeOnConfirm: true
			}, function () {
				licenseHolder.append("<input type='file' hidden name='license' onchange='showLicensePreview(this)'/>");
				$("input[name='license']").click();
			});
		});

		function showIdCardPreview(element) {
			var file = element.files[0];
			var anyWindow = window.URL || window.webkitURL;
			var objectUrl = anyWindow.createObjectURL(file);
			window.URL.revokeObjectURL(file);

			var idCardPath = $("input[name='id-card']").val();

			if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(idCardPath)) {
				isCorrect = false;
				swal({
					title: "错误",
					type: "error",
					text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
					cancelButtonText: "关闭",
					showCancelButton: true,
					showConfirmButton: false
				});
			} else if (file.size > 5 * 1024 * 1024) {
				swal({
					title: "错误",
					type: "error",
					text: "图片文件最大支持：5MB",
					cancelButtonText: "关闭",
					showCancelButton: true,
					showConfirmButton: false
				});
			} else {
				idCardPreviewHolder.html("<div class='preview-img'>" +
						"<i class='material-icons' onclick='removeIdCardPreview()'>close</i>" +
						"<img src='" + objectUrl + "' width='200'></div>");
				isUploadIdCard = true;
			}
		}

		function showLicensePreview(element) {
			var file = element.files[0];
			var anyWindow = window.URL || window.webkitURL;
			var objectUrl = anyWindow.createObjectURL(file);
			window.URL.revokeObjectURL(file);

			var licensePath = $("input[name='license']").val();

			if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(licensePath)) {
				isCorrect = false;
				swal({
					title: "错误",
					type: "error",
					text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
					cancelButtonText: "关闭",
					showCancelButton: true,
					showConfirmButton: false
				});
			} else if (file.size > 5 * 1024 * 1024) {
				swal({
					title: "错误",
					type: "error",
					text: "图片文件最大支持：5MB",
					cancelButtonText: "关闭",
					showCancelButton: true,
					showConfirmButton: false
				});
			} else {

				licensePreviewHolder.html("<div class='preview-img'>" +
						"<i class='material-icons' onclick='removeLicensePreview()'>close</i>" +
						"<img src='" + objectUrl + "' width='200'></div>");
				isUploadLicense = true;
			}

		}

		function removeIdCardPreview() {
			swal({
				title: "确认",
				text: "确认删除该图片吗？",
				confirmButtonText: "确定",
				cancelButtonText: "取消",
				showCancelButton: true,
				closeOnConfirm: true
			}, function () {
				idCardPreviewHolder.html("");
				isUploadIdCard = false;
				$("input[name='id-card']").remove();
			});
		}

		function removeLicensePreview() {
			swal({
				title: "确认",
				text: "确认删除该图片吗？",
				confirmButtonText: "确定",
				cancelButtonText: "取消",
				showCancelButton: true,
				closeOnConfirm: true
			}, function () {
				licensePreviewHolder.html("");
				isUploadLicense = false;
				$("input[name='license']").remove();
			});
		}

		$("#submit-verify").click(function (event) {
			event.preventDefault();

			var idCard = $("input[name='id-card']");
			var license = $("input[name='license']");

//			var name = $("input[name='enterprise-name']");
			var industry = $("select[name='enterprise-industry']");
			var type = $("select[name='enterprise-type']");
//			var email = $("input[name='enterprise-email']");
//			var phone = $("input[name='enterprise-phone']");
			var address = $("textarea[name='enterprise-address']");
			var scale = $("select[name='scale']");

//			if (name.val() === "") {
//				setError(name, "enterprise-name", "不能为空");
//				return;
//			} else {
//				removeError(name, "enterprise-name");
//			}

			if (industry.val() === "0") {
				swal("","请选择所属行业","error");
				return;
			}

			if (type.val() === "0") {
				swal("","请选择企业类型","error");
				return;
			}
			if (scale.val() === "0") {
				swal("","企业规模不能为空","error");
				return;
			}
			if (address.val() === "") {
				swal("","企业地址不能为空","error");
				return;
			}

			var formData = new FormData();

			formData.append("industry", industry.val());
			formData.append("enature", type.val());
			formData.append("address", address.val());
			formData.append("escale", scale.val());

			if (!isUploadIdCard) {
				swal({
					title: "错误",
					type: "error",
					text: "请上传相关负责人手持身份证照片",
					cancelButtonText: "关闭",
					showCancelButton: true,
					showConfirmButton: false
				});
				return;
			} else {
				formData.append('lcertifi', idCard.prop("files")[0]);
			}

			if (!isUploadLicense) {
				swal({
					title: "错误",
					type: "error",
					text: "请上传企业营业执照",
					cancelButtonText: "关闭",
					showCancelButton: true,
					showConfirmButton: false
				});
				return;
			} else {
				formData.append('ecertifi', license.prop("files")[0]);
			}

			$.ajax({
				url: "/account/enterpriseVerify/upload",
				type: 'post',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function (data) {
					console.log(data);
					var result = JSON.parse(data);
					checkResultWithLocation(result.status, result.msg, result.msg, '/account');
				}
			})
		});
//
//
//		$(".form-control").focus(function () {
//			$(this.parentNode).addClass("focused");
//		}).blur(function () {
//			$(this.parentNode).removeClass("focused");
//		});
	</script>
@endsection
