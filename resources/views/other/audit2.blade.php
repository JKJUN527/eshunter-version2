@extends('layout.master')
@section('title', '企业审核2')

@section('custom-style')
<link media="all" href="{{asset('../style/app.css')}}" type="text/css" rel="stylesheet">
	<style type="text/css">
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
    			<div id="step">
    				<div id="step_1" class="step_num">
    					<span>完善个人信息</span>
    				</div> 
    				<div class="step_line"></div> 
    				<div id="step_2" class="step_num">
    					<span>确认公司信息</span>
    				</div>
    			</div>
    			<div class="comp-wrap img-to-img clearfix">
    				<div class="left_box left">
    					<img src="images/1.gif" alt="用户头像" class="img1"> 
    					<p>陈XX·老板</p>
    				</div> 
    				<div class="horizon-line"></div> 
    				<div class="right_box right">
    					<img src="images/1.gif" alt="公司头像" class="img2"> 
    					<p>店小二</p>
    				</div>
    			</div>
    			<form id="personalInfo" action="javascript:;" autocomplete="off">
    				<table class="table-layout">
    					<tbody>
    						<tr class="company-name">
    							<td class="title">
    								<span class="required title">公司全称</span>
    							</td> 
    							<td>
    								<span class="name">店小二</span>
    							</td>
    						</tr> 
    						<tr>
    							<td class="title">
    								<span class="required title">公司简称</span>
    							</td> 
    							<td>
    								<input type="text" placeholder="请填写全称简写或主要产品名称，将展示在公司主页" name="companyShortName" class="inputer input_zore"> 
    								<span class="vue-error vue-error-0" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>
    							</td>
    						</tr> 
    						<tr>
    							<td class="title">
    								<span class="required title">行业领域</span>
    							</td> 
    							<td>
    								<div class="comp-wrap vue-checkbox-select inputer">
    									<input name="industryField" type="text" readonly="readonly" placeholder="请选择" class="button input_one"> 
    										<i class="triangle input_one"></i> 
    										<div class="dropdown-wrap ul_one" style="display: none;">
    											<p style="font-size: 14px; color: rgb(153, 153, 153); margin-top: 12px;">(最多可选择两个)</p> 
    											<ul class=" ul_one1 clearfix ">
    												<li data-value="移动互联网">
    													移动互联网
    												</li>
    												<li data-value="电子商务">
    													电子商务
    												</li>
    												<li data-value="社交网络">
    													社交网络
    												</li>
    												<li data-value="企业服务">
    													企业服务
    												</li>
    												<li data-value="O2O">
    													O2O
    												</li>
    												<li data-value="教育">
    													教育
    												</li>
    												<li data-value="游戏">
    													游戏
    												</li>
    												<li data-value="旅游">
    													旅游
    												</li>
    												<li data-value="金融">
    													金融
    												</li>
    												<li data-value="医疗健康">
    													医疗健康
    												</li>
    												<li data-value="生活服务">
    													生活服务
    												</li>
    												<li data-value="信息安全">
    													信息安全
    												</li>
    												<li data-value="数据服务">
    													数据服务
    												</li>
    												<li data-value="广告营销">
    													广告营销
    												</li>
    												<li data-value="文化娱乐">
    													文化娱乐
    												</li>
    												<li data-value="硬件">
    													硬件
    												</li>
    												<li data-value="分类信息">
    													分类信息
    												</li>
    												<li data-value="招聘">
    													招聘
    												</li>
    												<li data-value="其他">
    													其他
    												</li>
    											</ul> 
    											<div class="error-tips" style="display: none;">
    												<i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 行业领域最多可选2个
            									</div>
    										</div> 
    										<span class="vue-error vue-error-1" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>
    								</div>
    							</td>
    						</tr> 
    						<tr>
    							<td class="title">
    								<span class="required title">公司规模</span>
    							</td> 
    							<td>
    								<div need-validate="true" class="comp-wrap vue-select inputer">
    									<input name="companySize" type="text" readonly="readonly" placeholder="请选择" class="button input_two"> 
    										<i class="triangle input_two"></i> 
    										<ul class="ul_two" style="display: none;">
    											<li data-value="少于15人">
                    								少于15人
                								</li>
                								<li data-value="15-50人">
                    								15-50人
                								</li>
                								<li data-value="50-150人">
                    								50-150人
                								</li>
                								<li data-value="150-500人">
                    								150-500人
                								</li>
                								<li data-value="500-2000人">
                    								500-2000人
                								</li>
                								<li data-value="2000人以上">
                    								2000人以上
                								</li>
    										</ul> 
    										<span class="vue-error vue-error-2" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>
    								</div>
    							</td>
    						</tr> 
    						<tr>
    							<td class="title">
    								<span class="required title">发展阶段</span>
    							</td> 
    							<td>
    								<div need-validate="true" class="comp-wrap vue-select inputer">
    									<input name="financeStage" type="text" readonly="readonly" placeholder="请选择" class="button input_three"> 
    										<i class="triangle"></i> 
    										<ul class="atUp ul_three" style="display: none;">
    											<li data-value="未融资">
                    								未融资
                								</li>
                								<li data-value="天使轮">
                    								天使轮
                								</li>
                								<li data-value="A轮">
                    								A轮
                								</li>
                								<li data-value="B轮">
                    								B轮
                								</li>
                								<li data-value="C轮">
                    								C轮
                								</li>
                								<li data-value="D轮及以上">
                    								D轮及以上
                								</li>
                								<li data-value="上市公司">
                    								上市公司
                								</li>
                								<li data-value="不需要融资">
                    								不需要融资
                								</li>
    										</ul> 
    										<span class="vue-error vue-error-3" style="display: none;"><i class="iconfont icon-gantanhao icon-glyph-attention2"></i> 此项不能为空</span>
    								</div>
    							</td>
    						</tr> 
    						<tr id="investment" style="display: none;">
    							<td class="title">
    								<span>投资机构</span>
    							</td> 
    							<td>
    								<ul>
    									<li style="display: none;">
    										<span class="investment_stage">
                                    			天使轮
                     						</span> 
                     						<div class="investment_date">
                     							<input type="text" placeholder="投资时间" readonly="readonly" class="no_select hasDatepicker" id="dp1516605871991"> 
                     								<i class="inverted_triangle"></i>
                     						</div> 
                     						<input type="text" placeholder="投资机构" maxlength="50" id="financeOrg0" class="investment_institution"> 
                     							<input type="text" placeholder="投资金额" maxlength="20" id="financeMoney0" class="investment_money">
    									</li>
    									<li style="display: none;">
    										<span class="investment_stage">
                                    			A轮
                                			</span> 
                                			<div class="investment_date">
                                				<input type="text" placeholder="投资时间" readonly="readonly" class="no_select hasDatepicker" id="dp1516605871992"> 
                                					<i class="inverted_triangle"></i>
                                			</div> 
                                			<input type="text" placeholder="投资机构" maxlength="50" id="financeOrg1" class="investment_institution"> 
                                				<input type="text" placeholder="投资金额" maxlength="20" id="financeMoney1" class="investment_money">
    									</li>
    									<li style="display: none;">
    										<span class="investment_stage">
                                    			B轮
                                			</span> 
                                			<div class="investment_date">
                                				<input type="text" placeholder="投资时间" readonly="readonly" class="no_select hasDatepicker" id="dp1516605871993"> 
                                					<i class="inverted_triangle"></i>
                                			</div> 
                                			<input type="text" placeholder="投资机构" maxlength="50" id="financeOrg2" class="investment_institution"> 
                                				<input type="text" placeholder="投资金额" maxlength="20" id="financeMoney2" class="investment_money">
    									</li>
    									<li style="display: none;">
    										<span class="investment_stage">
                                    			C轮
                                			</span> 
                                			<div class="investment_date">
                                				<input type="text" placeholder="投资时间" readonly="readonly" class="no_select hasDatepicker" id="dp1516605871994"> 
                                					<i class="inverted_triangle"></i>
                                			</div> 
                                			<input type="text" placeholder="投资机构" maxlength="50" id="financeOrg3" class="investment_institution"> 
                                				<input type="text" placeholder="投资金额" maxlength="20" id="financeMoney3" class="investment_money">
    									</li>
    									<li style="display: none;">
    										<span class="investment_stage">
                                    			D轮及以上
                                			</span> 
                                			<div class="investment_date">
                                				<input type="text" placeholder="投资时间" readonly="readonly" class="no_select hasDatepicker" id="dp1516605871995"> 
                                					<i class="inverted_triangle"></i>
                                			</div> 
                                			<input type="text" placeholder="投资机构" maxlength="50" id="financeOrg4" class="investment_institution"> 
                                			<input type="text" placeholder="投资金额" maxlength="20" id="financeMoney4" class="investment_money">
    									</li>
    								</ul>
    							</td>
    						</tr>
    					</tbody>
    				</table> 
    				<input type="submit" value="新建公司" class="submit">
    				<a href="step1.html" class="content-after-submit">返回上一步</a>
    			</form>
    		</div>
@endsection

@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
   
@endsection
