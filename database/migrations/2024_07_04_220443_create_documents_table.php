<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_label')->unique();
            $table->string('document_url');
            $table->string('document_type'); // ['pdf', 'doc', 'docx', 'img', 'xls', 'pptx']
            $table->text('document_description');
            $table->float('document_size', precision:53);
            $table->timestamps(precision:0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
