@inject('apiPresenter','App\Presenters\ApiPresenter')
<div class="crumbs">
	<ul>
		{!!$apiPresenter->nav($type,$typeCh)!!}
		@if(!empty($title)||!empty($startStr))
		<li><a href="">{{{ $title or $startStr.'-'.$startStr.'食谱' }}}</a></li>
		@endif
	</ul>
</div>
<div class="clear"></div>
<div class="three_2">
	{!!$apiPresenter->sidebar($type)!!}
</div>
<script type="text/javascript">
  //导航高亮
  $(".nav").find("a[class='hover']").removeClass();
  var nav = $(".nav").find("[href$='{{$type}}']");
  nav.parent().parent().parent().find('a:first').addClass("hover");
  nav.addClass("hover");
  $(".three_2").find("a[href$='{{$type}}']").addClass("hover");
</script>
