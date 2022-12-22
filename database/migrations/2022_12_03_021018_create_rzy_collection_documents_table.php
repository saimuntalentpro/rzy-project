<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRzyCollectionDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rzy_collection_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rzy_collection_id')->constrained('rzy_collections')->onDelete('cascade');
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
        Schema::dropIfExists('rzy_collection_documents');
    }
}
