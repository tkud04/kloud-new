<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use App\User;
use App\Carts;
use App\ShippingDetails;
use App\BankAccounts;
use App\Wallet;
use App\Transactions;
use App\Deals;
use App\DealData;
use App\DealImages;
use App\Auctions;
use App\Bids;
use App\Ratings;
use App\Comments;
use App\Coupons;
use App\Orders;
use App\OrderDetails;
use App\Settings;
use App\Withdrawals;
use App\BlogPosts;
use App\Stores;
use \Cloudinary\Api;
use \Cloudinary\Api\Response;
use App\SmtpConfigs;
use App\Leads;
use GuzzleHttp\Client;

class Helper implements HelperContract
{
	   public $transferLimit = 201000;
	
   	public $categories= [
			                       "phones-tablets" => "Phones & Tablets",
			                       "tv-electronics" => "TV & Electronics",
								   "fashion" => "Fashion",
								   "computers" => "Computers",
								   "groceries" => "Groceries",
								   "unique-bundles" => "Unique Bundles",
								   "health-beauty" => "Health & Beauty",
								   "home-office" => "Home & Office",
								   "babies-kids-toys" => "Babies, Kids & Toys",
								   "games-consoles" => "Games & Consoles",
								   "watches-sunglasses" => "Watches & Sunglasses",
								   "others" => "Other Categories"
			];  
			
			public $states = [
			                       'abia' => 'Abia',
			                       'adamawa' => 'Adamawa',
			                       'akwa-ibom' => 'Akwa Ibom',
			                       'anambra' => 'Anambra',
			                       'bauchi' => 'Bauchi',
			                       'bayelsa' => 'Bayelsa',
			                       'benue' => 'Benue',
			                       'borno' => 'Borno',
			                       'cross-river' => 'Cross River',
			                       'delta' => 'Delta',
			                       'ebonyi' => 'Ebonyi',
			                       'enugu' => 'Enugu',
			                       'edo' => 'Edo',
			                       'ekiti' => 'Ekiti',
			                       'gombe' => 'Gombe',
			                       'imo' => 'Imo',
			                       'jigawa' => 'Jigawa',
			                       'kaduna' => 'Kaduna',
			                       'kano' => 'Kano',
			                       'katsina' => 'Katsina',
			                       'kebbi' => 'Kebbi',
			                       'kogi' => 'Kogi',
			                       'kwara' => 'Kwara',
			                       'lagos' => 'Lagos',
			                       'nasarawa' => 'Nasarawa',
			                       'niger' => 'Niger',
			                       'ogun' => 'Ogun',
			                       'ondo' => 'Ondo',
			                       'osun' => 'Osun',
			                       'oyo' => 'Oyo',
			                       'plateau' => 'Plateau',
			                       'rivers' => 'Rivers',
			                       'sokoto' => 'Sokoto',
			                       'taraba' => 'Taraba',
			                       'yobe' => 'Yobe',
			                       'zamfara' => 'Zamfara',
			                       'fct' => 'FCT'  
			];         

            public $emailConfig = [
                           'ss' => 'smtp.gmail.com',
                           'se' => 'dunphydavid83@gmail.com',
                           'sp' => '587',
                           'su' => 'dunphydavid83@gmail.com',
                           'spp' => 'kudayisi2$',
                           'sa' => 'yes',
                           'sec' => 'tls'
                       ];     
                        
             public $signals = ['okays'=> ["login-status" => "Sign in successful",
                     "cobra-deal-status" => "Deal updated.",
                     "update-deal-status" => "Deal updated.",
                     "cobra-user-status" => "User info updated.",
                     "profile-status" => "Info updated.",
                     "cobra-comment-status" => "Comment updated.",
                     "cobra-coupon-status" => "Coupon updated.",
                     "cobra-approve-rating-status" => "User rating updated.",
                     "forgot-password-status" => "A link to reset your password has been sent to your email.",
                     "cobra-forgot-password-status" => "A link to reset your password has been sent to your email.",
                     "reset-status" => "Password updated! You can now login.",
                     "add-deal-status" => "Deal added!",
                     "add-post-status" => "New post added!",
                     "delete-deal-status" => "Deal deleted .",
                     "delete-auction-status" => "Auction deleted.",
                     "delete-store-status" => "Store removed.",
                     "update-post-status" => "Post updated!",
                     "update-store-status" => "Store info updated!",
                     "cobra-store-status" => "Store info updated!",
                     "add-coupon-status" => "Coupon added!",
                     "rate-deal-status" => "Thank you for your input!",
                     "no-bid-status" => "Insufficient funds to place bid. Please make a deposit and try again.",
                     "bid-status" => "Bid has been placed.",
                     "comment-deal-status" => "Thank you, your comment has been sent. ",
                     "remove-cart-status" => "Deal removed from cart.",
                     "kloudpay-withdraw-status" => "Withdrawal request has been submitted and is pending review",
                     "kloudpay-transfer-status" => "Transfer successful!",
                     "cobra-approve-withdrawal-status" => "Withdrawal request approved. Go to PayStack Dashboard to make the transfer",
                     "cobra-auction-status" => "New auction created!",
                     "cobra-settings-status" => "Settings updated. ",
                     "cobra-end-auction-status" => "Auction ended! Deal has been added to the highest bidder's cart",
                     "cloud-image-deleted" => "Image(s) deleted",
                     "cloud-image-not_found" => "Image(s) not found",
                     "update-smtp-status" => "SMTP settings updated!",
                     "add-leads-status" => "Leads added.",                   
                     "delete-leads-status" => "Leads deleted.", 
                     "fund-wallet-status" => "Funds added/removed.", 
                     "vendor-signup-status" => "Welcome to your new store! Import your products and start selling.",
                     "signup-status" => "Signup successful! You can now log in.",
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please contact support.",
                     "cobra-user-status-error" => "There was an error updating info for this user. Please try again.",
                     "cobra-settings-status-error" => "There was an error updating site configuration. Please try again. ",
                     "cobra-post-status-error" => "There was an unknown error fetching that post.",
                     "bid-status-error" => "There was an error placing your bid.",
                     "cobra-deal-status-error" => "There was an error updating this deal. Please try again.",
                     "kloudpay-withdraw-status-error" => "Insufficient funds in KloudPay wallet",
                     "comment-deal-status-error" => "There was an error submitting your comment. Please try again. ",
                     "rate-deal-status-error" => "There was an error submitting your rating. Please try again. ",
                     "cobra-auction-status-error" => "There was an error creating the auction. Please try again.",
                     "cobra-end-auction-status-error" => "There were no bidders for this auction.",
                     "cobra-store-status-error" => "Store info could not be updated due to an unknown error. ",
                     "add-leads-status-error" => "There was a problem saving the leads, please check your limit and try again.",
                     "delete-leads-status-error" => "There was a problem deleting the leads, please try again.",
                     "update-smtp-status-error" => "There was an error updating smtp settings, please try again.",
                     "kloudpay-transfer-status-error" => "Transfer request denied. This could be because you have insufficient funds or the transfer amount has exceeded our limit of &#8358;200,000.00",
                     "cobra-get-store-status-error" => "We couldn't find the store you were looking for. Please check that you got yhe store name correctly."]
                   ];
          /**
           * Sends an email(blade view or text) to the recipient
           * @param String $to
           * @param String $subject
           * @param String $data
           * @param String $view
           * @param String $image
           * @param String $type (default = "view")
           **/
           function sendEmail($to,$subject,$data,$view,$type="view")
           {
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject){
                           $message->from('info@worldlotteryusa.com',"Admin");
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject){
                           $message->from('info@worldlotteryusa.com',"Admin");
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }    

          function sendEmailSMTP($data,$view,$type="view")
           {
           	    // Setup a new SmtpTransport instance for new SMTP
                $transport = "";
if($data['sec'] != "none") $transport = new Swift_SmtpTransport($data['ss'], $data['sp'], $data['sec']);

else $transport = new Swift_SmtpTransport($data['ss'], $data['sp']);

   if($data['sa'] != "no"){
                  $transport->setUsername($data['su']);
                  $transport->setPassword($data['spp']);
     }
// Assign a new SmtpTransport to SwiftMailer
$smtp = new Swift_Mailer($transport);

// Assign it to the Laravel Mailer
Mail::setSwiftMailer($smtp);

$se = $data['se'];
$sn = $data['sn'];
$to = $data['em'];
$subject = $data['subject'];
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject,$se,$sn){
                           $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject,$se,$sn){
                            $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }    

           function createUser($data)
           {
           	$ret = User::create(['fname' => $data['fname'], 
                                                      'lname' => $data['lname'], 
                                                      'email' => $data['email'], 
                                                      'phone' => $data['phone'], 
                                                      'role' => $data['role'], 
                                                      'status' => $data['status'], 
                                                      'verified' => $data['verified'], 
                                                      'password' => bcrypt($data['pass']), 
                                                      ]);
                                                      
                return $ret;
           }
           function createShippingDetails($data)
           {
           	$ret = ShippingDetails::create(['user_id' => $data['user_id'],                                                                                                          
                                                      'company' => "", 
                                                      'zipcode' => "",                                                      
                                                      'address' => "", 
                                                      'city' => "", 
                                                      'state' => "", 
                                                      ]);
                                                      
                return $ret;
           }
           
           function createBankAccount($data)
           {
           	$ret = BankAccounts::create(['user_id' => $data['user_id'],                                                                                                          
                                                      'bank' => $data['bank'],
                                                      'acname' => $data['acname'],                                                     
                                                      'acnum' => $data['acnum']
                                                      ]);
                                                      
                return $ret;
           }
           
           function inCart($user_id, $sku)
           {
           	$ret = false; 
           	$cart = Carts::where('user_id',$user_id)->where('sku',$sku)->first();
               if($cart != null)
                  {
                  	$ret = true;
                  }
               return $ret; 
          }
           
           function addToCart($data)
           {
           	$type = "cart";
               $auction_id = "";
			   $color = "";
               $inCart = $this->inCart($data['user_id'], $data['sku']);
               if($inCart)
                {
                	$cart = Carts::where('user_id',$data['user_id'])->where('sku',$data['sku'])->first();
 
                   if($cart != null)
                  {
                  	$cart->update(['qty' => ($cart->qty + $data['qty'])]);
                  }
                	$ret = "ok";
                }
               else{
               if(isset($data['type'])) $type = $data['type'];
               if(isset($data['auction_id'])) $auction_id = $data['auction_id'];
               if(isset($data['color'])) $color = $data['color'];
           	$ret = Carts::create(['user_id' => $data['user_id'],
                                          'sku' => $data['sku'],  
                                          'qty' => $data['qty'], 
                                          'color' => $color, 
                                          'size' => $data['sz'], 
                                          'auction_id' => $auction_id, 
                                         'type' => $type,                                 
                                         ]);
                 }                                  
                return $ret;
           }
           
           function createWallet($data)
           {
           	$ret = Wallet::create(['user_id' => $data['user_id'], 
                                                      'balance' => "0",                                                                                                            
                                                      ]);                                                     
                return $ret;
           }		
           function createDeal($data)
           {
           	$sku = $this->generateSKU();
               $type = isset($data['type']) ? $data['type'] : "deal";
               
           	$ret = Deals::create(['name' => $data['name'],                                                                                                          
                                                      'sku' => $sku, 
                                                      'user_id' => $data['user_id'],  
                                                      'type' => $type,  
                                                      'category' => $data['category'], 
                                                      'status' => "pending", 
                                                      'rating' => "0", 
                                                      'deadline' => "", 
                                                      ]);
                                                      
                 $data['sku'] = $ret->sku;                         
                $dealData = $this->createDealData($data);
				$ird = "none";
				$irdc = 0;
				if(isset($data['ird']) && isset($data['irdc']))
				{
					$ird = $data['ird'];
				    $irdc = $data['irdc'];
				}
                $this->createDealImage(['sku' => $data['sku'], 'url' => $ird, 'irdc' => $irdc]);
                return $ret;
           }
           function createDealData($data)
           {
           	$in_stock = (isset($data["in_stock"])) ? "new" : $data["in_stock"];
           
           	$ret = DealData::create(['sku' => $data['sku'],                                                                                                          
                                                      'description' => $data['description'], 
                                                      'amount' => $data['amount'],                                                      
                                                      'colors' => $data['color'],                                                      
                                                      'size' => $data['size'],                                                      
                                                      'in_stock' => $in_stock, 
                                                      'min_bid' => isset($data['min_bid']) ? $data['min_bid'] : "0"                                                  
                                                      ]);
                                                      
                return $ret;
           }
         
