<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDataTable extends Migration
{
    public function up()
    {
        Schema::create('form_data', function (Blueprint $table) {
            $table->id(); 
            $table->string('uuid')->unique(); 
            $table->string('name');
            $table->string('surname');
            $table->string('site');
            $table->string('status')->default('New')->nullable();
            $table->string('type');
            $table->text('file_client')->nullable(); 
            $table->integer('numberArticles')->nullable();
            $table->string('aocType')->nullable();
            $table->string('documentSearch')->nullable();
            $table->string('language')->nullable();
            $table->string('nbeName')->nullable();
            $table->string('documentSearchNom')->nullable();
            $table->string('languageName')->nullable();
            $table->string('nbeNameTrait')->nullable();
            $table->string('job')->nullable();
            $table->string('numberLines')->nullable();
            $table->string('jobNbe')->nullable();
            $table->string('sector')->nullable();
            $table->string('projectName')->nullable();
            $table->string('typeMillion')->nullable();
            $table->string('mainFunction')->nullable();
            $table->string('elementaryFunction')->nullable();
            $table->string('numberLinesNbe')->nullable();
            $table->string('technicalPost')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_data');
    }
}