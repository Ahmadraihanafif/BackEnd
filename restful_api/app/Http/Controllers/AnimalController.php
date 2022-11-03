<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

class AnimalController extends Controller
{
    public $animal = [
        ['id' => 1, 'nama' => 'Kucing'],
        ['id' => 2, 'nama' => 'Semut'],
        ['id' => 3, 'nama' => 'Kucing Hutan'],
        ['id' => 4, 'nama' => 'Burung Dara']

    ];

    public function index()
    {
        foreach ($this->animal as $a) {
            echo  $a['id'] . '. ' .  $a['nama'] . "<br>";
        }
    }
    public function store(Request $request)
    {
        array_push($this->animal, ['id' => 5, 'nama' => $request->nama]);
        $this->index();
    }
    public function update(Request $request, $id)
    {
        // array_splice($this->animal, $request->name, 1, $id);
        array_splice($this->animal, $id - 1, 1, [['id' => $id, 'nama' => $request->nama]]);
        $this->index();
    }
    public function destroy($id)
    {
        unset($this->animal[$id - 1]);
        $this->index();
    }
}
