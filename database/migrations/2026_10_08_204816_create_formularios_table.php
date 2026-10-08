<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'formularios',
            function (Blueprint $table) {

                $table->id();

                $table
                    ->foreignId('cita_id')
                    ->nullable()
                    ->unique()
                    ->constrained('citas')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

                $table->string(
                    'nombre_paciente',
                    120
                );

                $table
                    ->date(
                        'fecha_nacimiento'
                    )
                    ->nullable();

                $table
                    ->string(
                        'sexo',
                        30
                    )
                    ->nullable();

                $table
                    ->decimal(
                        'peso',
                        5,
                        2
                    )
                    ->nullable();

                $table
                    ->decimal(
                        'estatura',
                        5,
                        2
                    )
                    ->nullable();

                $table
                    ->text('objetivo')
                    ->nullable();

                $table
                    ->text(
                        'antecedentes_personales'
                    )
                    ->nullable();

                $table
                    ->text(
                        'antecedentes_familiares'
                    )
                    ->nullable();

                $table
                    ->text('alergias')
                    ->nullable();

                $table
                    ->text('medicamentos')
                    ->nullable();

                $table
                    ->text(
                        'habitos_alimenticios'
                    )
                    ->nullable();

                $table
                    ->text(
                        'actividad_fisica'
                    )
                    ->nullable();

                $table
                    ->string(
                        'consumo_agua',
                        100
                    )
                    ->nullable();

                $table
                    ->text('observaciones')
                    ->nullable();

                $table->timestamps();

                $table->index(
                    'nombre_paciente'
                );
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'formularios'
        );
    }
};