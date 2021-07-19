<?php namespace Creator\Movies\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateCreatorMovies extends Migration
{
    public function up()
    {
        Schema::table('creator_movies_', function($table)
        {
            $table->string('slug')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('creator_movies_', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
