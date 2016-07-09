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
        
        // $this->insert('TB_USER',['username'=>'admin',
        //                          'auth_key'=>'wb0xstMoA1tm5jY8j5xtdTIXsyZQ98EP',
        //                          'password_hash'=>'$2y$13$4t8zlHs4i0kpzuPhfQ8.6.pMTYkC5W6oVKlgoBlf/WNHg8xbJ8nXm',
        //                          'email'=>'admin@gmail.com',
        //                          'status'=>'20',
        //                          'created_at'=>1466698045,
        //                          'updated_at'=>1466698045
        //                          ]);
                                 
        // $this->insert('TB_USER',['username'=>'user',
        //                          'auth_key'=>'-EUJ2F7fCl-8A4mlxy5s_Usptlnksy71',
        //                          'password_hash'=>'$2y$13$1CIo6uc4/fsb9Fu5uk0A6OVHc.CDIHW8mOU.YCTPonU2BFtggcloW',
        //                          'email'=>'user@gmail.com ',
        //                          'status'=>'10',
        //                          'created_at'=>1466698045,
        //                          'updated_at'=>1466698045
        //                          ]);
                                 
    }

    public function safeDown()
    {
        $this->dropTable('TB_USER');
    }
}
