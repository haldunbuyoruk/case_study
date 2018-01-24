<div class="col-sm-3 sidenav">
    		<div class="nav-side-menu">
				<div class="menu-list">
					<ul class="menu-content"><li style="font-size: 24px;" title="Anasayfa"><a href="<?= \Configs\Config::BASE_URL?>"> <i class="fa fa-home" aria-hidden="true"></i>  <span style="font-size: 14px;">Anasayfa</span></a></li></ul>

<?
printNavBar($categories);

function printNavBar($categories, $mainCatID = 0) {

	$mainUlClass = 'sub-menu collapse';

	if($mainCatID == 0)
		$mainUlClass = 'menu-content collapse out';


	echo '<ul class="'.$mainUlClass.'" id="'.$mainCatID.'">';

	foreach ($categories as $item_id => $list_item) {

		$toggle = '';
		$hasChild = false;
		if(isset($list_item->children)){ // if child add collapse
			$toggle = 'data-toggle="collapse" data-target="#'.$list_item->id.'" class= "collapsed"';
			$hasChild = true;
		}
		echo '<li '.$toggle.'>';

		echo '<a target="_blank" href="https://www.epttavm.com/category/'.$list_item->slug.'" ><i class="fa" aria-hidden="true"></i>'.$list_item->name.'</a>';

		if ($hasChild) {
			echo '<span class="arrow"></span></li>';
			if(isset($list_item->children))
				printNavBar($list_item->children, $list_item->id);

		}

		echo '</li>';

	}

	echo '</ul>';

}



 ?>
			</div>
		</div>
	</div>