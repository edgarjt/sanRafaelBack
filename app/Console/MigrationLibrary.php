<?php


namespace App\Console;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationLibrary extends Migration
{
    public function run() {

        if (Schema::hasTable('yegua')){
            if (!Schema::hasColumn('yegua', 'yeg_altura')){
                Schema::table('yegua', function (Blueprint $table){
                   $table->string('yeg_altura')->nullable()->after('yeg_semental');
                });
            }
        }

        if (Schema::hasTable('caballo')){
            if (!Schema::hasColumn('caballo', 'cab_altura')){
                Schema::table('caballo', function (Blueprint $table){
                    $table->string('cab_altura')->nullable()->after('cab_semental');
                });
            }
        }

        if (Schema::hasTable('caballo')){
            if (Schema::hasColumn('caballo', 'cab_nacimiento')){
                Schema::table('caballo', function (Blueprint $table) {
                    $table->string('cab_nacimiento')->nullable()->change();
                });
            }
        }

        if (Schema::hasTable('yegua')){
            if (Schema::hasColumn('yegua', 'yeg_nacimiento')){
                Schema::table('yegua', function (Blueprint $table) {
                    $table->string('yeg_nacimiento')->nullable()->change();
                });
            }
        }

        if (Schema::hasTable('trofeoCaballo')){
            if (Schema::hasColumn('trofeoCaballo', 'trf_foto')){
                Schema::table('trofeoCaballo', function (Blueprint $table) {
                    $table->string('trf_foto')->nullable()->change();
                });
            }
        }

        if (Schema::hasTable('trofeoYegua')){
            if (Schema::hasColumn('trofeoYegua', 'trf_foto')){
                Schema::table('trofeoYegua', function (Blueprint $table) {
                    $table->string('trf_foto')->nullable()->change();
                });
            }
        }

        if (Schema::hasTable('slider')){
            if (Schema::hasColumn('slider', 'sli_link')){
                Schema::table('slider', function (Blueprint $table) {
                    $table->string('sli_link')->nullable()->change();
                });
            }
        }

        if (Schema::hasTable('infoWeb')){
            if (Schema::hasColumn('infoWeb', 'inf_logo')){
                Schema::table('infoWeb', function (Blueprint $table) {
                    $table->string('inf_logo')->nullable()->change();
                });
            }
        }

        if (Schema::hasTable('infoWeb')){
            if (!Schema::hasColumn('infoWeb', 'inf_dir')){
                Schema::table('infoWeb', function (Blueprint $table){
                    $table->string('inf_dir')->nullable()->after('inf_historia');
                });
            }
        }
        if (Schema::hasTable('infoWeb')){
            if (!Schema::hasColumn('infoWeb', 'inf_hora')){
                Schema::table('infoWeb', function (Blueprint $table){
                    $table->string('inf_hora')->nullable()->after('inf_dir');
                });
            }
        }

        if (Schema::hasTable('infoWeb')){
            if (!Schema::hasColumn('infoWeb', 'inf_facebook')){
                Schema::table('infoWeb', function (Blueprint $table){
                    $table->string('inf_facebook')->nullable()->after('inf_hora');
                });
            }
        }

        if (Schema::hasTable('infoWeb')){
            if (!Schema::hasColumn('infoWeb', 'inf_instagram')){
                Schema::table('infoWeb', function (Blueprint $table){
                    $table->string('inf_instagram')->nullable()->after('inf_facebook');
                });
            }
        }

        if (Schema::hasTable('infoWeb')){
            if (!Schema::hasColumn('infoWeb', 'inf_twitter')){
                Schema::table('infoWeb', function (Blueprint $table){
                    $table->string('inf_twitter')->nullable()->after('inf_instagram');
                });
            }
        }

        printf("\e[32mSuccess migrate columns \033[0m \n");
    }
}
