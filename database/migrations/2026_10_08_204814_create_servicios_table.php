<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'servicios',
            function (Blueprint $table) {

                $table->id();

                $table->string(
                    'nombre',
                    120
                );

                $table
                    ->text('descripcion')
                    ->nullable();

                $table
                    ->decimal(
                        'precio',
                        10,
                        2
                    )
                    ->nullable();

                $table
                    ->unsignedSmallInteger(
                        'duracion_minutos'
                    )
                    ->nullable();

                $table
                    ->boolean('activo')
                    ->default(true);

                $table
                    ->unsignedSmallInteger(
                        'orden'
                    )
                    ->default(0);

                $table->timestamps();

                $table->index([
                    'activo',
                    'orden'
                ]);
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'servicios'
        );
    }
};