           function createDealImage($data)
           {
           	$ret = DealImages::create(['sku' => $data['sku'],                                                                                                          
                                                      'url' => $data['url'], 
                                                      'irdc' => $data['irdc'], 
                                                      ]);
                                                      
                return $ret;
           }
           function createAuction($data)
           {
           	$d = $this->getDeal($data['deal_id']);
           	$dd = $d['data'];
           	$ap = isset($data['auction_price']) ? $data['auction_price'] : $dd['amount']; 
               $bp = $dd['amount']; 
               if(isset($data['buy_price']) && $data['buy_price'] > 0) $bp = $data['buy_price'];
           	$ret = Auctions::create(['deal_id' => $data['deal_id'], 
                                                'user_id' => $data['user_id'],       
                                                'category' => $d['category'],       
                                                 'auction_price' => $ap,       
                                                 'buy_price' => $bp, 
                                                 'hb' => "", 
                                                      'days' => $data['days'], 
                                                      'hours' => $data['hours'],                                                    
                                                      'minutes' => $data['minutes'], 
                                                      'status' => "live", 
                                                      'bids' => "0", 
                                                      ]);
                                                      
                  $dx = Deals::where('id', $d['id'])->first();
                $dx->update(['type' => "auction"]);    
               
                return $ret;
           }
           function createBid($data)
           {  
            $color = isset($data['color']) ? $data['color']: "";		   
           	$ret = Bids::create(['auction_id' => $data['auction_id'],                                                                                                          
                                                      'user_id' => $data['user_id'], 
                                                      'size' => $data['sz'], 
                                                      'color' => $color, 
                                                      'qty' => $data['qty'], 
                                                      'amount' => $data['amount'],    
                                                       'pay' => "0",    
                                                      'status' => "unpaid"
                                                      ]);
                                                      
                return $ret;
           }
           function createTransaction($data)
           {
           	$ret = Transactions::create(['description' => $data['description'],                                                                                                          
                                                      'type' => $data['type'], 
                                                      'user_id' => $data['user_id'],
                                                      'amount' => $data['amount'],
                                                      ]);
                                                      
                return $ret;
           }
           
           function createOrder($data)
           {
           	$ref = (isset($data['reference'])) ? $data['reference'] : "none"; 
               $cmm = (isset($data['comment'])) ? $data['comment'] : ""; 
			   
           	$ret = Orders::create(['number' => $this->generateOrderNumber($data['type']),                                                                                                          
                                                      'user_id' => $data['user_id'], 
                                                      'total' => $data['total'],
                                                      'sd' => $data['sd'],
                                                      'reference' => $ref,
                                                      'comment' => $cmm,
                                                      'status' => 'active'
                                                      ]);
                                                      
                return $ret;
           }
           
           function createOrderDetails($data)
           {
           	$ret = OrderDetails::create(['order_id' => $data['order_id'],                                                                                                          
                                                      'deal_id' => $data['deal_id'], 
                                                      'qty' => $data['qty'],
                                                      'color' => $data['color'],
                                                      'size' => $data['size'],
                                                      'type' => $data['type'],
                                                      ]);
                                                      
                return $ret;
           }
           
           function createRating($data)
           {
           	$ret = Ratings::create(['user_id' => $data['user_id'],                                                                                                          
                                                      'deal_id' => $data['deal_id'], 
                                                      'stars' => $data['stars'],
                                                      'status' => $data['status'],
                                                      ]);
                                                      
                return $ret;
           }
           
           function createComment($data)
           {
           	$ret = Comments::create(['user_id' => $data['user_id'],                                                                                                          
                                                      'type' => $data['type'], 
                                                      'deal_id' => $data['deal_id'], 
                                                      'comment' => $data['comment'],
                                                      'status' => $data['status'],
                                                      ]);
                                                      
                return $ret;
           }
		   function createBlogPost($data)
           {
           	$ret = BlogPosts::create(['category' => $data['category'],                                                                                                          
                                                      'user_id' => $data['user_id'], 
                                                      'flink' => $data['flink'],
                                                      'title' => $data['title'],
                                                      'img' => isset($data['ird']) ? $data['ird'] : "none",
                                                      'irdc' => isset($data['irdc']) ? $data['irdc'] : "0",
                                                      'content' => $data['content'],
                                                      'likes' => $data['likes'],
                                                      'status' => $data['status'],
                                                      ]);
                                                      
                return $ret;
           }
           
           function createCoupon($data)
           {
           	$ret = Coupons::create(['code' => $data['code'],                                                                                                          
                                                      'discount' => $data['discount'], 
                                                      'status' => "pending"
                                                      ]);
                                                      
                return $ret;
           }  
		   function createStore($data)
           {
           	$ret = Stores::create(['user_id' => $data['user_id'],                                                                                                          
                                                      'flink' => $data['flink'], 
                                                      'name' => $data['sname'],
                                                      'pickup_address' => $data['pickup_address'],
                                                      'rating' => 0,
                                                      'img' => $data['img'], 
                                                      'description' => $data['description'], 
                                                      'revenue' => 0, 
                                                      'status' => "pending"
                                                      ]);
                                                      
                return $ret;
           }  
           
           function addSettings($data)
           {
           	$ret = Settings::create(['item' => $data['item'],                                                                                                          
                                                      'value' => $data['value'], 
                                                      'type' => $data['type'], 
                                                      ]);
                                                      
                return $ret;
           }
           
           function getSetting($i)
          {
          	$ret = "";
          	$settings = Settings::where('item',$i)->first();
               
               if($settings != null)
               {
               	//get the current withdrawal fee
               	$ret = $settings->value;
               }
               
               return $ret; 
          }
          
           function createWithdrawal($data)
           {
           	$ret = Withdrawals::create(['user_id' => $data['user_id'],                                                                                                          
                                                      'amount' => $data['amount'], 
                                                      'status' => 'pending',
                                                      ]);
                                                      
                return $ret;
           }

           function generateSKU()
           {
           	$ret = "KTK".rand(999,99999)."LD".rand(999,9999);
                                                      
                return $ret;
           }
           
           function generateOrderNumber($type)
           {
           	$tt = '';
               if($tt == 'checkout') $tt = 'CKT'; 
               else if($tt == 'deposit') $tt = 'DPT'; 
           	$ret = $tt.rand(1,999)."KLD".rand(29,4999).rand(date("md"),99999);
                                                      
                return $ret;
           }               
           
           function getDeadline($baseTimeStamp,$offset)
           {
           	$ret = null; 
               if(count($offset) > 0){$ret = baseTimeStamp; }
               
               if($ret != null){
               	
               if(isset($offset['days']) && $offset['days'] > 0)
               {
                    $ret->addDays($offset['days']);
               }
               if(isset($offset['hours']) && $offset['hours'] > 0)
               {
                    $ret->addHours($offset['hours']);
               }
               if(isset($offset['minutes']) && $offset['minutes'] > 0)
               {
                    $ret->addMinutes($offset['minutes']);
               }
               
               }
                return $ret;
           }
             
           function getDeals($category,$q="")
           {
           	$ret = [];
               $deals = null; 
           	if($q == "") $deals = Deals::where('type',$category)->where('status',"approved")->get();
               else $deals = Deals::where('type',$category)->where('status',"approved")->where('category',$q)->get();
 
              if($deals != null)
               {
               	foreach($deals as $d)
                   {
                   	$temp = [];
                   	$temp['id'] = $d->id; 
                       $temp['images'] = $this->getDealImages($d->sku);    
                       $temp['data'] = $this->getDealData($d->sku);
                   	$temp['name'] = $d->name; 
                   	$temp['sku'] = $d->sku; 
                       $u = User::where('id',$d->user_id)->first();
                       $temp['u'] = $u; 
                       $s = $this->getUserStore($u);
                   	$temp['seller'] = ($u != null) ? $u->fname." ".$u->lname : "Unknown"; 
                       $temp['store'] = (count($s) > 0) ? $s : "Unknown"; 
                       $temp['seller-verified'] = ($u != null) ? $u->verified : "Unknown"; 
                   	$temp['type'] = $d->type; 
                   	$temp['category'] = $d->category; 
                   	$temp['status'] = $d->status; 
                   	$temp['rating'] = $d->rating;
                       $temp['auction'] = $this->getAuction($d->id);            
                       
                       array_push($ret, $temp); 
                   }
               }                                 
                                                      
                return $ret;
           }
		   
		   function refineDeals($deals,$p="")
           {
           	$ret = [];
              if($deals != null && $p != "")
               {
				  $priceRange = explode("to",$p);
				  $debug = [];
				  
               	foreach($deals as $d)
                   {           
                       $dt = $this->getDealData($d['sku']);
					   array_push($debug,[$dt['amount'],$priceRange]);
					   if($dt['amount'] >= $priceRange[0] && $dt['amount'] <= $priceRange[1]) array_push($ret, $d); 
                   }
				   
				  # dd($debug);
               }                                 
                                                      
                return $ret;
           }

		   
           
           function getUserDeals($user)
           {
           	$ret = [];
               $deals = Deals::where('user_id',$user->id)->get();
 
              if($deals != null)
               {
               	foreach($deals as $d)
                   {
                   	$temp = [];
                   	$temp['id'] = $d->id; 
                       $temp['images'] = $this->getDealImages($d->sku);    
                       $temp['data'] = $this->getDealData($d->sku);
                   	$temp['name'] = $d->name; 
                   	$temp['sku'] = $d->sku; 
                       $u = User::where('id',$d->user_id)->first();
                       $temp['u'] = $u; 
                   	$temp['seller'] = ($u != null) ? $u->fname." ".$u->lname : "Unknown"; 
                       $temp['seller-verified'] = ($u != null) ? $u->verified : "Unknown"; 
                   	$temp['type'] = $d->type; 
                   	$temp['category'] = $d->category; 
                   	$temp['status'] = $d->status; 
                   	$temp['rating'] = $d->rating;
                       $temp['auction'] = $this->getAuction($d->id);            
                       
                       array_push($ret, $temp); 
                   }
               }                                 
                                                      
                return $ret;
           }		
           
           function getDealData($sku)
           {
           	$ret = [];
               $dealData = DealData::where('sku',$sku)->first();
 
              if($dealData != null)
               {
               	$ret['id'] = $dealData->id; 
                   $ret['description'] = $dealData->description; 
                   $ret['amount'] = $dealData->amount; 
                   $ret['colors'] = $dealData->colors; 
                   $ret['sizes'] = $dealData->size; 
                   $ret['in_stock'] = $dealData->in_stock; 
                   $ret['min_bid'] = $dealData->min_bid; 
               }                                 
                                                      
                return $ret;
           }		   
           
           function getDealImages($sku)
           {
           	$ret = [];
               $img = DealImages::where('sku',$sku)->get();
 
              if($img != null)
               {
               	foreach($img as $i)
                   {
                   	$temp = [];
                   	$temp['id'] = $i->id; 
                   	$temp['url'] = $i->url; 
                       $temp['irdc'] = $i->irdc; 
                       array_push($ret, $temp); 
                   }
               }                                 
                                                      
                return $ret;
           }	
         
