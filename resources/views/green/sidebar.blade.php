<div class="crumbs">
	<ul>
	  <li><a class="no" href="#">首页</a></li>
	  @if(empty($cateName))
	  <li><a href="/open/apply/32/category?type={{$type}}">{{$typeCh}}</a></li>
	  <li><a href="">{{{ $title or $startStr.'-'.$startStr.'食谱' }}}</a></li>
	  @else
	  <li><a href="">{{$cateName}}</a></li>
	  @endif
	</ul>
</div>
<div class="clear"></div>
<div class="three_2">
  <h2>园所简介</h2>
  <ul>
    <li><a href="#">公示公告</a></li>
    <li><a href="#">动态新闻</a></li>
    <li><a href="#">发展计划</a></li>
    <li><a href="#">热点专题</a></li>
    <li class="no"><a href="#">政策法规</a></li>
  </ul>
</div>
