<?php

namespace Database\Seeders;

use App\Models\Tipo;
use App\Models\User;
use App\Models\Cajon;
use App\Models\Tarifa;
use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creación de usuarios
        User::create([
            'nombre' => 'Javier Garcia',
            'tipo' => 'Admin',
            'email' => 'javier@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'nombre' => 'Gonzalo Carreño',
            'tipo' => 'Empleado',
            'email' => 'gonzalo@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'nombre' => 'Alberto Salaz',
            'tipo' => 'Cliente',
            'email' => 'alberto@gmail.com',
            'password' => bcrypt('12345678')
        ]);




        //lista de permisos:
        Permission::create(['name' => 'dash']);


        //rentas
        Permission::create(['name' => 'rentas_index']);
        Permission::create(['name' => 'rentas_ticket_renta']);
        Permission::create(['name' => 'rentas_ticket_visita']);
        Permission::create(['name' => 'rentas_cobrar_ticket']);
        Permission::create(['name' => 'rentas_entradas_salidas']);
        Permission::create(['name' => 'rentas_buscar']);


        //tickets extraviados
        Permission::create(['name' => 'extraviados_index']);
        Permission::create(['name' => 'extraviados_salidas']);

        //empresa
        Permission::create(['name' => 'empresa_index']);
        Permission::create(['name' => 'empresa_create']);

        //cajones
        Permission::create(['name' => 'cajones_index']);
        Permission::create(['name' => 'cajones_create']);
        Permission::create(['name' => 'cajones_edit']);
        Permission::create(['name' => 'cajones_destroy']);

        //tipos de vehículos
        Permission::create(['name' => 'tipos_index']);
        Permission::create(['name' => 'tipos_create']);
        Permission::create(['name' => 'tipos_edit']);
        Permission::create(['name' => 'tipos_destroy']);

        //roles
        Permission::create(['name' => 'roles_index']);
        Permission::create(['name' => 'roles_create']);
        Permission::create(['name' => 'roles_edit']);
        Permission::create(['name' => 'roles_destroy']);
        Permission::create(['name' => 'roles_asignar']);
        //permisos
        Permission::create(['name' => 'permisos_create']);
        Permission::create(['name' => 'permisos_edit']);
        Permission::create(['name' => 'permisos_destroy']);
        Permission::create(['name' => 'permisos_asignar']);


        //tarifas
        Permission::create(['name' => 'tarifas_index']);
        Permission::create(['name' => 'tarifas_create']);
        Permission::create(['name' => 'tarifas_edit']);
        Permission::create(['name' => 'tarifas_destroy']);


        //cortes de caja
        Permission::create(['name' => 'cortes_index']);
        Permission::create(['name' => 'cortes_create']);
        Permission::create(['name' => 'cortes_imprimir']);

        //entradas y salidas de dinero (movimientos)
        Permission::create(['name' => 'movimientos_index']);
        Permission::create(['name' => 'movimientos_create']);
        Permission::create(['name' => 'movimientos_edit']);
        Permission::create(['name' => 'movimientos_destroy']);


        //reporte de ventas diarias
        Permission::create(['name' => 'reporte_ventasdiarias_index']);
        Permission::create(['name' => 'reporte_ventasdiarias_exportar']);

        //reporte de ventas por fecha
        Permission::create(['name' => 'reporte_ventasporfecha_index']);
        Permission::create(['name' => 'reporte_ventasporfecha_exportar']);

        //reporte de rentas próximas a vencer
        Permission::create(['name' => 'reporte_rentasavencer_index']);
        Permission::create(['name' => 'reporte_rentasavencer_exportar']);
        Permission::create(['name' => 'reporte_rentasavencer_salidas']);


        //usuarios
        Permission::create(['name' => 'usuarios_index']);
        Permission::create(['name' => 'usuarios_create']);
        Permission::create(['name' => 'usuarios_edit']);
        Permission::create(['name' => 'usuarios_destroy']);


        //lista de roles
        $admin    = Role::create(['name' => 'Admin']);
        $empleado = Role::create(['name' => 'Empleado']);
        $cliente  = Role::create(['name' => 'Cliente']);





        //asignar permisos a los roles
        $admin->givePermissionTo([
            'dash',
            'rentas_index',
            'rentas_ticket_renta',
            'rentas_ticket_visita',
            'rentas_cobrar_ticket',
            'rentas_entradas_salidas',
            'rentas_buscar',
            'extraviados_index',
            'extraviados_salidas',
            'empresa_index',
            'empresa_create',
            'cajones_index',
            'cajones_create',
            'cajones_edit',
            'cajones_destroy',
            'tipos_index',
            'tipos_create',
            'tipos_edit',
            'tipos_destroy',
            'roles_index',
            'roles_create',
            'roles_edit',
            'roles_destroy',
            'roles_asignar',
            'permisos_create',
            'permisos_edit',
            'permisos_destroy',
            'permisos_asignar',
            'tarifas_index',
            'tarifas_create',
            'tarifas_edit',
            'tarifas_destroy',
            'cortes_index',
            'cortes_create',
            'cortes_imprimir',
            'movimientos_index',
            'movimientos_create',
            'movimientos_edit',
            'movimientos_destroy',
            'reporte_ventasdiarias_index',
            'reporte_ventasdiarias_exportar',
            'reporte_ventasporfecha_index',
            'reporte_ventasporfecha_exportar',
            'reporte_rentasavencer_index',
            'reporte_rentasavencer_exportar',
            'reporte_rentasavencer_salidas',
            'usuarios_index',
            'usuarios_create',
            'usuarios_edit',
            'usuarios_destroy'
        ]);

        $empleado->givePermissionTo([
            'dash',
            'rentas_index',
            'rentas_ticket_renta',
            'rentas_ticket_visita',
            'rentas_cobrar_ticket',
            'rentas_entradas_salidas',
            'rentas_buscar',
            'extraviados_index',
            'extraviados_salidas',
            'tipos_index',
            'cortes_index',
            'cortes_create',
            'cortes_imprimir',
            'movimientos_index',
            'movimientos_create',
            'movimientos_edit',
            'movimientos_destroy',
            'reporte_ventasdiarias_index',
            'reporte_ventasdiarias_exportar',
            'reporte_ventasporfecha_index',
            'reporte_ventasporfecha_exportar',
            'reporte_rentasavencer_index',
            'reporte_rentasavencer_exportar',
            'reporte_rentasavencer_salidas',
        ]);


        //asignar rol al usuario admin
        $uAdmin = User::find(1);
        $uAdmin->assignRole('Admin');

        //asignar rol al usuario empleado
        $uEmpleado = User::find(2);
        $uEmpleado->assignRole('Empleado');


        //crear tipos de vehiculos base de sistema
        Tipo::create([
            'descripcion' => 'Coche',
            'imagen'      => 'coche.jpg'
        ]);
        Tipo::create([
            'descripcion' => 'Autobús',
            'imagen'      => 'autobus.jpg'
        ]);
        Tipo::create([
            'descripcion' => 'Motocicleta',
            'imagen'      => 'motocicleta.jpeg'
        ]);
        Tipo::create([
            'descripcion' => 'Cuatrimoto',
            'imagen'      => 'cuatrimoto.jpg'
        ]);
        Tipo::create([
            'descripcion' => 'Bicicleta',
            'imagen'      => 'bicicleta.jpg'
        ]);



        //crear cajones
        Cajon::create([
            'descripcion' => 'C1',
            'estatus'     => 'Disponible',
            'tipo_id'     => 1
        ]);
        Cajon::create([
            'descripcion' => 'C2',
            'estatus'     => 'Disponible',
            'tipo_id'     => 2
        ]);
        Cajon::create([
            'descripcion' => 'C3',
            'estatus'     => 'Disponible',
            'tipo_id'     => 3
        ]);
        Cajon::create([
            'descripcion' => 'C4',
            'estatus'     => 'Disponible',
            'tipo_id'     => 4
        ]);
        Cajon::create([
            'descripcion' => 'C5',
            'estatus'     => 'Disponible',
            'tipo_id'     => 5
        ]);


        //crear tarifas base de sistema
        Tarifa::create([
            'tiempo'       => 'Hora',
            'descripcion'  => 'Coche',
            'costo'        => 13,
            'jerarquia'    => 1,
            'tipo_id'         => 1
        ]);
        Tarifa::create([
            'tiempo'       => 'Hora',
            'descripcion'  => 'Autobús',
            'costo'        => 100,
            'jerarquia'    => 2,
            'tipo_id'         => 2
        ]);
        Tarifa::create([
            'tiempo'       => 'Hora',
            'descripcion'  => 'Motocicleta',
            'costo'        => 25,
            'jerarquia'    => 3,
            'tipo_id'         => 3
        ]);
        Tarifa::create([
            'tiempo'       => 'Hora',
            'descripcion'  => 'Cuatrimoto',
            'costo'        => 50,
            'jerarquia'    => 4,
            'tipo_id'         => 4
        ]);
        Tarifa::create([
            'tiempo'       => 'Hora',
            'descripcion'  => 'Bicicleta',
            'costo'        => 10,
            'jerarquia'    => 5,
            'tipo_id'         => 5
        ]);
        Tarifa::create([
            'tiempo'       => 'Mes',
            'descripcion'  => 'Pension Mensual',
            'costo'        => 25,
            'jerarquia'    => 5,
            'tipo_id'         => 1
        ]);




        //crear empresa
        Empresa::create([
            'nombre' => 'Inversiones Sunup',
            'telefono' => '949753048',
            'email' => 'inversionessunup@gmail.com',
            'direccion' => 'Av. José Pardo 251, Miraflores 15074, Lima, Perú',
            'logo' => 'logo.png'
        ]);
    }
}
