<?php
namespace Home\Facades;

class BaseFacades {
	/**
	 * 设置查询页码
	 * @param int $curPage
	 * @param int $pageSize
	 * @param string $order
	 * @param string $sort
	 *
	 * @return array
	 */
	protected function setPage($curPage = 1,$pageSize = 20,$order = '',$sort = "desc"){
		if($curPage < 1){
			$curPage = 1;
		}
		if($pageSize < 0){
			$pageSize = 20;
		}
		if(empty($order)){
			$order = "id desc";
		}
		else{
			$order = $order.' '.$sort;
		}
		return [$curPage,$pageSize,$order];
	}

	/**
	 * 搜索返回格式
	 * @param $itemCount
	 * @param $res
	 * @param $pageParams
	 * 				curPage
	 *				pageSize
	 * @return array
	 */
	protected function afterSearch($itemCount,$res,$pageParams){
		$pageParams['total'] = (int)$itemCount;
		$pageParams['pageNum'] = 9;
		$result = [
			'itemCount'=>(int)$itemCount,
			'result'=>$res,
			'page'=>$this->_getPage($pageParams),
		];
		return $result;
	}

	private function _getPage($pageParams){
		$floorPage = floor($pageParams['pageNum']/2);
		$startPage = $pageParams['curPage'] - $floorPage;
		$endPage = $pageParams['curPage'] + $floorPage;

		$totalPage = ceil($pageParams['total']/$pageParams['pageSize']);//页码总数
		$perPage = $pageParams['curPage'] - 1;//上一页

		$nextPage = $pageParams['curPage'] + 1;//下一页
		if($totalPage <= $pageParams['pageNum']){
			$startPage = 1;
			$endPage = $totalPage;
		}
		else{
			if($startPage < 1){
				$endPage = $pageParams['pageNum'];
				$startPage = 1;
			}
			if($endPage > $totalPage){
				$startPage = $totalPage - $pageParams['pageNum'] + 1;//总页数-固定页数+1
				$endPage = $totalPage;
			}
		}

		$page = '';
		if($pageParams['curPage'] > 1){
			$page.='<a href="javascript:void(0)" title="首页"  page="1">1</a>';
			$page.='<a href="javascript:void(0)" title="上一页" page="'.$perPage.'"> < </a>';
		}
		for($i=$startPage;$i<=$endPage;$i++){
			if($i == $pageParams['curPage']){
				//当前页
				$page.='<a href="javascript:void(0)" class="number current" title="'.$i.'" page="'.$i.'">'.$i.'</a>';
			}
			else{
				$page.='<a href="javascript:void(0)" class="number" title="'.$i.'" page="'.$i.'">'.$i.'</a>';
			}
		}
		if($pageParams['curPage'] < $totalPage){
			$page.='<a href="javascript:void(0)" title="下一页"> page="'.$nextPage.'"> </a>';
			$page.='<a href="javascript:void(0)" title="尾页" page="'.$totalPage.'">'.$totalPage.'</a>';//总页数就是尾页的页码
		}
		return $page;
	}
}