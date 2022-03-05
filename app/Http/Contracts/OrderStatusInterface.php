<?php

namespace App\Http\Contracts;


interface OrderStatusInterface{
    public function index();
    public function show($id);
    public function store($credentials);
    public function update($credentials,$id);
    public function delete($id);
}
