<?php

//send respose
function send_success($message, $data){

    $response = [
         'success' => true,
         'message' => $message,
         'data'    =>  $data
    ];

    return response()->json($response);
}

//send_error
function send_error($message, $errors = [] , $code = 404){

     $response = [
          'success' => false,
          'message' => $message,
     ];

     !empty($errors) ? $response['errors'] = $errors : null;
     return response()->json($response,$code);
}