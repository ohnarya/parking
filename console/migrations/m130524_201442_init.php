<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('TB_USER', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email'                => $this->string()->notNull()->unique(),
            'history'              => $this->string(255),    
            'level'                => $this->smallInteger()->notNull()->defaultvalue(1),   // 1: user, 2: admin
            'status'               => $this->smallInteger()->notNull()->defaultValue(10),  // 0: deleted 1: active
            'permit'               => $this->string(50),
            'easyparking'          => $this->boolean()->notNull()->defaultValue(true),
            'easyexit'             => $this->boolean()->notNull()->defaultValue(true),
            'myhistory'            => $this->boolean()->notNull()->defaultValue(true),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->insert('TB_USER',['username'=>'admin',
                                 'auth_key'=>'vmE63l-oAZFRabHk1ZNDhHm7vlFMv3nf',
                                 'password_hash'=>'$2y$13$b/ivuBUmlzAGhj0PQYEVvO6oXk9QspKuLHmoPafTHTgRNrBiRuOgq',
                                 'email'=>'admin@gmail.com',
                                 'level'=>'2',
                                 'status'=>'10',
                                 'created_at'=>1468097874,
                                 'updated_at'=>1468097874
                                 ]);
                                 
        $this->insert('TB_USER',['username'=>'user',
                                 'auth_key'=>'HEBKw_uMMtF57tqTeYzV2--lNtX8FyvM',
                                 'password_hash'=>'$2y$13$JD1AO36xfoa7rwss3UO1yuKrqInnZBywoI1y/QusRUSY2mxJ7VfYK',
                                 'email'=>'user@gmail.com ',
                                 'level'=>'1',
                                 'status'=>'10',
                                 'created_at'=>1468349350,
                                 'updated_at'=>1468349350
                                 ]);
                                 
    }

    public function safeDown()
    {
        $this->dropTable('TB_USER');
    }
}
