<?
namespace Models;
use Helpers\Http as Http;
Class Campaigns{

	public function __construct(){

	}

	public function getCampaigns(){
		
		$campaigns = json_decode(Http::get_web_page('https://api.epttavm.com/campaign'));
		usort($campaigns->data, function($a,$b){
			$orderDiff = $a->order - $b->order;
			if($orderDiff) return $orderDiff;
			return strtotime($b->start_date) - strtotime($a->start_date);
		});

		return $campaigns->data;
	}



	public function getCampaignDetails($slug){
		$campaignDetails = json_decode(Http::get_web_page('https://api.epttavm.com/campaign/'.$slug));
		$campaignDetails->data->products = array();
		//$firstTab = (object)null;
		//$campaignDetails->data->tabs[0]->firstTab = $this->getCampaignTabs('pane-0',$campaignDetails->data->slug, false); // takes too long to get images

		return $campaignDetails->data;
	}

	public function getCampaignTabs($id,$slug, $returnJson = true){
		$id = (int)str_replace('pane-','',$id);
		$tabContent = json_decode(Http::get_web_page('https://api.epttavm.com/campaign/tab/'.$slug.'/'.$id));
		$products = $tabContent->data->tab->products;
		$returnContent = array();
		foreach ($products as $key => $product) {
			$returnContent[$key]['productID'] = $product->id;
			$returnContent[$key]['imagesrc'] = $this->getCampaignProductImage($product->id);
			$returnContent[$key]['url'] = ' https://www.epttavm.com/item/'.$product->id;
		}

		return $returnJson ? json_encode($returnContent) : $returnContent;

	}

	public function getCampaignProductImage($id){
		return (Http::get_web_page('https://api.epttavm.com/product/'.$id.'/image/170​'));
	}
}
?>