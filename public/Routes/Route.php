<?
namespace Routes;
use \Controllers\CategoriesController as CategoriesController;
use \Controllers\CampaignsController as CampaignsController;
use \Controllers\TrackingController as TrackingController;

use \Libraries\Router as Router;
use \Libraries\View as View;
Class Route{

	public $router;

	public $campaignsController;

	public $categoriesController;

	public $trackingController;


	public function __construct(){

		$this->router = new Router();
		$this->campaignsController = new CampaignsController();
		$this->categoriesController = new CategoriesController();
		$this->trackingController = new TrackingController();


		$this->router->map( 'GET', '/tabs/[*:tabID]/[*:slug]', function($tabID, $slug) {

		    $campaignDetails = $this->campaignsController->getCampaignTabs($tabID, $slug);
		    print_r($campaignDetails);
		    exit;
		});

		$this->router->map( 'POST', '/track/', function() {

			$clickArgs = array('campaign' => $_POST['campaign'], 'tab_id' => $_POST['tabID'], 'product_id' => $_POST['productID'], 'resolution' => $_POST['resolution']);
		    $response = $this->trackingController->track($clickArgs);
		    print_r(json_encode($response));
		    exit;
		});

		$this->router->map( 'POST', '/trackReport/', function() {
		    $response = $this->trackingController->getData($_POST);
		    print_r(json_encode($response));
		    exit;
		});

		$this->router->map( 'GET', '/reports', function() {
		    $data = $this->trackingController->getData();
		    View::render('Reports',$data->result, false);

		});

		$this->router->map( 'GET','/', function() {
		    $data['campaigns'] = $this->campaignsController->getCampaigns();
		    $data['categories'] = $this->categoriesController->getCategories();
		    View::render('Campaigns',$data);
		});

		$this->router->map( 'GET', '/campaign/[*:slug]', function( $slug ) {
		    $data['campaignDetails'] = $this->campaignsController->getCampaignDetails($slug);
		    $data['categories'] = $this->categoriesController->getCategories();
		    View::render('CampaignDetails',$data);
		});

		$match = $this->router->match();
		if( $match && is_callable( $match['target'] ) ) {
		    call_user_func_array( $match['target'], $match['params'] );
		} else {
		    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		}
	}


}
?>