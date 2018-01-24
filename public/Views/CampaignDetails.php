<div class="col-sm-9">
<div class="row">
	<h1><?=$campaignDetails->title; ?></h1>
	<div class="campaigndates">Kampanya Geçerlilik Tarihi: <?=date("d-m-Y", strtotime($campaignDetails->start_date)); ?> / <?=date("d-m-Y",strtotime($campaignDetails->end_date)); ?> </div>
	<div class="image">
			<img src="//img.epttavm.com/<?=$campaignDetails->big_image_url; ?>" />
	</div>

	<div class="tabs">
		<ul class="nav nav-tabs">
	<?
		$tabContents= '<div class="tab-content">';
		foreach ($campaignDetails->tabs as $key => $tab) {
			$class= '';
			$tabContent = "";
			if($key == 0)
				$class = 'active';
			foreach ($tab->products as $p => $product) {
				$tabContent .='<div class="col-md-3 mrg-top" id="'.$product->id.'">
									<a  target="_blank" href="https://www.epttavm.com/item/'.$product->id.'"  onclick ="track(\''.str_replace("'"," ",$campaignDetails->title).'\', \''.$tab->name.'\', \''.$product->id.'\')"><div style="width:170px;height:140px;border:1px solid #000;text-align:center;"><i class="fa fa-circle-o-notch fa-spin" style="font-size:24px;margin-top:60px;"></i></div></a></div>';
			}
			$tabContents .= '<div class="tab-pane fade in '.$class.'" id= "'.$tab->id.'">'.$tabContent.'</div>';
			?>

			 <li class="campaign-tabs <?=$class;?>" data-id="<?=$tab->id;?>" data-slug="<?=$campaignDetails->slug;?>"><a href="#<?=$tab->id; ?>" data-toggle="tab"  onclick ="track('<?=str_replace("'"," ",$campaignDetails->title)?>', '<?=$tab->name;?>')"><?=$tab->name; ?></a>
			 </li>
		<?}

		$tabContents .= "</div>";
	?>
		</ul>
	</div>

	<?=$tabContents;?>

</div>