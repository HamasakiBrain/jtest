<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function formCreate(Request $request){
       $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:25'],
            'message' => ['required', 'string', 'max:255'],
        ]);



       $name = $request->get('name');
       $message = $request->get('message');
       $phone = $request->get('phone');
        Form::create([
            'name' => $name,
            'phone' => $phone,
            'message' => $message
       ]);

       if(file_exists(env('FORM_FILE_NAME')) ) {
           $file = fopen(env('FORM_FILE_NAME'), 'a');
           fwrite($file, "${name}:${phone}:${message}". PHP_EOL);
           fclose($file);
       } else {
           $file = fopen(env('FORM_FILE_NAME'), 'w');
           fwrite($file, "${name}:${phone}:${message}". PHP_EOL);
           fclose($file);
       }
       return response(['message' => 'Data sent successfully']);
    }
}
