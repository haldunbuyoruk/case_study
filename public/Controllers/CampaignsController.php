<?
namespace Controllers;
use \Models\Campaigns as Campaigns;

Class CampaignsController{

	public $campaigns;

	public function __construct(){
		$this->campaigns = new Campaigns();
	}

	public function getCampaigns(){
		$campaignsData = $this->campaigns->getCampaigns();
		return $campaignsData;
	}

	public function getCampaignDetails($slug){
		return $this->campaigns->getCampaignDetails($slug);
	}


	public function getCampaignTabs($id, $slug){
		return $this->campaigns->getCampaignTabs($id,$slug);
	}
}
?>