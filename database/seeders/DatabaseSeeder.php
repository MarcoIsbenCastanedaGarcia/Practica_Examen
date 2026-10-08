<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Formulario;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'correo' =>
                'nutriologo@consultorio.com'
            ],
            [
                'nombre' =>
                    'Nutriólogo Principal',

                'password' =>
                    Hash::make(
                        'Nutriologo2026!'
                    ),

                'rol' =>
                    'nutriologo',
            ]
        );

        $consultaInicial =
            Servicio::updateOrCreate(
                [
                    'nombre' =>
                        'Consulta nutricional inicial'
                ],
                [
                    'descripcion' =>
                        'Valoración inicial, objetivos, hábitos y plan de trabajo.',

                    'precio' =>
                        650.00,

                    'duracion_minutos' =>
                        60,

                    'activo' =>
                        true,

                    'orden' =>
                        1,
                ]
            );

        Servicio::updateOrCreate(
            [
                'nombre' =>
                    'Consulta de seguimiento'
            ],
            [
                'descripcion' =>
                    'Revisión de avances y ajustes al plan nutricional.',

                'precio' =>
                    450.00,

                'duracion_minutos' =>
                    40,

                'activo' =>
                    true,

                'orden' =>
                    2,
            ]
        );

        Servicio::updateOrCreate(
            [
                'nombre' =>
                    'Valoración antropométrica'
            ],
            [
                'descripcion' =>
                    'Medición y evaluación de composición corporal.',

                'precio' =>
                    350.00,

                'duracion_minutos' =>
                    30,

                'activo' =>
                    true,

                'orden' =>
                    3,
            ]
        );

        $cita =
            Cita::firstOrCreate(
                [
                    'fecha' =>
                        today()
                            ->addDays(2)
                            ->toDateString(),

                    'hora' =>
                        '10:00:00',
                ],
                [
                    'servicio_id' =>
                        $consultaInicial->id,

                    'nombre_paciente' =>
                        'Paciente de Prueba',

                    'telefono' =>
                        '5551234567',

                    'correo' =>
                        'paciente@ejemplo.com',

                    'motivo' =>
                        'Quiero mejorar mis hábitos alimenticios.',

                    'estado' =>
                        'pendiente',
                ]
            );

        Formulario::firstOrCreate(
            [
                'cita_id' =>
                    $cita->id
            ],
            [
                'nombre_paciente' =>
                    'Paciente de Prueba',

                'fecha_nacimiento' =>
                    '2000-05-15',

                'sexo' =>
                    'Femenino',

                'peso' =>
                    62.50,

                'estatura' =>
                    165.00,

                'objetivo' =>
                    'Mejorar hábitos y composición corporal.',

                'antecedentes_personales' =>
                    'Sin antecedentes relevantes.',

                'antecedentes_familiares' =>
                    'Antecedentes familiares de diabetes.',

                'alergias' =>
                    'Ninguna conocida.',

                'medicamentos' =>
                    'Ninguno.',

                'habitos_alimenticios' =>
                    'Realiza tres comidas al día.',

                'actividad_fisica' =>
                    'Camina tres veces por semana.',

                'consumo_agua' =>
                    '1.5 litros al día',

                'observaciones' =>
                    'Registro de ejemplo para probar el sistema.',
            ]
        );
    }
}