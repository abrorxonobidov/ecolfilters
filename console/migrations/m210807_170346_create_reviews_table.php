<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 * - `{{%product}}`
 */
class m210807_170346_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'modifier_id' => $this->integer(),
            'created_at' => $this->datetime()->notNull()->defaultValue(new \yii\db\Expression('NOW()')),
            'updated_at' => $this->datetime()->notNull()->defaultValue(new \yii\db\Expression('NOW()')),
            'type_id' => $this->integer()->notNull()->defaultValue(1)->comment('Тип отзыва'),
            'product_id' => $this->integer(),
            'name' => $this->string(255)->notNull()->comment('Ваша имя'),
            'description' => $this->text()->notNull()->comment('Ваш отзыв'),
            'phone' => $this->string(255)->comment('Ваш номер телефона'),
            'status' => "ENUM('new', 'rejected', 'accepted') NOT NULL DEFAULT 'new'",
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-reviews-author_id}}',
            '{{%reviews}}',
            'author_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-reviews-author_id}}',
            '{{%reviews}}',
            'author_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `modifier_id`
        $this->createIndex(
            '{{%idx-reviews-modifier_id}}',
            '{{%reviews}}',
            'modifier_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-reviews-modifier_id}}',
            '{{%reviews}}',
            'modifier_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            '{{%idx-reviews-type_id}}',
            '{{%reviews}}',
            'type_id'
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-reviews-product_id}}',
            '{{%reviews}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-reviews-product_id}}',
            '{{%reviews}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
        $this->addCommentOnTable('{{%reviews}}', 'Отзывы');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-reviews-author_id}}',
            '{{%reviews}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-reviews-author_id}}',
            '{{%reviews}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-reviews-modifier_id}}',
            '{{%reviews}}'
        );

        // drops index for column `modifier_id`
        $this->dropIndex(
            '{{%idx-reviews-modifier_id}}',
            '{{%reviews}}'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            '{{%idx-reviews-type_id}}',
            '{{%reviews}}'
        );

        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-reviews-product_id}}',
            '{{%reviews}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-reviews-product_id}}',
            '{{%reviews}}'
        );

        $this->dropTable('{{%reviews}}');
    }
}
