<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{

//     public function displayGreetings(){
//         $name = "Juan Dela Cruz";
//         $address = "Calasiao";
//         //return view ('greetings', ['name'=>$name]);
//          return view ('greetings', compact ('name', 'address'));
// //index 'name' 
//     }
//     public function clientProfile (){ //function sa web.php
//         return view ('clientProfile'); //return 'yong uri sa web.php

//     }
//     public function clientDashboard (){
//         return view ('dashboard');
        
//     }
//     public function clientAboutUs (){
//         return view ('aboutUs');
        
//     }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grade = 86;
        $name = "Glend";
        $sex = "Female";
        $Address = "Calasiao";
        // $client = [ //associative array single dikmesion
        //     "name" => "Glend",
        //     "sex" => "Female",
        //     "Address" => "Calasiao",
        // ];
        
        $clients = array( //multidimensional array
            array("name"=>"Glend", "sex"=> "Female", "address" => "Dagupan"),
            array("name"=>"Jema", "sex"=> "female", "address" => "Laguna"),
            array("name"=>"Ella", "sex"=> "female", "address" => "Navotas")
            
        );
        $client = array();
        return view("client")->with ("grade", $grade)->with("name", $name)->with("sex", $sex)->with("Address", $Address)->with("clients",$clients);
    
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //tatawin 'yong form method is get no orm  method is get
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //may pupuntahan 'yong data method is post
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //method is get
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // method get 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //method put
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //method is delete
    }
}
//controller method 
//<a href"client/create">ADD CLIENT</a> //href="client/$id/edit
//<form action="clients" method=""> 
//parameter ay id {client} the id in table 



// //<form action="/posts/{{ $post->id }}" method="POST">
//     @csrf
//     @method('PUT') <!-- Tells Laravel this is an update, not a new creation -->

//     <input type="text" name="title" value="{{ $post->title }}">
//     <textarea name="content">{{ $post->content }}</textarea>
    
//     <button type="submit">Save Changes</button>
// </form>

// public function show(string $id)
// {
//     // 1. Find the post by ID, or throw a 404 error if it doesn't exist
//     $post = Post::findOrFail($id);

//     // 2. Return the view with the post data
//     return view('posts.show', ['post' => $post]);
// }

// public function show(string $id)
// {
//     // It "searches" the database for this EXACT ID
//     $user = User::find($id); 

//     if (!$user) {
//         return "User not found!";
//     }

//     return "Showing profile for: " . $user->name;
// // }

// public function update(Request $request, string $id)
// {
//     // 1. Validate the incoming form data
//     $request->validate([
//         'title' => 'required|max:255',
//         'content' => 'required',
//     ]);

//     // 2. Find the record in the database
//     $post = Post::findOrFail($id);

//     // 3. Update the record with the new data from the form
//     $post->update([
//         'title' => $request->title,
//         'content' => $request->content,
//     ]);

//     // 4. Redirect the user back with a success message
//     return redirect()->route('posts.show', $id)->with('success', 'Post updated successfully!');
// }