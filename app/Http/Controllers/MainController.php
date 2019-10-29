<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                     
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$hd = $this->helpers->getHottestDeals();
		$na = $this->helpers->getNewArrivals();
		$bs = $this->helpers->getBestSellers();
		$hc = $this->helpers->getHotCategories();
		$sliders = $this->helpers->getSliders();
		//dd($sliders);
    	return view('index',compact(['user','cart','c','signals','hd','na','bs','hc','sliders']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAbout()
    {
               $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
    	return view('about',compact(['user','cart', 'c','signals']));
		//return redirect()->intended('/');
    }	

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBundle(Request $request)
    {
               $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$req = $request->all();
		$category = "";
		$bundleProducts = [];
		$q = "";
		
		if(isset($req['q']))
		{
			$q = $req['q'];
			$bundleProducts = $this->helpers->getDeals("deal",$req['q']);
			$category = $this->helpers->categories[$req['q']];
		} 
        else
        {
        	$bundleProducts = $this->helpers->getDeals("deal");
        }

        if(isset($req['p']))
		{
			$p = $req['p'];
			$bundleProducts = $this->helpers->refineDeals($deals,$p);
			#dd($deals);
			
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$deals = $bundleProducts;
		$title = "Bundle Products";
		
    	return view('deals',compact(['user','cart','deals','category','c','q','signals','title']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAuctions(Request $request)
    {
               $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$req = $request->all();
		$category = "";
		$auctions = [];
		$q = "";
		if(isset($req['q']))
		{
			$q = $req['q'];
			$auctions = $this->helpers->getAuctions($req['q']);
			$category = $this->helpers->categories[$req['q']];
		} 
        else
        {
        	$auctions = $this->helpers->getAuctions();
        }   
		
		if(isset($req['p']))
		{
			$p = $req['p'];
			$auctions = $this->helpers->refineAuctions($auctions,$p);
			#dd($deals);
			
		}
        #dd($auctions);		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$title = "Kloud Auctions";
    	return view('auctions',compact(['user','cart','auctions','category','c','q','signals','title']));
    }
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAuction(Request $request)
    {
               $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$req = $request->all();
		$category = "";
		$auction = [];
		if(isset($req['xf']))
		{
			$auction = $this->helpers->getAuction($req['xf']);
			$category = $this->helpers->categories[$req['q']];
			
			$c = $this->helpers->categories;
		    $signals = $this->helpers->signals;
		    $mainClass = "amado_product_area section-padding-100 clearfix";
        	return view('auction',compact(['user','cart','auction','category','c','signals','mainClass']));
		} 
        else
        {
        	return redirect()->intended('auctions');
        }     
		
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMyAuctions()
    {
               $user = null;
		
		$cart = [];
		$mine = "no";
		$category = $this->helpers->categories;
		
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$auctions = $this->helpers->getUserAuctions($user);
		}
        else
        {
        	return redirect()->intended('auctions');
        }     
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$mainClass = "amado_product_area section-padding-100 clearfix";
    	return view('my-auctions',compact(['user','cart','auctions','category','c','signals','mainClass']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddAuction(Request $request)
    {
       $user = null;
		$signals = $this->helpers->signals;
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$c = $this->helpers->categories;
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             $deal = $this->helpers->getDeal($req['xf']);
             if($deal == [])
             {
             	return redirect()->back();
             }
             else
             {
             	return view('add-auction',compact(['cart','user','c','signals','deal']));
             }        
         }          
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddAuction(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'days' => 'required',
                             'hours' => 'required',
                             'minutes' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req['deal_id'] = $req['xf'];
             $req['user_id'] = $user->id;
             $ret = $this->helpers->createAuction($req);
	        session()->flash("cobra-create-auction-status",$ret);
			return redirect()->intended('my-auctions');
         }        	
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEndAuction(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             #$req["uid"] = $user->id; 
             $ret = $this->helpers->adminEndAuction($req,"bid");
	        session()->flash("cobra-end-auction-status",$ret);
			return redirect()->intended('my-auctions');
         }           	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAutoEndAuction(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'ebxh' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             #$req["uid"] = $user->id; 
			 $reqq = explode("-",$req['ebxh']);
             $ret = $this->helpers->adminEndAuction($reqq[0],"bid");
	        session()->flash("cobra-end-auction-status",$ret);
			return redirect()->intended('my-auctions');
         }           	
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getDeleteAuction(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->intended('/');
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->deleteAuction($user, $req['xf']);
	        session()->flash("delete-auction-status",$ret);
			return redirect()->intended('my-auctions');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBid(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'sku' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             $req["user_id"] = $user->id; 
             $ret = $this->helpers->bid($req);
             if($ret == "no-funds") session()->flash("no-bid-status","ok");
	        else session()->flash("bid-status",$ret);
			return redirect()->intended('my-bids');
         }           	
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMyBids()
    {
               $user = null;
		
		$cart = [];
		$mine = "no";
		$category = $this->helpers->categories;
		
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$bids = $this->helpers->getUserBids($user);
		}
        else
        {
        	return redirect()->intended('auctions');
        }     
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$mainClass = "amado_product_area section-padding-100 clearfix";
    	return view('my-bids',compact(['user','cart','bids','category','c','signals','mainClass']));
    }
    

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTopDeals(Request $request)
    {
               $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$req = $request->all();
		$category = "";
		$topDeals = [];
		$q = "";
		
		if(isset($req['q']))
		{
			$q = $req['q'];
			$topDeals = $this->helpers->getDeals("deal",$req['q']);
			$category = $this->helpers->categories[$req['q']];
		} 
        else
        {
        	$topDeals = $this->helpers->getDeals("deal");
        }

        if(isset($req['p']))
		{
			$p = $req['p'];
			$topDeals = $this->helpers->refineDeals($deals,$p);
			#dd($deals);
			
		}
		
		$deals = $topDeals;
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$title = "Top Deals";
    	return view('deals',compact(['user','cart','category','deals','c','q','signals','title']));
    }	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeals(Request $request)
    {
               $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$req = $request->all();
		$category = "";
		$deals = [];
		$q = "";
		
		if(isset($req['q']))
		{
			$q = $req['q'];
			$deals = $this->helpers->getDeals("deal",$req['q']);
			$category = $this->helpers->categories[$req['q']];
		} 
        else
        {
        	$deals = $this->helpers->getDeals("deal");
        }

        if(isset($req['p']))
		{
			$p = $req['p'];
			$deals = $this->helpers->refineDeals($deals,$p);
			#dd($deals);
			
		}
		
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$title = "Deals";
    	return view('deals',compact(['user','cart','category','deals','c','q','signals','title']));
    }	
	

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCart()
    {
      $user = null;
	  $cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$cartTotals = $this->helpers->getCartTotals($cart);
		}
		else
        {    
        	return redirect()->intended('login?return=cart');
        }
		
		$deals = $this->helpers->getDeals("deal");
		
        $signals = $this->helpers->signals;
		#dd($cart);
		$mainClass = "cart-table-area section-padding-100";
        return view('cart',compact(['user','cart','cartTotals','signals','deals','mainClass']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getAddToCart(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        #dd($req);
        
        $validator = Validator::make($req, [
                             'qty' => 'required|numeric',
                             'sku' => 'required',
                             'sz' => 'required|not_in:undefined'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["user_id"] = $user->id; 
             $this->helpers->addToCart($req);
	        session()->flash("add-to-cart-status","ok");
			return redirect()->intended('cart');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postUpdateCart(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'quantity' => 'required|array|min:1',
                             'quantity.*' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$quantities = $req["quantity"]; 
             $this->helpers->updateCart($cart, $quantities);
	        session()->flash("update-cart-status","ok");
			return redirect()->intended('cart');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getRemoveFromCart(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'asf' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$asf = $req["asf"]; 
             $this->helpers->removeFromCart($user, $asf);
	        $request->session()->flash("remove-cart-status","ok");
			return redirect()->intended('cart');
         }        
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCheckout()
    {
		       $user = null;
		       $cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$sd = $this->helpers->getShippingDetails($user);
			$cartTotals = $this->helpers->getCartTotals($cart);
			$orderNumber = $this->helpers->generateOrderNumber("checkout");
			$states = $this->helpers->states;
		}
		else
        {
        	return redirect()->intended('login?return=checkout');
        }
        
		#dd($sd);
		$sdd = $sd[0];
        $signals = $this->helpers->signals;
		$mainClass = "cart-table-area section-padding-100";
        return view('checkout',compact(['user','cart','signals','cartTotals','sd','sdd','orderNumber','states','mainClass']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postCheckout(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        #dd($req);
        
        $validator = Validator::make($req, [
                             'fname' => 'required|filled',
                             'lname' => 'required|filled',
                             'email' => 'required|email|filled',
                             'address' => 'required|filled',
                             'city' => 'required|filled',
                             'state' => 'required|not_in:none',
                             'zip' => 'required|filled',
                             'sd' => 'required',
                             'phone' => 'required|filled',
                             'terms' => 'required|accepted',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $stt = $this->helpers->checkout($user,$req,"kloudpay");
	        $request->session()->flash("pay-kloudpay-status",$stt);
	       
            $location = 'orders'; 
	        if($stt == 'error') $location = 'checkout'; 
	        
			return redirect()->intended($location);
         }        
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeal(Request $request)
    {
		       $user = null;
		       $deal = [];
		       $req = $request->all();
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$validator = Validator::make($req, [
                             'sku' => 'required',
         ]);
         
         if($validator->fails())
         {
             #$messages = $validator->messages();
             return redirect()->intended('deals');
         }
         
         else
         {
         	$deal = $this->helpers->getDeal($req['sku']);
			#dd($deal);
             $mine = "no";
             if($user != null && ($user->id == $deal['u']->id)) $mine = "yes";
             $rating = $this->helpers->getUserRating($deal,$user);
             $overallRating = $this->helpers->getRating($deal);
             $comments = $this->helpers->getComments($deal);
			 $deals = $this->helpers->getDeals("deal");
             $category = $this->helpers->categories[$deal['category']];
             $signals = $this->helpers->signals;
		     $mainClass = "single-product-area section-padding-100 clearfix";
             return view('deal',compact(['user','cart','category','signals','deal','deals','rating','overallRating','comments', 'mine', 'mainClass']));
         }        
		
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postRateDeal(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'rating' => 'required|numeric',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->rateDeal($user, $req);
	        session()->flash("rate-deal-status",$ret);
			return redirect()->intended('deals');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getDeleteDeal(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->intended('/');
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->deleteDeal($user, $req['xf']);
	        session()->flash("delete-deal-status",$ret);
			return redirect()->intended('my-deals');
         }        
    }
    
      /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getDeleteStore(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->intended('/');
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->deleteUserStore($user,$req['xf']);
	        session()->flash("delete-store-status",$ret);
			return redirect()->intended('dashboard');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postComment(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'comment' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->commentDeal($user, $req);
	        session()->flash("comment-deal-status",$ret);
			return redirect()->intended('deals');
         }        
    }
    

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAirtime()
    {
		       $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		$title = "Buy Airtime";
        return view('airtime',compact(['user','cart','title']));
    }	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getHotels()
    {
		       $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		$title = "Book A Room";
        return view('hotels',compact(['user','cart','title']));
    }	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTravelStart()
    {
		       $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		$title = "Travel Start";
        return view('travelstart',compact(['user','cart','title']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getKloudPay()
    {
		       $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		$signals = $this->helpers->signals;
        return view('kloudpay',compact(['user','cart','signals']));
    }
    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getWallet()
    {
		       $user = null;
		       $wallet = [];
		$cart = [];
		$signals = $this->helpers->signals;
				
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$wallet = $this->helpers->getWallet($user);
			$transactions = $this->helpers->getTransactions($user);
		}
		
		else
        {
        	return redirect()->intended('login?return=wallet');
        }
        return view('wallet',compact(['user','cart','wallet','signals','transactions']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getKloudPayDeposit()
    {
		       $user = null;
		       $wallet = [];
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$wallet = $this->helpers->getWallet($user);
		}
		else
        {
        	return redirect()->intended('login?return=deposit');
        }
        return view('kloudpay-deposit',compact(['user','cart','wallet']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getKloudPayTransfer()
    {
		       $user = null;
		       $wallet = [];
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$wallet = $this->helpers->getWallet($user);
		}
		else
        {
        	return redirect()->intended('login?return=deposit');
        }
        return view('kloudpay-transfer',compact(['user','cart','wallet']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postKloudPayTransfer(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'phone' => 'required',
                             'amount' => 'required'                          
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->transferFunds($user, $req);
	        session()->flash("kloudpay-transfer-status",$ret);
			return redirect()->intended('kloudpay');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getKloudPayWithdraw()
    {
		       $user = null;
		       $wallet = [];
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$wallet = $this->helpers->getWallet($user);
			$fee = $this->helpers->getWithdrawalFee();
		}
		else
        {
        	return redirect()->intended('login?return=deposit');
        }
        return view('kloudpay-withdraw',compact(['user','cart','wallet','fee']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postKloudPayWithdraw(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'amount' => 'required'                          
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
             $ret = $this->helpers->withdrawFunds($user, $req);
	        session()->flash("kloudpay-withdraw-status",$ret);
			return redirect()->intended('kloudpay');
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getOrders()
    {
		       $user = null;
		       $orders = [];
		       $cart = [];
		$signals = $this->helpers->signals;
					   
		if(Auth::check())
		{
			$user = Auth::user();
			$orders = $this->helpers->getOrders($user);
			$cart = $this->helpers->getCart($user);
		}
		else
        {
        	return redirect()->intended('login?return=orders');
        }
        return view('orders',compact(['user','cart','orders','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getInvoice(Request $request)
    {
		       $user = null;
		       $invoice = [];
		
		if(Auth::check())
		{
			$user = Auth::user();
			$req = $request->all();
			$validator = Validator::make($req, [
                             'on' => 'required',
             ]);
         
            if($validator->fails())
             {
                #$messages = $validator->messages();
                return redirect()->intended('orders');
            }
            else
            {
                $invoice = $this->helpers->getUserInvoice($user,$req['on']);
				#dd($invoice);
                $alertClass = "danger";
                $sd = $this->helpers->getSingleShippingDetails($user,$invoice['sd']);
                $alert = true; 
                $alertText = "This invoice has been marked as UNPAID. ";
                
                if(isset($invoice['status']) && $invoice['status'] == "active"):
                   $alertClass = "success";
                   $alert = false; 
                endif; 
                
                if($invoice == []):
                  $alert = true; 
                  $alertClass = "warning";
                  $alertText = "Invalid order number. Please check the number and try again.";
                endif; 
                return view('invoice',compact(['user','invoice','sd', 'alert', 'alertClass','alertText']));
            }         
		}
		else
        {
        	return redirect()->intended('login?return=orders');
        }
        
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEnterprise()
    {
		       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$mainClass = "cart-table-area section-padding-100";
        return view('enterprise',compact(['user','mainClass']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFAQ()
    {
		       $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
        return view('faq',compact(['user','cart']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDashboard()
    {
		       $user = null;
		       $dashboard = [];
		       $cart = [];
		$signals = $this->helpers->signals;
				
		if(Auth::check())
		{
			$user = Auth::user();
			//$dashboard = $this->helpers->getDashboard($user);
			$sd = $this->helpers->getShippingDetails($user);
			$transactions = $this->helpers->getTransactions($user);
			$wallet = $this->helpers->getWallet($user);
			$cart = $this->helpers->getCart($user);
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
		
		
        return view('dashboard',compact(['user','sd', 'wallet','cart','transactions','signals']));
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProfile()
    {
		       $user = null;
		       $dashboard = [];
		       $cart = [];
		$signals = $this->helpers->signals;
				
		if(Auth::check())
		{
			$user = Auth::user();
			$account = $this->helpers->getUser($user->email);
			$cart = $this->helpers->getCart($user);
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
		
		
        return view('profile',compact(['user','account', 'cart', 'signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postProfile(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'fname' => 'required',
                             'lname' => 'required',
                             'email' => 'required|email',
                             'phone' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["xf"] = $user->id; 
         	$this->helpers->updateProfile($user, $req);
	        session()->flash("profile-status","ok");
			return redirect()->intended('profile');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMerchants()
    {
		       $user = null;
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			if($user->verified == "vendor"){
			return redirect()->intended('my-store'); 
           }
		}
		
		
			return view('merchants',compact(['user','cart']));
        
        
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMyDeals()
    {
       $user = null;
		$signals = $this->helpers->signals;
		
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$c = $this->helpers->categories;
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		
		$deals = $this->helpers->getUserDeals($user);
    	return view('my-deals',compact(['user','deals','cart','c','signals']));
    }
    
        /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddDeal()
    {
       $user = null;
		$signals = $this->helpers->signals;
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
			$c = $this->helpers->categories;
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		
		#$deals = $this->helpers->adminGetDeals();
    	return view('add-deal',compact(['user','cart','c','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddDeal(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        #dd($req);
        
        $validator = Validator::make($req, [
                             'name' => 'required',
                             'category' => 'required',
                             'description' => 'required',
                             'size-1' => 'required|not_in:none',
                             'color' => 'required|not_in:null',
                             'amount' => 'required|numeric',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["user_id"] = $user->id; 
             $req["type"] = "deal";

             $sz = "";
             if($req['size-1'] == "other")
			 {
				 if(isset($req['size-2']) && $req['size-2'] > 0) $sz = $req['size-2'];
				 else $sz = "0";
			 }
             else
			 {
				 $sz = $req['size-1'];
			 }
             $req['size'] = $sz;
			 
             $d = $this->helpers->createDeal($req);
			  $req["sku"] = $d->sku; 
	        session()->flash("add-deal-status","ok");
	        $this->helpers->notifyAdmin("deal",$req);
			return redirect()->intended('my-store');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTransactions()
    {
		       $user = null;
		       $transactions = [];
		       $cart = [];
		
		if(Auth::check())
		{
			$user = Auth::user();
			$transactions = $this->helpers->getTransactions($user);
			$cart = $this->helpers->getCart($user);
		}
		else
        {
        	return redirect()->intended('login?return=transactions');
        }
		
        return view('transactions',compact(['user','cart','transactions']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getStores()
    {
		       $user = null;
		       $deals = [];
		       $cart = [];
			   $signals = $this->helpers->signals;
			   
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);		
		}
		
		$stores = $this->helpers->getStores();
        #dd($stores);
		return view('stores',compact(['user','cart','stores','signals']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getStore($flink)
    {
		       $user = null;
		       $deals = [];
		       $cart = [];
			   
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);			
		}
		
		$signals = $this->helpers->signals;
		$store = $this->helpers->getStore($flink);
        #dd($store);        
        
		if(count($store) < 1)
        {
        	return redirect()->intended('stores');
        }
        
        
        $title = (isset($store["name"])) ? $store["name"] : "Store";
        $mine = "no";
		return view('store',compact(['user','cart','store','title','mine','signals']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMyStore()
    {
		       $user = null;
		       $deals = [];
		       $cart = [];
			   $signals = $this->helpers->signals;
			   
		if(Auth::check())
		{
			$user = Auth::user();
			$store = $this->helpers->getUserStore($user);
			$cart = $this->helpers->getCart($user);			
		}
		else
        {
        	return redirect()->intended('stores');
        }
		#dd($store);
		$title = (isset($store["name"])) ? $store["name"] : "Store";
        $mine = "yes";
		return view('store',compact(['user','cart','store','title','mine','signals']));
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getManageMyStore()
    {
		       $user = null;
		       $deals = [];
		       $store = [];
		       $cart = [];
			   $signals = $this->helpers->signals;
			   
		if(Auth::check())
		{
			$user = Auth::user();
			$store = $this->helpers->getUserStore($user);
			$cart = $this->helpers->getCart($user);			
		}
		
		if(count($store) < 1)
        {
        	return redirect()->intended('stores');
        }
        
		#dd($store);
		$title = (isset($store["name"])) ? $store["name"] : "Store";
        $mine = "yes";
		return view('manage-store',compact(['user','cart','store','title','mine','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditStore()
    {
		       $user = null;
		       $store = [];
		       $cart = [];
			   $signals = $this->helpers->signals;
			   
		if(Auth::check())
		{
			$user = Auth::user();
			$store = $this->helpers->getUserStore($user);
			$cart = $this->helpers->getCart($user);			
		}
		
		if(count($store) < 1)
        {
        	return redirect()->intended('stores');
        }
        
		#dd($store);
		$title = (isset($store["name"])) ? $store["name"] : "Store";
        $mine = "yes";
		return view('edit-store',compact(['user','cart','store','title','mine','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditStore(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'ird' => 'required',
                             'name' => 'required',
                             'flink' => 'required',
                             'description' => 'required',
							 
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
             $r = $this->helpers->updateUserStore($user, $req);
	        session()->flash("update-store-status",$r);
			return redirect()->intended('manage-my-store');
         }        
    }
	
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getStoreSalesHistory()
    {
		       $user = null;
		       $store = [];
		       $cart = [];
			   $signals = $this->helpers->signals;
			   
		if(Auth::check())
		{
			$user = Auth::user();
			$store = $this->helpers->getUserStore($user);
			$sales = $this->helpers->getTransactions($user);
			$cart = $this->helpers->getCart($user);			
		}
		
		if(count($store) < 1)
        {
        	return redirect()->intended('stores');
        }
        
		#dd($store);
		$title = (isset($store["name"])) ? $store["name"] : "Store";
        $mine = "yes";
		return view('sales-history',compact(['user','cart','store','title','mine','sales','signals']));
    }
    
   /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditDeal(Request $request)
    {
		       $user = null;
		       $deal = [];
		       $req = $request->all();
		
		$cart = [];
		if(Auth::check())
		{
			$user = Auth::user();
			$cart = $this->helpers->getCart($user);
		}
		
		$validator = Validator::make($req, [
                             'sku' => 'required',
         ]);
         
         if($validator->fails())
         {
             #$messages = $validator->messages();
             return redirect()->intended('deals');
         }
         
         else
         {
         	$deal = $this->helpers->getUserDeal($user, $req['sku']);
             $mine = "yes";
             
             if(count($deal) < 1)
             {
             	$du = "deal?sku=".$req['sku'];
             	return redirect()->intended($du);
            }
            
             $signals = $this->helpers->signals;
             $categories = $this->helpers->categories;
			 $c = $this->helpers->categories;
		     #$mainClass = "single-product-area section-padding-100 clearfix";
			 #dd($deal);
             return view('edit-deal',compact(['user','cart','c','categories','signals','deal']));
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditDeal(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                            'name' => 'required',
                            'ird' => 'required',
                            'irdc' => 'required|numeric',
                            'sku' => 'required',
                             'category' => 'required',
                             'in_stock' => 'required',
                             'description' => 'required',
                             'amount' => 'required|numeric',
							  'size-1' => 'required|not_in:none',
                             'color' => 'required|not_in:null'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 $sz = "";
             if($req['size-1'] == "other")
			 {
				 if(isset($req['size-2']) && $req['size-2'] > 0) $sz = $req['size-2'];
				 else $sz = "0";
			 }
             else
			 {
				 $sz = $req['size-1'];
			 }
             $req['size'] = $sz;
             $r = $this->helpers->updateUserDeal($user, $req);
	        session()->flash("update-deal-status",$r);
			$du = "deal?sku=".$req['sku'];
            return redirect()->intended($du);
         }        
    } 
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getUserGuide()
    {
    	$user = null;
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		return view('user-guide',compact(['user']));
    } 
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddAccount(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'initial_balance' => 'required',
                             'account_number' => 'required',
                             'last_deposit_name' => 'required',
                             'last_deposit' => 'required',
                             'balance' => 'required',
                             'address' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["user_id"] = $user->id; 
             $this->helpers->createBankAccount($req);
	        session()->flash("add-account-status","ok");
			return redirect()->intended('dashboard');
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postUpload(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
		}
		else
        {
        	return redirect()->intended('/');
        }
        $req = $request->all();
        $img = $request->file('img');
		dd($img);
        //dd($req);
        
        $validator = Validator::make($req, [
                             'initial_balance' => 'required',
                             'account_number' => 'required',
                             'last_deposit_name' => 'required',
                             'last_deposit' => 'required',
                             'balance' => 'required',
                             'address' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 \Cloudinary\Uploader::upload("dog.mp4", ["folder" => "my_folder/my_sub_folder/",
                                           			  "public_id" => "my_dog", "overwrite" => TRUE,
													  "notification_url" => url('upload-notify'), 
													  "resource_type" => "image"]);

         	$req["user_id"] = $user->id; 
             $this->helpers->createBankAccount($req);
	        session()->flash("add-account-status","ok");
			return redirect()->intended('dashboard');
         }        
    }
    
	
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteImage(Request $request)
    {
        $req = $request->all();
        
        $validator = Validator::make($req, [
                             'ird' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$img = $req["ird"];
			 $ret = $this->helpers->deleteCloudImage($img);
			#dd($ret);
			$ss = "cloud-image-".$ret['status'];
			$location = '/'; 
	        if(isset($req["loc"])) $location = $req["loc"];    
            session()->flash($ss,"ok");
         }        
         return redirect()->intended($location);
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getZoho()
    {
        $ret = "1535561942737";
    	return $ret;
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPractice()
    {
		$url = "http://www.kloudtransact.com/cobra-deals";
	    $msg = "<h2 style='color: green;'>A new deal has been uploaded!</h2><p>Name: <b>My deal</b></p><br><p>Uploaded by: <b>A Store owner</b></p><br><p>Visit $url for more details.</><br><br><small>KloudTransact Admin</small>";
		$dt = [
		   'sn' => "Tee",
		   'em' => "kudayisitobi@gmail.com",
		   'sa' => "KloudTransact",
		   'subject' => "A new deal was just uploaded. (read this)",
		   'message' => $msg,
		];
    	return $this->helpers->bomb($dt);
    }   


}