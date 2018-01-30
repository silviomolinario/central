<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                CREATE FUNCTION `PRODUTO_CODE`() RETURNS varchar(8) CHARSET latin1
                BEGIN

                    DECLARE codigo VARCHAR(8) DEFAULT "" ;

                    WHILE LENGTH(codigo) = 0 DO
                                                SET @newCodigo = (
                                                                        SELECT concat(
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1),
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1),
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1),
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1),
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1),
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1),
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1),
                                                                                substring("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", rand()*36+1, 1)
                                                                        ) AS newCodigo);

                        SELECT COUNT(*) INTO @rcount FROM produtos WHERE pro_codigo_principal = @newCodigo ;

                        IF @rcount = 0 THEN
                            SET codigo = @newCodigo ;
                        END IF ;

                    END WHILE ;

                    RETURN codigo ;
                END
    
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION `PRODUTO_CODE`');
    }
}
