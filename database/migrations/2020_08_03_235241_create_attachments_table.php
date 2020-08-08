<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->comment('UUID');
            $table->string('name')->comment('Nome original');
            $table->string('mime_type')->comment('MIME type');
            $table->string('extension')->comment('Extensão');
            $table->integer('size')->comment('Tamanho (KB)');
            $table->char('hash_md5', 32)->comment('MD5');
            $table->char('hash_sha256', 64)->comment('SHA256');
            $table->char('hash_sha512', 128)->comment('SHA512');
            $table->timestamp('created_at')->useCurrent()->comment('Data de criação');
            $table->timestamp('deleted_at')->nullable()->comment('Data de exclusão');
            $table->unsignedBigInteger('created_by')->comment('Criado por');
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('Excluido por');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
