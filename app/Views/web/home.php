<?php
use App\Models\User;

$query1 = User::select(['`id`', '`name`', '`email`'])->get();
echo $query1 . '<br>';
$query2 = User::where('name','like','%abc%')->where('email','=','abc@gmail.com')->get();
echo $query2 . '<br>';
echo "Home page";