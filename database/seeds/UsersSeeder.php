<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDeItem;
use App\Models\Usuario;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(\App\User::class, 5)->create();
        TipoDeItem::create([
            'pkTipoDeItem'  => 1,
            'descricao'     => 'Texto'
            ]);
        TipoDeItem::create([
            'pkTipoDeItem'  => 2,
            'descricao'     => 'Video'
            ]);
        TipoDeItem::create([
            'pkTipoDeItem'  => 3,
            'descricao'     => 'Questionario'
            ]);
        
        Usuario::create([
            'pkUsuario'     => 1,
            'nome'          => 'Brenner Cunha',
            'email'         => 'brennersc@gmail.com',
            'password'      => '$2y$10$vJfykP7PRwKsbv5aYF7VzOFo/IptsfK3Az9NmHFzt7trovmQNLtQC',
            'cpf'           => '1185905608',
            'telefone'      => '31983776219',
            'urlImage'      => NULL,
            'created_at'    => NOW(),
            'updated_at'    => NOW(),
            'fkEmpresa'     => NULL,
            'fkSetor'       => NULL,
            'fkCargo'       => NULL,
            'facebook'      => NULL,
            'instagram'     => NULL,
            'twitter'       => NULL,
            'linkedin'      => NULL,
            'site'          => NULL,
            'administrador' => 1
            ]);
        Usuario::create([
            'pkUsuario'     => 2,
            'nome'          => 'Lucas Borges',
            'email'         => 'ryok21@gmail.com',
            'password'      => '$2y$10$vJfykP7PRwKsbv5aYF7VzOFo/IptsfK3Az9NmHFzt7trovmQNLtQC',
            'cpf'           => '06460094608',
            'telefone'      => '31975380034',
            'urlImage'      => NULL,
            'created_at'    => NOW(),
            'updated_at'    => NOW(),
            'fkEmpresa'     => NULL,
            'fkSetor'       => NULL,
            'fkCargo'       => NULL,
            'facebook'      => NULL,
            'instagram'     => NULL,
            'twitter'       => NULL,
            'linkedin'      => NULL,
            'site'          => NULL,
            'administrador' => 1
        ]);
    }
}
