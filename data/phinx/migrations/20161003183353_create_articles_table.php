<?php

use Phinx\Migration\AbstractMigration;

class CreateArticlesTable extends AbstractMigration
{
    public function up()
    {
        $this->table('articles', ['id' => false, 'primary_key' => 'article_uuid'])
            ->addColumn('article_uuid', 'binary', ['limit' => 16])
            ->addColumn('article_id', 'text')
            ->addColumn('slug', 'text', ['null' => true])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('published_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('type', 'integer')// see Core\Entity\ArticleType
            ->addColumn('status', 'integer')// active, not active, ...
            ->addColumn('admin_user_uuid', 'binary', ['limit' => 16])
            ->addForeignKey('admin_user_uuid', 'admin_users', 'admin_user_uuid', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addIndex('type', ['name' => 'type_INDEX'])
            ->addIndex('published_at', ['name' => 'published_at_INDEX'])
            ->create();
    }

    public function down()
    {
        $this->dropTable('articles');
    }
}
