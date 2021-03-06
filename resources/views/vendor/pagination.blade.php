@if(!empty($totalPages))
@if ($pagenum = round(env("PAGENUM")/2)) @endif
<ul class="pagination">
	@if($totalPages>1)
		@if($currentPage>1)
			<a href="?type={{$type}}">首页</a>
			<a href="?type={{$type}}&page={{$currentPage-1}}">上一页</a>
		@endif

		<?php
			if($currentPage>$pagenum){
				$page = $currentPage-$pagenum;
				if($totalPages>($currentPage+$pagenum)){
					$forPage = $currentPage+$pagenum;
				}else{
					$forPage = $totalPages;
				}
			}else{
				$page = 1;
				if($totalPages>$pagenum){
					$forPage = $pagenum;
				}else{
					$forPage = $totalPages;
				}
			}

		?>
		@for ($page = $page; $page <= $forPage; $page++)
			<a @if($page == $currentPage)class="hover" @endif href="?type={{$type}}&page={{$page}}">{{$page}}</a>
		@endfor

		@if($totalPages>$currentPage)
			<a href="?type={{$type}}&page={{$currentPage+1}}">下一页</a>
			<a href="?type={{$type}}&page={{$totalPages}}">尾页</a>
		@endif
	@endif
</ul>
<span class="txt">共{{$totalRecords}}条数据</span>
@endif