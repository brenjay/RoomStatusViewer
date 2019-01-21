<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('number');
            $table->string('full_name');
            
            $table->boolean('cleaned')->default(false);
            $table->boolean('passing')->default(false);
            $table->date('last_cleaned')->nullable()->default(null);
            $table->date('last_checked')->nullable()->default(null);
            $table->integer('bulb_hours')->nullable()->unsigned()->default(null);
            
            $table->integer('building')->nullable()->unsigned()->default(null);
            $table->foreign('building')->references('id')->on('buildings')->onDelete('cascade');
            
            $table->integer('assigned_to')->nullable()->unsigned()->default(null);
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            
            $table->integer('cleaned_by')->nullable()->unsigned()->default(null);
            $table->foreign('cleaned_by')->references('id')->on('users')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    Schema::dropIfExists('rooms');
        
    Schema::table('rooms', function (Blueprint $table) {
        $table->dropForeign(['building']);
        $table->dropColumn(['building']);
        
        $table->dropForeign(['assigned_to']);
        $table->dropColumn(['assigned_to']);
        
        $table->dropForeign(['cleaned_by']);
        $table->dropColumn(['cleaned_by']);
    });
    
    }
}
