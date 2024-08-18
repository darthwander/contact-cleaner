<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cnpj')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('webhook_url')->nullable();
            $table->string('api_token')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('delete_only_404')->default(false);
            $table->boolean('only_200')->default(false);
            $table->boolean('only_200_wp')->default(false);
            $table->boolean('code_487')->default(false);
            $table->boolean('code_487_wp')->default(false);
            $table->timestamps();

            // Index cnpj
            $table->index('cnpj');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop index cnpj
        Schema::table('companies', function (Blueprint $table) {
            $table->dropIndex(['cnpj']);
        });

        Schema::dropIfExists('companies');
    }
}
