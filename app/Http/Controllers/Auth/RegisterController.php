<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        try {
            Log::info('Attempting to create user with data:', ['name' => $data['name'], 'email' => $data['email']]);
            
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            
            Log::info('User created successfully:', ['id' => $user->id]);
            return $user;
            
        } catch (\Exception $e) {
            Log::error('Error creating user:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function register(Request $request)
    {
        try {
            // Test database connection
            DB::connection()->getPdo();
            Log::info('Database connection successful');
            
            // Log the incoming request data
            Log::info('Registration request data:', $request->all());
            
            $validator = $this->validator($request->all());
            
            if ($validator->fails()) {
                Log::error('Validation failed:', ['errors' => $validator->errors()->toArray()]);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            event(new Registered($user = $this->create($request->all())));
            
            Log::info('Registration completed successfully');
            
            return redirect()->route('login')
                ->with('success', 'Registration successful! Please login to continue.');
                
        } catch (\Exception $e) {
            Log::error('Registration error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput();
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}