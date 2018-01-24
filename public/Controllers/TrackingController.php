<?

namespace Controllers;
use \Models\Tracking as Tracking;


class TrackingController{
	public $tracking;

		public function __construct(){
			$this->tracking = new Tracking();
		}

		public function track($clickArgs){
			return $this->tracking->track($clickArgs);
		}

		public function getData($data = ''){
			return $this->tracking->getTrackingData($data);
		}
}

?>