           function getCart($user)
           {
           	$ret = [];
               $cart = Carts::where('user_id',$user->id)->get();
              if($cart != null)
               {
               	foreach($cart as $c) 
                    {
                    	$temp = [];
               	     $temp['id'] = $c->id; 
                        $temp['sku'] = $c->sku; 
                        $temp['deal'] = $this->getDeal($c->sku);
                        $temp['qty'] = $c->qty; 
						$temp['color'] = $c->color; 
                        $temp['size'] = $c->size; 
                        $temp['bid'] = Bids::where('auction_id', $c->auction_id)->where('user_id', $user->id)->first(); 
                        $temp['type'] = $c->type; 
                        array_push($ret, $temp); 
                   }
               }                                 
                                                      
                return $ret;
           }
           function clearCart($user)
           {
           	$ret = [];
               $cart = Carts::where('user_id',$user->id)->get();
 
              if($cart != null)
               {
               	foreach($cart as $c) 
                    {
                    	$c->delete(); 
                   }
               }                                 
           }		
          function getCartTotals($cart)
           {
           	$ret = ["subtotal" => 0, "delivery" => 0, "total" => 0, "md" => []];
               $md = ['order-id' => $this->generateOrderNumber("checkout"),
                         ];
               $mmd = '';
               
              if($cart != null && count($cart) > 0)
               {           	
               	foreach($cart as $c) 
                    {
                    	
                       $deal = $c["deal"];
                        if(count($deal) < 1)
						{
							$mmd .= "<s>Deleted</s><br>";
							$amount = 0;
							$qty = 0;
						}
						else
						{
                          $auction = $this->getAuction($deal['id']);
                          $amount = $deal['data']['amount'];
                          
                          $type = "deal";
                          if(isset($c['type']) && $c['type'] != "") $type = $c['type'];
                          
                          if($type == "auction"){
                                        	$b = $c['bid'];
                                            if($b != null){
                                            	$amount = $b->pay;
                                            }
                                        }
                                        
               	          $qty = $c['qty']; 
                          $mmd .= $deal['name']." x".$qty."<br>";
         
                          $ret['subtotal'] += ($amount * $qty);
						}
                   }
                   
                   $md["items"] = $mmd;
                   $ret["md"] = $md;
                   $ret['delivery'] = $this->getDeliveryFee();
                   $ret['total'] = (int)$ret['subtotal'] + (int)$ret['delivery'];
               }                                 
                                                      
                return $ret;
           }	
           function getOrderTotals($orderDetails)
           {
           	$ret = ["subtotal" => 0, "delivery" => 0, "total" => 0, "md" => []];
               
               $mmd = '';
               
               
              if($orderDetails != null && count($orderDetails) > 0)
               {
                 $mmdtemp = [];				   
               	foreach($orderDetails as $od) 
                    {
                    	
                       $deal = $od["deal"];
                        if(count($deal) < 1)
						{
							$mmd .= "<s>Deleted</s><br>";
							$amount = 0;
							$qty = 0;
						}
						else
						{
                          $auction = $this->getAuction($deal['id']);
                          $amount = $deal['data']['amount'];
                          
                          $type = "deal";
                          if(isset($od['type']) && $od['type'] != "") $type = $od['type'];
                          
                          if($type == "auction"){
                                        	$b = $od['bid'];
                                            if($b != null){
                                            	$amount = $b->pay;
                                            }
                                        }
                                        
               	          $qty = $od['qty']; 
               	          $color = $od['color']; 
               	          $size = $od['size']; 
                          $mmd = $deal['name']." (x".$qty.") | Color: ".$color."| Size: ".$size."<br>";
						  array_push($mmdtemp,$mmd);
         
                          $ret['subtotal'] += ($amount * $qty);
						}
                   }
                   
                   $md = $mmdtemp;
                   $ret["md"] = $md;
                   $ret['delivery'] = $this->getDeliveryFee();
                   $ret['total'] = (float)$ret['subtotal'] + (float)$ret['delivery'];
               }                                 
                                                      
                return $ret;
           }	
	       function updateCart($cart, $quantities)
           {
           	#$ret = ["subtotal" => 0, "delivery" => 0, "total" => 0];
              
              if($cart != null && count($cart) > 0)
               {
               	for($c = 0; $c < count($quantities); $c++) 
                    {
                    	$ccc = $cart[$c];
                    	$cc = Carts::where('id', $ccc['id'])->first();
                   
                        if($cc != null)
                        {
                        	$cc->update(['qty' => $quantities[$c] ]);
                        }
                   }
                   
                   return "ok";
               }                                 
                                                      
                return $ret;
           }	
           function removeFromCart($user, $asf)
           {
           	#$ret = ["subtotal" => 0, "delivery" => 0, "total" => 0];
              
              if($user != null)
               {
                    	$cc = Carts::where('user_id', $user->id)->get();
                   
                        if($cc != null)
                        {
                        	foreach($cc as $c)
                            {
                            	if($c->type != "auction" && ($c->sku == $asf || $c->id == $asf)){$c->delete(); break; }
                            }
                                                    	
                        }
                   
                   return "ok";
               }                                 
                                                      
                return $ret;
           }	
           function getDeal($sku)
           {
           	$ret = [];
               $d = Deals::where('sku',$sku)
                             ->orWhere('id',$sku)->first();
 
              if($d != null)
               {
               	$dealData = DealData::where('sku',$d->sku)->first();
               	$ret['id'] = $d->id; 
               	$ret['images'] = $this->getDealImages($d->sku);               
                   $ret['data'] = $this->getDealData($d->sku); 
                   $ret['auction'] = $this->getAuction($d->id); 
               	$ret['name'] = $d->name; 
               	$ret['sku'] = $d->sku; 
                   $u = User::where('id',$d->user_id)->first();
                   $ret['u'] = $u; 
                   	$ret['seller'] = ($u != null) ? $u->fname." ".$u->lname : "Unknown"; 
                       $ret['seller-verified'] = ($u != null) ? $u->verified : "Unknown"; 
               	$ret['type'] = $d->type; 
               	$ret['category'] = $d->category; 
               	$ret['status'] = $d->status; 
               	$ret['rating'] = $this->getRating($d);
               }                                 
                                                      
                return $ret;
           }	
           function updateDeal($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['sku']))
               {
               	$d = Deals::where('sku', $data['sku'])->first();
                   
                        if($d != null)
                        {
                        	$dd = DealData::where('sku', $d->sku)->first();
                        
                        	$d->update(['name' => $data['name'],
                                              'category' => $data['category'],
                                              'status' => $data['status'],
                                           ]);
                                           
                            $dd->update(['description' => $data['description'],
                                              'amount' => $data['amount'],
                                              'in_stock' => $data['in_stock'],
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }
		   function updateBlogPost($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['id']))
               {
               	$p = BlogPosts::where('id', $data['id'])->first();
                   
                        if($p != null)
                        {
                        	$p->update(['category' => $data['category'],
                                              'type' => $data['type'], 
                                                      'flink' => $data['flink'],
                                                      'title' => $data['title'],
                                                      'img' => $data['img'],
                                                      'content' => $data['content'],
                                                      'status' => $data['status'],
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }	
           
           function updateBid($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['sku']))
               {
               	$b = Bids::where('user_id', $data['user_id'])
                                ->where('auction_id', $data['auction_id'])->first();
                   
                        if($b != null)
                        {
                            $color = isset($data['color']) ? $data['color']: "";							
                        	$b->update(['amount' => $data['amount'],
							            'size' => $data['sz'], 
                                        'color' => $color, 
                                        'qty' => $data['qty'], 
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }	
           
           function updateCoupon($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	$c = Coupons::where('id', $data['xf'])->first();
                   
                        if($c != null)
                        {                       
                        	$c->update(['code' => $data['code'],
                                              'discount' => $data['discount'],
                                              'status' => $data['status'],
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }	
           
           function updateComment($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	$c = Comments::where('id', $data['xf'])->first();
                   
                        if($c != null)
                        {                       
                        	$c->update(['comment' => $data['comment'],
                                              'status' => $data['status'],
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }	
           
           function getUser($email)
           {
           	$ret = [];
               $u = User::where('email',$email)
			            ->orWhere('id',$email)->first();
 
              if($u != null)
               {
                   	$temp['fname'] = $u->fname; 
                       $temp['lname'] = $u->lname; 
                       $temp['wallet'] = $this->getWallet($u);
                       $temp['phone'] = $u->phone; 
                       $temp['email'] = $u->email; 
                       $temp['role'] = $u->role; 
                       $temp['status'] = $u->status; 
                       $temp['verified'] = $u->verified; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }	  
           function updateUser($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['phone']))
               {
               	$u = User::where('phone', $data['phone'])->first();
                   
                        if($u != null)
                        {
							$role = $u->role;
							if(isset($data['role'])) $role = $data['role'];
							$status = $u->status;
							if(isset($data['status'])) $status = $data['status'];
							
                        	$u->update(['fname' => $data['fname'],
                                              'lname' => $data['lname'],
                                              'email' => $data['email'],
                                              'phone' => $data['phone'],
                                              'role' => $role,
                                              'status' => $status,
                                              #'verified' => $data['verified'],
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }	
           function updateProfile($user, $data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	$u = User::where('id', $data['xf'])->first();
                   
                        if($u != null && $user == $u)
                        {
							$role = $u->role;
							if(isset($data['role'])) $role = $data['role'];
							$status = $u->status;
							if(isset($data['status'])) $role = $data['status'];
							
                        	$u->update(['fname' => $data['fname'],
                                              'lname' => $data['lname'],
                                              'email' => $data['email'],
                                              'phone' => $data['phone'],
                                              'role' => $role,
                                              'status' => $status,
                                              #'verified' => $data['verified'],
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }	
           function getUserDeal($user, $sku)
           {
           	$ret = [];
               $d = Deals::where('user_id',$user->id)
			            ->where('sku',$sku)->first();
 
              if($d != null)
               {
                   	$temp = [];
                   	$temp['id'] = $d->id; 
                       $temp['images'] = $this->getDealImages($d->sku);    
                       $temp['data'] = $this->getDealData($d->sku);
                   	$temp['name'] = $d->name; 
                   	$temp['sku'] = $d->sku; 
                   	$temp['type'] = $d->type; 
                   	$temp['category'] = $d->category; 
                   	$temp['status'] = $d->status; 
                   	$temp['rating'] = $d->rating;
                       #$temp['auction'] = $this->getAuction($d->id);   
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }	  
           function updateUserDeal($user, $data)
           {  
              $ret = 'error'; 
              $sku = $data['sku'];
              
             $d = Deals::where('user_id',$user->id)
			            ->where('sku',$sku)->first();
                   
                        if($d != null)
                        {
                        	$dd = DealData::where('sku',$d->sku)->first();
                            $img = DealImages::where('sku',$d->sku)->first();
                            
                        	$d->update(['name' => $data['name'],
                                              'status' => "pending",
                                              'category' => $data['category']
                                           ]);
                                           
                              $dd->update(['amount' => $data['amount'],
                                              'description' => $data['description'],
                                              'colors' => $data['color'],
                                              'size' => $data['size'],
                                              'in_stock' => $data['in_stock']
                                           ]);
                                           
                             $img->update(['url' => $data['ird'],
                                              'irdc' => $data['irdc']
                                           ]);
                                           
                                           $ret = "ok";
                        }                                    
                                                
                  return $ret;                               
           }	
           function getShippingDetails($user)
           {
           	$ret = [];
               $sdd = ShippingDetails::where('user_id',$user->id)->get();
 
              if($sdd != null)
               {
				   foreach($sdd as $sd)
				   {
				      $temp = [];
                   	   $temp['company'] = $sd->company; 
                       $temp['address'] = $sd->address; 
                       $temp['city'] = $sd->city;
                       $temp['state'] = $sd->state; 
                       $temp['zipcode'] = $sd->zipcode; 
                       $temp['id'] = $sd->id; 
                       $temp['date'] = $sd->created_at->format("jS F, Y"); 
                       array_push($ret,$temp); 
				   }
               }                         
                                                      
                return $ret;
           }
		   function getSingleShippingDetails($user,$id)
           {
           	$ret = [];
               $sd = ShippingDetails::where('user_id',$user->id)->where('id',$id)->first();
 
              if($sd != null)
               {
				      $temp = [];
                   	   $temp['company'] = $sd->company; 
                       $temp['address'] = $sd->address; 
                       $temp['city'] = $sd->city;
                       $temp['state'] = $sd->state; 
                       $temp['zipcode'] = $sd->zipcode; 
                       $temp['id'] = $sd->id; 
                       $temp['date'] = $sd->created_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                         
                                                      
                return $ret;
           }	  
           
           function getBankAccount($user)
           {
           	$ret = [];
               $b = BankAccounts::where('user_id',$user->id)->first();
 
              if($b != null)
               {
                   	$temp['bank'] = $b->bank; 
                       $temp['acname'] = $b->acname; 
                       $temp['acnum'] = $b->acnum;
                       $temp['date'] = $b->created_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }	  
           
           function updateShippingDetails($user, $data)
           {
			  $dsd = $data['sd'];
			if($dsd == "none")
			{
				$company = $data['company'];
				if(is_null($company)) $company = "";
				$shippingDetails =  ShippingDetails::create(['user_id' => $user->id,                                                                                                          
                                                      'company' => $company, 
                                                      'address' => $data['address'],
                                                     'city' => $data['city'],
                                                'state' => $data['state'],
                                              'zipcode' => $data['zip'] 
                                                      ]);
			} 
			else
			{
				$sd = ShippingDetails::where('user_id',$user->id)->where('id',$dsd)->first();
 
                if($sd != null)
                {
					$company = $data['company'];
				if(is_null($company)) $company = "";
               	   $sd->update(['company' => $company,
                                          'address' => $data['address'],
                                          'city' => $data['city'],
                                          'state' => $data['state'],
                                          'zipcode' => $data['zip']
                      ]);               
                }
			}
			
           }	
           function getWallet($user)
           {
           	$ret = [];
               $wallet = Wallet::where('user_id',$user->id)->first();
 
              if($wallet != null)
               {
               	$ret['id'] = $wallet->id; 
                   $ret['balance'] = $wallet->balance;                  
               }                                 
                                                      
                return $ret;
           }		  
           function getDashboard($user)
           {
           	$ret = [];
               $dealData = DealData::where('sku',$sku)->first();
 
              if($dealData != null)
               {
               	$ret['id'] = $dealData->id; 
                   $ret['description'] = $dealData->description; 
                   $ret['amount'] = $dealData->amount; 
                   $ret['in_stock'] = $dealData->in_stock; 
                   $ret['min_bid'] = $dealData->min_bid; 
               }                                 
                                                      
                return $ret;
           }		  
           function getTransactions($user)
           {
           	$ret = [];
               $transactions = Transactions::where('user_id',$user->id)
			                               ->orderBy('created_at', 'desc')->get();
 
              if($transactions != null)
               {
               	foreach($transactions as $t)
                   {
                   	$temp = [];
                   	$temp['id'] = $t->id; 
                       $temp['amount'] = $t->amount; 
                       $temp['type'] = $t->type; 
                       $temp['date'] = $t->created_at->format("jS F, Y"); 
                       
                       switch($temp['type'])
                       {
                       	case 'paid':
                             $desc = explode(',',$t->description);   
                             $iu = url('invoice').'?on='.$desc[0]; #invoice url
                             $pm = ($desc[1] == 'wallet') ? 'KloudPay Wallet' : 'Credit/debit card'; #payment method 
                             $temp['description'] = 'Paid for order <a href="'.$iu.'" target="_blank">'.$desc[0].'</a> via '.$pm; 
                             $temp['badgeClass'] = 'badge-success'; 
                           break; 
                           
                           case 'sold':
                             $desc = explode(',',$t->description);   
                             $qty = $desc[0];
                             
                             $d = Deals::where('id',$desc[1])->first();
                             $dn = ($d != null) ? $d->name: 'Unknown'; #deal username
                             $iu = url('invoice').'?on='.$desc[2]; #invoice url
							 $temp['amount'] = $t->amount * $qty; 
                             $temp['description'] = 'User purchased '.$qty.' pcs of '.$dn.', order number <a href="'.$iu.'" target="_blank">'.$desc[2].'</a>'; 
                             $temp['badgeClass'] = 'badge-success'; 
                           break; 
                           
                           case 'receive-sale':
                             $desc = explode(',',$t->description);   
                             $qty = $desc[0];
                             
                             $d = Deals::where('id',$desc[1])->first();
                             $dn = ($d != null) ? $d->name: 'Unknown'; #deal username
                             $iu = url('invoice').'?on='.$desc[2]; #invoice url
                             $temp['description'] = 'User purchased '.$qty.' pcs of '.$dn.', order number <a href="'.$iu.'" target="_blank">'.$desc[2].'</a>'; 
                             $temp['badgeClass'] = 'badge-success'; 
                           break; 
                           
                           case 'refund':
                             $desc = explode(',',$t->description);   
                             $iu = url('invoice').'?on='.$desc[0]; #invoice url
                             $pm = ($desc[1] == 'wallet') ? 'KloudPay Wallet' : 'Credit/debit card'; #payment method 
                             $temp['description'] = 'Refund for order <a href="'.$iu.'" target="_blank">'.$desc[0].'</a> to '.$pm; 
                             $temp['badgeClass'] = 'badge-danger'; 
                           break; 
                           
                           case 'transfer':
                             $u = User::where('id',$t->description)->first();
                             $un = ($u != null) ? $u->fname.' '.$u->lname : 'Unknown'; #recipient username
                             $temp['description'] = "Transferred to ".$un."'s KloudPay Wallet"; 
                             $temp['badgeClass'] = 'badge-primary'; 
                           break; 
                           
                           case 'receive-transfer':
                             $u = User::where('id',$t->description)->first();
                             $un = ($u != null) ? $u->fname.' '.$u->lname : 'Unknown'; #sender username
                             $temp['description'] = "Transferred from ".$un."'s KloudPay Wallet"; 
                             $temp['badgeClass'] = 'badge-success'; 
                           break; 
                           
                           case 'deposit':
                             $temp['description'] = 'Deposited to KloudPay Wallet'; 
                             $temp['badgeClass'] = 'badge-info'; 
                           break; 
                           
                           case 'withdraw':
                             $temp['description'] = 'Withdrew from KloudPay Wallet'; 
                             $temp['badgeClass'] = 'badge-info'; 
                           break; 
                       }
                       
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }		
           
           function adminGetTransactions()
           {
           	$ret = [];
               $transactions = Transactions::orderBy('created_at', 'desc')->get();
 
              if($transactions != null)
               {
               	foreach($transactions as $t)
                   {
                   	$temp = [];
                   	$temp['id'] = $t->id; 
                       $u = User::where('id',$t->user_id)->first();
                       $temp['email'] = ($u != null) ? $u->email: 'Unknown'; 
                       $temp['amount'] = $t->amount; 
                       $temp['type'] = $t->type; 
                       $temp['date'] = $t->created_at->format("jS F, Y"); 
                       
                      switch($temp['type'])
                       {
                       	case 'paid':
                             $desc = explode(',',$t->description);   
                             $iu = url('invoice').'?on='.$desc[0]; #invoice url
                             $pm = ($desc[1] == 'wallet') ? 'KloudPay Wallet' : 'Credit/debit card'; #payment method 
                             $temp['description'] = 'Paid for order <a href="'.$iu.'" target="_blank">'.$desc[0].'</a> via '.$pm; 
                             $temp['badgeClass'] = 'badge-success'; 
                           break; 
                           
                           case 'sold':
                             $desc = explode(',',$t->description);   
                             $qty = $desc[0];
                             
                             $d = Deals::where('id',$desc[1])->first();
                             $dn = ($d != null) ? $d->name: 'Unknown'; #deal username
                             $iu = url('invoice').'?on='.$desc[2]; #invoice url
                             $temp['description'] = 'User purchased '.$qty.' pcs of '.$dn.', order number <a href="'.$iu.'" target="_blank">'.$desc[2].'</a>'; 
                             $temp['badgeClass'] = 'badge-success'; 
                           break; 
                           
        
                           
                           case 'refund':
                             $desc = explode(',',$t->description);   
                             $iu = url('invoice').'?on='.$desc[0]; #invoice url
                             $pm = ($desc[1] == 'wallet') ? 'KloudPay Wallet' : 'Credit/debit card'; #payment method 
                             $temp['description'] = 'Refund for order <a href="'.$iu.'" target="_blank">'.$desc[0].'</a> to '.$pm; 
                             $temp['badgeClass'] = 'badge-danger'; 
                           break; 
                           
                           case 'transfer':
                             $u = User::where('id',$t->description)->first();
                             $un = ($u != null) ? $u->fname.' '.$u->lname: 'Unknown'; #recipient username
                             $temp['description'] = "Transferred to ".$un."'s KloudPay Wallet"; 
                             $temp['badgeClass'] = 'badge-primary'; 
                           break; 
                           
                           case 'receive-transfer':
                             $u = User::where('id',$t->description)->first();
                             $un = ($u != null) ? $u->fname.' '.$u->lname : 'Unknown'; #sender username
                             $temp['description'] = "Transferred from ".$un."'s KloudPay Wallet"; 
                             $temp['badgeClass'] = 'badge-success'; 
                           break; 
                           
                           case 'deposit':
                             $temp['description'] = 'Deposited to KloudPay Wallet'; 
                             $temp['badgeClass'] = 'badge-info'; 
                           break; 
                           
                           case 'withdraw':
                             $temp['description'] = 'Withdrew from KloudPay Wallet'; 
                             $temp['badgeClass'] = 'badge-info'; 
                           break; 
                       }
                       
                       array_push($ret, $temp); 
                   }
               }                          
                                                     
                return $ret;
           }		

           function getAuctions($category="")
           {
           	$ret = [];
               $auctions = null; 
           	if($category == ""){
				$auctions = Auctions::where('status',"live")->orderBy('created_at', 'desc')->get();
			}
            else{
				$auctions = Auctions::where('category',$category)
				                    ->where('status',"live")
									->orderBy('created_at', 'desc')->get();
			}         
               
              if($auctions != null)
               {
               	foreach($auctions as $a)
                   {
                   	$temp = [];
                   	$temp['id'] = $a->id; 
                       $temp['bids'] = $this->getBids($a->id);
                       $temp['ed'] = $this->getED($a);
                       $temp['user_id'] = $a->user_id;
                       $temp['hb'] = $this->getHighestBidder($a->id);
                       $temp['total-bids'] = $this->getTotalBids($a->id);
                   	$temp['deal'] = $this->adminGetDeal($a->deal_id);
                       $temp['auction_price'] = $a->auction_price;
                       $temp['buy_price'] = $a->buy_price;
                       $temp['category'] = $a->category; 
                       $temp['days'] = $a->days; 
                       $temp['hours'] = $a->hours; 
                       $temp['minutes'] = $a->minutes; 
                       $temp['status'] = $a->status; 
                       $temp['date'] = $a->created_at->format("M d, Y h:i A"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }	
		   
		   function refineAuctions($auctions,$p="")
           {
           	$ret = [];
              if($auctions != null && $p != "")
               {
				  $priceRange = explode("to",$p);
				  $debug = [];
				  
               	foreach($auctions as $a)
                   {           
                       $auctionPrice = $a['auction_price'];
					   if($auctionPrice >= $priceRange[0] && $auctionPrice <= $priceRange[1]) array_push($ret, $a); 
                   }
				   
				  # dd($debug);
               }                                 
                                                      
                return $ret;
           }
           
           function getUserAuctions($user)
           {
           	$ret = [];
               $auctions = null; 
           	            
				$auctions = Auctions::where('user_id',$user->id)
									->orderBy('created_at', 'desc')->get();
     
               
              if($auctions != null)
               {
               	foreach($auctions as $a)
                   {
                   	$temp = [];
                   	$temp['id'] = $a->id; 
                       $temp['bids'] = $this->getBids($a->id);
                       $temp['ed'] = $this->getED($a);
                   	$temp['user_id'] = $a->user_id;
                       $temp['hb'] = $this->getHighestBidder($a->id);
                       $temp['total-bids'] = $this->getTotalBids($a->id);
                       $temp['deal'] = $this->adminGetDeal($a->deal_id);
                       $temp['auction_price'] = $a->auction_price;
                       $temp['buy_price'] = $a->buy_price;
                       $temp['category'] = $a->category; 
                       $temp['days'] = $a->days; 
                       $temp['hours'] = $a->hours; 
                       $temp['minutes'] = $a->minutes; 
                       $temp['status'] = $a->status; 
                       $temp['date'] = $a->created_at->format("M d, Y h:i A"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }	

          function getAuction($dealID,$live="no")
           {
           	$ret = [];
               $a = Auctions::where('deal_id', $dealID)
                                  ->where('status', "live")->first();
               
              if($a != null)
               {
                   	$temp = [];
                   	$temp['id'] = $a->id; 
                       $temp['bids'] = $this->getBids($a->id);
                       $temp['ed'] = $this->getED($a);
                       $temp['user_id'] = $a->user_id;
                       $temp['hb'] = $this->getHighestBidder($a->id);
                       $temp['total-bids'] = $this->getTotalBids($a->id);
                   	$temp['deal'] = $this->adminGetDeal($a->deal_id);
                       $temp['auction_price'] = $a->auction_price;
                       $temp['buy_price'] = $a->buy_price;
                       $temp['category'] = $a->category; 
                       $temp['days'] = $a->days; 
                       $temp['hours'] = $a->hours; 
                       $temp['minutes'] = $a->minutes; 
                       $temp['status'] = $a->status; 
                       $temp['date'] = $a->created_at->format("jS F, Y h:i A"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }	
		   
		   function getBid($id)
           {
           	$ret = [];
               $b = Bids::where('id',$id)->first();
 
              if($b != null)
               {
               	$ret['id'] = $b->id; 
                   $ret['auction'] = $this->adminGetAuction($b->auction_id); 
                   $ret['user'] = $this->getUser($b->user_id); 
                   $ret['amount'] = $b->amount; 
                   $ret['status'] = $b->status; 
                   $ret['date'] = $b->created_at->format("jS F, Y h:i A"); 
               }                                 
                                                      
                return $ret;
           }	
		   
		   function getBids($id)
           {
           	$ret = [];
               $bids = Bids::where('auction_id',$id)->get();
 
              if($bids != null)
               {
				#$ret['auction'] = $this->adminGetAuction($id); 
				#$ret['bids'] = []; 
				
               	foreach($bids as $b)
                   {
                   	$temp = [];
                   	$temp['user'] = $this->getUser($b->user_id); 
                    $temp['amount'] = $b->amount;
                    $temp['pay'] = $b->pay; 
                    $temp['status'] = $b->status; 
                    $temp['date'] = $b->created_at->format("jS F, Y h:i A"); 
                    array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }
		   
		   function getHighestBidder($id)
           {
			 $ret = "no";
			 
           	$hb = Bids::where('auction_id',$id)->max('amount');
           
             if($hb != null) 
              {
                 $r = Bids::where('auction_id',$id)
			           ->where('amount',$hb)->first();
			
			     $ret = User::where('id',$r->user_id)->first();                        
              }        
                          
              return $ret;
           }
           
           function getTotalBids($id)
           {
			 $ret = 0;
			 
           	$ret = Bids::where('auction_id',$id)->sum('amount');
            
                                                      
                return $ret;
           }
		   
		   function getUserBids($user)
           {
           	$ret = [];
               $bids = Bids::where('user_id',$user->id)->get();
               $pastAuctions = Auctions::where('hb',$user->id)->get();
               $added = [];
               
              if($bids != null)
               {
				
				#$ret['bids'] = []; 
				
				
               	foreach($bids as $b)
                   {
                   	$temp = [];
					$temp['auction'] = $this->adminGetAuction($b->auction_id); 
					array_push($added, $b->auction_id); 
                   	$temp['amount'] = $b->amount; 
                      $temp['pay'] = $b->pay; 
                      $temp['hb'] = $this->getHighestBidder($b->auction_id);
                      $temp['status'] = $b->status;
                    $temp['date'] = $b->updated_at->format("jS F, Y h:i A"); 
                    array_push($ret, $temp); 
                   }
               }     

            if($pastAuctions != null)
               {
				
				#$ret['bids'] = []; 
				
               	foreach($pastAuctions as $a)
                   {
                     if(!in_array($a->id,$added))
                     {
                   	$temp = [];
					$temp['auction'] = $this->adminGetAuction($a->id); 
					$bbid = Bids::where('auction_id',$a->id)
			           ->where('user_id',$user->id)->first();
			
                   	$temp['amount'] = $bbid->amount; 
                   $temp['pay'] = $bbid->pay; 
                      $temp['hb'] = $user;
                      $temp['status'] = $bbid->status;
                    $temp['date'] = $bbid->updated_at->format("jS F, Y h:i A"); 
                    array_push($ret, $temp); 
                   }
                  }
               }                          
                   #dd($ret);                                  
                return $ret;
           }

           function bid($data)
           {
           	$ret = "error";
              #dd($data);
               $deal = Deals::where('sku',$data['sku'])->first();
 
              if($deal != null)
               {
				$a = Auctions::where('deal_id',$deal->id)->first();
				#$ret['bids'] = []; 
				
               	if($a != null)
                   {
                   	$data['auction_id'] = $a->id;
                   
                   	$b = Bids::where('user_id', $data['user_id'])
                                ->where('auction_id', $a->id)->first();
                                
					   $user = User::where('id', $data['user_id'])->first();
					     //check if account balance is enough
                          $wallet = $this->getWallet($user);
                   
                       if($wallet['balance'] > $this->getBidAmount())
                       {}
                          
					      if($b == null)
                          {                       	
                          	$data['amount'] = 1;
                          	$this->createBid($data);
                          }
                          else
                          {
                          	$data['amount'] = $b->amount + 1;
                          	$this->updateBid($data);
                          }
                          
                          /**debit the bidder
                 	    $userData = ['email' => $user->email,
                                     'type' => 'remove',
                                     'amount' => $this->getBidAmount()
                                    ];
                                    
                         $this->fundWallet($userData);
                         **/
                          $ret = "ok";
                   }       
               }                          
                                                      
                return $ret;
           }


          function adminGetUsers()
           {
           	$ret = [];
               $users = User::orderBy('created_at', 'desc')->get();
 
              if($users != null)
               {
               	foreach($users as $u)
                   {
                   	$temp = [];
                   	$temp['fname'] = $u->fname; 
                       $temp['lname'] = $u->lname; 
                       $wallet = Wallet::where('user_id',$u->id)->first();
                   	$temp['balance'] = ($wallet == null) ? "NA" : $wallet->balance; 
                       $temp['phone'] = $u->phone; 
                       $temp['email'] = $u->email; 
                       $temp['role'] = $u->role; 
                       $temp['status'] = $u->status; 
                       $temp['verified'] = $u->verified; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }

          function adminGetDeals()
           {
           	$ret = [];
           	$deals = Deals::orderBy('created_at', 'desc')->get();
 
              if($deals != null)
               {
               	foreach($deals as $d)
                   {
                   	$temp = [];
                   	$temp['id'] = $d->id; 
                   	$temp['name'] = $d->name; 
                   	$temp['sku'] = $d->sku; 
                   	$temp['type'] = $d->type; 
                       $temp['category'] = $d->category; 
                       $temp['status'] = $d->status; 
                   	$temp['data'] = $this->getDealData($d->sku); 
                   	$temp['images'] = $this->getDealImages($d->sku);
                       $temp['rating'] = $this->getRating($d);
                       array_push($ret, $temp); 
                   }
               }                                 
                                                      
                return $ret;
           }
           
          function adminGetDeal($sku)
           {
           	$ret = [];
           	$d = Deals::where('sku',$sku)
                             ->orWhere('id',$sku)->first();
 
              if($d != null)
               {
                   	$temp = [];
                   	$temp['id'] = $d->id; 
                   	$temp['name'] = $d->name; 
                   	$temp['sku'] = $d->sku; 
                   	$temp['type'] = $d->type; 
                       $temp['category'] = $d->category; 
                       $temp['status'] = $d->status; 
                   	$temp['data'] = $this->getDealData($d->sku); 
                   	$temp['images'] = $this->getDealImages($d->sku);
                       $temp['rating'] = $this->getRating($d);
                       $ret = $temp;                   
               }                                 
                     
                return $ret;
           }           
           
           function adminGetOrders()
           {
           	$ret = [];
           	$orders = Orders::orderBy('created_at', 'desc')->get();
 
              if($orders != null)
               {
               	foreach($orders as $o)
                   {
                   	$temp = [];
                   	$temp['id'] = $o->id; 
                   	$temp['number'] = $o->number; 
                       $u = User::where('id',$o->user_id)->first();
                   	$temp['email'] = ($u != null) ? $u->email : "Unknown"; 
                   	$temp['total'] = $o->total; 
                   	$temp['status'] = $o->status; 
                   	$temp['date'] = $o->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }                                 
                                                      
                return $ret;
           }

function adminGetOrder($number)
           {
           	$ret = [];
           	$order = Orders::where('number',$number)->first();
 
              if($order != null)
               {
                   	$temp = [];
                   	$temp['id'] = $order->id; 
                   	$temp['number'] = $order->number; 
                       $u = User::where('id',$order->user_id)->first();
                   	$temp['email'] = ($u != null) ? $u->email : "Unknown"; 
                   	$temp['total'] = $order->total; 
                   	$temp['status'] = $order->status; 
					$temp['date'] = $order->created_at->format("jS F, Y"); 
                       $ret = $temp; 
                   
               }                                 
                                                      
                return $ret;
           }

           function adminGetAuctions()
           {
           	$ret = [];
               $auctions = Auctions::orderBy('created_at', 'desc')->get();
                           
              if($auctions != null)
               {
               	foreach($auctions as $a)
                   {
                   	$temp = [];
                   	$temp['id'] = $a->id; 
                       #$temp['bids'] = $this->getBids($a->id);
                       $temp['ed'] = $this->getED($a);
                       $temp['user_id'] = $a->user_id;
                   	$temp['deal'] = $this->adminGetDeal($a->deal_id);
                       $temp['hb'] = $this->getHighestBidder($a->id);
                       $temp['total-bids'] = $this->getTotalBids($a->id);
                       $temp['auction_price'] = $a->auction_price;
                       $temp['buy_price'] = $a->buy_price;
                       $temp['category'] = $a->category; 
                       $temp['days'] = $a->days; 
                       $temp['hours'] = $a->hours; 
                       $temp['minutes'] = $a->minutes; 
                       $temp['status'] = $a->status; 
                       $temp['date'] = $a->created_at->format("M d, Y h:i A"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }	
           
           function adminGetAuction($id)
           {
           	$ret = [];
               $a = Auctions::where('id', $id)->first();
               
              if($a != null)
               {
                   	$temp = [];
                   	$temp['id'] = $a->id; 
                       #$temp['bids'] = $this->getBids($a->id);
                       $temp['ed'] = $this->getED($a);
                       $temp['user_id'] = $a->user_id;
                   	$temp['deal'] = $this->adminGetDeal($a->deal_id);
                       $temp['hb'] = $this->getHighestBidder($a->id);
                       $temp['total-bids'] = $this->getTotalBids($a->id);
                       $temp['auction_price'] = $a->auction_price;
                       $temp['buy_price'] = $a->buy_price;
                       $temp['category'] = $a->category; 
                       $temp['days'] = $a->days; 
                       $temp['hours'] = $a->hours; 
                       $temp['minutes'] = $a->minutes; 
                       $temp['status'] = $a->status; 
                       $temp['date'] = $a->created_at->format("M d, Y h:i A"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }	
           
           function adminEndAuction($id,$mode)
           {
           	$ret = "error";
               $a = Auctions::where('id', $id)->first();
               
               
              if($a != null)
               {
               	$d = Deals::where('id', $a->deal_id)->first();
                   $d->update(['type' => "deal"]);                   
               	$ret = "ok";
               	if($a->status == "live")
                    {
                    	#update auction status
                   	   $a->update(['status' => 'ended','bids' => $this->getTotalBids($a->id)]);
                    
                       
                       
                       #get highest bidder
                     	$hb = $this->getHighestBidder($a->id);
                       #dd($hb);
                       if($hb != null) 
                       {                   
					     
					      #update bid
                       $b = Bids::where('user_id',$hb->id)->where('auction_id',$a->id)->first();
                       #dd($b); 
                       if($b != null) 
                       {
						  #add to highest bidder cart
                         $dt = ['user_id' => $hb->id,'sku' => $d->sku,'qty' => $b->qty,'color' => $b->color,'sz' => $b->size,'auction_id' => $a->id,'type' => "auction"];
					     $this->addToCart($dt);
					     $a->update(['hb' => $hb->id]);
						   
						   
                       	$amount = $a->auction_price;
                       	if($mode == "buy") $amount = $a->buy_price;
                           $b->update(['pay' => $amount]);
                       }
                         $ret = "ok"; 
                       }
                       
                    }  
                       
               }                          
                                                      
                return $ret;
           }	

           function adminGetRatings()
           {
           	$ret = [];
               $ratings = Ratings::orderBy('created_at', 'desc')->get();
 
              if($ratings != null)
               {
               	foreach($ratings as $r)
                   {
                   	$temp = [];
                   	$temp['id'] = $r->id; 
                       $deal = Deals::where('id',$r->deal_id)->first();
                   	$temp['deal'] = ($deal == null) ? "Unknown" : $deal->name; 
					$u = User::where('id',$r->user_id)->first();
                   	$temp['user'] = ($u != null) ? $u->email : "Unknown"; 
                       $temp['rating'] = $r->stars; 
                       $temp['status'] = $r->status; 
                       $temp['date'] = $r->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }	

           function adminGetComments()
           {
           	$ret = [];
               $comments = Comments::orderBy('created_at', 'desc')->get();
 
              if($comments != null)
               {
               	foreach($comments as $c)
                   {
                   	$temp = [];
                   	$temp['id'] = $c->id; 
                       $temp['type'] = $c->type;                        
                       if($temp['type'] == "deal") $deal = Deals::where('id',$c->deal_id)->first();
                   	else if($temp['type'] == "blog") {}
                       $temp['deal'] = ($deal == null) ? "Unknown" : $deal->name; 
					$u = User::where('id',$c->user_id)->first();
                   	$temp['user'] = ($u != null) ? $u->email : "Unknown"; 
                       $temp['comment'] = $c->comment; 
                       $temp['status'] = $c->status; 
                       $temp['date'] = $c->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }		
           
           function adminGetComment($id)
           {
           	$ret = [];
               $c= Comments::where('id', $id)->first();
 
              if($c != null)
               {
                   	$temp = [];
                   	$temp['id'] = $c->id; 
                       $temp['type'] = $c->type;                        
                       if($temp['type'] == "deal") $deal = Deals::where('id',$c->deal_id)->first();
                   	else if($temp['type'] == "blog") {}
                   	$temp['deal'] = ($deal == null) ? "Unknown" : $deal->name; 
					$u = User::where('id',$c->user_id)->first();
                   	$temp['user'] = ($u != null) ? $u->email : "Unknown"; 
                       $temp['comment'] = $c->comment; 
                       $temp['status'] = $c->status; 
                       $temp['date'] = $c->created_at->format("jS F, Y"); 
                        $ret = $temp;   
               }                          
                                                      
                return $ret;
           }		
           
           function adminGetCoupons()
           {
           	$ret = [];
               $coupons = Coupons::orderBy('created_at', 'desc')->get();
 
              if($coupons != null)
               {
               	foreach($coupons as $c)
                   {
                   	$temp = [];
                   	$temp['id'] = $c->id; 
                       $temp['code'] = $c->code; 
                       $temp['discount'] = $c->discount; 
                       $temp['status'] = $c->status; 
                       $temp['date'] = $c->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }		
           
           function adminGetCoupon($id)
           {
           	$ret = [];
               $c = Coupons::where('id', $id)->first();
 
              if($c != null)
               {               	
                   	$temp = [];
                   	$temp['id'] = $c->id; 
                       $temp['code'] = $c->code; 
                       $temp['discount'] = $c->discount; 
                       $temp['status'] = $c->status; 
                       $temp['date'] = $c->created_at->format("jS F, Y"); 
                       $ret = $temp;                   
               }                          
                                                      
                return $ret;
           }	
        
        function getStoreSales()
           {
           	$ret = 0;                                                                                 
                return $ret;
           }	
           
        function getLiveAuctions()
           {
           	$ret = 0;                                                                                 
                return $ret;
           }	

        function adminGetStats()
           {
           	$ret = ['totalUsers' => User::all()->count(),
			             'totalPosts' => BlogPosts::all()->count(),
                         'totalSales' => Orders::all()->sum('total'),
                         'totalDeals' => Deals::all()->count(),
                         'totalOrders' => Orders::all()->count(),
                         'totalUsersActive' => User::where('status','enabled')->count(),
                         'totalOrdersPending' => Deals::where('status','pending')->count(),
                         'totalWithdrawals' => Withdrawals::where('status','pending')->count(),
                         'totalStores' => Stores::all()->count(),
                         'totalStoreSales' => $this->getStoreSales(),
                         'totalAuctions' => Auctions::all()->count(),
                         'totalLiveAuctions' => Auctions::where('status','live')->count(),
                        ];      
                                                                                       
                return $ret;
           }			  
           function getBidAmount()
           {
           	$ret = $this->getSetting("bid");
                                                                                    
               return $ret;
           }		
           function getHottestDeals()
           {
           	$ret = $this->getDeals("deal");                                                                                 
                return $ret;
           }		
           function getNewArrivals()
           {
           	$ret = $this->getDeals("deal");                                                                                 
                return $ret;
           }		
           function getBestSellers()
           {
           	$ret = $this->getDeals("deal");                                                                                  
                return $ret;
           }		
           function getHotCategories()
           {
           	$ret = $this->getDeals("deal");                                                                                  
                return $ret;
           }

           function getRating($deal)
           {
           	$ret = 0;
           	$ratings = Ratings::where('deal_id',$deal['id'])
                              ->where('status',"approved")
			                  ->orderBy('created_at', 'desc')->get();
               
                if($ratings !== null) 
                {
                	$rc = $ratings->count();
                    $sum = 0;
                    
                    foreach($ratings as $r)
                    {
                    	$sum += $r->stars;
                    }
                    
                	if($rc > 0) $ret = $sum / $rc; 
                }       
                return $ret;
           }	
           
           function getUserRating($deal,$user)
           {
           	$ret = 0;
               if($user !== null)
                {
           	   $rating = Ratings::where('deal_id',$deal['id'])
                                      ->where('user_id',$user->id)->first();   
               
                   if($rating !== null) 
                   {
                   	$ret = $rating->stars; 
                   }     
                }
                return $ret;
           }	
           
           function getComments($deal)
           {
           	$ret = [];
           	$comments = Comments::where('deal_id',$deal['id'])
                                 ->where('status',"active")
			                    ->orderBy('created_at', 'desc')->get(); 
               
                if($comments !== null) 
                {
                   foreach($comments as $c)
                   {
                   	if($c->status =="active")
                       {
                   	   $temp = [];
                      	$temp['id'] = $c->id; 
                          $user = User::where('id',$c->user_id)->first();
                      	$temp['user'] = ($user == null) ? "Anonymous" : $user->fname." ".$user->lname; 
                          $temp['comment'] = $c->comment; 
                          $temp['date'] = $c->created_at->format("jS F, Y h:i A"); 
                          array_push($ret, $temp); 
                       }
                   }
                }       
                return $ret;
           }
		   
		   function getBlogPosts($category,$q="")
           {
           	$ret = [];
           	$posts = null; 
			if($category = "all"){
				if($q == "") $posts = BlogPosts::orderBy('created_at', 'desc')->get(); 
               else $posts = BlogPosts::where('title','ilike','%'.$q.'%')->orderBy('created_at', 'desc')->get(); 
			}
			else{
				if($q == "") $posts = BlogPosts::where('category',$category)->orderBy('created_at', 'desc')->get(); 
               else $posts = BlogPosts::where('category',$category)->where('title','ilike','%'.$q.'%')->orderBy('created_at', 'desc')->get(); 
			}
           	
			                    
               
                if($posts !== null) 
                {
                   foreach($posts as $p)
                   {
                   	  if($p->status =="active")
                       {
                   	      $temp = [];
                      	  $temp['id'] = $p->id; 
                          $user = User::where('id',$p->user_id)->first();
                      	  $temp['user'] = ($user == null) ? "Anonymous" : $user->fname." ".$user->lname; 
                          $temp['flink'] = $p->flink; 
                          $temp['title'] = $p->title; 
                          $temp['img'] = $p->img; 
                          $temp['irdc'] = $p->irdc; 
                          $temp['content'] = $p->content; 
                          $temp['likes'] = $p->likes; 
						   $temp['status'] = $p->status; 
                          $temp['date'] = $p->created_at->format("jS F, Y h:i A"); 
                          array_push($ret, $temp); 
                       }
                   }
                }       
                return $ret;
           }
		   
		   function getBlogPost($id)
           {
           	$ret = [];
           	$p = BlogPosts::where('flink',$id)
                                    ->orWhere('id',$id)->first(); 
               
                if($p !== null) 
                {
                   	  if($p->status =="active")
                       {
                   	      $temp = [];
                      	  $temp['id'] = $p->id; 
                          $user = User::where('id',$p->user_id)->first();
                      	  $temp['user'] = ($user == null) ? "Anonymous" : $user->fname." ".$user->lname; 
                          $temp['flink'] = $p->flink; 
                          $temp['title'] = $p->title; 
						  $temp['img'] = $p->img; 
						  $temp['irdc'] = $p->irdc; 
                          $temp['content'] = $p->content; 
                          $temp['likes'] = $p->likes; 
                          $temp['status'] = $p->status; 
                          $temp['date'] = $p->created_at->format("jS F, Y h:i A"); 
                          $ret = $temp; 
                       }
                }       
                return $ret;
           }	

           function getOrders($user)
           {
           	$ret = [];
           	$orders = Orders::where('user_id',$user->id)
			                ->orderBy('created_at', 'desc')->get();
               
                if($orders != null)
               {
               	foreach($orders as $o)
                   {
                   	$temp = [];
                   	$temp['id'] = $o->id; 
                   	$temp['number'] = $o->number; 
                       $temp['status'] = $o->status; 
                       $temp['details'] = $this->getOrderDetails($user->id,$o->id); 
                       $temp['sd'] = $o->sd; 
                       $temp['amount'] = $o->total; 
					   $temp['date'] = $o->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }       
                return $ret;
           }
		   
		   
		   function getOrder($on)
           {
           	$ret = [];
           	$o = Orders::where('number',$on)->first();
               
                if($o != null)
               {
                   	$temp = [];
                   	$temp['id'] = $o->id; 
                   	$temp['number'] = $o->number; 
                       $temp['status'] = $o->status; 
                       $temp['details'] = $this->getOrderDetails($o->user_id,$o->id); 
                       $temp['sd'] = $o->sd; 
                       $temp['amount'] = $o->total; 
					   $temp['date'] = $o->created_at->format("jS F, Y"); 
                       $ret = $temp; 

               }       
                return $ret;
           }
		   
		   function getOrderDetails($user_id,$id)
           {
           	$ret = [];
               $odd = OrderDetails::where('order_id',$id)->get();
              if($odd != null)
               {
               	foreach($odd as $od) 
                    {
                    	$temp = [];
               	     $temp = [];
                   	$temp['id'] = $od->id; 
                   	$temp['deal'] = $this->getDeal($od->deal_id);
                        $temp['qty'] = $od->qty; 
                        $temp['type'] = $od->type; 
						$temp['bid'] = Bids::where('auction_id', $od->auction_id)->where('user_id', $user_id)->first();
                        $temp['color'] = $od->color; 
                        $temp['size'] = $od->size; 
                        array_push($ret, $temp); 
                   }
               }                                 
                                                      
                return $ret;
           }
		   
           function addOrder($user,$data)
           {
           	$cart = $this->getCart($user);
               
               if($data['transaction-type'] == 'paid') 
                {
           	$order = $this->createOrder($data);
               
               #create order details
               foreach($cart as $c)
               {
               	$amount = $c['deal']['data']['amount'];
                   
               	#if cart item is auction, mark bid as paid
                   $bid = null; 
                   $auction_id = "";
				   
                   if($c['type'] == "auction")
                  {
                  	$bid = $c['bid'];
                                                	
                        if($bid != null)
                        {
                        	$auction_id = $bid->auction_id; 
                        	$amount = $bid->pay; 
                        	$bid->update(['status' => "paid"]);
                       }             
                  }
               
               
               	$dt = [];
                   $dt['order_id'] = $order->id; 
                   $dt['auction_id'] = $auction_id; 
                   $dt['deal_id'] = $c['deal']['id']; 
                   $dt['amount'] = $amount;
                   $dt['qty'] = $c['qty'];
                   $dt['color'] = $c['color'];
                   $dt['size'] = $c['size'];
                   $dt['type'] = $c['type'];
                   
                   $od = $this->createOrderDetails($dt);
                   
                  
                   
                   #add each deal sales to store revenue
                   
                  # $store = Stores::where('user_id',$c['deal']['u']->id)->first();
                   #dd($c);                               	                  	
                       
                       $d = $c['deal'];
                       $merchant = $d['u'];
                       $store = Stores::where('user_id',$merchant->id)->first();
                       $tt = [];
                       array_push($tt, $store);
                       array_push($tt, $merchant);
                       #dd($tt);
                       $revenue = $store->revenue + ($amount * $c['qty']);
                       $store->update(['revenue' => $revenue]);
                       
                       //check if account balance is enough
                   $wallet = $this->getWallet($merchant);
                   
                   if($merchant != null && $wallet != null)
                   {                                    
                     //credit the merchant
                     $receiverData = ['email' => $merchant->email,
                                     'type' => 'add',
                                     'amount' => ($amount * $c['qty'])
                                    ];
                         #dd($receiverData);           
               	$this->fundWallet($receiverData);
                   }
				   
                       
                       
                   
                   #create transaction for each deal
                   $stt = [];
                   $stt['type'] = "sold";
                   $stt['description'] = $c['qty'].','.$c['deal']['id'].','.$order->id;                   
                   $stt['user_id'] = $c['deal']['u']->id;
                   $stt['amount'] = $amount;
                   $this->createTransaction($stt);                 
                 }
				}
               
               #add transactions
                   $tdt = [];
                   $tdt['type'] = $data['transaction-type'];
                   $tdt['description'] = ($tdt['type']  == 'paid' || $tdt['type'] == 'refund') ? $order->number.','.$data['transaction-description'] : $data['transaction-description'];                   
                   $tdt['user_id'] = $user->id;
                   $tdt['amount'] = $data['total'];
                   $this->createTransaction($tdt); 
               
           }

           function getInvoice($on)
           {
           	  $ret = [];
           	   $order = $this->getOrder($on); 
              $ret['totals'] = $this->getOrderTotals($order['details']);
              $ret['sd'] = $order['sd'];
              $ret['number'] = $order['number'];
              $ret['date'] = $order['date'];
              $ret['status'] = $order['status'];
              $ret['amount'] = $order['amount'];
                return $ret;
           }

           function getUserInvoice($user, $on)
           {
           	$ret = [];
           	$order = Orders::where('number',$on)
                                   ->where('user_id',$user->id)->first();   
               
                if($order != null)
               {
               	$ret = $this->getInvoice($on); 
               }       
                return $ret;
           }		  			  	   
           
           function fundWallet($data)
           {
           	$account = User::where('email',$data['email'])
			               ->orWhere('phone',$data['email'])->first();
               
               if($account != null)
               {
               	$wallet = Wallet::where('user_id',$account->id)->first();
                   $formerBalance = $wallet->balance; 
                   $newBalance = 0;
                   
                   switch($data['type'])
                   {
                   	case "add":
                         $newBalance = $formerBalance + $data['amount'];
                       break; 
                       
                       case "remove":
                         $newBalance = $formerBalance - $data['amount'];
                       break; 
                       
                       default:
                         $newBalance = $formerBalance;
                       break; 
                  }
                  
                  $wallet->update(['balance' => $newBalance]);
              }
          
                return "ok";
           }		
           
           function transferFunds($user, $data)
           {
           	$ret = "error";
           	$receiver = User::where('phone',$data['phone'])
                                     ->orWhere('email',$data['phone'])->first();
               
               if($receiver != null)
               {
               	//check if account balance is enough
                   $wallet = $this->getWallet($user);
                   
                   if($wallet['balance'] > $data['amount'] && $data['amount'] < $this->transferLimit)
                   {
               	  //debit the giver
                 	$userData = ['email' => $user->email,
                                     'type' => 'remove',
                                     'amount' => $data['amount']
                                    ];
                                    
                     //credit the receiver
                     $receiverData = ['email' => $receiver->email,
                                     'type' => 'add',
                                     'amount' => $data['amount']
                                    ];
                                    
               	$this->fundWallet($userData);
                   $this->fundWallet($receiverData);
				   
				   #add transaction for sender
                   $tdt = [];
                   $tdt['type'] = "transfer";
                   $tdt['description'] = $receiver->id;                   
                   $tdt['user_id'] = $user->id;
                   $tdt['amount'] = $data['amount'];
                   $this->createTransaction($tdt); 
                   
                   #add transaction for receiver 
                   $tdt = [];
                   $tdt['type'] = "receive-transfer";
                   $tdt['description'] = $user->id;                   
                   $tdt['user_id'] = $receiver->id; 
                   $tdt['amount'] = $data['amount'];
                   $this->createTransaction($tdt); 
                   
                   $ret = "ok";
                 }
              }            
               return $ret;
           }		
           
           
           function withdrawFunds($user, $data)
           {
           	$ret = 'error'; 
               $wallet = $this->getWallet($user);
               $fee = $this->getWithdrawalFee();
               
               if($wallet['balance'] > ($data['amount'] + $fee))
               {
               	//create request
               	$this->createWithdrawal(['user_id' => $user->id,
                                     'amount' => $data['amount']
                                    ]);
                                    
                   $ret = 'ok'; 
              }
          
                return $ret;
           }		
           
           function checkout($user, $data, $type)
           {
			   $deb = [$data,$type];
			   #dd($deb);
               switch($type){
               	case "kloudpay":
                 	$ret = $this->payWithKloudPay($user, $data);
                   break; 
                   
                   case "paystack":
                 	$ret = $this->payWithPayStack($user, $data);
                   break; 
              }           
             
                return $ret;
           }

 		  function payWithKloudPay($user, $data)
           {                     
              if(isset($data['ssa']) && $data['ssa'] == "on"){
               	$this->updateShippingDetails($user, $data);
              }
              
             # dd($data);
           	$wallet = $this->getWallet($user); 
               $amount = $data['amount'] / 100;
               
               if($wallet['balance'] >= $amount)
               {
               	#deduct funds from wallet, create order
                   //debit the user
                   $userData = ['email' => $user->email,
                                     'type' => 'remove',
                                     'amount' => $amount
                                    ];
                   $this->fundWallet($userData);
                   
                   #create order
                   $data['type'] = 'checkout';
                   $data['total'] = $amount;
                   $data['user_id'] = $user->id;
                   $data['transaction-type'] = "paid";
                   $data['transaction-description'] = "wallet";
                   $this->addOrder($user,$data);
                   return "ok";
               }
               else
               {
               	return "error";
               }                                      	                         
           }
           
           function payWithPayStack($user, $payStackResponse)
           { 
              $md = $payStackResponse['metadata'];
              $amount = $payStackResponse['amount'] / 100;
              $ref = $payStackResponse['reference'];
              $type = $md['type'];
              $ssa = (isset($md['ssa'])) ? $md['ssa'] : 'off';
              
              if($ssa == "on") $this->updateShippingDetails($user, $md);
              $dt = [];
              
              if($type == "checkout"){
               	$dt['comment'] = $md['comment'];
                   $dt['reference'] = $ref;
                   $dt['transaction-type'] = "paid";
                   $dt['transaction-description'] = "card";
              }
              else if($type == "kloudpay"){
               	//credit the user
                   $userData = ['email' => $user->email,
                                     'type' => 'add',
                                     'amount' => $amount
                                    ];
                   $this->fundWallet($userData);
                   $dt['transaction-type'] = "deposit";
                   $dt['transaction-description'] = "";
              }
              
              $dt['user_id'] = $user->id;
              $dt['total'] = $amount;
              $dt['type'] = "checkout";
              
              #dd($payStackResponse);
              #create order

              $this->addOrder($user,$dt);
                return "ok";
           }
           
           function getPasswordResetCode($user)
           {
           	$u = $user; 
               
               if($u != null)
               {
               	//We have the user, create the code
                   $code = bcrypt(rand(125,999999)."rst".$u->id);
               	$u->update(['reset_code' => $code]);
               }
               
               return $code; 
           }
           
           function verifyPasswordResetCode($code)
           {
           	$u = User::where('reset_code',$code)->first();
               
               if($u != null)
               {
               	//We have the user, delete the code
               	$u->update(['reset_code' => '']);
               }
               
               return $u; 
           }
           
           function getWithdrawalFee()
           {
           	$ret = $this->getSetting("withdrawal");
               
               return $ret; 
           }
           
           function getWithdrawals()
           {
           	$ret = [];
               $withdrawals = Withdrawals::orderBy('created_at', 'desc')->get();     
 
              if($withdrawals != null)
               {
               	foreach($withdrawals as $w)
                   {
                   	$temp = [];
                   	$temp['id'] = $w->id; 
                       $user = User::where('id',$w->user_id)->first();
                       $temp['user'] = ($user == null) ? "Anonymous" : $user->fname." ".$user->lname; 
                       $temp['amount'] = $w->amount;                        
                       $temp['status'] = $w->status; 
                       $temp['date'] = $w->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }	
           
           function getPendingWithdrawals($user)
           {
           	$ret = [];
               $withdrawals = Withdrawals::where('user_id',$user->id)
			                             ->where('status','pending')
										 ->orderBy('created_at', 'desc')->get();          
 
              if($withdrawals != null)
               {
               	foreach($withdrawals as $w)
                   {
                   	$temp = [];
                   	$temp['id'] = $w->id; 
                       $temp['amount'] = $w->amount;                        
                       $temp['status'] = $w->status; 
                       $temp['date'] = $w->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                   }
               }                          
                                                      
                return $ret;
           }	
           
           function approveWithdrawal($data)
           {
           	$ret = "error";
               $w = Withdrawals::where('id',$data['ff'])->first();            
 
              if($w != null)
               {
               	$w->update(['status' => 'approved']);
                   $ret = 'ok'; 
               }                          
                                                      
                return $ret;
           }	
           
           function approveRating($data)
           {
           	$ret = "error";
               $r = Ratings::where('id',$data['id'])->first();            
 
              if($r != null)
               {
               	$status = "pending";
                   if($data['ax'] == "jl") $status = "approved";
                   else if($data['ax'] == "lj") $status = "rejected";
               	$r->update(['status' => $status]);
                   $ret = 'ok'; 
               }                          
                                                      
                return $ret;
           }	
           
           function isAdmin($user)
           {
           	$ret = false; 
               if($user->role === "admin" || $user->role === "su") $ret = true; 
           	return $ret;
           }
           
           function isSuperAdmin($user)
           {
           	$ret = false; 
               if($user->role === "su") $ret = true; 
           	return $ret;
           }

           function rateDeal($user,$data)
           {
           	$ret = "error";
               $d = Deals::where('id',$data['xf'])->first();            
 
              if($d != null)
               {
               	$data['status'] = "pending";
                   $data['user_id'] = $user->id;
                   $data['deal_id'] = $data['xf'];
                   $data['stars'] = $data['rating'];
                   $this->createRating($data); 
                   $ret = 'ok'; 
               }                          
                                                      
                return $ret;
           }	
           
           function commentDeal($user,$data)
           {
           	$ret = "error";
               $d = Deals::where('id',$data['xf'])->first();            
 
              if($d != null)
               {
               	$data['status'] = "pending";
                   $data['user_id'] = $user->id;
                   $data['deal_id'] = $data['xf'];
                   $data['type'] = "deal";
                   $this->createComment($data); 
                   $ret = 'ok'; 
               }                          
                                                      
                return $ret;
           }

           function approveDeal($data)
           {
           	$ret = "error";
               $d = Deals::where('sku',$data['sku'])->first();            
 
              if($d != null)
               {
               	$status = "pending";
                   if($data['ax'] == "jl") $status = "approved";
                   else if($data['ax'] == "lj") $status = "rejected";
               	$d->update(['status' => $status]);
                   $ret = 'ok'; 
               }                          
                                                      
                return $ret;
           }

            function getStore($flink)
           {
           	$ret = [];
               $s = Stores::where('flink', $flink)
                              ->orWhere('id', $flink)->first();     
 
              if($s != null)
               {
                   	$temp = [];
                   	$temp['id'] = $s->id; 
                       $user = User::where('id',$s->user_id)->first();
                       $temp['user'] = ($user == null) ? "Anonymous" : $user->fname." ".$user->lname; 
                       $temp['name'] = $s->name;
                       $temp['pickup_address'] = $s->pickup_address;
                       $temp['deals'] = ($user == null) ? [] : $this->getUserDeals($user);                        
                       $temp['flink'] = $s->flink;
                       $temp['total-revenue'] = $s->revenue;
                       $temp['rating'] = $s->rating;                        
                       $temp['img'] = $s->img;                        
                       $temp['description'] = $s->description;                                            
                       $temp['status'] = $s->status; 
                       $temp['date'] = $s->created_at->format("jS F, Y"); 
                       $temp['last_updated'] = $s->updated_at->format("jS F, Y h:i A"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }

		   function getUserStore($user)
           {
           	$ret = [];
               $s = Stores::where('user_id', $user->id)->first();     
 
              if($s != null)
               {
                   	$temp = [];
                   	$temp['id'] = $s->id; 
                       $user = User::where('id',$s->user_id)->first();
                       $temp['user'] = ($user == null) ? "Anonymous" : $user->fname." ".$user->lname; 
                       $temp['name'] = $s->name;  
                       $temp['pickup_address'] = $s->pickup_address;
                       $temp['rating'] = $s->rating;                        
                       $temp['img'] = $s->img;                        
                       $temp['description'] = $s->description;    
                       $temp['total-revenue'] = $s->revenue;
                       $temp['deals'] = ($user == null) ? [] : $this->getUserDeals($user);      					   
                       $temp['flink'] = $s->flink;                        
                       $temp['status'] = $s->status; 
                       $temp['date'] = $s->created_at->format("jS F, Y"); 
                       $temp['last_updated'] = $s->updated_at->format("jS F, Y h:i A"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }

		   function getStores()
           {
           	$ret = [];
               $stores = Stores::orderBy('created_at', 'desc')->get();     
 
              if($stores != null)
               {
				  foreach($stores as $s)
				   {
                   	   $temp = [];
                   	   $temp['id'] = $s->id; 
                       $user = User::where('id',$s->user_id)->first();
                       $temp['user'] = ($user == null) ? "Anonymous" : $user->fname." ".$user->lname; 
                       $temp['name'] = $s->name;    
                       $temp['pickup_address'] = $s->pickup_address;
                       $temp['deals'] = ($user == null) ? [] : $this->getUserDeals($user);      					   
                       $temp['flink'] = $s->flink;                        
                       $temp['rating'] = $s->rating;                        
                       $temp['img'] = $s->img;                        
                       $temp['description'] = $s->description;  
                       $temp['total-revenue'] = $s->revenue;
                       $temp['status'] = $s->status; 
                       $temp['date'] = $s->created_at->format("jS F, Y"); 
                       $temp['last_updated'] = $s->updated_at->format("jS F, Y h:i A"); 
                       array_push($ret,$temp);
                   }					   
               }                          
                                                      
                return $ret;
           }		  

           function updateUserStore($user,$data)
           {  
              $ret = 'error';                        
         	$store = Stores::where('user_id', $user->id)->first();
                   
                        if($store != null)
                        {
                        	$status = $store->status; 
                           if(isset($data['status'])) $status = $data['status'];
                           
                        	#if store has old image, delete from cloudinary
                            $oldImage = $store->img; 
                            
                            if(isset($data['ird']) && ($oldImage != $data['ird']))  $this->deleteCloudImage($oldImage);
                            
                        	$store->update(['name' => $data['name'],
                                              'pickup_address' => $data['pickup_address'],
                                              'flink' => $data['flink'],
                                              'description' => $data['description'],
                                              'img' => $data['ird'],
                                              'status' => $status,
                                           ]);
                                           
                                           $ret = "ok";
                        }                                                                                 
                  return $ret;                               
           }	
           
           function updateStore($data)
           {  
              $ret = 'error';                        
         	$store = Stores::where('id', $data['id'])->first();
                #dd([$data, $store]);   
                        if($store != null)
                        {
                        	$status = $store->status; 
                           if(isset($data['status'])) $status = $data['status'];
                           
                        	#if store has old image, delete from cloudinary
                            $oldImage = $store->img; 
                            if(isset($data['ird']) && ($oldImage != $data['ird'])) $this->deleteCloudImage($oldImage);
                            
                        	$store->update(['name' => $data['name'],
                                              'pickup_address' => $data['pickup_address'],
                                              'flink' => $data['flink'],
                                              'description' => $data['description'],
                                              'img' => $data['ird'],
                                              'status' => $status,
                                           ]);
                                           
                                           $ret = "ok";
                        }                                                                                 
                  return $ret;                               
           }	
           
           function deleteCloudImage($id)
          {
          	$ret = [];
          	$kid = "uploads/".$id;
          	$api = new \Cloudinary\Api();
             $rett = $api->delete_resources([$kid]);
            
            $ds = json_encode($rett);
             $s = json_decode($ds,true);
             #dd($ret);
             $d = $s['deleted'];
             $dc = $s['deleted_counts'];
             $ret['status'] = $d[$kid];
             $ret['counts'] = $dc[$kid];
             
             #update store if exists
             $store = Stores::where('img', $id)->first();
             if($store != null) $store->update(['img' => 'none']);
             return $ret; 
         }
         
         function getED($a)
           {
           	$ret = ""; 
               $p = "P".$a->days."DT".$a->hours."H".$a->minutes."M";
               $time = new \DateTime($a->created_at->format("M d, Y h:i A"));
               $time->add(new \DateInterval($p));

               $ret = $time->format("M d, Y h:i A");
               return $ret; 
           }
           
           function deleteDeal($user, $id)
           {
           	$ret = "error";
               $d = Deals::where('sku',$id)
                             ->orWhere('id',$id)->first();
 
              if($d != null && ($d->user_id == $user->id || $this->isSuperAdmin($user)))
               {
				 DealData::where('sku',$d->sku)->delete();
				 DealImages::where('sku',$d->sku)->delete();
				Carts::where('sku',$d->sku)->delete();
				 $auctions = Auctions::where('deal_id',$d->id)->get();
				
				if($auctions != null && count($auctions) > 0)
                {
                	foreach($auctions as $a)
                   {
                   	$this->deleteAuction($user, $a->id);
                   }
                }
                
                $od = OrderDetails::where('deal_id',$d->id)->get();
				
				if($od != null && count($od) > 0)
                {
                	foreach($od as $o)
                   {
                   #	$this->deleteOrder($o->order_id);
                   }
                }
				$d->delete(); 
				$ret = "ok";
               }                          
                                                      
                return $ret;
           }
           
           function deleteAuction($user, $id)
           {
           	$ret = "error";
               $a = Auctions::where('id',$id)->first();
 
              if($a != null && ($a->user_id == $user->id || $this->isSuperAdmin($user)))
               {
				 Bids::where('auction_id',$a->id)->delete(); 
				 Carts::where('auction_id',$a->id)->delete(); 
				
				$d = Deals::where('id',$a->deal_id)->first();
				if($d != null) $d->update(['type' => "deal"]);
				
				$a->delete(); 
				 $ret = "ok";
               }                          
                                                      
                return $ret;
           }
           
           
           function deleteStore($user)
           {
           	$ret = "error";
               $s = Stores::where('user_id',$user->id)->first();
 
              if($s != null && $s->user_id == $user->id)
               {
				 $d = Deals::where('user_id',$user->id)->get();
				 if($d != null && count($d) > 0)
                 {
                 	foreach($d as $dd)
                     {
                     	$this->deleteDeal($user, $dd->id);
                     }
                 }
                 
                 $s->delete(); 
				 $user->update(['verified' => "user"]);
				 $ret = "ok";    
              }
				                    
                                                      
                return $ret;
           }
           
           function deleteUserStore($user,$id)
           {
           	$ret = "error";
               $s = Stores::where('user_id',$id)->first();
               $u = User::where('id',$id)->first();
 
              if($s != null && ($s->user_id == $u->id || $this->isSuperAdmin($user)))
               {
				 $d = Deals::where('user_id',$u->id)->get();
				 if($d != null && count($d) > 0)
                 {
                 	foreach($d as $dd)
                     {
                     	$this->deleteDeal($user, $dd->id);
                     }
                 }
                 
                 $s->delete(); 
				 $u->update(['verified' => "user"]);
				 $ret = "ok";    
              }
				                    
                                                      
                return $ret;
           }
           
           function deleteOrder($id)
           {
           	$ret = "error";
               $d = Orders::where('id',$id)->first();
 
              if($d != null)
               {
				 OrderDetails::where('order_id',$d->id)->delete();
				$d->delete(); 
				$ret = "ok";
               }                          
                                                      
                return $ret;
           }
           
           function getSiteConfig()
           {
           	$ret = [];
           	$configs = Settings::where('type','config')->get(); 
               
                if($configs !== null) 
                {
                   foreach($configs as $c)
                   {
                   	   $temp = [];
                      	$temp['id'] = $c->id; 
                          $temp['item'] = $c->item; 
                          $temp['value'] = $c->value; 
                          $temp['date'] = $c->created_at->format("jS F, Y h:i A"); 
                          array_push($ret, $temp);                       
                   }
                }       
                return $ret;
           }
		   
		function updateSiteConfig($data)
           {  
              $ret = 'error';                        
         	$configs = Settings::where('type','config')->get(); 
                   
                        if($configs != null)
                        {
                        	foreach($configs as $c)
                             {
                   	        $c->update(["value" => $data[$c->item]]); 
                             }
                            $ret = "ok";
                        }                                                                                 
                  return $ret;                               
           }	
           
           function getDeliveryFee()
           {
           	$ret = 1000;
           
           	//should pull value from Settings model
              
           	$ret = $this->getSetting("delivery");
               
               return $ret; 
           }

		   function selectLeads($type)
           {
           	$ret = [];
			$leads = null;
			
			  if($type == "merchants") $leads = User::where('verified',"vendor")->get();
			  else if($type == "users") $leads = User::where('verified',"user")->get();
			 else if($type == "test") $leads = [User::where('email',"aquarius4tkud@yahoo.com")->first(), User::where('email',"kudayisitobi@gmail.com")->first()];
			  else $leads = User::where('role',"user")->get();
 
              if($leads != null)
               {
               	foreach($leads as $m)
                    {
                    	array_push($ret,$m->email);
                    }
				$this->addLeads($ret); 
               }                          
                                                      
                return $ret;
           }	  
		   
           function addLeads($data)
           {
           	$ret = "error"; 
                if($data != null && count($data) > 0)
               {
               	for($l = 0; $l < count($data); $l++) 
                    {
                    	$ll = $data[$l];
                    	$lll = Leads::where('email', $ll)->first();
                   
                        if($lll == null)
                        {
                        	Leads::create(['email' => $ll, 'status' => "pending"]);
                        }
                        else
                        {
                        	$lll->update(['status' => "pending" ]);
                        }
                   }
                   
                   $ret = "ok";
               }    
                     
                return $ret;
           }
           
           function deleteLeads()
           {
           	$ret = "ok"; 
            Leads::where('id','>','0')->delete();
   
                return $ret;
           }
           
           function addSmtpConfig($data)
           {
           	return SmtpConfigs::create(['host' => $data['ss'],                                                                                                          
                                            'port' => $data['sp'],
                                            'user' => $data['su'],
                                            'pass' => $data['spp'],
                                            'enc' => $data['se'],
                                            'auth' => $data['sa'],
                                            'status' => 'disabled'
                                          ]);
           }
           
           function getSmtpConfig()
           {
           	$ret = [];
               $config = SmtpConfigs::where('id','>','0')->first();
 
              if($config != null)
               {
                   	$temp['host'] = $config->host; 
                       $temp['port'] = $config->port; 
                       $temp['user'] = $config->user; 
                       $temp['pass'] = $config->pass; 
                       $temp['enc'] = $config->enc; 
                       $temp['auth'] = $config->auth; 
                       $temp['status'] = $config->status; 
                       $temp['date'] = $config->created_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }	  
           
           function getLeads()
           {
           	$ret = [];
               $leads = Leads::all();
 
              if($leads != null)
               {
               	foreach($leads as $l)
                    {
                    	$temp =[];
                   	$temp['id'] = $l->id; 
                       $temp['email'] = $l->email; 
                       $temp['status'] = $l->status;                       
                       $temp['date'] = $l->created_at->format("jS F, Y"); 
                       array_push($ret, $temp); 
                    }
               }                          
                                                      
                return $ret;
           }	  
           
           function hasKey($arr,$key) 
           {
           	$ret = false; 
               if( isset($arr[$key]) && $arr[$key] != "" && $arr[$key] != null ) $ret = true; 
               return $ret; 
           }          
           
           function updateSmtpConfig($data)
           {
           	$config = SmtpConfigs::where('id','>','0')->first();
 
              if($config == null)
               {
               	$this->addSmtpConfig($data); 
               }
               
             else{
               	    $temp = [];
                   	if($this->hasKey($data, 'ss')) $temp['host'] = $data['ss']; 
                       if($this->hasKey($data, 'sp')) $temp['port'] = $data['sp']; 
                       if($this->hasKey($data, 'su')) $temp['user'] = $data['su']; 
                       if($this->hasKey($data, 'spp')) $temp['pass'] = $data['spp']; 
                       if($this->hasKey($data, 'se')) $temp['enc'] = $data['se']; 
                       if($this->hasKey($data, 'sa')) $temp['auth'] = $data['sa']; 
                       if($this->hasKey($data, 'status')) $temp['status'] = $data['status']; 
                       $config->update($temp); 
               }                          
           }
		   
		   function setNextLead() 
           {
			   // get current lead id
			  $currentLead = Leads::where('status', 'next')->first();
			  
			  if($currentLead != null)
			  {
			   // next lead is now current lead, set the next lead
			  $newNextID = Leads::where('id', '>', $currentLead->id)
			                    ->where('status',"pending")->min('id');
								
			  $newNext = Leads::where('id',$newNextID)->first();
			  
			  if($newNext != null)
			  {
				  $newNext->update(["status" =>"next"]);
			  }
			  }
		   }

		   function getNextLead() 
           {
			   $ret = null;
			   
			  // get current lead id
			  $currentLead = Leads::where('status', 'next')->first();
			  
			  if($currentLead == null)
			  {
				  $lowest = 0;   
				  // get next lead id
                $nextID = Leads::where('id', '>', $lowest)
				               ->where('status',"pending")->min('id');
				
				  // get next lead
			      $ret = Leads::where('id',$nextID)->first();
			  }
			  else
			  {
				  $nextID = $currentLead->id;
				  $ret = $currentLead;
			  }			  
			  
			  return $ret;
		   }

           function bombNext($data) 
           {
           	//form query string
               $qs = "sn=".$data['sn']."&sa=".$data['sa']."&subject=".$data['subject']."&message=".html_entity_decode($data['message']);

               $lead = $this->getNextLead();
			   
			   if($lead == null)
			   {
				    $ret = json_encode(["status" => "ok","message" => "finished"]);
			   }
			   else
			    { 
                  $ll = $lead->email;

                  $qs .= "&receivers=".$ll."&ug=".$lead->id; 
               
                  $config = $this->getSmtpConfig();
                  $qs .= "&host=".$config['host']."&port=".$config['port']."&user=".$config['user']."&pass=".$config['pass'];
               
			      //Send request to nodemailer
			      $url = "https://radiant-island-62350.herokuapp.com/?".$qs;
			   
			
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
                 ]);
			     $res = $client->request('GET', $url);
			  
                 $ret = $res->getBody()->getContents(); 
			 
			     $rett = json_decode($ret);
			     if($rett->status == "ok")
			     {
					  $this->setNextLead();
			    	 $lead->update(["status" =>"sent"]);					
			     }
			     else
			     {
			    	 $lead->update(["status" =>"pending"]);
			     }
			    }
              return $ret; 
           }
		   
		   function bomb($data) 
           {
           	//form query string
               $qs = "sn=".$data['sn']."&sa=".$data['sa']."&subject=".$data['subject'];

               $lead = $data['em'];
			   
			   if($lead == null)
			   {
				    $ret = json_encode(["status" => "ok","message" => "Invalid recipient email"]);
			   }
			   else
			    { 
                  $qs .= "&receivers=".$lead."&ug=deal"; 
               
                  $config = $this->getSmtpConfig();
                  $qs .= "&host=".$config['host']."&port=".$config['port']."&user=".$config['user']."&pass=".$config['pass'];
                  $qs .= "&message=".$data['message'];
               
			      //Send request to nodemailer
			      $url = "https://radiant-island-62350.herokuapp.com/?".$qs;
			   
			
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
                 ]);
			     $res = $client->request('GET', $url);
			  
                 $ret = $res->getBody()->getContents(); 
			 
			     $rett = json_decode($ret);
			     if($rett->status == "ok")
			     {
					//  $this->setNextLead();
			    	//$lead->update(["status" =>"sent"]);					
			     }
			     else
			     {
			    	// $lead->update(["status" =>"pending"]);
			     }
			    }
              return $ret; 
           }

           function notifyAdmin($type, $data)
		   {
			  $url = "";
			  $msg = "";
			  $dt = [];
			
			   if($type == "deal"){
				   $u = User::where('id',$data['user_id'])->first();
                       $s = $this->getUserStore($u);
				   $url = "http://www.kloudtransact.com/cobra-deal?sku=".$data['sku'];
	               $msg = "<h2 style='color: green;'>A new deal has been uploaded!</h2><p>Name: <b>".$data['name']."</b></p><br><p>Uploaded by: <b>".$s['name']."</b></p><br><p>Visit $url for more details.</><br><br><small>KloudTransact Admin</small>";
		           $dt = [
		                    'sn' => "KloudTransact Admin",
		                    'sa' => "KloudTransact",
		                    'subject' => "A new deal was just uploaded. (read this)",
		                    'message' => $msg,
		                  ];    	
                  }
                  else if($type == "store"){
				   $url = "http://www.kloudtransact.com/cobra-deals";
	               $msg = "<h2 style='color: green;'>A new deal has been uploaded!</h2><p>Name: <b>My deal</b></p><br><p>Uploaded by: <b>A Store owner</b></p><br><p>Visit $url for more details.</><br><br><small>KloudTransact Admin</small>";
		           $dt = [
		                    'sn' => "KloudTransact Admin",
		                    'sa' => "KloudTransact",
		                    'subject' => "A new deal was just uploaded. (read this)",
		                    'message' => $msg,
		                  ];    	
                  }
                  $dt['em'] = "kudayisitobi@gmail.com";
                  return $this->bomb($dt);
				  $dt['em'] = "info@kloudtransact.com";
                  return $this->bomb($dt);
		   }

        	public function getSliders()
	{
		$s = [   
					 ['id' => "1",
	                  'title' => "New Arrivals",
	                  'category' => "denim jackets",
	                  'date' => date("jS F, Y h:i A"),
					  'brief' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. ",
	                  'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. ",
	                  'img' => "img/bg.jpg",         
                      'price' => "15000",         
	                 ],      
					 ['id' => "2",
	                  'title' => "New Arrivals",
	                  'category' => "denim jackets",
	                  'date' => date("jS F, Y h:i A"),
					  'brief' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. ",
	                  'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. ",
	                  'img' => "img/bg-2.jpg",         
                      'price' => "24000",                     
	                 ],   
	               
    	
	];
		return $s;
	}

   public function getCategories()
    {
    	$c= [
			                       "phones-tablets" => "Phones & Tablets",
			                       "tv-electronics" => "TV & Electronics",
								   "fashion" => "Fashion",
								   "computers" => "Computers",
								   "groceries" => "Groceries",
								   "unique-bundles" => "Unique Bundles",
								   "health-beauty" => "Health & Beauty",
								   "home-office" => "Home & Office",
								   "babies-kids-toys" => "Babies, Kids & Toys",
								   "games-consoles" => "Games & Consoles",
								   "watches-sunglasses" => "Watches & Sunglasses",
								   "others" => "Other Categories"
			];  
    	return $c; 
   }
		
           
           
}
?>