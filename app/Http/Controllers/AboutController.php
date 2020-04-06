<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Models\Provider;
use App\Models\Region;
use App\Models\Community;
use App\Models\Offer;
use App\Models\Business;
use App\Models\Theme;
use App\Models\OfferTheme;
use App\Models\OfferSample;
use App\Models\OfferCountry;
use App\Models\UseCase;
use App\Models\Contact;
use App\Models\Subscription;
use App\Models\Article;
use Response;
use Newsletter;

class AboutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //$this->middleware(['auth','verified']);
    }

    public function index(Request $request)
    {
        $teammates = array(
            array(
                'id'        => 1, 
                'avatar'    => '../images/dummy/Matthew_DB.png', 
                'name'      => 'Matthew van Niekerk',
                'title'  => 'Co-founder and CEO', 
                'linkedin' => 'https://www.linkedin.com/in/ceosettlemint/'
            ),
            array(
                'id'        => 2, 
                'avatar'    => '../images/dummy/Roderik_DB.png', 
                'name'      => 'Roderik van der Veer',
                'title'  => 'Co-founder and CTO', 
                'linkedin' => 'https://www.linkedin.com/in/roderik/'
            ),
            array(
                'id'        => 3, 
                'avatar'    => '../images/dummy/Vincent_DB.png', 
                'name'      => 'Vincent Bultot',
                'title'  => 'DataMatch Advisor', 
                'linkedin' => 'https://www.linkedin.com/in/vbultot/'
            ),
            array(
                'id'        => 4, 
                'avatar'    => '../images/dummy/Valentina_DB.png', 
                'name'      => 'Valentina Ponomariova',
                'title'  => 'Marketing and Communications Manager', 
                'linkedin' => 'https://www.linkedin.com/in/valentina-ponomariova-96a5705a/'
            ),
        );        
        $data = array( 'teammates' );
        return view('about.about', compact($data));
    }

    public function getAuthUser ()
    {
        return Auth::user();
    }

    public function partners(Request $request)
    {        
        $partners = array (
            array(
                'id'    => 1,
                'logo'  => '/images/partners/ericsson.png',
                'link'  => 'http://www.blog-ericssonfrance.com/2018/11/13/databroker-dao-rejoint-le-5g-life-campus-dericsson-a-hasselt-en-belgique/'
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/techzine.png',
                'link'  => 'https://www.techzine.be/nieuws/29548/belgen-op-mwc-settlemint-laat-zien-waartoe-blockchain-in-staat-is.html'
            ),
            array(
                'id'    => 3,
                'logo'  => '/images/partners/LeVif.png',
                'link'  => 'https://datanews.levif.be/ict/start-ups/une-start-up-de-louvain-ouvre-une-plate-forme-de-commerce-pour-donnees-iot/article-normal-1073539.html?cookie_check=1552640905'
            ),
            array(
                'id'    => 4,
                'logo'  => '/images/partners/datanews.png',
                'link'  => 'https://datanews.knack.be/ict/start-ups/leuvense-start-up-opent-handelsplatform-voor-iot-data/article-normal-1412063.html?cookie_check=1552640929'
            ),
            array(
                'id'    => 5,
                'logo'  => '/images/partners/PRNews.png',
                'link'  => 'https://eprnews.com/internet-of-things-marketplace-databroker-dao-continues-at-full-speed-announcing-3-new-alliance-members-and-listing-on-tokenjar-359835/'
            ),
            array(
                'id'    => 6,
                'logo'  => '/images/partners/inc.png',
                'link'  => 'https://www.inc.com/darren-heitner/the-internet-of-things-doesnt-have-to-be-confusing-heres-how-your-business-can-get-in-on-600-billion-market.html'
            ),
            array(
                'id'    => 7,
                'logo'  => '/images/partners/TechBullion.png',
                'link'  => 'https://www.techbullion.com/interview-with-matthew-van-niekerk-founder-of-databroker-dao-on-databroker-dao-token-sale/'
            ),
            array(
                'id'    => 8,
                'logo'  => '/images/partners/detijd.png',
                'link'  => 'https://www.tijd.be/dossier/blockchain/leuvenaars-halen-virtuele-miljoenen-op-voor-handel-in-sensordata/10012926.html'
            ),
            array(
                'id'    => 9,
                'logo'  => '/images/partners/criptonotcias.png',
                'link'  => 'https://www.criptonoticias.com/publicidad/databroker-dao-anuncio-fechas-road-show-china-duplica-recompensas-venta-token/'
            ),
            array(
                'id'    => 10,
                'logo'  => '/images/partners/Reuters.png',
                'link'  => 'https://www.reuters.com/brandfeatures/venture-capital/article?id=32112'
            ),
            array(
                'id'    => 11,
                'logo'  => '/images/partners/Medium.png',
                'link'  => 'https://medium.com/databrokerdao/is-databroker-dao-taking-on-iota-342dc1481812'
            ),
            array(
                'id'    => 12,
                'logo'  => '/images/partners/smartbelgium.png',
                'link'  => 'https://smartbelgium.belfius.be/deelnemers/databroker-dao-is-eerste-marktplaats-iot-data/'
            ),
            array(
                'id'    => 13,
                'logo'  => '/images/partners/jinse.png',
                'link'  => 'http://www.jinse.com/news/blockchain/116602.html'
            ),
            array(
                'id'    => 14,
                'logo'  => '/images/partners/momenta_partners.png',
                'link'  => 'https://www.momenta.partners/edge/unlocking-the-value-of-sensor-data-through-the-marketplace-part-1'
            ),
            array(
                'id'    => 15,
                'logo'  => '/images/partners/identitymindglobal.png',
                'link'  => 'https://cdn2.hubspot.net/hubfs/459645/IDM-DatabrokerDAO-CaseStudy.pdf?t=1505774771437'
            ),
            array(
                'id'    => 16,
                'logo'  => '/images/partners/BlockchainNews.png',
                'link'  => 'https://www.the-blockchain.com/2017/10/14/announcing-first-members-databrokerdao-alliance/'
            ),
            array(
                'id'    => 17,
                'logo'  => '/images/partners/demorgen.png',
                'link'  => 'https://myprivacy.persgroep.net/?siteKey=6OfBU0sZ5RFXpOOK&callbackUrl=https://www.demorgen.be/privacy-wall/accept?redirectUri=/economie/geld-ophalen-was-nog-nooit-zo-makkelijk-maar-is-het-ook-veilig-b4b9bc32/'
            ),
            array(
                'id'    => 18,
                'logo'  => '/images/partners/dsdestandaard.png',
                'link'  => 'http://www.standaard.be/cnt/dmf20170914_03072983'
            ),
            array(
                'id'    => 19,
                'logo'  => '',
                'link'  => ''
            ),
            array(
                'id'    => 20,
                'logo'  => '',
                'link'  => ''
            ),
            array(
                'id'    => 21,
                'logo'  => '/images/partners/globenewswire.png',
                'link'  => 'https://www.globenewswire.com/news-release/2017/08/31/1106159/0/en/Medici-Ventures-Portfolio-Company-SettleMint-Announces-Token-Sale-for-DataBroker-DAO-Beginning-September-18-2017.html'
            ),
            array(
                'id'    => 22,
                'logo'  => '/images/partners/marketwatch.png',
                'link'  => 'https://www.marketwatch.com/press-release/medici-ventures-portfolio-company-settlemint-announces-token-sale-for-databroker-dao-beginning-september-18-2017-2017-08-31'
            ),
            array(
                'id'    => 23,
                'logo'  => '',
                'link'  => ''
            ),
            array(
                'id'    => 24,
                'logo'  => '',
                'link'  => ''
            )
        );
        $resellers = array (
            array(
                'id'    => 1,
                'logo'  => '/images/partners/Image_25.png',
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/Image_26.png',
            ),
        );
        $data = array( 'partners', 'resellers' );
        return view('about.partners', compact($data));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function matchmaking(Request $request)
    {        
        return view('about.matchmaking');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function usecase(Request $request)
    {        
        $usecases = Article::where('communityIdx', '<>', null)->with('community')->orderby('published', 'desc')->limit(9)->get();
        $usecases2 = Article::where('communityIdx', '<>', null)->with('community')->orderby('published', 'desc')->limit(3)->get();
        $communities = Community::all();
        $data = array( 'usecases', 'usecases2', 'communities' );
        return view('about.usecase', compact($data));
    }

    public function news(Request $request)
    {        
        $updates = Article::where('communityIdx', null)->orderby('published', 'desc')->limit(9)->get();
        $updates2 = Article::where('communityIdx', null)->orderby('published', 'desc')->limit(3)->get();
        $data = array( 'updates', 'updates2');
        return view('about.news', compact($data));
    }

    public function updates_loadmore(Request $request)
    {
        $output = '';
        $published = $request->published;
        $updates = Article::where('communityIdx', null)->where('published', '<', $published)->orderby('published', 'desc')->limit(12)->get();
        if(!$updates->isEmpty())
        {
            foreach($updates as $update)
            {
                $published = $update->published;
                $author = $update->author;
                $title = $update->articleTitle;
                $id = $update->articleIdx;
                $image = $update->image;
                $output .= '<div class="col-md-4">'.
                                '<a href="/about/updates/'. $id .'" target="_blank">
                                    <div class="card card-profile card-plain">
                                        <div class="card-header holder" id="responsive-card-header">'.
                                            '<img class="img" src="/uploads/usecases/medium/'. $image .'" id="responsive-card-img">
                                        </div>
                                        <div class="card-body text-left">
                                            <div class="para-small">
                                                <span class="color-green"><b>- By&nbsp;'.$author.'&nbsp;|&nbsp;'.date_format($published,"F d, Y").'</b></span>
                                            </div>
                                            <h4 class="offer-title card-title">'.$title.'</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>';
            }
            if(count($updates) == 12)
            {
                $output .= '<div class="col-md-12">
                            <div class="flex-center" id="remove-row">
                                <button type="button" class="button blue-outline w225" id="btn-more" data-id="'. $published .'">LOAD MORE</button>
                            </div>
                        </div>';
            }
            echo $output;
        }
    }

    public function usecases_loadmore(Request $request)
    {
        $output = '';
        $published = $request->published;
        $usecases = Article::where('communityIdx', '<>', null)->where('published', '<', $published)->orderby('published', 'desc')->limit(12)->get();
        if(!$usecases->isEmpty())
        {
            foreach($usecases as $usecase)
            {
                $published = $usecase->published;
                $communityName = $usecase->community->communityName;
                $title = $usecase->articleTitle;
                $id = $usecase->articleIdx;
                $image = $usecase->image;
                $output .= '<div class="col-md-4">'.
                                '<a href="/about/usecase/'. $id .'" target="_blank">
                                    <div class="card card-profile card-plain">
                                        <div class="card-header holder" id="responsive-card-header">'.
                                            '<img class="img" src="/uploads/usecases/medium/'. $image .'" id="responsive-card-img">
                                        </div>
                                        <div class="card-body text-left">
                                            <div class="para-small">
                                                <span class="color-green"><b>'.$communityName.'</b></span>
                                            </div>
                                            <h4 class="offer-title card-title">'.$title.'</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>';
            }
            if(count($usecases) == 12)
            {
                $output .= '<div class="col-md-12">
                            <div class="flex-center" id="remove-row">
                                <button type="button" class="button blue-outline w225" id="btn-more" data-id="'. $published .'">LOAD MORE</button>
                            </div>
                        </div>';
            }
            echo $output;
        }
    }

    public function usecase_detail($id){

        $usecase = Article::where('articleIdx', $id)->with('community')->get();
        $usecases2 = Article::where('communityIdx', '<>', null)->with('community')->orderby('published', 'desc')->limit(3)->get();
        $data = array('usecase', 'usecases2');
        return view('about.usecase_detail', compact($data));
    }

    public function news_detail($id){
        // usecases detail
        // $usecase = Article::where('articleIdx', $id)->with('community')->get();
        // $usecases2 = Article::with('community')->orderby('published', 'desc')->limit(3)->get();
        // $data = array('usecase', 'usecases2');
        // return view('about.news_detail', compact($data));

        $update = Article::where('articleIdx', $id)->get();
        $updates2 = Article::where('communityIdx', null)->orderby('published', 'desc')->limit(3)->get();
        $data = array('update', 'updates2');
        // return view('about.news_detail', compact($data));
        return view('about.updates_detail', compact($data));
    }

    

    public function contact(){
        $user = $this->getAuthUser();
        $communities = Community::get();  
        $businesses = Business::get();
        $countries = Region::where('regionType', 'country')->get(); 
        if($user){
            $userData = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')
                            ->join('regions', 'regions.regionIdx', '=', 'companies.regionIdx')
                            ->where('userIdx', $user->userIdx)
                            ->get()
                            ->first();
        }else 
            $userData = null;
        $data = array( 'communities', 'businesses', 'countries', 'userData' );
        return view('about.contact', compact($data));
    }

    public function contact_pass(){
        $communities = Community::get();  
        $businesses = Business::get();
        $countries = Region::where('regionType', 'country')->get(); 
        $data = array( 'communities', 'businesses', 'countries' );
        return view('about.contact_pass', compact($data));
    }

    public function send(Request $request){
        $validator = Validator::make($request->all(),[
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'message' => 'required|min:5|max:1000',
            'companyName' => 'required|min:2',
            'regionIdx' => 'required',
            'community'=> 'required|array|min:1'
        ],[
            'community.required'=>'Please choose at least one.',
            'regionIdx.required'=>'The country field is required.'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $businessName = $request->businessName2==='Other industry'?$request->businessName:$request->businessName2;
        $role = $request->role2==='Other'?$request->role:$request->role2;

        $contact_data['firstname'] = $request->firstname;
        $contact_data['lastname'] = $request->lastname;
        $contact_data['email'] = $request->email;        
        $contact_data['companyName'] = $request->companyName;
        $contact_data['regionIdx'] = $request->regionIdx;
        $contact_data['businessName'] = $businessName;
        $contact_data['role'] = $role;
        $contact_data['content'] = $request->message;
        $contact_data['communities'] = json_encode($request->community);

        $contact_obj = Contact::create($contact_data);

        $data = $contact_data;
        $communities = array();
        foreach ($request->community as $key => $value) {
            $comm = Community::where('communityIdx', $value)->get()->first();
            array_push($communities, $comm['communityName']);
        }
        $data['communities'] = $communities;
        $region = Region::where('regionIdx', $request->regionIdx)->get()->first();
        $data['region'] = $region['regionName'];
        $allCommunities = Community::get();
        $hasInterests = array();
        foreach ($allCommunities as $key => $comm) {
            if(in_array($comm['communityName'], $communities))
                $hasInterests[$comm['communityName']] = "true";
            else $hasInterests[$comm['communityName']] = "false";
        }
        $query['message'] = $data['content'];
        $query['firstname'] = $data['firstname'];
        $query['lastname'] = $data['lastname'];
        $query['email'] = $data['email'];
        $query['companyName'] = $data['companyName'];
        $query['regionIdx'] = $data['regionIdx'];
        $query['businessName2'] = $request->businessName2 ? $request->businessName2 : "";
        $query['businessName'] = $request->businessName ? $request->businessName : "";
        $query['role2'] = $request->role2 ? $request->role2 : "";
        $query['role'] = $request->role ? $request->role : "";
        $query = array_merge($query, $hasInterests);

        $client = new \GuzzleHttp\Client();
        $url = "https://prod-33.westeurope.logic.azure.com:443/workflows/678891364593415ca0bd87aa5fdc1dae/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=L5XvuSyw821hQf4GUDLTY1OrPotQik6gvQ3nIJEAljk";
        $response = $client->request("POST", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=> json_encode($query)
        ]);

        $this->sendEmail("contact", [
            'from'=>"cg@jts.ec", 
            'to'=>env('DB_TEAM_EMAIL'), 
            'name'=>'Databroker', 
            'subject'=>'Message to the Databroker Team',
            'data'=>$data
        ]);
        $this->sendEmail("contact", [
            'from'=>"cg@jts.ec", 
            'to'=>"valentina@settlemint.com", 
            'name'=>'Databroker', 
            'subject'=>'Message to the Databroker Team',
            'data'=>$data
        ]);

        return view('about.contact_success');
    }

    public function media_center(){
        $press_list = array(
            array(
                'id'    => 1,
                'title' => 'Media inquiries',
                'text'  => 'We’re always happy to work with journalists from around the world to discuss the rising value and importance of data in general, or Databroker’s peer-to-peer data marketplace in particular. If you’re a member of the media and would like to talk with us, please get in touch.',
                'action'=> 'CONTACT US',
                'link'=>'contact'
            ),
            array(
                'id'    => 2,
                'title' => 'Databroker media kit',
                'text'  => 'Our media kit contains everything you need to write about Databroker, including web-friendly logos, photos of our team, short biographies of our founders, a company overview and a summary of what our platform offers.',
                'action'=> 'DOWNLOAD OUR MEDIA KIT',
                'link'=> 'download.data-toolkit'
            ),
        );
        $partners = array (
            array(
                'id'    => 1,
                'logo'  => '/images/partners/ericsson.png',
                'link'  => 'http://www.blog-ericssonfrance.com/2018/11/13/databroker-dao-rejoint-le-5g-life-campus-dericsson-a-hasselt-en-belgique/'
            ),
            array(
                'id'    => 2,
                'logo'  => '/images/partners/techzine.png',
                'link'  => 'https://www.techzine.be/nieuws/29548/belgen-op-mwc-settlemint-laat-zien-waartoe-blockchain-in-staat-is.html'
            ),
            array(
                'id'    => 3,
                'logo'  => '/images/partners/LeVif.png',
                'link'  => 'https://datanews.levif.be/ict/start-ups/une-start-up-de-louvain-ouvre-une-plate-forme-de-commerce-pour-donnees-iot/article-normal-1073539.html?cookie_check=1552640905'
            ),
            array(
                'id'    => 4,
                'logo'  => '/images/partners/datanews.png',
                'link'  => 'https://datanews.knack.be/ict/start-ups/leuvense-start-up-opent-handelsplatform-voor-iot-data/article-normal-1412063.html?cookie_check=1552640929'
            ),
            array(
                'id'    => 5,
                'logo'  => '/images/partners/PRNews.png',
                'link'  => 'https://eprnews.com/internet-of-things-marketplace-databroker-dao-continues-at-full-speed-announcing-3-new-alliance-members-and-listing-on-tokenjar-359835/'
            ),
            array(
                'id'    => 6,
                'logo'  => '/images/partners/inc.png',
                'link'  => 'https://www.inc.com/darren-heitner/the-internet-of-things-doesnt-have-to-be-confusing-heres-how-your-business-can-get-in-on-600-billion-market.html'
            ),
            array(
                'id'    => 7,
                'logo'  => '/images/partners/TechBullion.png',
                'link'  => 'https://www.techbullion.com/interview-with-matthew-van-niekerk-founder-of-databroker-dao-on-databroker-dao-token-sale/'
            ),
            array(
                'id'    => 8,
                'logo'  => '/images/partners/detijd.png',
                'link'  => 'https://www.tijd.be/dossier/blockchain/leuvenaars-halen-virtuele-miljoenen-op-voor-handel-in-sensordata/10012926.html'
            ),
            array(
                'id'    => 9,
                'logo'  => '/images/partners/criptonotcias.png',
                'link'  => 'https://www.criptonoticias.com/publicidad/databroker-dao-anuncio-fechas-road-show-china-duplica-recompensas-venta-token/'
            ),
            array(
                'id'    => 10,
                'logo'  => '/images/partners/Reuters.png',
                'link'  => 'https://www.reuters.com/brandfeatures/venture-capital/article?id=32112'
            ),
            array(
                'id'    => 11,
                'logo'  => '/images/partners/Medium.png',
                'link'  => 'https://medium.com/databrokerdao/is-databroker-dao-taking-on-iota-342dc1481812'
            ),
            array(
                'id'    => 12,
                'logo'  => '/images/partners/smartbelgium.png',
                'link'  => 'https://smartbelgium.belfius.be/deelnemers/databroker-dao-is-eerste-marktplaats-iot-data/'
            ),
            array(
                'id'    => 13,
                'logo'  => '/images/partners/jinse.png',
                'link'  => 'http://www.jinse.com/news/blockchain/116602.html'
            ),
            array(
                'id'    => 14,
                'logo'  => '/images/partners/momenta_partners.png',
                'link'  => 'https://www.momenta.partners/edge/unlocking-the-value-of-sensor-data-through-the-marketplace-part-1'
            ),
            array(
                'id'    => 15,
                'logo'  => '/images/partners/identitymindglobal.png',
                'link'  => 'https://cdn2.hubspot.net/hubfs/459645/IDM-DatabrokerDAO-CaseStudy.pdf?t=1505774771437'
            ),
            array(
                'id'    => 16,
                'logo'  => '/images/partners/BlockchainNews.png',
                'link'  => 'https://www.the-blockchain.com/2017/10/14/announcing-first-members-databrokerdao-alliance/'
            ),
            array(
                'id'    => 17,
                'logo'  => '/images/partners/demorgen.png',
                'link'  => 'https://myprivacy.persgroep.net/?siteKey=6OfBU0sZ5RFXpOOK&callbackUrl=https://www.demorgen.be/privacy-wall/accept?redirectUri=/economie/geld-ophalen-was-nog-nooit-zo-makkelijk-maar-is-het-ook-veilig-b4b9bc32/'
            ),
            array(
                'id'    => 18,
                'logo'  => '/images/partners/dsdestandaard.png',
                'link'  => 'http://www.standaard.be/cnt/dmf20170914_03072983'
            ),
            array(
                'id'    => 19,
                'logo'  => '',
                'link'  => ''
            ),
            array(
                'id'    => 20,
                'logo'  => '',
                'link'  => ''
            ),
            array(
                'id'    => 21,
                'logo'  => '/images/partners/globenewswire.png',
                'link'  => 'https://www.globenewswire.com/news-release/2017/08/31/1106159/0/en/Medici-Ventures-Portfolio-Company-SettleMint-Announces-Token-Sale-for-DataBroker-DAO-Beginning-September-18-2017.html'
            ),
            array(
                'id'    => 22,
                'logo'  => '/images/partners/marketwatch.png',
                'link'  => 'https://www.marketwatch.com/press-release/medici-ventures-portfolio-company-settlemint-announces-token-sale-for-databroker-dao-beginning-september-18-2017-2017-08-31'
            ),
            array(
                'id'    => 23,
                'logo'  => '',
                'link'  => ''
            ),
            array(
                'id'    => 24,
                'logo'  => '',
                'link'  => ''
            )
        );
        $data = array( 'press_list', 'partners' );
        return view('about.media_center', compact($data));        
    }

    public function terms_conditions(){
        return view('about.terms_conditions');
    }

    public function privacy_policy(){
        return view('about.privacy_policy');
    }

    public function cookie_policy(){
        return view('about.cookie_policy');
    }

    public function download(){
        //PDF file is stored under project/public/download/Databroker-Press-Kit.zip
        $file= public_path(). "/download/Databroker-Press-Kit.zip";
        $headers = array(
                'Content-Type: application/pdf',
                );
        return Response::download($file, 'Databroker-Press-Kit.zip', $headers);
    }

    protected function register_nl()
    {
        $communities = Community::get();
        $businesses = Business::get();
        $countries = Region::where('regionType', 'country')->get(); 
        $user = $this->getAuthUser();
        $userData = null;
        if($user){
            $userData = User::join('companies', 'companies.companyIdx', '=', 'users.companyIdx')->where('userIdx', $user->userIdx)->get()->first();
            $seenFlag = 0;
            $subscription = Subscription::where('email', $userData['email'])->get()->first();
            if(!$subscription){
                $data = array( 'communities', 'businesses', 'countries', 'userData' ); 
                return view('auth.nl_push', compact($data));
            }else{
                return redirect()->back();
            }
        }else{
            $data = array( 'communities', 'businesses', 'countries'); 
            return view('auth.register_nl', compact($data));
        }
    }  

    protected function create_nl(Request $request){
        if($request->userIdx)
            $rules = [
                "community"=> 'required|array|min:1'
            ];
        else
            $rules = [
                'firstname' => 'required|min:2',
                'lastname' => 'required|min:2',
                'email' => 'required|max:255|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'companyName' => 'required|min:2',
                'businessName2' => 'required',
                'role2' => 'required',
                'community'=> 'required|array|min:1'
            ];
        if($request->businessName2 == "Other industry") $rules['businessName'] = "required|string";
        if($request->role2 == "Other") $rules['role'] = "required|string";
        $validator = Validator::make($request->all(), $rules, [
            'companyName.required'=>'Your company name is required.',
            'businessName2.required'=>'Your industry is required.',
            'businessName.required'=>'Your industry is required.',
            'role2.required'=>'Your role is required.',
            'role.required'=>'Your role is required.',
            'community.required'=>'Please choose at least one.'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $businessName = ($request->businessName2==='Other industry' || !$request->businessName2)?$request->businessName:$request->businessName2;
        $role = ($request->role2==='Other' || !$request->role2)?$request->role:$request->role2;

        $subscription['firstname'] = $request->firstname;
        $subscription['lastname'] = $request->lastname;
        $subscription['email'] = $request->email;        
        $subscription['companyName'] = $request->companyName;
        $subscription['regionIdx'] = $request->regionIdx;
        $subscription['businessName'] = $businessName;
        $subscription['role'] = $role;
        $subscription['communities'] = json_encode($request->community);

        $subscriptionObj = Subscription::where('email', '=', $request->email)->get()->first();
        if($subscriptionObj) $subscriptionObj->delete();

        $subscriptionObj = Subscription::create($subscription);

        // if ( ! Newsletter::isSubscribed($request->email) ) {
        //     Newsletter::subscribe($request->email);
        // }

        $data = $subscription;
        $communities = array();
        foreach ($request->community as $key => $value) {
            $comm = Community::where('communityIdx', $value)->get()->first();
            array_push($communities, $comm['communityName']);
        }
        $data['communities'] = $communities;
        $region = Region::where('regionIdx', $request->regionIdx)->get()->first();
        $data['region'] = $region['regionName'];
        $allCommunities = Community::get();
        $hasInterests = array();
        foreach ($allCommunities as $key => $comm) {
            if(in_array($comm['communityName'], $communities))
                $hasInterests[$comm['communityName']] = "true";
            else $hasInterests[$comm['communityName']] = "false";
        }
        $query['firstname'] = $data['firstname'];
        $query['lastname'] = $data['lastname'];
        $query['email'] = $data['email'];
        $query['companyName'] = $data['companyName'];
        $query['regionIdx'] = $request->regionIdx ? $request->regionIdx : "";
        $query['businessName2'] = $request->businessName2 ? $request->businessName2 : "";
        $query['businessName'] = $request->businessName ? $request->businessName : "";
        $query['role2'] = $request->role2 ? $request->role2 : "";
        $query['role'] = $request->role ? $request->role: "";
        $query = array_merge($query, $hasInterests);

        $client = new \GuzzleHttp\Client();
        $url = "https://prod-48.westeurope.logic.azure.com:443/workflows/95373d6629684ab4a3adcc6572a61659/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=nmg5h6l_9s5gJnY9JIHRcCeZPcFnOF0l-dyi5mdWVbA";
        $response = $client->request("POST", $url, [
            'headers'=> ['Content-Type' => 'application/json'],
            'body'=> json_encode($query)
        ]);

        return view('auth.register_nl_success');
    }
}
