<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

	public function pagination($id,$totalPages,$currentPage){
		if($totalPages>1){
			$html  =  '<ul class="pagination media-review">';
				if($currentPage>1){
					$last = $currentPage-1;
					$html .=  '<a href="javascript:toPage('.$id.','.$last.');">上一页</a>';
				}
				for ($page=1; $page <=$totalPages;$page++) {
					$html .=  '<a ';
					if($page == $currentPage){
						$html .= 'class="hover"';
					}
					$html .= ' href="javascript:toPage('.$id.','.$page.');">'.$page.'</a>';
				}
				if ($totalPages>$currentPage) {
					$next = $currentPage+1;
			    	$html .=  '<a href="javascript:toPage('.$id.','.$next.');">下一页</a>';
			    }
			$html .=  '</ul>';
		}else{
			$html = "";
		}
		return $html;
	}

}