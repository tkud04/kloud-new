<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use App\User;

class LoginController extends Controller {

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
	public function getRegister()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended('/');
		}
		
    	return view('register',compact(['user']));
    }
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMerchantRegister()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			if($user->verified == "vendor") return redirect()->intended('/');
		}
		
    	return view('mregister',compact(['user']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getLogin(Request $request)
    {
       $user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended($return);
		}
		$signals = $this->helpers->signals;
    	return view('login',compact(['user','return','signals']));
    }

    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMerchantLogin(Request $request)
    {
       $user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
		
		if(Auth::check())
		{
			$user = Auth::user();
			//return redirect()->intended($return);
		}
		$signals = $this->helpers->signals;
    	return view('mlogin',compact(['user','return','signals']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postLogin(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'pass' => 'required|min:6',
                             'id' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$remember = true; 
             $return = isset($req['return']) ? $req['return'] : '/';
             
         	//authenticate this login
            if(Auth::attempt(['email' => $req['id'],'password' => $req['pass'],'status'=> "enabled"],$remember) || Auth::attempt(['phone' => $req['id'],'password' => $req['pass'],'status'=> "enabled"],$remember))
            {
            	//Login successful               
               $user = Auth::user();          
                #dd($user); 
				
               if($this->helpers->isAdmin($user)){return redirect()->intended('/');}
               else{
                  $rex = "/";
                  if($user->verified == "vendor") $rex = "my-store";
                  return redirect()->intended($return);
               }
            }
			
			else
			{
				session()->flash("login-status","error");
				return redirect()->intended('login');
			}
         }        
    }


    
        /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAdminLogin(Request $request)
    {
       $user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
		
		if(Auth::check())
		{
			$user = Auth::user();
			$return = 'dashboard';
			if($this->helpers->isAdmin($user)) $return = 'cobra';
			
			return redirect()->intended($return);
		} else{
			$signals = $this->helpers->signals;
         	return view('admin.login',compact(['user','return','signals']));
          }
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAdminLogin(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'pass' => 'required|min:6',
                             'id' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$remember = true; 
             $return = isset($req['return']) ? $req['return'] : '/';
             
         	//authenticate this login
            if(Auth::attempt(['email' => $req['id'],'password' => $req['pass'],'status'=> "enabled"],$remember) || Auth::attempt(['phone' => $req['id'],'password' => $req['pass'],'status'=> "enabled"],$remember))
            {
            	//Login successful               
               $user = Auth::user();          
                #dd($user); 
               if($this->helpers->isAdmin($user)){return redirect()->intended('cobra');}
               else{return redirect()->intended("dashboard");}
            }
			
			else
			{
				session()->flash("login-status","error");
				return redirect()->intended('admin');
			}
         }        
    }
	
    public function postRegister(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'pass' => 'required|confirmed',
                             'email' => 'required|email',                            
                             'phone' => 'required|numeric',
                             'fname' => 'required',
                             'lname' => 'required',
                             'dcd' => 'required',
                             #'g-recaptcha-response' => 'required',
                           # 'terms' => 'accepted',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
            $req['role'] = "user";    
            $req['status'] = "enabled";           
            $req['verified'] = "user";           
            
                       #dd($req);            

            $user =  $this->helpers->createUser($req); 
			$req['user_id'] = $user->id;
            $shippingDetails =  $this->helpers->createShippingDetails($req); 
            $wallet =  $this->helpers->createWallet($req); 
            $bank =  $this->helpers->createBankAccount(['user_id' => $user->id,
                                                       'bank' => '',
                                                      'acname' => '',                                                     
                                                      'acnum' => ''
                                                    ]); 
                                                    
             //after creating the user, send back to the registration view with a success message
             #$this->helpers->sendEmail($user->email,'Welcome To Disenado!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
             session()->flash("signup-status", "success");
             return redirect()->intended('/');
          }
    }

    public function postMerchantRegister(Request $request)
    {
        $req = $request->all();
        //dd($req);
        $user = User::where('phone',$req['phone'])->first();
        if(!is_null($user))
       {
       	$req['pass'] = $user->password; 
           $req['pass_confirmation'] = $user->password; 
      }
        $validator = Validator::make($req, [
                             #'pass' => 'required|confirmed',
                             'email' => 'required|email',                            
                             'phone' => 'required|numeric',
                             'fname' => 'required',
                             'lname' => 'required',
                             'sname' => 'required',
                             'flink' => 'required',
                             'description' => 'required',
                             #'ird' => 'required',
                             #'g-recaptcha-response' => 'required',
                           # 'terms' => 'accepted',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
            $req['role'] = "user";    
            $req['status'] = "enabled";           
            $req['verified'] = "vendor";           
            
                       #dd($req);            
            
                //if user doesn't exist, create user first
                if(is_null($user))
                {
                        $user =  $this->helpers->createUser($req); 
                        $req['user_id'] = $user->id;
                        $shippingDetails =  $this->helpers->createShippingDetails($req); 
                       $wallet =  $this->helpers->createWallet($req); 
                       $bank =  $this->helpers->createBankAccount(['user_id' => $user->id,
                                                       'bank' => '',
                                                      'acname' => '',                                                     
                                                      'acnum' => ''
                                                    ]); 
                }
                else
               {
               	$user->update(['verified' => "vendor"]);
               }
            
			    //if store doesn't exist, create store
			    $store = $this->helpers->getUserStore($user);
			    if(count($store) > 0) return redirect()->intended('my-store');
				$req['user_id'] = $user->id;
				$req['img'] = (isset($req["ird"])) ? $req["ird"] : "none";
				#$req['sname'] = $req["fname"]."'s Store";
			    $this->helpers->createStore($req);
							  
             //after creating the store, send to the store view with a success message
             #$this->helpers->sendEmail($user->email,'Welcome To Disenado!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
             session()->flash("vendor-signup-status", "success");
             $flink = "stores/".$req['flink'];
             return redirect()->intended($flink);
          }
    }
	
	
	public function getForgotUsername()
    {
         return view('forgot_username');
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotUsername(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'email' => 'required|email'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['email'];

                $user = User::where('email',$ret)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("This user doesn't exist!","errors"); 
                }
                
                #$this->helpers->sendEmail($user->email,'Your Username',['username' => $user->username],'emails.username','view');                                                         
            session()->flash("username-status","success");           
            return redirect()->intended('forgot-username');

      }
                  
    }    
    
    
    public function getForgotPassword()
    {
    	$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended('/');
		}
		$signals = $this->helpers->signals;
         return view('forgot-password', compact(['user','signals']));
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotPassword(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'id' => 'required'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['id'];

                $user = User::where('email',$ret)
                                  ->orWhere('phone',$ret)->first();

                if(is_null($user) || ($user->role == 'user'))
                {
                        return redirect()->back()->withErrors("No admin account exists with that email or phone number!","errors"); 
                }
                
                //get the reset code 
                $code = $this->helpers->getPasswordResetCode($user);
              
                //Configure the smtp sender
                $sender = $this->helpers->emailConfig;              
                $sender['sn'] = 'KloudTransact Support'; 
                #$sender['se'] = 'kloudtransact@gmail.com'; 
                $sender['em'] = $user->email; 
                $sender['subject'] = 'Reset Your Password'; 
                $sender['link'] = 'www.kloudtransact.com'; 
                $sender['ll'] = url('reset').'?code='.$code; 
                
                //Send password reset link
                $this->helpers->sendEmailSMTP($sender,'emails.password','view');                                                         
            session()->flash("forgot-password-status","ok");           
            return redirect()->intended('forgot-password');

      }
                  
    }    
    
    public function getAdminForgotPassword()
    {
    	$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended('/');
		}
		$signals = $this->helpers->signals;
         return view('admin.forgot-password', compact(['user','signals']));
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postAdminForgotPassword(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'id' => 'required'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['id'];

                $user = User::where('email',$ret)
                                  ->orWhere('phone',$ret)->first();

                if(is_null($user) || ($user->role == 'user'))
                {
                        return redirect()->back()->withErrors("No admin account exists with that email or phone number!","errors"); 
                }
                
                //get the reset code 
                $code = $this->helpers->getPasswordResetCode($user);
              
                //Configure the smtp sender
                $sender = $this->helpers->emailConfig;              
                $sender['sn'] = 'KloudTransact Support'; 
               # $sender['se'] = 'kloudtransact@gmail.com'; 
                $sender['em'] = $user->email; 
                $sender['subject'] = 'Reset Your Password'; 
                $sender['link'] = 'www.kloudtransact.com'; 
                $sender['ll'] = url('reset').'?code='.$code; 
                
                //Send password reset link
                $this->helpers->sendEmailSMTP($sender,'emails.password','view');                                                         
            session()->flash("cobra-forgot-password-status","ok");           
            return redirect()->intended('cobra-forgot-password');

      }
                  
    }    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPasswordReset(Request $request)
    {
       $user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
		
		if(Auth::check())
		{
			$user = Auth::user();
			$return = 'dashboard';
			if($this->helpers->isAdmin($user)) $return = 'cobra';
			return redirect()->intended($return);
		} 
       else
        {
			if(isset($req['code']))
            {
            	$user = $this->helpers->verifyPasswordResetCode($req['code']);
                if($user == null)   
                { 
                	return redirect()->back()->withErrors("The code is invalid or has expired. ","errors"); 
                }
                $v = ($user->role == "user") ? 'reset' : 'admin.reset';
            	return view($v,compact(['user','return']));
            }
            
            else
            {
            	return redirect()->intended($return);
            }
         	
          }
    }
    
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postPasswordReset(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'pass' => 'required|min:6|confirmed',
                             'acsrf' => 'required'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$id = $req['acsrf'];
             $ret = $req['pass'];

            $user = User::where('id',$id)->first();
            $user->update(['password' => bcrypt($ret)]);
                
            session()->flash("reset-status","ok");  
            $v = ($user->role == "user") ? 'login' : 'admin';         
            return redirect()->intended($v);

      }
                  
    }    

   
    
    public function getLogout()
    {
        if(Auth::check())
        {  
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}