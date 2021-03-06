<?php
/*
 * Migrations generated by: Skipper (http://www.skipper18.com)
 * Migration id: f7dd7677-71c9-4e98-b75c-aae4244e0148
 * Migration datetime: 2020-05-22 13:40:52.688358
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkipperMigrations2020052213405268 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo', function (Blueprint $table) {
            $table->bigInteger('pkCargo')->autoIncrement()->unsigned();
            $table->string('nome', 100);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->bigInteger('fkEmpresa')->nullable(true)->unsigned();
        });
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigInteger('pkEmpresa')->autoIncrement()->unsigned();
            $table->string('razaoSocial', 100);
            $table->string('nomeFantasia', 100);
            $table->string('cnpj', 20);
            $table->string('endereco', 50);
            $table->string('site', 100)->nullable(true);
            $table->string('telefone', 20);
            $table->string('redeSocial', 100)->nullable(true);
            $table->string('ramoDeAtividade', 100)->nullable(true);
            $table->string('responsavelMarketing', 100)->nullable(true);
            $table->string('responsavelFinanceiro', 100)->nullable(true);
            $table->string('responsavelComercial', 100)->nullable(true);
            $table->integer('numero')->nullable(true);
            $table->string('complemento', 100)->nullable(true);
            $table->string('bairro', 100)->nullable(true);
            $table->string('cidade', 100)->nullable(true);
            $table->string('estado', 100)->nullable(true);
            $table->string('cep', 15)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->unique(['cnpj'], 'empresa_cnpj_unique');

        });
        Schema::create('gestor', function (Blueprint $table) {
            $table->bigInteger('pkGestor')->autoIncrement()->unsigned();
            $table->bigInteger('fkSetor')->nullable(true)->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->bigInteger('fkEmpresa')->nullable(true)->unsigned();
            $table->bigInteger('fkUsuario')->nullable(true)->unsigned();
            $table->boolean('ehmaster')->nullable(true);
        });
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigInteger('pkUsuario')->autoIncrement()->unsigned();
            $table->string('nome', 100);
            $table->string('email', 100);
            $table->string('cpf', 20);
            $table->string('telefone', 15);
            $table->string('urlImage', 100)->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->bigInteger('fkEmpresa')->nullable(true)->unsigned();
            $table->bigInteger('fkSetor')->nullable(true)->unsigned();
            $table->bigInteger('fkCargo')->nullable(true)->unsigned();
            $table->string('facebook')->nullable(true);
            $table->string('instagram')->nullable(true);
            $table->string('twitter')->nullable(true);
            $table->string('linkedin')->nullable(true);
            $table->string('site')->nullable(true);
            $table->string('password')->nullable(true);
            $table->boolean('administrador')->nullable(true);
            $table->unique(['cpf'], 'pessoa_cpf_unique');
            $table->unique(['email'], 'pessoa_email_unique');
        });
        Schema::create('setor', function (Blueprint $table) {
            $table->bigInteger('pkSetor')->autoIncrement()->unsigned();
            $table->string('nome', 100);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->bigInteger('fkEmpresa')->nullable(true)->unsigned();
        });


        Schema::create('materias', function (Blueprint $table) {
            $table->bigInteger('pkMateria')->autoIncrement()->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->text('titulo');
            $table->longText('descricao')->nullable(true);
            $table->bigInteger('fkCategoria')->nullable(true)->unsigned();
        });
        Schema::create('items', function (Blueprint $table) {
            $table->bigInteger('pkItem')->autoIncrement()->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->bigInteger('fkMateria')->nullable(true)->unsigned();
            $table->bigInteger('fkTipoDeItem')->nullable(true)->unsigned();
            $table->longText('texto')->nullable(true);
            $table->longText('videoIncorporado')->nullable(true);
            $table->integer('ordem')->nullable(true);
            $table->float('pontuacaoPorQuestao', 8, 2)->nullable(true);
            $table->float('minimoAprovacao', 8, 2)->nullable(true);
            $table->text('enunciado')->nullable(true);
        });
        Schema::create('tipo_deitems', function (Blueprint $table) {
            $table->bigInteger('pkTipoDeItem')->autoIncrement()->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->text('descricao')->nullable(true);
        });

        Schema::create('respostas', function (Blueprint $table) {
            $table->bigInteger('fkQuestoes')->nullable(true)->unsigned();
            $table->bigInteger('pkRespostas')->autoIncrement()->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->string('texto')->nullable(true);
            $table->boolean('correta')->nullable(true);
        });
        Schema::create('alertas', function (Blueprint $table) {
            $table->bigInteger('pkAlerta')->autoIncrement()->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->text('mensagem')->nullable(true);
            $table->bigInteger('fkSetor')->nullable(true)->unsigned();
            $table->bigInteger('fkUsuario')->nullable(true)->unsigned();
            $table->bigInteger('grupo')->nullable(true);
            $table->bigInteger('fkEmpresa')->nullable(true)->unsigned();
            $table->string('titulo')->nullable(true);
        });
        Schema::create('categorias', function (Blueprint $table) {
            $table->bigInteger('pkCategoria')->autoIncrement()->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->bigInteger('fkEmpresa')->nullable(true)->unsigned();
            $table->string('titulo')->nullable(true);
        });
        Schema::create('usuario_respostas', function (Blueprint $table) {
            $table->bigInteger('fkRespostas')->unsigned();
            $table->bigInteger('fkUsuario')->unsigned();
            $table->primary(['fkRespostas','fkUsuario']);
        });
        Schema::create('questoes', function (Blueprint $table) {
            $table->bigInteger('pkQuestoes')->autoIncrement()->unsigned();
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);
            $table->string('enunciado')->nullable(true);
            $table->bigInteger('fkItem')->nullable(true)->unsigned();
        });
        Schema::table('cargo', function (Blueprint $table) {
            $table->foreign('fkEmpresa')->references('pkEmpresa')->on('empresa');
        });
        Schema::table('gestor', function (Blueprint $table) {
            $table->foreign('fkEmpresa')->references('pkEmpresa')->on('empresa');
        });
        Schema::table('gestor', function (Blueprint $table) {
            $table->foreign('fkSetor')->references('pkSetor')->on('setor');
        });
        Schema::table('gestor', function (Blueprint $table) {
            $table->foreign('fkUsuario')->references('pkUsuario')->on('usuario');
        });
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('fkEmpresa')->references('pkEmpresa')->on('empresa');
        });
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('fkSetor')->references('pkSetor')->on('setor');
        });
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('fkCargo')->references('pkCargo')->on('cargo');
        });
        Schema::table('setor', function (Blueprint $table) {
            $table->foreign('fkEmpresa')->references('pkEmpresa')->on('empresa');
        });


        Schema::table('materias', function (Blueprint $table) {
            $table->foreign('fkCategoria')->references('pkCategoria')->on('categorias');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('fkMateria')->references('pkMateria')->on('materias');
        });
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('fkTipoDeItem')->references('pkTipoDeItem')->on('tipo_deitems');
        });

        Schema::table('respostas', function (Blueprint $table) {
            $table->foreign('fkQuestoes')->references('pkQuestoes')->on('questoes');
        });

        Schema::table('alertas', function (Blueprint $table) {
            $table->foreign('fkSetor')->references('pkSetor')->on('setor');
        });
        Schema::table('alertas', function (Blueprint $table) {
            $table->foreign('fkUsuario')->references('pkUsuario')->on('usuario');
        });
        Schema::table('alertas', function (Blueprint $table) {
            $table->foreign('fkEmpresa')->references('pkEmpresa')->on('empresa');
        });
        Schema::table('categorias', function (Blueprint $table) {
            $table->foreign('fkEmpresa')->references('pkEmpresa')->on('empresa');
        });
        Schema::table('questoes', function (Blueprint $table) {
            $table->foreign('fkItem')->references('pkItem')->on('items');
        });

        Schema::table('usuario_respostas', function (Blueprint $table) {
            $table->foreign('fkRespostas')->references('pkRespostas')->on('respostas');
            $table->foreign('fkUsuario')->references('pkUsuario')->on('usuario');
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_respostas', function (Blueprint $table) {
            $table->dropForeign('respostas_pk_respostas');
            $table->dropForeign('usuario_pk_usuario');
        });
        if (Schema::hasTable('questoes')) {
            Schema::table('questoes', function (Blueprint $table) {
                $table->dropForeign(['fkQuestionario']);
            });
        }
        if (Schema::hasTable('categorias')) {
            Schema::table('categorias', function (Blueprint $table) {
                $table->dropForeign(['fkEmpresa']);
            });
        }
        if (Schema::hasTable('alertas')) {
            Schema::table('alertas', function (Blueprint $table) {
                $table->dropForeign(['fkEmpresa']);
            });
        }
        if (Schema::hasTable('alertas')) {
            Schema::table('alertas', function (Blueprint $table) {
                $table->dropForeign(['fkUsuario']);
            });
        }
        if (Schema::hasTable('alertas')) {
            Schema::table('alertas', function (Blueprint $table) {
                $table->dropForeign(['fkSetor']);
            });
        }
        if (Schema::hasTable('menus')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->dropForeign(['pai']);
            });
        }
        if (Schema::hasTable('respostas')) {
            Schema::table('respostas', function (Blueprint $table) {
                $table->dropForeign(['fkQuestoes']);
            });
        }
        if (Schema::hasTable('questionarios')) {
            Schema::table('questionarios', function (Blueprint $table) {
                $table->dropForeign(['fkItem']);
            });
        }
        if (Schema::hasTable('items')) {
            Schema::table('items', function (Blueprint $table) {
                $table->dropForeign(['fkTipoDeItem']);
            });
        }
        if (Schema::hasTable('items')) {
            Schema::table('items', function (Blueprint $table) {
                $table->dropForeign(['fkMateria']);
            });
        }
        if (Schema::hasTable('materias')) {
            Schema::table('materias', function (Blueprint $table) {
                $table->dropForeign(['fkCategoria']);
            });
        }

        if (Schema::hasTable('redes_sociais')) {
            Schema::table('redes_sociais', function (Blueprint $table) {
                $table->dropForeign(['fkEmpresa']);
            });
        }
        if (Schema::hasTable('redes_sociais')) {
            Schema::table('redes_sociais', function (Blueprint $table) {
                $table->dropForeign(['fkTipoRedeSocial']);
            });
        }
        if (Schema::hasTable('redes_sociais')) {
            Schema::table('redes_sociais', function (Blueprint $table) {
                $table->dropForeign(['fkUsuario']);
            });
        }
        if (Schema::hasTable('setor')) {
            Schema::table('setor', function (Blueprint $table) {
                $table->dropForeign(['fkEmpresa']);
            });
        }
        if (Schema::hasTable('usuario')) {
            Schema::table('usuario', function (Blueprint $table) {
                $table->dropForeign(['fkCargo']);
            });
        }
        if (Schema::hasTable('usuario')) {
            Schema::table('usuario', function (Blueprint $table) {
                $table->dropForeign(['fkSetor']);
            });
        }
        if (Schema::hasTable('usuario')) {
            Schema::table('usuario', function (Blueprint $table) {
                $table->dropForeign(['fkEmpresa']);
            });
        }
        if (Schema::hasTable('gestor')) {
            Schema::table('gestor', function (Blueprint $table) {
                $table->dropForeign(['fkUsuario']);
            });
        }
        if (Schema::hasTable('gestor')) {
            Schema::table('gestor', function (Blueprint $table) {
                $table->dropForeign(['fkSetor']);
            });
        }
        if (Schema::hasTable('gestor')) {
            Schema::table('gestor', function (Blueprint $table) {
                $table->dropForeign(['fkEmpresa']);
            });
        }
        if (Schema::hasTable('cargo')) {
            Schema::table('cargo', function (Blueprint $table) {
                $table->dropForeign(['fkEmpresa']);
            });
        }
        Schema::dropIfExists('questoes');
        Schema::dropIfExists('usuario_respostas');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('alertas');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('respostas');
        Schema::dropIfExists('questionarios');
        Schema::dropIfExists('tipo_deitems');
        Schema::dropIfExists('items');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('temas');
        Schema::dropIfExists('tipos_redes_sociais');
        Schema::dropIfExists('redes_sociais');
        Schema::dropIfExists('setor');
        Schema::dropIfExists('usuario');
        Schema::dropIfExists('gestor');
        Schema::dropIfExists('empresa');
        Schema::dropIfExists('cargo');
    }
}
