<?
namespace Models;
use Libraries\DB as DB;
Class Tracking{

	public function __construct(){

	}

	public function getTrackingData($data){
		$whereTimestamp = "";
		if(!empty($data))
			$whereTimestamp = "WHERE ";
		$params = array();
		if(isset($data['start_date']) && isset($data['end_date'])){
			$whereTimestamp .= " timestamp >= ':startDate 00:00:01' AND timestamp <= ':endDate 23:59:59' ";
			$params[":startDate"] = date('Y-m-d', strtotime($data['start_date']));
			$params[":endDate"] = date('Y-m-d', strtotime($data['end_date']));
		}

		if(isset($data['campaign']) && $data['campaign'] != '-1'){
			$whereTimestamp .= "AND campaign = ':campaign'";
			$params[':campaign'] = $data['campaign'];
		}

		if(isset($data['tab_id']) && $data['tab_id'] != -1){
			$whereTimestamp .= "AND tab_id = ':tab_id'";
			$params[':tab_id'] = $data['tab_id'];
		}

		if(isset($data['product_id']) && (int)$data['product_id'] > -1){
			$whereTimestamp .= "AND product_id = :product_id";
			$params[':product_id'] = (int) $data['product_id'];
		}
		$result = DB::read("SELECT `timestamp`, `ip`, `useragent`,  `campaign`, CASE  WHEN tab_id != '-1' THEN `tab_id`  WHEN tab_id = '-1' THEN '-' END as tab_id , CASE  WHEN product_id != '0' THEN `product_id`  WHEN product_id = '0' THEN '-' END as product_id, `resolution` FROM pageviews $whereTimestamp", $params);
		return $result;
	}

	public function track($clickArgs){
		$trackingData = array(
			":ip"          => $_SERVER['REMOTE_ADDR'],
			":useragent"   => $_SERVER['HTTP_USER_AGENT'],
		);

		foreach ($clickArgs as $key => $value) {
			$trackingData[':'.$key] = $value;
		}

		$response = DB::write("INSERT INTO pageviews ( `ip`, `useragent`,  `campaign`, `tab_id`, `product_id`, `resolution`) VALUES (':ip',':useragent',':campaign',':tab_id' , ':product_id', ':resolution') ", $trackingData);

		return $response;
	}
}
?>