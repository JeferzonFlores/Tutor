<?php

use App\Student;
use App\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        App\User::create([
            'username'=>'Ramiro',
            'name' => 'admin f',
            'email'=> 'lionhhh1996@gmail.com',
            'password' => bcrypt('1234567')

        ]);
        App\User::create([
            'username'=>'admin1',
            'name' => 'admin f',
            'email'=> 'lionhhh1996@gmail.com',
            'password' => bcrypt('1234567')

        ]);

        // Crear un estudiante de prueba
        if (!Student::where('username', 'estudiante')->first()) { // Cambiado 'email' a 'username'
            Student::create([
                'name' => 'Estudiante Ejemplo',
                'username' => 'estudiante', // Usar 'username'
                'student_id_number' => 'S12345',
                'phone' => '123456789',
                'password' => Hash::make('password'),
            ]);
            $this->command->info('Estudiante de prueba creado: estudiante / password');
        } else {
            $this->command->info('Estudiante de prueba ya existe.');
        }

        // Crear un docente de prueba
        if (!Teacher::where('username', 'docente')->first()) { // Cambiado 'email' a 'username'
            Teacher::create([
                'name' => 'Docente Ejemplo',
                'username' => 'docente', // Usar 'username'
                'employee_id_number' => 'T98765',
                'department' => 'Informática',
                'password' => Hash::make('password'),
            ]);
            $this->command->info('Docente de prueba creado: docente / password');
        } else {
            $this->command->info('Docente de prueba ya existe.');
        }
    }
}
