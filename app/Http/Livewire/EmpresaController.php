<?php

namespace App\Http\Livewire;

use DB;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class EmpresaController extends Component
{

    use WithFileUploads;

    public $nombre, $telefono, $email, $direccion, $logo, $tempImg;


    public function mount()
    {


        $empresa = Empresa::first();


        if ($empresa != null && $empresa->count() > 0) {
            $this->nombre = $empresa->nombre;
            $this->telefono = $empresa->telefono;
            $this->direccion = $empresa->direccion;
            $this->email = $empresa->email;
            //$this->logo = $empresa->logo;

            $this->tempImg = $empresa->logo;
        }
    }



    public function render()
    {
        return view('livewire.empresa.component')
            ->extends('layouts.template')
            ->section('content');
    }


    public function Guardar()
    {
        $rules = [
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
            'direccion' => 'required'
        ];

        $customMessages = [
            'nombre.required' => 'El campo nombre es requerido',
            'telefono.required' => 'El campo teléfono es requerido',
            'email.required' => 'El campo email es inválido',
            'direccion.required' => 'El campo dirección es requerido'
        ];


        $this->validate($rules, $customMessages);



        DB::table('empresa')->truncate(); //aliminar info


        //tarea
        $empresa = Empresa::create([
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion
        ]);


        if ($this->logo != null) {

            // delete previous image           
            if ($this->tempImg != null && file_exists('images/logo/' . $this->tempImg)) {
                unlink('images/logo/' . $this->tempImg);
            }
            if ($this->tempImg != null &&  File::exists(public_path('logos/' . $this->tempImg))) {
                unlink(public_path('logos/' . $this->tempImg));
            }

            // save new image 
            $customFileName = uniqid() . '_.' . $this->logo->extension();
            $this->logo->storeAs('', $customFileName, 'public2');

            // update db
            $empresa->logo = $customFileName;
            $empresa->save();
        }


        $this->tempImg = $empresa->logo;
        $this->reset('logo');
        $this->emit('msgok', 'Información de la empresa registrada');
    }
}
