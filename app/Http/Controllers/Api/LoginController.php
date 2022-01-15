<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class LoginController extends Controller
{
    
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $data['token'] =  $user->createToken('LoanApp')->accessToken; 
            $data['name'] =  $user->name;
   
            $response = [
                'success' => true,
                'data'    => $data,
                'message' => 'User logged-in successfully.',
            ];
    
            return response()->json($response, 200);
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            $response = [
                'success' => false,
                'message' => 'Unauthorised.',
                'data' => ['error'=>'Unauthorised']
            ];
    
            return response()->json($response, '404');
        } 
    }
}