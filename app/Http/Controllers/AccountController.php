<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\User;
class AccountController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);
        
    	return view('account',compact('account'));
    }
  
     public function update(Request $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect('account');
                        
    }

    /*public function demo(){
        $from = new \SendGrid\Email("Example User", "singhdeopa@gmail.com");
        $subject = "Sending with SendGrid is Fun";
        $to = new \SendGrid\Email("Example User", "singhdeopa@gmail.com");
        $content = new \SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
        $mail = new \SendGrid\Mail($from, $subject, $to, $content);
        $apiKey = $_ENV['SENDGRID_API_KEY'];
        //return $apiKey;
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);
        echo $response->statusCode();

        echo $response->body();
    }*/

}
