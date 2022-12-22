<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyAgreementDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_agreement_documents', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->index();
            $table->foreignId('rzy_agreement_id')->constrained('rzy_agreements')->onDelete('cascade');
            $table->string('document_title', 200)->nullable(false);
            $table->string('document_url', 200)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rzy_agreement_documents');
    }
}
