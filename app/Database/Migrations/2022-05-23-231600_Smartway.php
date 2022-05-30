<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Smartway extends Migration
{
    public function up()
    {
        //usuarios
        $this->forge->addField([
			'IdUsu'          => [
				'type'           => 'INT',
				'constraint'     => 11,	
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'username' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Nombre de usuario',
			],
			'password' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Contraseña de usuario',
			],
            'email' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Correo de usuario',
			],
            'activo' => [
				'type'       => 'tinyint',
				'unsigned'       => true,
			],
            'descripción' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Descripción Uusario',
			],
            'image_url' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Imagen Usuario',
			],
            'user_tipe' => [
				'type'       => 'tinyint',	
				'unsigned'       => true,
			],
            'city' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Ciudad de Usuario',
			],
            'created_at timestamp default now() comment \'Fecha de creación del usuario\'',
		]);
		$this->forge->addKey('IdUsu', true);
		$this->forge->createTable('users',true, ['comment' => 'Tabla de usuarios']);
        
        //envios
        $this->forge->addField([
			'IdEnv'          => [
				'type'           => 'INT',
				'constraint'     => 11,	
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'IdUsu'          => [
				'type'           => 'INT',
				'constraint'     => 11,	
				'unsigned'       => true,
			],
			'Lon' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Longitud',
			],
            'Lat' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'comment' => 'Latitud',
			],
            'created_at timestamp default now() comment \'Fecha de creación del usuario\'',
		]);
		$this->forge->addKey('IdEnv', true);
		$this->forge->addForeignKey('IdUsu','users','IdUsu');
		$this->forge->createTable('envios',true, ['comment' => 'Tabla de usuarios']);
    }

    public function down()
    {
        $this->forge->dropTable('users',true);
        $this->forge->dropTable('envios',true);
    }
}
