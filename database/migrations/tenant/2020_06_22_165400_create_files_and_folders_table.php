<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesAndFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->unsignedBigInteger('workspace_id')->index();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->cascadeOnDelete();

            $table->string('name')->nullable();
            $table->string('mime_type')->nullable();

            $table->string('original_filename')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('sha256_checksum')->nullable();
            $table->unsignedBigInteger('size');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 36);
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->unsignedBigInteger('workspace_id')->index();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->cascadeOnDelete();

            $table->string('name')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
        Schema::dropIfExists('folders');
    }
}
