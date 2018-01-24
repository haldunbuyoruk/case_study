<div class="col-sm-9">
<?
foreach ($campaigns as $key => $campaign) { ?>

<div class="row campaign-list" style="margin-top:10px">
	<a href='<?= \Configs\Config::BASE_URL?>campaign/<?= $campaign->slug?>' onclick ="track('<?=htmlspecialchars($campaign->title, ENT_QUOTES);?>')" >
		<div class="col-md-7">
			<img src="//img.epttavm.com/<?= $campaign->small_image_url; ?>" />
		</div>

		<div class="col-md-4"> <h2 class="campaign-title"><?=(strlen($campaign->title) > 100) ? substr($campaign->title,0, 100).'...' : $campaign->title ?> </h2>


		<p><b> Kampanya Geçerlilik Tarihi :</b> <?= date("d-m-Y", strtotime($campaign->start_date)); ?> / <?= date("d-m-Y",strtotime($campaign->end_date)); ?></p>
		<p><b> Kampanya Özeti: </b> <?= (strlen(strip_tags($campaign->detail)) > 100) ? substr(strip_tags($campaign->detail),0, 100).'...' : strip_tags($campaign->detail) ?> </p>
		</div>
	</a>
</div>

<? }

 ?>