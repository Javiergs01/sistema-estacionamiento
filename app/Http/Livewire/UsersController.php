<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Renta;
use Livewire\Component;
use Livewire\WithPagination;



class UsersController extends Component
{
	use WithPagination;

	//properties
	public  $tipo = 'Elegir', $nombre, $telefono, $email, $direccion, $movil, $password;
	public  $selected_id, $search;
	public  $action = 1;
	private $pagination = 5;
	public  $tipos;


	public function render()
	{

		if (strlen($this->search) > 0) {
			return view('livewire.users.component', [
				'info' => User::where('nombre', 'like', '%' .  $this->search . '%')
					->paginate($this->pagination),
			])->extends('layouts.template')->section('content');
		} else {

			$info = User::orderBy('id', 'desc')
				->paginate($this->pagination);

			return view('livewire.users.component', [
				'info' => $info,
			])->extends('layouts.template')->section('content');
		}
	}

	//permite la búsqueda cuando se navega entre el paginado
	public function updatingSearch()
	{
		$this->gotoPage(1);
	}

	//activa la vista edición o creación
	public function doAction($action)
	{
		$this->resetInput();
		$this->action = $action;
	}

	//método para reiniciar variables
	private function resetInput()
	{
		$this->nombre = '';
		$this->tipo = 'Elegir';
		$this->telefono = '';
		$this->email = '';
		$this->movil = '';
		$this->direccion = '';
		$this->password = '';
		$this->selected_id = null;
		$this->action = 1;
		$this->search = '';
		//$this->jerarquia =null;
	}

	//buscamos el registro seleccionado y asignamos la info a las propiedades
	public function edit($id)
	{
		$record = User::findOrFail($id);
		$this->selected_id = $id;
		$this->nombre = $record->nombre;
		$this->telefono = $record->telefono;
		$this->movil = $record->movil;
		$this->email = $record->email;
		$this->direccion = $record->direccion;
		$this->tipo = $record->tipo;
		$this->action = 2;
	}


	//método para registrar y/o actualizar registros
	public function StoreOrUpdate()
	{

		$this->validate([
			'nombre' => 'required',
			'password'  => 'required',
			'email'   => 'required|email',
			'tipo'   => 'not_in:Elegir'
		]);


		if ($this->selected_id <= 0) {

			$user =  User::create([
				'nombre' => $this->nombre,
				'telefono' => $this->telefono,
				'movil' => $this->movil,
				'tipo' => $this->tipo,
				'email' => $this->email,
				'direccion' => $this->direccion,
				'password' => bcrypt($this->password)
			]);
		} else {

			$user = User::find($this->selected_id);
			$user->update([
				'nombre' => $this->nombre,
				'telefono' => $this->telefono,
				'movil' => $this->movil,
				'tipo' => $this->tipo,
				'email' => $this->email,
				'direccion' => $this->direccion,
				'password' => bcrypt($this->password)
			]);
		}


		if ($this->selected_id)
			$this->emit('msgok', 'Usuario Actualizado');
		else
			$this->emit('msgok', 'Usuario Creado');


		$this->resetInput();
	}


	//escuchar eventos y ejecutar acción solicitada
	protected $listeners = [
		'deleteRow'     => 'destroy'
	];


	//método para eliminar un registro dado
	public function destroy($id)
	{
		if ($id) {

			if ($id == auth()->user()->id) {
				$this->emit('msg-error', "Este usuario tiene una sesión abierta, no es posible eliminarlo");
				return;
			}


			$records = Renta::where('user_id', $id)->count();
			if ($records > 0) {
				$this->emit('msg-error', "No es posible eliminar el registro porque hay rentas asociadas al usuario");
			} else {
				$user = User::where('id', $id);
				$user->delete();
				$this->resetInput();
				$this->emit('msgok', "Usuario eliminado de sistema");
			}
		}
	}
}
