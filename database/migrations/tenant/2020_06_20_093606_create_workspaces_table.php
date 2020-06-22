<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role_workspace', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('role_id')->index();
            $table->foreign('role_id')->references('id')->on(config('permission.table_names')['roles'])->cascadeOnDelete();

            $table->unsignedBigInteger('workspace_id')->index();
            $table->foreign('workspace_id')->references('id')->on('workspaces')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workspaces');
        Schema::dropIfExists('role_workspace');
    }
}
