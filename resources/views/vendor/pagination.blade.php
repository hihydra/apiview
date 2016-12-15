@if(!empty($totalPages))
	<ul class="pagination">
	@if($totalPages>1)
		@if($currentPage>1)
		  <a href="?page={{$currentPage-1}}">上一页</a>
		@endif
		  @for ($page = 1; $page <= $totalPages; $page++)
		    <a @if($page == $currentPage)class="hover" @endif href="?type={{$type}}&page={{$page}}">{{$page}}</a>
		  @endfor
		@if($totalPages>$currentPage)
		  <a href="?page={{$currentPage+1}}">下一页</a>
		@endif
	@endif
	</ul>
	 <span class="txt">共{{$totalRecords}}条数据</span>
@endif