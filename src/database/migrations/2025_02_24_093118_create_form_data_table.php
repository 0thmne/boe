<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDataTable extends Migration
{
    public function up()
    {
        Schema::create('form_data', function (Blueprint $table) {
            $table->string('nom');
            $table->string('prenom');
            $table->string('site');
            $table->string('id');
            $table->string('type');
            $table->string('fichier')->nullable();
            $table->integer('nombreArticles')->nullable();
            $table->string('aocType')->nullable();
            $table->string('rechercheDoc')->nullable();
            $table->string('langue')->nullable();
            $table->string('nbeNom')->nullable();
            $table->string('fichierNom')->nullable();
            $table->string('rechercheDocNom')->nullable();
            $table->string('langueNom')->nullable();
            $table->string('nbeNomTrait')->nullable();
            $table->string('metier')->nullable();
            $table->string('nombreLignes')->nullable();
            $table->string('fichierNbe')->nullable();
            $table->string('metierNbe')->nullable();
            $table->string('secteur')->nullable();
            $table->string('nomProjet')->nullable();
            $table->string('typeMillion')->nullable();
            $table->string('fonctionPrincipale')->nullable();
            $table->string('fonctionElementaire')->nullable();
            $table->string('nombreLignesNbe')->nullable();
            $table->string('posteTechnique')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_data');
    }
}
