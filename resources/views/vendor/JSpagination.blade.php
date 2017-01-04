@if(!empty($totalPages))
@if ($pagenum = round(env("PAGENUM")/2)) @endif
<ul class="pagination media-review">
	@if($totalPages>1)
		@if($currentPage>1)
			<a href="javascript:toPage('{{$id}}','1');">首页</a>
			<a href="javascript:toPage('{{$id}}','{{$currentPage-1}}');">上一页</a>
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
			<a @if($page == $currentPage)class="hover" @endif href="javascript:toPage('{{$id}}','{{$page}}');">{{$page}}</a>
		@endfor

		@if($totalPages>$currentPage)
			<a href="javascript:toPage('{{$id}}','{{$currentPage+1}}');">下一页</a>
			<a href="javascript:toPage('{{$id}}','{{$totalPages}}');">尾页</a>
		@endif
	@endif
</ul>
@endif