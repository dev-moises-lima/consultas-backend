<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Paciente;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Paciente::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('sintomas');
            $table->decimal('porcentagem_dos_sintomas_sentidos');
            $table->string('condicao');
            $table->integer('pressao_arterial_diastolica');
            $table->integer('pressao_arterial_sistolica');
            $table->integer('frequencia_cardiaca');
            $table->integer('respiracao');
            $table->decimal('temperatura', places: 1);

            // $table->boolean("febre");
            // $table->boolean("coriza");
            // $table->boolean("nariz_entupido");
            // $table->boolean("cansaco");
            // $table->boolean("tosse");
            // $table->boolean("dor_de_cabeca");
            // $table->boolean("dores_no_corpo");
            // $table->boolean("mal_estar_geral");
            // $table->boolean("dor_de_garganta");
            // $table->boolean("dificuldade_de_respirar");
            // $table->boolean("falta_de_paladar");
            // $table->boolean("falta_de_olfato");
            // $table->boolean("dificuldade_de_locomocao");
            // $table->boolean("diarreia");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
