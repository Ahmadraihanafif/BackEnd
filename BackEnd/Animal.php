<?php

# membuat class Animal
class Animal
{
    # property animals
    public $data;
    public $Animal;
    # method constructor - mengisi data awal
    # parameter: data hewan (array)
    public function __construct($data)
    {
        $this->Animal = array('Kucing', 'Anjing', 'Tikus');
    }

    # method index - menampilkan data animals
    public function index()
    {
        foreach ($this->Animal as $key => $nama_hewan) {
            echo ($key + 1) . '.' . $nama_hewan;
            echo "<br/>";
        }
        # gunakan foreach untuk menampilkan data animals (array)
    }

    # method store - menambahkan hewan baru
    # parameter: hewan baru
    public function store($data)
    {
        array_push($this->Animal, $data);
        # gunakan method array_push untuk menambahkan data baru
    }

    # method update - mengupdate hewan
    # parameter: index dan hewan baru
    public function update($index, $data)
    {
        array_splice($this->Animal, $index, 1, $data);
    }


    # method delete - menghapus hewan
    # parameter: index
    public function destroy($index)
    {
        unset($this->Animal[$index]);
        # gunakan method unset atau array_splice untuk menghapus data array
    }
}

$Animal = new Animal([]);

echo "Index - Menampilkan seluruh hewan <br>";
$Animal->index();
echo "<br>";

echo "Store - Menambahkan hewan baru <br>";
$Animal->store('Burung Onta');
$Animal->index();
echo "<br>";

echo "Update - Mengupdate hewan <br>";
$Animal->update(0, 'Kucing Liar');
$Animal->index();
echo "<br>";

echo "Destroy - Menghapus hewan <br>";
$Animal->destroy(1);
$Animal->index();
echo "<br>";
