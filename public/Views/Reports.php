<?
$html = '';
$campaign = array();
$tab_id = array();
$product_id = array();
foreach ($data as $key => $value) {
	$html .='<tr>
			<td>'.$value->timestamp.'</td>
			<td>'.$value->ip.'</td>
			<td>'.$value->resolution.'</td>
			<td>'.$value->useragent.'</td>
			<td>'.$value->campaign.'</td>
			<td>'.$value->tab_id.'</td>
			<td>'.$value->product_id.'</td>

		</tr>';
		array_push($campaign,$value->campaign);
		array_push($tab_id,$value->tab_id);
		array_push($product_id,$value->product_id);
}
?>
<div class="container">
	<div class="row">
		<div class='col-sm-3'>
			<div class="controls">
	            <div class="input-group">
	            	<label>Başlangıç Tarihi</label>
	                <input id="startDate" type="text" class="date-picker inpt form-control" />
	                <span for="startDate" onclick="openCalender('startDate')">
	                	<div class="glyphicon glyphicon-calendar" ></div>
	                </span>
	            </div>
	        </div>
		</div>
		<div class='col-sm-3'>
			<div class="controls">
	            <div class="input-group">
	            	<label>Bitiş Tarihi</label>
	                <input id="endDate" type="text" class="date-picker inpt form-control" />
	                <span for="endDate" onclick="openCalender('endDate')">
	                	<div class="glyphicon glyphicon-calendar" ></div>
	                </span>
	            </div>
	        </div>
		</div>
		<div class='col-sm-3'>
		</div>
	</div>
	<div style='clear:both'></div>
	<div class="row">
		<div class='col-sm-3'>
			<div class="controls">
	            <div class="form-group">
	            	<label>Kampanyalar</label>
	                <select name="campaign" id="campaign" class="form-control">
	                	<option value='-1'>Seçiniz</option>
	                	<?
	                		foreach (array_unique($campaign) as $key => $value) {
	                			echo "<option value='".$value."'>".$value."</option>";
	                		}
	                	?>
	                </select>
	            </div>
	        </div>
		</div>
		<div class='col-sm-3'>
			<div class="controls">
	            <div class="form-group">
	            	<label>Kampanya Tabları</label>
	                <select name="tab_id" id="tab_id" class="form-control">
	                	<option value='-1'>Seçiniz</option>
	                	<?
	                		foreach (array_unique($tab_id) as $key => $value) {
	                			echo "<option value='".$value."'>".$value."</option>";
	                		}
	                	?>
	                </select>
	            </div>
	        </div>
		</div>
		<div class='col-sm-3'>
			<div class="controls">
	            <div class="form-group">
	            	<label>Kampanya Ürünleri</label>
	                <select name="product_id" id="product_id" class="form-control">
	                	<option value='-1'>Seçiniz</option>
	                	<?
	                		foreach (array_unique($product_id) as $key => $value) {
	                			echo "<option value='".$value."'>".$value."</option>";
	                		}
	                	?>
	                </select>
	            </div>
	        </div>
		</div>
		<div style='clear:both'></div>
		<div class="col-sm-3">
			<button class="btn report-btn" onclick="getTracking();">Sorgula</button>
		</div>
	</div>

	<div class="row" style="margin-top: 50px;">

		<table class="table table-striped" id="report">
			<thead>
				<tr>
					<th>Görüntüleme Tarihi</th>
				    <th>IP</th>
					<th>Çözünürlük</th>
					<th>Tarayıcı</th>
					<th>Kampanya</th>
					<th>Tab</th>
					<th>Ürün #</th>

				</tr>
			</thead>
			<tbody>
				<?=$html?>
			</tbody>

		</table>
	</div>