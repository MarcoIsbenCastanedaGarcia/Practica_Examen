<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'citas',
            function (Blueprint $table) {

                $table->id();

                $table
                    ->foreignId(
                        'servicio_id'
                    )
                    ->nullable()
                    ->constrained(
                        'servicios'
                    )
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

                $table->string(
                    'nombre_paciente',
                    120
                );

                $table->string(
                    'telefono',
                    25
                );

                $table->string(
                    'correo',
                    150
                );

                $table->date(
                    'fecha'
                );

                $table->time(
                    'hora'
                );

                $table->text(
                    'motivo'
                );

                $table->enum(
                    'estado',
                    [
                        'pendiente',
                        'confirmada',
                        'cancelada'
                    ]
                )->default('pendiente');

                $table->timestamps();

                $table->unique(
                    [
                        'fecha',
                        'hora'
                    ],
                    'citas_fecha_hora_unique'
                );

                $table->index([
                    'estado',
                    'fecha'
                ]);

                $table->index(
                    'correo'
                );
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'citas'
        );
    }
};