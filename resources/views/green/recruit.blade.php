@extends('green.layouts')
@section('title')招生-@stop
@section('css')
<link rel="stylesheet" href="/assets/public/combo-select/combo.select.css" type="text/css"/>
<link href="/assets/green/css/add.css" rel="stylesheet" type="text/css">
@stop
@section('content')
<div id="div_display">
	<div class="content-1">
		@if(!empty($errorMsg))
		<div class="content-table-2">
			<div class="Table">
				<div class="inner-container">
					<div class="block">
						<div class="form-horizontal block-form" role="form">
							<div id="msg" class="alert alert-info">
								{!!$errorMsg!!}
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		@else
		<div class="content-table-1">
			<div class="Table">
				<form id="form_student">
					<input id="student_ipt_sid" name="sid" value="32" type="hidden">
					<input id="student_ipt_id" name="id" value="" type="hidden">
					<input id="student_ipt_guaId1" name="guaId1" value="" type="hidden">
					<input id="student_ipt_guaId2" name="guaId2" value="" type="hidden">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="100%" colspan="6">幼儿基本信息(必须项)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td width="15%">幼儿姓名：</td>
								<td width="15%"><input id="student_ipt_name" name="name" value="" type="text" placeholder="" class="inp"></td>
								<td width="15%">性别：</td>
								<td width="15%">
									<select id="student_ipt_sex" name="sex" class="seleCss" cmenu="true">
										<option value="">请选择</option>
										<option value="FALSE">男</option>
										<option value="TRUE">女</option>
									</select>
								</td>
								<td width="15%">出生年月：</td>
								<td width="15%"><input id="student_ipt_dateOfBirth" name="dateOfBirth" value="" type="text" class="inp Wdate" readonly="readonly" onclick="WdatePicker({startDate:'%y%M%d',dateFmt:'yyyyMMdd',alwaysUseStartDate:true,maxDate:'%y-%M-%d'})">
								</td>
							</tr>
							<tr>
								<td>民族：</td>
								<td>
									<select id="student_ipt_nation" name="nation" class="seleCss" cmenu="true">
									<option value="汉族">汉族</option>
									<option value="蒙古族">蒙古族</option>
									<option value="回族">回族</option>
									<option value="藏族">藏族</option>
									<option value="维吾尔族">维吾尔族</option>
									<option value="苗族">苗族</option>
									<option value="彝族">彝族</option>
									<option value="壮族">壮族</option>
									<option value="布依族">布依族</option>
									<option value="朝鲜族">朝鲜族</option>
									<option value="满族">满族</option>
									<option value="侗族">侗族</option>
									<option value="瑶族">瑶族</option>
									<option value="白族">白族</option>
									<option value="土家族">土家族</option>
									<option value="哈尼族">哈尼族</option>
									<option value="哈萨克族">哈萨克族</option>
									<option value="傣族">傣族</option>
									<option value="黎族">黎族</option>
									<option value="傈僳族">傈僳族</option>
									<option value="佤族">佤族</option>
									<option value="畲族">畲族</option>
									<option value="高山族">高山族</option>
									<option value="拉祜族">拉祜族</option>
									<option value="水族">水族</option>
									<option value="东乡族">东乡族</option>
									<option value="纳西族">纳西族</option>
									<option value="景颇族">景颇族</option>
									<option value="柯尔克孜族">柯尔克孜族</option>
									<option value="土族">土族</option>
									<option value="达斡尔族">达斡尔族</option>
									<option value="仫佬族">仫佬族</option>
									<option value="羌族">羌族</option>
									<option value="布朗族">布朗族</option>
									<option value="撒拉族">撒拉族</option>
									<option value="毛难族">毛难族</option>
									<option value="仡佬族">仡佬族</option>
									<option value="锡伯族">锡伯族</option>
									<option value="阿昌族">阿昌族</option>
									<option value="普米族">普米族</option>
									<option value="塔吉克族">塔吉克族</option>
									<option value="怒族">怒族</option>
									<option value="乌孜别克族">乌孜别克族</option>
									<option value="俄罗斯族">俄罗斯族</option>
									<option value="鄂温克族">鄂温克族</option>
									<option value="德昂族">德昂族</option>
									<option value="保安族">保安族</option>
									<option value="裕固族">裕固族</option>
									<option value="京族">京族</option>
									<option value="塔塔尔族">塔塔尔族</option>
									<option value="独龙族">独龙族</option>
									<option value="鄂伦春族">鄂伦春族</option>
									<option value="赫哲族">赫哲族</option>
									<option value="门巴族">门巴族</option>
									<option value="珞巴族">珞巴族</option>
									<option value="基诺族">基诺族</option>
									<option value="穿青人族">穿青人族</option>
									<option value="其他">其他</option>
								</select>
							</td>
							<td>身份证号：</td>
							<td><input id="student_ipt_idNo" name="idNo" value="" type="text" class="inp"></td>
							<td>健康状况：</td>
							<td>
								<select id="student_ipt_health" name="health" class="seleCss" cmenu="true">
									<option value="">请选择</option>
									<option value="健康或良好">健康或良好</option>
									<option value="一般或较弱">一般或较弱</option>
									<option value="有慢性病">有慢性病</option>
									<option value="有生理缺陷">有生理缺陷</option>
									<option value="残疾">残疾</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>住宅电话：</td>
							<td><input id="student_ipt_mobile" name="mobile" value="" type="text" class="inp"></td>
							<td>购房日期：</td>
							<td width="15%"><input id="student_ipt_datePurchase" name="datePurchase" value="" type="text" class="inp Wdate" readonly="readonly" onclick="WdatePicker({startDate:'%y%M%d',dateFmt:'yyyyMMdd',alwaysUseStartDate:true,maxDate:'%y-%M-%d'})">
							</td>
						</tr>
						<tr>
							<td>家庭住址：</td>
							<td colspan="5">
									<div id="div_region_0">
										<div id="div_region_0_0">
											<select id="region_0_0" class="seleCss" cmenu="true">
												 <option value="407684" selected="selected">武汉市</option>
											</select>
											<div id="div_region_407684_0">
												<select id="region_407684_0" class="seleCss" onchange="javascript:selRegion('407684','0','102');" cmenu="true">
													<option value="">--请选择--</option>
													<option value="408817">东西湖区</option>
													<option value="407685">市辖区</option>
												    <option value="410379">新洲区</option>
													<option value="408249">武昌区</option>
													<option value="408967">汉南区</option>
													<option value="408118">汉阳区</option>
													<option value="409343">江夏区</option>
													<option value="407686">江岸区</option>
													<option value="407845">江汉区</option>
													<option value="408541">洪山区</option>
													<option value="407966">硚口区</option>
													<option value="409019">蔡甸区</option>
													<option value="408442">青山区</option>
													<option value="409724">黄陂区</option>
												</select>
											</div>
										</div>
									</div>
									<input id="ipt_addressDetails" style="width: 180px;" type="text" class="inp" name="addressDetails" placeholder="详细地址（门牌号）...">
									<input id="ipt_region_0" name="region" type="hidden">
							</td>
						</tr>
						<tr>
							<td>幼儿户籍所在地：</td>
							<td colspan="5">
									<div id="div_region_1">
										<div id="div_region_0_1">
											<select id="region_0_1" class="seleCss" cmenu="true">
												 <option value="407684" selected="selected">武汉市</option>
											</select>
											<div id="div_region_407684_1">
												<select id="region_407684_1" class="seleCss" onchange="javascript:selRegion('407684','1','102');" cmenu="true">
													<option value="">--请选择--</option>
													<option value="408817">东西湖区</option>
													<option value="407685">市辖区</option>
												    <option value="410379">新洲区</option>
													<option value="408249">武昌区</option>
													<option value="408967">汉南区</option>
													<option value="408118">汉阳区</option>
													<option value="409343">江夏区</option>
													<option value="407686">江岸区</option>
													<option value="407845">江汉区</option>
													<option value="408541">洪山区</option>
													<option value="407966">硚口区</option>
													<option value="409019">蔡甸区</option>
													<option value="408442">青山区</option>
													<option value="409724">黄陂区</option>
												</select>
											</div>
										</div>
									</div>
									<input id="ipt_addressDetails" style="width: 180px;" type="text" class="inp" name="addressDetails" placeholder="详细地址（门牌号）...">
									<input id="ipt_region_0" name="region" type="hidden">
							</td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<th width="100%" colspan="6">监护人信息1</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>与幼儿关系*：</td>
							<td>
								<select id="guardian_ipt_relation1" name="relation1" class="seleCss" cmenu="true">
									<option value="">请选择</option>
									<option value="父亲">父亲</option>
									<option value="母亲">母亲</option>
									<option value="祖父母或外祖父母">祖父母或外祖父母</option>
									<option value="兄弟姐妹">兄弟姐妹</option>
									<option value="其他">其他</option>
								</select>
							</td>
							<td>监护人姓名*：</td>
							<td><input id="guardian_ipt_name1" name="name1" value="" type="text" placeholder="" class="inp"></td>
							<td>联系电话*：</td>
							<td><input id="guardian_ipt_mobile1" input="" name="mobile1" value="" type="text" class="inp"></td>
						</tr>
						<tr>
							<td>工作单位*：</td>
							<td><input id="guardian_ipt_workUnit1" name="workUnit1" value="" type="text" placeholder="" class="inp"></td>
							<td>户籍所在地：</td>
							<td><input id="guardian_ipt_idCardAddress1" name="idCardAddress1" value="" type="text" class="inp"></td>
						</tr>
						<tr>
						<td>备注：</td>
						<td colspan="3"><textarea name="note1" class="textarea"></textarea></td>
							<td colspan="2">（对军人、烈士子女等特殊情况说明）</td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<th width="100%" colspan="6">监护人信息2</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>与幼儿关系*：</td>
							<td>
							<select id="guardian_ipt_relation2" name="relation2" class="seleCss" cmenu="true">
								<option value="">请选择</option>
								<option value="父亲">父亲</option>
								<option value="母亲">母亲</option>
								<option value="祖父母或外祖父母">祖父母或外祖父母</option>
								<option value="兄弟姐妹">兄弟姐妹</option>
								<option value="其他">其他</option>
							</select>
							</td>
							<td>监护人姓名*：</td>
							<td><input id="guardian_ipt_name2" name="name2" value="" type="text" placeholder="" class="inp"></td>
							<td>联系电话*：</td>
							<td><input id="guardian_ipt_mobile2" input="" name="mobile2" value="" type="text" class="inp" ></td>
						</tr>
						<tr>
							<td>工作单位*：</td>
							<td><input id="guardian_ipt_workUnit2" name="workUnit2" value="" type="text" placeholder="" class="inp"></td>
							<td>户籍所在地：</td>
							<td><input id="guardian_ipt_idCardAddress2" name="idCardAddress2" value="" type="text" class="inp" ></td>
						</tr>
						<tr>
							<td>备注：</td>
							<td colspan="3"><textarea name="note2" class="textarea"></textarea></td>
							<td colspan="2">（对军人、烈士子女等特殊情况说明）</td>
						</tr>
					</tbody>
				</table>
			</form>
				<div class="clear"></div>
					<div id="p_fw_msg">
						<p>注：有 “ * ”  标记的内容为必填项。</p>
						<p>幼儿园的招生范围是：</p>
						@foreach($data['regionInfos'] as $regionInfo)
						<p>{{$regionInfo['names']}}</p>
						@endforeach
					</div>
					<div class="region_sub">
						<a id="ipt_submit" class="confirm" href="javascript:void(0);" onclick="javascript:submitStudent();">提交入园申请</a>
					</div>
				<div class="clear"></div>
			</div>
		</div>
		@endif
	</div>
</div>
@stop
@section('script')
<script type="text/javascript" src="/assets/green/js/recruit/admission.js"></script>
<script type="text/javascript" src="/assets/green/js/utils.js"></script>
<script type="text/javascript" src="/assets/green/js/recruit/region.js"></script>
<script type="text/javascript" src="/assets/public/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/assets/public/combo-select/jquery.combo.select.js"></script>
<script>
$(function() {
	$('select').comboSelect();
});
</script>
@stop