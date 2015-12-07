<?php                                                                
                                                                     
use Illuminate\Database\Schema\Blueprint;                            
use Illuminate\Database\Migrations\Migration;                        
                                                                     
class CreateBreedersTable extends Migration {                        
                                                                     
        /**                                                          
         * Run the migrations.                                       
         *                                                           
         * @return void                                              
         */                                                          
        public function up()                                         
        {                                                            
                Schema::create('breeders', function(Blueprint $table)
                {                                                    
                        $table->increments('id');
                        $table->string('username');
                        $table->smallInteger("userID");
                        $table->string("speciesID");
                        $table->smallInteger("numFish");                    
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
                Schema::drop('breeders');
        }

}