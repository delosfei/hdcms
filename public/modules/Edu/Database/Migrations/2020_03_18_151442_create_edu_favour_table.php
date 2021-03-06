<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 点赞
 * @package
 */
class CreateEduFavourTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('edu_favour', function (Blueprint $table) {
      $table->bigIncrements('id');
      table_foreign_site($table);
      table_foreign_user($table);
      $table->unsignedBigInteger('favour_id');
      $table->string('favour_type');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('edu_favour');
  }
}
